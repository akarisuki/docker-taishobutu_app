<?php 
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../common/config.php';
include("../common/header.php");

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

<h1>防火対象物を追加</h1>
<div class="form-wrapper">
    <form method="post" action="taishobutu_check.php">

        <?php include ('../common/bettpiyo/bettpiyo_select.php'); ?>
        <a href="http://www.chikuta119.jp/info/ihan_kohyo/pdf/beppyo01.pdf" target="_blank">用途区分ガイド</a><br/>

        <label for="taishobutu_name" class="required">対象物名</label>
        <input type="text" name="taishobutu_name" placeholder="例: ○○消防署"><br/>

        <label for="taishobutu_address" class="required">対象物所在地</label>
        <input type="text" name="taishobutu_address" placeholder="例: 東京都千代田区1-1-1"><br/>

        <label for="taishobutu_tel" class="required">対象物連絡先</label>
        <input type="text" name="taishobutu_tel" maxlength="13" placeholder="例: 0312345678"><br/>

        <label for="owners_name" class="optional">所有者名</label>
        <input type="text" name="owners_name" placeholder="例: 消防太郎"><br/>

        <label for="owners_tel" class="optional">所有者連絡先</label>
        <input type="text" name="owners_tel" maxlength="13" placeholder="例: 09012345678"><br/>

        <label for="total_area" class="required">延べ面積</label>
        <input type="number" name="total_area" step="0.01" placeholder="例: 100.50">㎡<br/>

        <input type="submit" value="追加する">
        <input type="button" onclick="history.back()" value="戻る">
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="../common/script.js"></script>
</body>
</html>