<?php
ob_start();
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../../../common/config.php';
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
  header("Location: fire_fighting_training_datail.php");
  exit;
}

  $code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));
  $fire_fighting_training_code = $_POST['fire_fighting_training_code']; // 番号を取得
  $implementation_date = $_POST['implementation_date'];
  $training_content = $_POST['training_content'];
  $participation_of_fire_depts = $_POST['participation_of_fire_depts'];
  $instructor_name = $_POST['instructor_name'];
  $remarks = $_POST['remarks'];

  $sql = <<<EOD
    INSERT INTO fire_fighting_training SET code = :code ,fire_fighting_training_code = :fire_fighting_training_code,
    implementation_date = :implementation_date , training_content = :training_content,
    participation_of_fire_depts = :participation_of_fire_depts,instructor_name = :instructor_name,remarks = :remarks,
    created_at = :created_at, updated_at = :updated_at
  EOD;

  $stmt = $db_host->prepare($sql);
  $stmt->bindValue(':code', $code, PDO::PARAM_INT);
  $stmt->bindValue(':fire_fighting_training_code', $fire_fighting_training_code, PDO::PARAM_INT);
  $stmt->bindValue(':implementation_date', $implementation_date, PDO::PARAM_STR);
  $stmt->bindValue(':training_content', $training_content, PDO::PARAM_STR);
  $stmt->bindValue(':participation_of_fire_depts', $participation_of_fire_depts, PDO::PARAM_STR); // 追加: appointment_dateのバインド
  $stmt->bindValue(':instructor_name',$instructor_name,PDO::PARAM_STR);
  $stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);
  $stmt->bindValue(':created_at', (new \DateTime())->format('Y-m-d H:i:s'), PDO::PARAM_STR);
  $stmt->bindValue(':updated_at', (new \DateTime())->format('Y-m-d H:i:s'), PDO::PARAM_STR);
  $stmt->execute();
  
  $_SESSION['flash'] = [
    'type' => 'success',
    'message' => '追加が完了しました。'
  ];
  var_dump($_SESSION['flash']);
  $_SESSION['code'] = $code;
  header('Location: fire_fighting_training_datail.php?code=' . urlencode($code));
  ob_end_flush();
  exit();


?>