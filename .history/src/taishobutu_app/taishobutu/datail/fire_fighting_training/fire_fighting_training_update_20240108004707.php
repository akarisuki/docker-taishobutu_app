<?php
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../../../common/config.php';
include("../../../common/header.php");
require_once '../../../common/db_operation/db_connect.php';

$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));
$fire_fighting_training_code = $_POST['fire_fighting_training_code'];
$implementation_date = $_POST['implementation_date'];
$training_content = $_POST['training_content'];
$participation_of_fire_depts = $_POST['participation_of_fire_depts'];
$instructor_name = $_POST['instructor_name'];
$remarks = $_POST['remarks'];

$sql = "UPDATE fire_fighting_training SET implementation_date = :implementation_date, training_content = :training_content,
          instructor_name = :instructor_name ,participation_of_fire_depts = :participation_of_fire_depts, remarks = :remarks, updated_at = :updated_at WHERE fire_fighting_training_code = :fire_fighting_training_code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':implementation_date', $implementation_date, PDO::PARAM_STR);
$stmt->bindValue(':training_content', $training_content, PDO::PARAM_STR);
$stmt->bindValue(':instructor_name', $instructor_name, PDO::PARAM_STR);
$stmt->bindValue(':participation_of_fire_depts', $participation_of_fire_depts, PDO::PARAM_STR);
$stmt->bindValue(':remarks', $remarks, PDO::PARAM_STR);
$stmt->bindValue(':fire_fighting_training_code',$fire_fighting_training_code, PDO::PARAM_INT);
$stmt->bindValue(':updated_at', (new \DateTime())->format('Y-m-d H:i:s'), PDO::PARAM_STR);

$stmt->execute();

$_SESSION['flash'] = [
  'type' => 'success',
  'message' => '更新が完了しました。'
];
var_dump($_SESSION['flash']);
$_SESSION['code'] = $code;
header('Location: fire_fighting_training_datail.php?code=' . urlencode($code));
exit();