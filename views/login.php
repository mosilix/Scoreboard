<h1>Login</h1>
<?php
session_start();
if(isset($_SESSION["username"]))
  header("Location: /board");

if(isset($_GET['username'])&&isset($_GET['password'])){
$username=$_GET['username'];
$password=$_GET['password'];
$url = 'http://localhost/scoreboard/api/user/login.php?username='.$username.'&password='.$password;

//Once again, we use file_get_contents to GET the URL in question.
$contents = file_get_contents($url);

//If $contents is not a boolean FALSE value.
if($contents !== false){
    //Print out the contents.
    $result = json_decode($contents);
    $user = $result->username;
    $_SESSION["username"]=$user;
    header("Location: /board");
    echo $contents;
}
}
?>
<form action="" method="GET">
<input name="username" type="text">
<input name="password" type="text">
<input type="submit" value="submit">
</form>