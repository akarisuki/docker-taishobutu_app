<?php 
session_start();
session_regenerate_id(true);
include("/var/www/html/taishobutu_app/common/header.php");

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

        <?php include ('/var/www/html/taishobutu_app/common/bettpiyo/bettpiyo_select.php'); ?>
        <a href="http://www.chikuta119.jp/info/ihan_kohyo/pdf/beppyo01.pdf" target="_blank">用途区分ガイド</a><br/>
    
        <label for="taishobutu_name" class="required">対象物名</label>    
        <input type="text" name="taishobutu_name"><br/>

        <label for="taishobutu_address"class="required">対象物所在地</label>
        <input type="text" name="taishobutu_address"><br/>
    
        <label for="taishobutu_tel"class="required">対象物連絡先</label>
        <input type="text" name="taishobutu_tel" maxlength="13"><br/>
    
        <label for="owners_name"class="optional">所有者名</label>
        <input type="text" name="owners_name"><br/>
    
        <label for="owners_tel"class="optional">所有者連絡先</label>
        <input type="text" name="owners_tel" maxlength="13"><br/>
    
        <label for="total_area"class="required">延べ面積</label>
        <input type="number" name="total_area" step="0.01">㎡<br/>
        
        <input type="submit" value="追加する">
        <input type="button" onclick="history.back()" value="戻る">
    </form>
</div>

</body>
</html>