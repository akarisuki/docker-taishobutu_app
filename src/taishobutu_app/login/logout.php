<?php
session_start();
require_once '../common/config.php';
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
    setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();
$_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'ログアウトしました。'
];
header('Location: ' .BASE_URL. 'login/login.php');
?>
/