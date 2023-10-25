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
    if (empty(trim($value))) {
        $allFieldsFilled = false;
        break;
    }
}


if (!$allFieldsFilled) {
  $_SESSION['flash'] = [
    'type' => 'error', 
    'message' => "全てのフィールドを入力してください。"
  ];
    header("Location: fire_safety_manager_datail.php");
    exit;
}



  $code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));// 追加: codeを取得
  $fire_safety_manager_code = $_POST['fire_safety_manager_code']; // 番号を取得
  $fire_safety_manager_director = $_POST['fire_safety_manager_director'];
  $fire_safety_manager_name = $_POST['fire_safety_manager_name'];
  $appointment_date = $_POST['appointment_date'];
  $fire_plan_date = $_POST['fire_plan_date'];

  $sql = <<<EOD
    INSERT INTO fire_safety_manager SET code = :code ,fire_safety_manager_code = :fire_safety_manager_code,
    fire_safety_manager_director = :fire_safety_manager_director , fire_safety_manager_name = :fire_safety_manager_name,
    appointment_date = :appointment_date,fire_plan_date = :fire_plan_date
  EOD;

  $stmt = $db_host->prepare($sql);
  $stmt->bindValue(':code', $code, PDO::PARAM_INT);
  $stmt->bindValue(':fire_safety_manager_code', $fire_safety_manager_code, PDO::PARAM_INT);
  $stmt->bindValue(':fire_safety_manager_director', $fire_safety_manager_director, PDO::PARAM_STR);
  $stmt->bindValue(':fire_safety_manager_name', $fire_safety_manager_name, PDO::PARAM_STR);
  $stmt->bindValue(':appointment_date', $appointment_date, PDO::PARAM_STR); // 追加: appointment_dateのバインド
  $stmt->bindValue(':fire_plan_date', $fire_plan_date, PDO::PARAM_STR);
  $stmt->execute();

  $_SESSION['flash'] = [
    'type' => 'success',
    'message' => '追加が完了しました。'
  ];
  $_SESSION['code'] = $code;
  header('Location: http://localhost:50080/taishobutu_app/taishobutu/datail/fire_safety_manager/fire_safety_manager_datail.php?code=' . urlencode($code));
  exit();


?>