<?php
ob_start();
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['user_id']);  // 例: $_SESSION['user_id'] にユーザーIDが保存されている場合をログイン済みとみなす
include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';



$code = $_POST['code'];
$windowless_floor = $_POST['windowless_floor'];
$capacity = $_POST['capacity'];
$building_structure = $_POST['building_structure'];
$owners_address = $_POST['owners_address'];
$building_area = (float)$_POST['building_area'];
$site_area = (float)$_POST['site_area'];
$building_classification = $_POST['building_classification'];
$interior_limit = $_POST['interior_limit'];
$main_structure = $_POST['main_structure'];
$floor = $_POST['floor'];
$new_construction_date = $_POST['new_construction_date'];
$remarks_column	= $_POST['remarks_column'];


$sql = <<<EOD
  INSERT INTO taishobutu_datail SET code = :code , owners_address = :owners_address, building_structure = :building_structure,
  capacity = :capacity,  building_area = :building_area, windowless_floor = :windowless_floor,
  site_area = :site_area ,building_classification = :building_classification, interior_limit = :interior_limit,
  main_structure = :main_structure ,floor = :floor ,new_construction_date = :new_construction_date,
  remarks_column = :remarks_column
EOD;


$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $code, PDO::PARAM_INT);
$stmt->bindValue(':windowless_floor', $windowless_floor, PDO::PARAM_STR);
$stmt->bindValue(':capacity', $capacity, PDO::PARAM_STR);
$stmt->bindValue(':building_structure',$building_structure , PDO::PARAM_STR);
$stmt->bindValue(':owners_address', $owners_address, PDO::PARAM_STR);
$stmt->bindValue(':building_area', $building_area, PDO::PARAM_STR);
$stmt->bindValue(':site_area', $site_area, PDO::PARAM_STR);
$stmt->bindValue(':building_classification', $building_classification, PDO::PARAM_STR);
$stmt->bindValue(':interior_limit', $interior_limit, PDO::PARAM_STR);
$stmt->bindValue(':main_structure', $main_structure, PDO::PARAM_STR);
$stmt->bindValue(':floor', $floor, PDO::PARAM_STR);
$stmt->bindValue(':new_construction_date', $new_construction_date, PDO::PARAM_STR);
$stmt->bindValue(':remarks_column', $remarks_column, PDO::PARAM_STR);
$stmt->execute();

$_SESSION['flash'] = [
  'type' => 'success',
  'message' => '追加が完了しました。'
];
$_SESSION['code'] = $code;
header('Location: /taishobutu_show_datail.php?code=' . urldecode($code));
exit();



?>