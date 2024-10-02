<?php
session_start();
$dbUser=$_SESSION["dbUser"];
$dbPassword=$_SESSION["dbPassword"];
$dbHost=$_SESSION["dbHost"];
$dbName=$_SESSION["dbName"];
$conn=mysqli_connect($dbHost,$dbUser,$dbPassword,$dbName);

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{display:flex;justify-content:center;align-items:center;height:100vh;padding-left:10px;padding-right:10px;}
form{padding:10px;background-color:yellow;max-width:100%;box-sizing:border-box;border:3px solid skyblue;}
input{max-width:100%;box-sizing:border-box;border:1px solid lightgreen;}
body{background-color:green;}
#submit{background-color:black;color:white;border:0;border-top:2px solid gray;border-left:2px solid gray;}
reder{color:red;}
</style>
</head>
<body>
<form method="post" action="">
<input type="text" name="username" id="username" placeholder="Username" required/>
<br>
<br>
<input type="password" name="password" id="password" placeholder="Password" required/>
<br>
<br>
<input type="submit" name="submit" value="Sign Up" id="submit"/>
<?php
//bellow we will define some functions
//for validating the user input
function onlySpace($s){
$len=strlen($s);
for($i=0;$i<$len;$i++){
if($s[$i]!=' '){return false;}
}
return true;
}

?>
<?php
if(isset($_POST["username"]) && isset($_POST["password"])){
$username=$_POST["username"];
$password=$_POST["password"];
if(onlySpace($username) || onlySpace($password)){echo "<br><reder>Username and password cannot be formed of only spaces.</reder>";}
else{
$query1="select * from Credentials where Username=?;";
$configured1=mysqli_prepare($conn,$query1);
mysqli_stmt_bind_param($configured1,"s",$username);
mysqli_stmt_execute($configured1);
$result=mysqli_stmt_get_result($configured1);
$count=0;
while($row=mysqli_fetch_assoc($result)){$count++;if($count==1){echo"<br><reder>I don't have to explain to you why entered credentials are invalid.
Maybe I do not have to do anything...</reder>";break;}
}
if($count==0){
$query2="insert into Credentials (Username,Password) values (?,?);";
$configured2=mysqli_prepare($conn,$query2);
mysqli_stmt_bind_param($configured2,"ss",$username,$password);
mysqli_stmt_execute($configured2);
header("Location:login.php");
}
}
}
?>
</form>
</body>
</html>