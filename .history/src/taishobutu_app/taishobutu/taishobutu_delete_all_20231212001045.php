<?php
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../common/config.php';
include("../common/header.php");
require_once '../common/db_operation/db_connect.php';
$sql = "DELETE FROM taishobutu_main";
$stmt = $db_host->prepare($sql);
$stmt->execute();

// 削除が成功したら、セッション変数に削除フラグを設定
$_SESSION['flash'] = [
  'type' => 'success',
  'message' => '全削除が完了しました。'
];

$db_host = null;

// 削除後に元のページにリダイレクト
header('Location: taishobutu_index.php');
exit();

?>