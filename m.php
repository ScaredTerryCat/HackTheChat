<?php
session_start();
$currentUsername=$_SESSION["currentUsername"];
$dbName=$_SESSION["dbName"];
$dbPassword=$_SESSION["dbPassword"];
$dbUser=$_SESSION["dbUser"];
$dbHost=$_SESSION["dbHost"];
$conn=mysqli_connect($dbHost,$dbUser,$dbPassword,$dbName);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{margin:0;}
#showContainer{height:70vh;background-color:black;color:white;padding-left:10px;padding-right:10px;overflow-y:scroll;}
#inputContainer{height:30vh;background-color:skyblue;padding-top:10px;padding-left:10px;padding-right:10px;}
#messageForm{margin-bottom:10px;}
#messageInput{padding-left:10px;}
input{max-width:100%;box-sizing:border-box;}
img{max-width:100%;box-sizing:border-box;}
p{max-width:100%;box-sizing:border-box;}
greener{color:lightgreen;}
pinker{color:pink;}
#submitImage{background-color:lightgreen;}
</style>
</head>
<body>
<div id="showContainer">
<?php
function onlySpace($s){
$len=strlen($s);
for($i=0;$i<$len;$i++){
if($s[$i]!=' '){return false;}
}
return true;
}
if(isset($_POST["messageInput"]) && !onlySpace($_POST["messageInput"])){
$message=$_POST["messageInput"];
$_POST["messageInput"]=NULL;
$query2="insert into M(Username,Message) values(?,?);";
$configured2=mysqli_prepare($conn,$query2);
mysqli_stmt_bind_param($configured2,"ss",$currentUsername,$message);
mysqli_stmt_execute($configured2);
}
?>
<?php
if(isset($_FILES["f"])){
$targetDir="uploads/";
$targetFile=$targetDir.basename($_FILES["f"]["name"]);
move_uploaded_file($_FILES["f"]["tmp_name"],$targetFile);
$query3="insert into M(Username,Image) values(?,?);";
$configured3=mysqli_prepare($conn,$query3);
mysqli_stmt_bind_param($configured3,"ss",$currentUsername,$targetFile);
mysqli_stmt_execute($configured3);
$_FILES["f"]=NULL;
}
?>
<?php
$query1="select * from M;";
$configured1=mysqli_prepare($conn,$query1);
mysqli_stmt_execute($configured1);
$result=mysqli_stmt_get_result($configured1);
while($row=mysqli_fetch_assoc($result)){
$username=$row["Username"];
$message=$row["Message"];
$image=$row["Image"];
if($message!=""){echo "<p><greener>$username</greener> <pinker>wrote :</pinker> $message</p>";}
else{echo "<greener>$username</greener> <pinker>posted the following : </pinker><img src=\"$image\"></img>";}
}
?>
</div>
<div id="inputContainer">
<form id="messageForm" action="" method="post">
<input id="messageInput" type="text" placeholder="Hi the chat" name="messageInput"/>
<input type="submit" name="submitMessage" value="Send Message"/>
</form>

<form id="imageForm" action="" method="post" enctype="multipart/form-data">
<input id="imageInput" type="file" name="f"/>
<input type="submit" name="submitImage" value="Send File (image?)" id="submitImage"/>
</form>
</div>
</body>
<script>
messages=document.getElementById("showContainer");
window.addEventListener("load",function(){messages.scrollTop=messages.scrollHeight;});
</script>

</html>