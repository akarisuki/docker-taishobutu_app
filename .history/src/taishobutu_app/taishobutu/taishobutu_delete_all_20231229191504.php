<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../common/config.php';
//include("../common/header.php");
require_once '../common/db_operation/db_connect.php';
include("../common/cookie_user.php");

$fire_dept_code = $_SESSION['fire_dept_code']; 



$db_host->beginTransaction();

try {
  $sql = "CREATE TEMPORARY TABLE temp_table AS SELECT code FROM taishobutu_main WHERE fire_dept_code = :fire_dept_code";
  $stmt = $db_host->prepare($sql);
  $stmt->bindValue(':fire_dept_code', $fire_dept_code, PDO::PARAM_INT);
  $stmt->execute();

  $tables = ['taishobutu_main', 'taishobutu_datail', 'firefighting_equipment_list', 'fire_equipment_report', 'fire_fighting_training', 'fire_safety_manager', 'inspection_status'];
  foreach ($tables as $table) {
      $sql = "DELETE FROM $table WHERE code IN (SELECT code FROM temp_table)";
      $stmt = $db_host->prepare($sql);
      $stmt->execute();
  }

  // 削除が成功したら、セッション変数に削除フラグを設定
  $_SESSION['flash'] = [
    'type' => 'success',
    'message' => '全削除が完了しました。'
  ];

  $db_host->commit();
} catch (Exception $e) {
  $db_host->rollBack();
  
}

$db_host = null;

// 削除後に元のページにリダイレクト
header('Location: taishobutu_index.php');
exit();

?>