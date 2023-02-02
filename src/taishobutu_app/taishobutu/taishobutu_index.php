<?php


require_once '/home/ubuntu/public_html/taishobutu_app/common/header.php';

require_once '/home/ubuntu/public_html/taishobutu_app/common/bettpiyo_array.php';

require_once '/home/ubuntu/public_html/taishobutu_app/common/db_connect.php';

//一覧をデータベースから取得して表示する。

try{

$sql = "SELECT * FROM taishobutu_main WHERE1";
$stmt = $db_host->prepare($sql);
$stmt->execute();


} catch (PDOException $e) {
  echo 'ただいま接続障害が発生しております。'.$e->getMessage() . '<br/>恐れ入りますが時間を置いてから再度お試しください。';
  exit;
}

?>
<form action="" method="get">
  <input type="text" name="keyword" placeholder="Search keyword">
  <input type="submit" value="Search">
</form>

<?php
    $keyword = $_GET['keyword'];
    $sql = "SELECT * FROM taishobutu_main WHERE taishobutu_name LIKE '%".$keyword."%' OR taishobutu_address LIKE '%".$keyword."%'";
      
?>
<table>
  <tbody>
    <tr><th>番号</th><th>用途区分</th><th>対象物名</th><th>対象物所在地</th><th>対象物連絡先</th><th>関係者名</th><th>関係者連絡先</th><th>延面積</th></tr>
    <?php 
      while(true) {
        $result = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($result === false) {
            break;
        }
          echo "<tr>";
          echo "<th class='cell-boder'>". $result['code']."</th>";
          echo "<th class='cell-boder'>". $appendix_array[$result['appendix']]."</th>";
          echo "<th class='cell-boder'>". $result['taishobutu_name']."</th>";
          echo "<th class='cell-boder'>". $result['taishobutu_address']."</th>";
          echo "<th class='cell-boder'>". $result['taishobutu_tel']."</th>";
          echo "<th class='cell-boder'>". $result['concern_name']."</th>";
          echo "<th class='cell-boder'>". $result['concern_tel']."</th>";
          echo "<th class='cell-boder'>". $result['total_area']."㎡"."</th>";
          echo "<th class='cell-boder'><a href='taishobutu_datail.php? code=".$result['code']."'>対象物詳細</a></th>";
          echo "<th class='cell-boder'><a href='taishobutu_edit.php? code=".$result['code']."'>修正</a></th>";
          echo "<th class='cell-boder'><a href='taishobutu_delete.php? code=".$result['code']."'>削除</a></th>";
          echo "</tr>";
      }
    ?>
   
  </tbody>
</table>
</body>
</html>