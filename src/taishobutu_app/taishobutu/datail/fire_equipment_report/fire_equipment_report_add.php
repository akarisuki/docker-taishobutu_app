<?php

session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';
require_once '/var/www/html/taishobutu_app/common/function.php';

$allFieldsFilled = true;

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
  header("Location: fire_equipment_report_datail.php");
  exit;
}

  $code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : '');
  $fire_equipment_report_code = $_POST['fire_equipment_report_code']; // 番号を取得
  $report_date = $_POST['report_date'];
  $deficiency = $_POST['deficiency'];
  $inspector = $_POST['inspector'];
  $remarks = $_POST['remarks'];

  $sql = <<<EOD
    INSERT INTO fire_equipment_report SET code = :code ,fire_equipment_report_code = :fire_equipment_report_code,
    report_date = :report_date , deficiency = :deficiency,
    inspector = :inspector,remarks = :remarks
  EOD;

  $stmt = $db_host->prepare($sql);
  $stmt->bindValue(':code', $code, PDO::PARAM_INT);
  $stmt->bindValue(':fire_equipment_report_code', $fire_equipment_report_code, PDO::PARAM_INT);
  $stmt->bindValue(':report_date', $report_date, PDO::PARAM_STR);
  $stmt->bindValue(':deficiency', $deficiency, PDO::PARAM_STR);
  $stmt->bindValue(':inspector', $inspector, PDO::PARAM_STR); // 追加: appointment_dateのバインド
  $stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);
  $stmt->execute();

  $_SESSION['flash'] = [
    'type' => 'success',
    'message' => '追加が完了しました。'
  ];
  var_dump($_SESSION['flash']);
  $_SESSION['code'] = $code;
  header('Location: http://localhost:50080/taishobutu_app/taishobutu/datail/fire_equipment_report/fire_equipment_report_datail.php?code=' . urlencode($code));
  exit();


?>