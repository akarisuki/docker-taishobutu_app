<?php

session_start();
session_regenerate_id(true);


// include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';


  $code = $_POST['code']; // 追加: codeを取得
  $inspection_status_code = $_POST['inspection_status_code']; // 番号を取得
  $inspection_date = $_POST['inspection_date'];
  $inspector_name	 = $_POST['inspector_name'];
  $instructions = $_POST['instructions'];
  $remarks	 = $_POST['remarks'];

  $sql = <<<EOD
    INSERT INTO inspection_status SET code = :code ,inspection_status_code = :inspection_status_code,
    inspection_date = :inspection_date , inspector_name = :inspector_name,
    instructions = :instructions,remarks = :remarks
  EOD;

  $stmt = $db_host->prepare($sql);
  $stmt->bindValue(':code', $code, PDO::PARAM_INT);
  $stmt->bindValue(':inspection_status_code', $inspection_status_code, PDO::PARAM_INT);
  $stmt->bindValue(':inspection_date', $inspection_date, PDO::PARAM_STR);
  $stmt->bindValue(':inspector_name', $inspector_name, PDO::PARAM_STR);
  $stmt->bindValue(':instructions', $instructions, PDO::PARAM_STR); // 追加: appointment_dateのバインド
  $stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);
  $stmt->execute();
   
  $_SESSION['message'] = '登録が完了しました。';
  $_SESSION['code'] = $code;
  header('Location: http://localhost:50080/taishobutu_app/taishobutu/datail/inspection_status/inspection_status_datail.php?code=' . urlencode($code));
  exit();


?>