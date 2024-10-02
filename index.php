<?php
session_start();
$dbName="Database1";
$dbUser="root";
$dbPassword="";
$dbHost="localhost";
$_SESSION["dbName"]=$dbName;
$_SESSION["dbUser"]=$dbUser;
$_SESSION["dbPassword"]=$dbPassword;
$_SESSION["dbHost"]=$dbHost;
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{margin:0;text-align:center;color:lightgreen;background-color:black;}
#banner{background-color:darkred;padding-top:1px;padding-bottom:1px;border:3px solid lightgreen;margin-top:20px;margin-left:20px;margin-right:20px;border-radius:10px;margin-bottom:20px;}
#navBar{background-color:white;margin-left:20px;margin-right:20px;text-align:left;padding-left:10px;}
button{margin-top:10px;margin-bottom:10px;font-size:20px;margin-right:20px;color:white;background-color:black;}
a{color:white;text-decoration:none;}
#textAbout{margin-right:20px;margin-left:20px;background-color:darkblue;padding-top:10px;padding-bottom:5px;}
#spacer{background-color:skyblue;margin-right:10px;margin-left:10px;padding-top:10px;}
h2{margin:0;color:}
p{text-align:left;margin-left:10px;}
</style>
</head>
<body>
<div id="banner">
<h1>H. ackT. heC. hat</h1>
</div>
<div id="navBar">
<button><a href="login.php">Login</a></button><button><a href="signup.php">Sign up</a></button>
</div>
<div id="spacer"></div>
<div id="textAbout">
<h2>Hello ,</h2>
<p>Welcome to my very insercure ChatWebApp written with the help of html,css and php "languages".You are free to hack this for practice,
I recommend you try sql injection,reverseShells or bind maybe...  :)
Or you can just talk with the other people in the chat room and have some fun.
Have fun!</p>
</div>
<img src="ano.jpg"></img>
</body>
</html>