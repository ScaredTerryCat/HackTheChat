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
body{margin:0;display:flex;height:100vh;justify-content:center;align-items:center;padding-right:10px;padding-left:10px;}
body{max-width:100%;box-sizing:border-box;background-color:yellow;}
form{background-color:lightgreen;padding:10px;max-width:100%;box-sizing:border-box;}
input{max-width:100%;box-sizing:border-box;}
reder{color:red;}
</style>
</head>
<body>
<form method="post" action="">
<input type="text" name="username" id="username" placeholder="Username" required/>
<br><br>
<input type="password" name="password" id="password" placeholder="Password" required/>
<br><br>
<input type="submit" name="submit" id="submit" value="Login"/>
<?php
if(isset($_POST["username"]) && isset($_POST["password"])){
$username=$_POST["username"];
$password=$_POST["password"];
$query1="select * from Credentials where Username=? and Password=?;";
$configured1=mysqli_prepare($conn,$query1);
mysqli_stmt_bind_param($configured1,"ss",$username,$password);
mysqli_stmt_execute($configured1);
$result=mysqli_stmt_get_result($configured1);
$resultCount=0;
while($row=mysqli_fetch_assoc($result)){
$resultCount++;
}
if($resultCount==1){$_SESSION["currentUsername"]=$username;header("Location:m.php");}
else{echo "<br><reder>Credentials are not valid</reder>";}
}
?>
</form>
</body>
</html>
