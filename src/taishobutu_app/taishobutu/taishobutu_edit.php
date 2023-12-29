<?php 
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../common/config.php';
include("../common/header.php");
require_once '../common/db_operation/db_connect.php';
include("../common/cookie_user.php");

$code = $_GET['code'];
$sql = "SELECT * FROM taishobutu_main WHERE code = :code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $code, PDO::PARAM_INT);
$stmt->execute();
$edit_data = $stmt->fetch(PDO::FETCH_ASSOC);

$raw_total_area = $edit_data['total_area'];
$total_area = round((float)$raw_total_area, 2);
$display_total_area = '';

if (intval($total_area) === $total_area) {
    $display_total_area = intval($total_area);
} else {
    $display_total_area = number_format($total_area, 2, '.', '');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
        content="width=device-width,initial-scale=1.0,
        maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/sass/taishobutu/taishobutu_add.css">
    <link rel="stylesheet" href="../common/sass/common/header.css">


    <title>防火対象物管理アプリ</title>
</head>
<body>


    


<!-- <div class="title">
    <h1>修正画面</h1>
</div> -->
<div class="form-wrapper"> 
    <form method="post" action="taishobutu_edit_check.php">

        <label for="code">番号<?php echo $edit_data['code']; ?></label>
        <input type="hidden" name= "code" value="<?= $edit_data['code'] ?>">

        <?php include ('../common/bettpiyo/bettpiyo_select_edit.php'); ?>
        <a href="http://www.chikuta119.jp/info/ihan_kohyo/pdf/beppyo01.pdf" target="_blank">用途区分ガイド</a><br/>
    
        <label for="taishobutu_name" class="required">対象物名</label>    
        <input type="text" name="taishobutu_name" value="<?= htmlspecialchars($edit_data['taishobutu_name'], ENT_QUOTES, 'UTF-8') ?>"><br/>

        <label for="taishobutu_address"class="required">対象物所在地</label>
        <input type="text" name="taishobutu_address" value="<?= htmlspecialchars($edit_data['taishobutu_address'], ENT_QUOTES, 'UTF-8') ?>"><br/>
    
        <label for="taishobutu_tel"class="required">対象物連絡先</label>
        <input type="text" name="taishobutu_tel" value="<?= htmlspecialchars($edit_data['taishobutu_tel'], ENT_QUOTES, 'UTF-8') ?>"><br/>
    
        <label for="owners_name"class="optional">所有者名</label>
        <input type="text" name="owners_name" value="<?= htmlspecialchars($edit_data['owners_name'], ENT_QUOTES, 'UTF-8') ?>"><br/>
    
        <label for="owners_tel"class="optional">所有者連絡先</label>
        <input type="text" name="owners_tel" maxlength="14" value="<?= htmlspecialchars($edit_data['owners_tel'], ENT_QUOTES, 'UTF-8')?>"><br/>
    
        <label for="total_area"class="required">延べ面積</label>
        <input type="number" name="total_area" step="0.01" value="<?= $display_total_area ?>">㎡<br/>
        
        <input type="submit" value="修正する">
        <input type="button" onclick="history.back()" value="戻る">
    </form>
</div>