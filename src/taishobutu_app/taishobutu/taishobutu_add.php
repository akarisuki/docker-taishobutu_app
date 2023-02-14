<?php session_start();
      session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/header.css">


    <title>防火対象物管理アプリ</title>
</head>
<body>
<?php


include("/var/www/html/taishobutu_app/common/header.php");

?>

<h1>防火対象物を追加</h1>
<form method="post"action="taishobutu_check.php">
    <table>
        
        
        <label for="appendix">用途区分</label>
        
        <?php require_once   '/var/www/html/taishobutu_app/common/bettpiyo_select.php'; ?>
        <label for="taishobutu_name">対象物名</label>
        <input type="text" name="taishobutu_name">
        <label for="taishobutu_address">対象物所在地</label>
        <input type="text" name="taishobutu_address">
        <label for="taihobutu_tel">対象物連絡先</label>
        <input type="text" name="taishobutu_tel">
        <label for="owners_name">所有者名</label>
        <input type="text" name="owners_name">
      <th><label for="owners_tel">所有者連絡先</label></th>
        <td><input type="text" name="owners_tel"></td>
      <th><label>延べ面積</label></th>
        <td><input type="text" name="total_area">㎡</td>       
        
    </table>
    <input type="submit"value="追加する">
</form>



</body>
</html>