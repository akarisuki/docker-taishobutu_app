<?php
session_start();

require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

$sql = "DELETE FROM taishobutu_main";
$stmt = $db_host->prepare($sql);
$stmt->execute();

// 削除が成功したら、セッション変数に削除フラグを設定
$_SESSION['deleted'] = true;

$db_host = null;

// 削除後に元のページにリダイレクト
header('Location: taishobutu_index.php');
exit();

?>