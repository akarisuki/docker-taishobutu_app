<?php
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';
require_once '/var/www/html/taishobutu_app/common/function.php';

$_SESSION['flash'] = $_SESSION['flash'] ?? null;

$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));
$sql = "SELECT * FROM fire_equipment_report WHERE code = :code ORDER BY fire_equipment_report_code ASC";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $code, PDO::PARAM_INT);

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT fire_equipment_report_code FROM fire_equipment_report WHERE code = :code ORDER BY fire_equipment_report_code DESC LIMIT 1";
$stmt2 = $db_host->prepare($sql2);
$stmt2->bindValue(':code', $code, PDO::PARAM_INT);
$stmt2->execute();
$last_code_row = $stmt2->fetch(PDO::FETCH_ASSOC);
$last_fire_equipment_report_code = isset($last_code_row['fire_equipment_report_code']) ? $last_code_row['fire_equipment_report_code'] : 0;


?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost:50080/taishobutu_app/common/sass/taishobutu/datail/fire_equipment_report/fire_equipment_report_datail.css">
    <link rel="stylesheet" href="http://localhost:50080/taishobutu_app/common/sass/common/header.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- Bootstrap CSS -->

    <title>予防１１９</title>
    <script>
  $(document).ready(function () {
  let editMode = false;
  let editId = null;

  $(".edit-btn").on("click", function () {
    const id = $(this).data("id");
    editId = id;
    editMode = true;

    const row = $(this).closest("tr");
    const report_date = row.find("td:eq(1) .display-value").text();
    const deficiency = row.find("td:eq(2) .display-value").text();
    const inspector = row.find("td:eq(3) .display-value").text();
    const remarks = row.find("td:eq(4) .display-value").text();

    $("input[name='report_date']").val(report_date);
    $("input[name='deficiency']").val(deficiency);
    $("input[name='inspector']").val(inspector);
    $("input[name='remarks']").val(remarks);

    $("input[name='fire_equipment_report_code']").val(id);
    $("input[type='submit']").val("更新");
  });

  $(".delete-btn").on("click", function () {
    const id = $(this).data("id");
    const codeValue = $("input[name='code']").val(); 

    if (confirm("本当に削除しますか？")) {
      $.post("fire_equipment_report_delete.php", 
      { fire_equipment_report_code: id,}, 
      function (data) {
        location.reload();
      });
    }
  });

  $(".existingDataForm").on("submit", function (e) {
      e.preventDefault();

      const url = editMode ? "fire_equipment_report_update.php" : "fire_equipment_report_add.php";
      const formData = $(this).serialize();

      $.post(url, formData, function (data) {
        location.reload();
      });
    
  });
});

document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        var flashMessage = document.getElementById('flashMessage');
        if(flashMessage) {
            flashMessage.style.opacity = '0';
            setTimeout(function() {
                flashMessage.style.display = 'none';
            }, 1000); // 1秒後に非表示
        }
    }, 5000); // 5秒後に透明度を0に
});

</script>
    
</head>

<body>
<div class="taishobutu_show_datail_button">
    <form id="form11" action="http://localhost:50080/taishobutu_app/taishobutu/datail/taishobutu_show_datail.php" method="post">
        <input type="hidden" name="code" value="<?php echo $code; ?>">
        <a href="#" onclick="document.getElementById('form11').submit();" class="button" id="taishobutu_show_datail_button">対象物詳細画面へ戻る</a>
    </form>
</div>


    <?php
    // セッション変数からメッセージを取得し、表示
    if (isset($_SESSION['flash'])) {
      $flash = $_SESSION['flash'];
      echo  "<div id='flashMessage' class='alert alert-{$flash['type']}'>{$flash['message']}</div>";
      $_SESSION['flash'] = null;
    }
    ?>
    <div class="table-container">
        <table>
            <thead>
              <tr>
                <th>番号</th>
                <th>受理年月日</th>
                <th>点検を実施した設備</th>
                <th>点検実施者</th>
                <th>備考</th>
                <th>編集・削除</th>
              </tr>
            </thead>
            <tbody id="tableBody">
              <?php $i = 1; ?>
              <?php foreach ($results as $row): ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><span class="display-value"><?php echo isset($row['report_date']) ? $row['report_date'] : ''; ?></span></td>
                  <td><span class="display-value"><?php echo isset($row['deficiency']) ? $row['deficiency'] : ''; ?></span></td>
                  <td><span class="display-value"><?php echo isset($row['inspector']) ? $row['inspector'] : ''; ?></span></td>
                  <td><span class="display-value"><?php echo isset($row['remarks']) ? $row['remarks'] : ''; ?></span></td>
                  <td>
                    <button class="edit-btn" data-id="<?php echo $row['fire_equipment_report_code']; ?>" <?php echo empty($row['report_date']) ? 'disabled' : ''; ?>>編集</button>
                    <button class="delete-btn" data-id="<?php echo $row['fire_equipment_report_code']; ?>" <?php echo empty($row['report_date']) ? 'disabled' : ''; ?>>削除</button>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endforeach; ?>
              <?php while ($i <= 20): ?>
                <tr>
                  <td><?php echo $i++; ?></td>
                  <td><span class="display-value"></span></td>
                  <td><span class="display-value"></span></td>
                  <td><span class="display-value"></span></td>
                  <td><span class="display-value"></span></td>
                  <td>
                    <button class="edit-btn" disabled>編集</button>
                    <button class="delete-btn" disabled>削除</button>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
      </table>
    </div>
    
    <form class="existingDataForm" method="post" action="http://localhost:50080/taishobutu_app/taishobutu/datail/fire_equipment_report/fire_equipment_report_add.php">
      <input type="hidden" name="code" value="<?php echo $code; ?>">
      <input type="hidden" name="fire_equipment_report_code" value="<?php echo $last_fire_equipment_report_code + 1; ?>">
      <div class="input-form-container">
        <label>
          受理年月日:
          <input type="text" name="report_date" >
        </label>
        <label>
          点検を実施した設備:
          <input type="text" name="deficiency">
        </label>
        <label>
          点検実施者:
          <input type="text" name="inspector" >
        </label>
        <label>
          備考:
          <input type="text" name="remarks">
        </label>
        <input type="submit" value="追加">
      
      </div>
    </form>

  
  
</body>
</html>