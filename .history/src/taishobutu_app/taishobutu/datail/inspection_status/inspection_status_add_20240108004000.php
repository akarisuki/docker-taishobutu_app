<?php

session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../../../common/config.php';
include("../../../common/header.php");
require_once '../../../common/db_operation/db_connect.php';
require_once '../../../common/function.php';

$allFieldsFilled = true;  // 追加

// ポストされた全てのキーと値をループします
foreach ($_POST as $key => $value) {
  // remarksフィールドはバリデーションから除外
  if ($key === 'remarks') {
    continue;
  }
  if (empty(trim($value))) {
      $allFieldsFilled = false;
      break;
  }
}


if (!$allFieldsFilled) {
  $_SESSION['flash'] = [
    'type' => 'error', 
    'message' => "「備考」以外のフィールドを入力してください。"
  ];
  header("Location: inspection_atatus_datail.php");
  exit;
}

  $code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));
  $inspection_status_code = $_POST['inspection_status_code']; // 番号を取得
  $inspection_date = $_POST['inspection_date'];
  $inspection_name	 = $_POST['inspection_name'];
  $instructions = $_POST['instructions'];
  $remarks	 = $_POST['remarks'];

  var_dump($_POST);

  $sql = <<<EOD
    INSERT INTO inspection_status SET code = :code ,inspection_status_code = :inspection_status_code,
    inspection_date = :inspection_date , inspection_name = :inspection_name,
    instructions = :instructions,remarks = :remarks , created_at = :created_at, updated_at = :updated_at
  EOD;

  $stmt = $db_host->prepare($sql);
  $stmt->bindValue(':code', $code, PDO::PARAM_INT);
  $stmt->bindValue(':inspection_status_code', $inspection_status_code, PDO::PARAM_INT);
  $stmt->bindValue(':inspection_date', $inspection_date, PDO::PARAM_STR);
  $stmt->bindValue(':inspection_name', $inspection_name, PDO::PARAM_STR);
  $stmt->bindValue(':instructions', $instructions, PDO::PARAM_STR); // 追加: appointment_dateのバインド
  $stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);
  $stmt->execute();

  $_SESSION['flash'] = [
    'type' => 'success',
    'message' => '追加が完了しました。'
  ];
  $_SESSION['code'] = $code;
  header('Location: inspection_status_datail.php?code=' . urlencode($code));
  exit();


?>