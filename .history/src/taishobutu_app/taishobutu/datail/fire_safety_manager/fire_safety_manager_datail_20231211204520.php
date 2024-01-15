<?php
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../../../common/config.php';
include("../../../common/header.php");
require_once '../../../common/db_operation/db_connect.php';
require_once '../../../common/function.php';

$_SESSION['flash'] = $_SESSION['flash'] ?? null;

$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));
$sql = "SELECT * FROM fire_safety_manager WHERE code = :code ORDER BY fire_safety_manager_code ASC";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $code, PDO::PARAM_INT);

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT fire_safety_manager_code FROM fire_safety_manager WHERE code = :code ORDER BY fire_safety_manager_code DESC LIMIT 1";
$stmt2 = $db_host->prepare($sql2);
$stmt2->bindValue(':code', $code, PDO::PARAM_INT);
$stmt2->execute();
$last_code_row = $stmt2->fetch(PDO::FETCH_ASSOC);
$last_fire_safety_manager_code = isset($last_code_row['fire_safety_manager_code']) ? $last_code_row['fire_safety_manager_code'] : 0;

?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../common/sass/taishobutu/datail/fire_safety_manager/fire_safety_manager_datail.css">
    <link rel="stylesheet" href="../../../common/sass/common/header.css">
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
    const director = row.find("td:eq(1) .display-value").text();
    const name = row.find("td:eq(2) .display-value").text();
    const appointmentDate = row.find("td:eq(3) .display-value").text();
    const firePlanDate = row.find("td:eq(4) .display-value").text();

    $("input[name='fire_safety_manager_director']").val(director);
    $("input[name='fire_safety_manager_name']").val(name);
    $("input[name='appointment_date']").val(appointmentDate);
    $("input[name='fire_plan_date']").val(firePlanDate);

    $("input[name='fire_safety_manager_code']").val(id);
    $("input[type='submit']").val("更新");
  });

  $(".delete-btn").on("click", function () {
    const id = $(this).data("id");

    if (confirm("本当に削除しますか？")) {
      $.post("fire_safety_manager_delete.php", 
      { fire_safety_manager_code: id }, 
        function (data) {
        location.reload();
      });
    }
  });

  $(".existingDataForm").on("submit", function (e) {
    e.preventDefault();

    const url = editMode ? "fire_safety_manager_update.php" : "fire_safety_manager_add.php";
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
        <form id="form11" action="../taishobutu_show_datail.php" method="post">
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
                <th>職務上の地位</th>
                <th>防火管理者名</th>
                <th>選任年月日</th>
                <th>消防計画作成・変更届年月日</th>
                <th>編集・削除</th>
              </tr>
            </thead>
            <tbody id="tableBody">
              <?php $i = 1; ?>
              <?php foreach ($results as $row): ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><span class="display-value"><?php echo isset($row['fire_safety_manager_director']) ? $row['fire_safety_manager_director'] : ''; ?></span></td>
                  <td><span class="display-value"><?php echo isset($row['fire_safety_manager_name']) ? $row['fire_safety_manager_name'] : ''; ?></span></td>
                  <td><span class="display-value"><?php echo isset($row['appointment_date']) ? $row['appointment_date'] : ''; ?></span></td>
                  <td><span class="display-value"><?php echo isset($row['fire_plan_date']) ? $row['fire_plan_date'] : ''; ?></span></td>
                  <td>
                    <button class="edit-btn" data-id="<?php echo $row['fire_safety_manager_code']; ?>" <?php echo empty($row['fire_safety_manager_director']) ? 'disabled' : ''; ?>>編集</button>
                    <button class="delete-btn" data-id="<?php echo $row['fire_safety_manager_code']; ?>" <?php echo empty($row['fire_safety_manager_director']) ? 'disabled' : ''; ?>>削除</button>
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
    
    <form class="existingDataForm" method="post" action="fire_safety_manager_add.php">
      <input type="hidden" name="code" value="<?php echo $code; ?>">
      <input type="hidden" name="fire_safety_manager_code" value="<?php echo $last_fire_safety_manager_code + 1; ?>">
      <div class="input-form-container">
        <label>
          職務上の地位:
          <input type="text" name="fire_safety_manager_director" >
        </label>
        <label>
          防火管理者名:
          <input type="text" name="fire_safety_manager_name">
        </label>
        <label>
          選任年月日:
          <input type="text" name="appointment_date" >
        </label>
        <label>
          消防計画作成・変更届年月日:
          <input type="text" name="fire_plan_date">
        </label>
        <input type="submit" value="追加">
      
      </div>
    </form>

  
  
</body>
</html>