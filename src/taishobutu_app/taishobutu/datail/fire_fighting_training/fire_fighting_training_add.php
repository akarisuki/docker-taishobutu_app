<?php

session_start();
session_regenerate_id(true);


// include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';


  $code = $_POST['code']; // 追加: codeを取得
  $fire_fighting_training_code = $_POST['fire_fighting_training_code']; // 番号を取得
  $implementation_date = $_POST['implementation_date'];
  $training_content = $_POST['training_content'];
  $participation_of_fire_depts = $_POST['participation_of_fire_depts'];
  $instructor_name = $_POST['instructor_name'];
  $remarks = $_POST['remarks'];

  $sql = <<<EOD
    INSERT INTO fire_fighting_training SET code = :code ,fire_fighting_training_code = :fire_fighting_training_code,
    implementation_date = :implementation_date , training_content = :training_content,
    participation_of_fire_depts = :participation_of_fire_depts,instructor_name = :instructor_name,remarks = :remarks
  EOD;

  $stmt = $db_host->prepare($sql);
  $stmt->bindValue(':code', $code, PDO::PARAM_INT);
  $stmt->bindValue(':fire_fighting_training_code', $fire_fighting_training_code, PDO::PARAM_INT);
  $stmt->bindValue(':implementation_date', $implementation_date, PDO::PARAM_STR);
  $stmt->bindValue(':training_content', $training_content, PDO::PARAM_STR);
  $stmt->bindValue(':participation_of_fire_depts', $participation_of_fire_depts, PDO::PARAM_STR); // 追加: appointment_dateのバインド
  $stmt->bindValue(':instructor_name',$instructor_name,PDO::PARAM_STR);
  $stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);
  $stmt->execute();
  
  $_SESSION['message'] = '登録が完了しました。';
  $_SESSION['code'] = $code;
  header('Location: http://localhost:50080/taishobutu_app/taishobutu/datail/fire_fighting_training/fire_fighting_training_datail.php?code=' . urlencode($code));
  exit();


?>