<?php 
session_start();
session_regenerate_id(true);

require_once '../common/config.php';
include("../common/header.php");
require_once '../common/function.php';
require_once '../common/bettpiyo/bettpiyo_array.php';
require_once '../common/db_operation/db_connect.php';
include("../common/cookie_user.php");

$fire_dept_code = $_SESSION['fire_dept_code'] ?? null;




if (isset($_POST['search'])) {
  $_SESSION['search_appendix'] = isset($_POST['search_appendix']) ? (int)$_POST['search_appendix'] : 0;
  $_SESSION['search_taishobutu_name'] = isset($_POST['search_taishobutu_name']) ? $_POST['search_taishobutu_name'] : '';
  $_SESSION['search_taishobutu_address'] = isset($_POST['search_taishobutu_address']) ? $_POST['search_taishobutu_address'] : '';
  $_SESSION['search_total_area'] = isset($_POST['search_total_area']) ? (int)$_POST['search_total_area'] : 0;
} else {
  // 初回のページ表示時の処理
  $fire_dept_code = $_SESSION['fire_dept_code'] ?? null;
}


$search_appendix = isset($_SESSION['search_appendix']) ? $_SESSION['search_appendix'] : 0;
$search_taishobutu_name = isset($_SESSION['search_taishobutu_name']) ? $_SESSION['search_taishobutu_name'] : '';
$search_taishobutu_address = isset($_SESSION['search_taishobutu_address']) ? $_SESSION['search_taishobutu_address'] : '';
$search_total_area = isset($_SESSION['search_total_area']) ? $_SESSION['search_total_area'] : 0;


$sql = "SELECT * FROM taishobutu_main WHERE fire_dept_code = ?";
$bind_param_str = 'i';
$bind_param_arr[] = $fire_dept_code;


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

try {
  $stmt = $db_host->prepare($sql);
  
  if ($bind_param_str) {
    $i = 1;
    foreach ($bind_param_arr as $value) {
        $stmt->bindValue($i, $value);  // bindParamからbindValueに変更
        $i++;
    }
  }
  $stmt->execute();
} catch (PDOException $e) {
  echo "エラーが発生しました: " . $e->getMessage();
}

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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/css/modaal.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMxmnO/x5+X2U6lX4y4/QMzRVjzmV5u1N5w7QJi8LxfLg7jB/079M9CjyfN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="../common/script.js"></script>
    <title>予防１１９</title>
</head>
<body>
  <?php
  
  
  if (isset($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    echo  "<div id='flashMessage' class='alert alert-{$flash['type']}'>{$flash['message']}</div>";
    $_SESSION['flash'] = null;
  }
  
  
  ?>

<!--リンク元のHTMLリンク先は表示させたいエリアのid名を指定します。-->
<p><a href="#info" class="modal-open">お知らせを開く</a></p>

<!--表示エリアのHTML。id 名にリンク先と同じ名前を指定します。※表示エリアはHTML の変更が可能なので、レイアウトを自由に変更できます。-->
<section id="info">
<h2>Sale情報</h2>
<p>11 月1 日～ 12 月31 日まで年末セールを開催！ </p>
</section>
<div class="form-search">
  <form action="taishobutu_index.php" method="post">
    <tr>
      <th>検索フォーム</th><br/>
      <th>用途区分</th>
      <th><?php include('../common/bettpiyo/bettpiyo_select_search.php'); ?></th>
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

<form action="taishobutu_delete.php" method="post">
<?php
$result_count = 0; 
$results = [];
while(true) {
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    if($result === false) {
        break;
    }
    $results[] = $result;
    $result_count++;
}

if ($result_count === 0) {
    echo "<div class='no-records'><p>登録防火対象物がありません</p></div>";
} else {
    echo "<table class='excel-style'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th class='checkbox-top'>□</th>";
    echo "<th class='code-top'>番号</th>";
    echo "<th class='appendix-top'>用途区分</th>";
    echo "<th class='taishobutu_name-top'>防火対象物名</th>";
    echo "<th class='taishobutu_address-top'>防火対象物所在地</th>";
    echo "<th class='taishobutu_tel-top'>対象物連絡先</th>";
    echo "<th class='owner_name-top'>所有者名</th>";
    echo "<th class='owner_tel-top'>所有者連絡先</th>";
    echo "<th class='total_area-top'>延べ面積</th>";
    echo "<th class='edit'></th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($results as $result) {
        echo "<tr>";
        echo "<td class='checkbox-top'><input type='checkbox' name='codes[]' value='".htmlspecialchars($result['code'])."'></td>";
        echo "<td class='code-top'>".htmlspecialchars($result['code'])."</td>";
        echo "<td class='appendix-top'>".htmlspecialchars($appendix_array[$result['appendix']])."</td>";
        echo "<td class='taishobutu_name-top'><a href='" . BASE_URL . "/taishobutu/datail/taishobutu_show_datail.php?code=" . htmlspecialchars($result['code']) . "'>" . htmlspecialchars($result['taishobutu_name']) . "</a></td>";
        echo "<td class='taishobutu_address-top'>".htmlspecialchars($result['taishobutu_address'])."</td>";
        echo "<td class='taishobutu_tel-top'>".htmlspecialchars($result['taishobutu_tel'])."</td>";
        echo "<td class='owner_name-top'>".htmlspecialchars($result['owners_name'])."</td>";
        echo "<td class='owner_tel-top'>".htmlspecialchars($result['owners_tel'])."</td>";
        echo "<td class='total_area-top'>".htmlspecialchars($result['total_area'])."㎡"."</td>";
        echo "<td class='edit'><a href='" . BASE_URL . "taishobutu/taishobutu_edit.php?code=".htmlspecialchars($result['code'])."'>修正</a></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
?>
    <input type="submit" name="delete" value="選択したレコードを削除" onclick="return confirmDelete();">
</form>
<button type="button" name="delete-all" onclick="handleDeleteAll()">全削除</button>

<?php $db_host = null; ?>



</body>
</html>