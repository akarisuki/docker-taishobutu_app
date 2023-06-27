<?php

session_start();
session_regenerate_id(true);


// include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';


  $code = $_POST['code']; // 追加: codeを取得
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
   
  $_SESSION['message'] = '登録が完了しました。';
  $_SESSION['code'] = $code;
  header('Location: http://localhost:50080/taishobutu_app/taishobutu/datail/fire_equipment_report/fire_equipment_report_datail.php?code=' . urlencode($code));
  exit();


?>