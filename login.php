<?php
session_start();
include('auth.php');

$login = $_POST['login'];
$passwd = $_POST['passwd'];
if ($_POST['submit'] !== "OK"){
  echo "ERROR - No okay received from 'submit' input\n";
  header('Location: index.html');
}
else if ($login === "" || $login === null || $passwd === "" || $passwd === null){
  echo "ERROR -- No login or password\n";
  header('Location: index.html');
}
else if (auth($login, $passwd)){
  $_SESSION['logged_on_user'] = $login;
  header('Location: home.php');
}
else{
  $_SESSION['logged_on_user'] = "";
  echo "NO USER - ERROR\n";
  header('Location: index.html');
}
?>
