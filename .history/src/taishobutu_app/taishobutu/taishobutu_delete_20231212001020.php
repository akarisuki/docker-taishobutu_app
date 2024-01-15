<?php
ob_start();
session_start(); 
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../common/config.php';
include("../common/header.php");
require_once '../common/db_operation/db_connect.php';

if(isset($_POST['delete']) && isset($_POST['codes'])){
      $codes = $_POST['codes'];

      //すべてのコードが整数であることを確認
      $all_integers = true;
      foreach($codes as $code) {
            if(!ctype_digit($code)) {
                  $all_integers = false;
                  break;
            }
      }
}

if($all_integers) {
      $placeholders = implode(',',array_fill(0,count($codes), '?'));

      $sql = "DELETE FROM taishobutu_main WHERE code IN ($placeholders)";
      $stmt = $db_host->prepare($sql);

      foreach($codes as $index => $code) {
            $stmt->bindValue($index + 1, $code, PDO::PARAM_INT);
      }

      $stmt->execute();

      $_SESSION['deleted'] = true;
}

$db_host = null;
$_SESSION['flash'] = [
      'type' => 'success',
      'message' => '削除が完了しました。'
];
// 削除後に元のページにリダイレクト
header('Location: taishobutu_index.php');
exit();


?>