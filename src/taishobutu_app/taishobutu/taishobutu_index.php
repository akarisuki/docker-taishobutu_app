<?php 
session_start();
session_regenerate_id(true);


include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/function.php';
require_once '/var/www/html/taishobutu_app/common/bettpiyo/bettpiyo_array.php';
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';

if (isset($_POST['search'])) {
  $_SESSION['search_appendix'] = isset($_POST['search_appendix']) ? (int)$_POST['search_appendix'] : 0;
  $_SESSION['search_taishobutu_name'] = isset($_POST['search_taishobutu_name']) ? $_POST['search_taishobutu_name'] : '';
  $_SESSION['search_taishobutu_address'] = isset($_POST['search_taishobutu_address']) ? $_POST['search_taishobutu_address'] : '';
  $_SESSION['search_total_area'] = isset($_POST['search_total_area']) ? (int)$_POST['search_total_area'] : 0;
}

$search_appendix = isset($_SESSION['search_appendix']) ? $_SESSION['search_appendix'] : 0;
$search_taishobutu_name = isset($_SESSION['search_taishobutu_name']) ? $_SESSION['search_taishobutu_name'] : '';
$search_taishobutu_address = isset($_SESSION['search_taishobutu_address']) ? $_SESSION['search_taishobutu_address'] : '';
$search_total_area = isset($_SESSION['search_total_area']) ? $_SESSION['search_total_area'] : 0;


$sql = "SELECT * FROM taishobutu_main WHERE 1";

$bind_param_str = '';
$bind_param_arr = [];

if($search_appendix){
  $sql .= " AND appendix = ?";
  $bind_param_str .= 'i';
  $bind_param_arr[] = $search_appendix;
}

if($search_taishobutu_name){
  $sql .= " AND taishobutu_name LIKE ?";
  $bind_param_str .= 's';
  $bind_param_arr[] = '%' . $search_taishobutu_name . '%';
}

if($search_taishobutu_address){
  $sql .= " AND taishobutu_address LIKE ?";
  $bind_param_str .= 's';
  $bind_param_arr[] = '%' . $search_taishobutu_address . '%';
}

if($search_total_area){
  $sql .= " AND total_area = ?";
  $bind_param_str .= 'i';
  $bind_param_arr[] = $search_total_area;
}

$stmt = $db_host->prepare($sql);

if ($bind_param_str) {
  $i = 1;
  foreach ($bind_param_arr as $value) {
      $stmt->bindParam($i, $value);
      $i++;
  }
}
$stmt->execute();


$db_host = null;



?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/sass/taishobutu/taishobutu.index.css">
    <link rel="stylesheet" href="../common/sass/common/header.css">


    <title>予防１１９</title>
</head>
<body>
<div class="form-search">
  <form action="taishobutu_index.php" method="post">
    <tr>
      <th>検索フォーム</th><br/>
      <th>用途区分</th>
      <th><?php include('/var/www/html/taishobutu_app/common/bettpiyo/bettpiyo_select_search.php'); ?></th>
      <th>防火対象物名</th>
      <td><input type="text" name="search_taishobutu_name" placeholder="すべて" value="<?php if(!empty($search_taishobutu_name)){echo $search_taishobutu_name; }?>"></td>
      <th>防火対象物所在地</th>
      <td><input type="text" name="search_taishobutu_address" placeholder="すべて" value="<?php if(!empty($search_taishobutu_address)){echo $search_taishobutu_address; }?>"></td>
      <th>延べ面積</th>
      <td><input type="text" name="search_total_area" placeholder="すべて"value="<?php if(!empty($search_total_area)){echo $search_total_area; }?>"></td>
      <td><input type="submit" name="search" value="検索"></td>
      <td><input type="button" onclick="clearForm()" value="クリア"></td>
    </tr>
  </form>
</div>
<?php

$db_host = null;

?>
<table>
  <tbody>
    <tr><th>番号</th><th>用途区分</th><th>対象物名</th><th>対象物所在地</th><th>対象物連絡先</th><th>関係者名</th><th>関係者連絡先</th><th>延べ面積</th></tr>
    <?php
      $result_count = 0; 
      while(true) {
        $result = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($result === false) {
            break;
        }
          $result_count++;

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

      if ($result_count === 0) {
        print "<tr><td colspan='9'>レコードがありません</td></tr>";
      }

    
    ?>
  </tbody>
</table>

</body>
</html>