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
    <link rel="stylesheet" href="../common/sass/taishobutu.css">


    <title>防火対象物管理アプリ</title>
</head>
<body>
<?php


include("/var/www/html/taishobutu_app/common/header.php");

require_once '/var/www/html/taishobutu_app/common/bettpiyo_array.php';

require_once '/var/www/html/taishobutu_app/common/db_connect.php';

//一覧をデータベースから取得して表示する。

try{

$sql = "SELECT * FROM taishobutu_main WHERE1";
$stmt = $db_host->prepare($sql);
$stmt->execute();


} catch (PDOException $e) {
  print 'ただいま接続障害が発生しております。'.$e->getMessage() . '<br/>恐れ入りますが時間を置いてから再度お試しください。';
  exit;
}

?>
<form action="" method="get">
  <input type="text" name="keyword" placeholder="Search keyword">
  <input type="submit" value="Search">
</form>


<table>
  <tbody>
    <tr><th>番号</th><th>用途区分</th><th>対象物名</th><th>対象物所在地</th><th>対象物連絡先</th><th>関係者名</th><th>関係者連絡先</th><th>延面積</th></tr>
    <?php 
      while(true) {
        $result = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($result === false) {
            break;
        }
          print "<tr>";
          print "<th class='cell-boder'>". $result['code']."</th>";
          print "<th class='cell-boder'>". $appendix_array[$result['appendix']]."</th>";
          print "<th class='cell-boder'><a href='taishobutu_datail.php?code=".$result['code']."'>". $result['taishobutu_name']."</a></th>";
          print "<th class='cell-boder'>". $result['taishobutu_address']."</th>";
          print "<th class='cell-boder'>". $result['taishobutu_tel']."</th>";
          print "<th class='cell-boder'>". $result['owners_name']."</th>";
          print "<th class='cell-boder'>". $result['owners_tel']."</th>";
          print "<th class='cell-boder'>". $result['total_area']."㎡"."</th>";
          print "<th class='cell-boder'><a href='taishobutu_edit.php? code=".$result['code']."'>修正</a></th>";
          print "<th class='cell-boder'><a href='taishobutu_delete.php? code=".$result['code']."'>削除</a></th>";
          print "</tr>";
      }
    ?>
  
  </tbody>
</table>
</body>
</html>