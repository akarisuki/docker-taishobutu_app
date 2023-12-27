<?php
session_start();
require_once '../common/config.php';
$_SESSION=array();
if(isset($_COOKIE['userid']) === true){
    setcookie('userid','',time() - (86400 * 30),'/');
}
session_destroy();
$_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'ログアウトしました。'
];
header('Location: ' .BASE_URL. '/welcome.php');
?>