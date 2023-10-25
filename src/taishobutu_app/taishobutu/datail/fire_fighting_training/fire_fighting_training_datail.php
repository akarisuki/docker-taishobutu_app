<?php
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
include("/var/www/html/taishobutu_app/common/header.php");
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';
require_once '/var/www/html/taishobutu_app/common/function.php';

$_SESSION['flash'] = $_SESSION['flash'] ?? null;

$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));
$sql = "SELECT * FROM fire_fighting_training WHERE code = :code ORDER BY fire_fighting_training_code ASC";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $code, PDO::PARAM_INT);

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT fire_fighting_training_code FROM fire_fighting_training WHERE code = :code ORDER BY fire_fighting_training_code DESC LIMIT 1";
$stmt2 = $db_host->prepare($sql2);
$stmt2->bindValue(':code', $code, PDO::PARAM_INT);
$stmt2->execute();
$last_code_row = $stmt2->fetch(PDO::FETCH_ASSOC);
$last_fire_fighting_training_code = isset($last_code_row['fire_fighting_training_code']) ? $last_code_row['fire_fighting_training_code'] : 0;

?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost:50080/taishobutu_app/common/sass/taishobutu/datail/fire_figthing_training/fire_figthing_training_datail.css">
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
    const implementation_date = row.find("td:eq(1) .display-value").text();
    const training_content = row.find("td:eq(2) .display-value").text();
    const participation_of_fire_depts = row.find("td:eq(3) .display-value").text();
    const instructor_name = row.find("td:eq(4) .display-value").text();
    const remarks = row.find("td:eq(5) .display-value").text();

    $("input[name='implementation_date']").val(implementation_date);
    $("input[name='training_content']").val(training_content);
    $("input[name='participation_of_fire_depts']").val(participation_of_fire_depts);
    $("input[name='instructor_name']").val(instructor_name);
    $("input[name='remarks']").val(remarks);

    $("input[name='fire_fighting_training_code']").val(id);
    $("input[type='submit']").val("更新");
  });

  $(".delete-btn").on("click", function () {
    const id = $(this).data("id");

    if (confirm("本当に削除しますか？")) {
      $.post("fire_fighting_training_delete.php", 
      { fire_fighting_training_code: id }, 
        function (data) {
        location.reload();
      });
    }
  });

  $(".existingDataForm").on("submit", function (e) {
    if(editMode) {
      e.preventDefault();

      const url =  "fire_fighting_training_update.php" ;
      const formData = $(this).serialize();

      $.post(url, formData, function (data) {
        
        location.reload();
      });
    }
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
                <th>実施年月日</th>
                <th>実施した訓練内容</th>
                <th>消防機関の参加</th>
                <th>参加職員名</th>
                <th>備    考</th>
                <th>編集・削除</th>
              </tr>
            </thead>
            <tbody id="tableBody">
              <?php $i = 1; ?>
              <?php foreach ($results as $row): ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><span class="display-value"><?php echo isset($row['implementation_date']) ? $row['implementation_date'] : ''; ?></span></td>
                  <td><span class="display-value"><?php echo isset($row['training_content']) ? $row['training_content'] : ''; ?></span></td>
                  <td><span class="display-value"><?php echo isset($row['participation_of_fire_depts']) ? $row['participation_of_fire_depts'] : ''; ?></span></td>
                  <td><span class="display-value"><?php echo isset($row['instructor_name']) ? $row['instructor_name'] : ''; ?></span></td>
                  <td><span class="display-value"><?php echo isset($row['remarks']) ? $row['remarks'] : ''; ?></span></td>
                  <td>
                    <button class="edit-btn" data-id="<?php echo $row['fire_fighting_training_code']; ?>" <?php echo empty($row['implementation_date']) ? 'disabled' : ''; ?>>編集</button>
                    <button class="delete-btn" data-id="<?php echo $row['fire_fighting_training_code']; ?>" <?php echo empty($row['implementation_date']) ? 'disabled' : ''; ?>>削除</button>
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
    
    <form class="existingDataForm" method="post" action="http://localhost:50080/taishobutu_app/taishobutu/datail/fire_fighting_training/fire_fighting_training_add.php">
      <input type="hidden" name="code" value="<?php echo $code; ?>">
      <input type="hidden" name="fire_fighting_training_code" value="<?php echo $last_fire_fighting_training_code + 1; ?>">
      <div class="input-form-container">
        <label>
          実施年月日:
          <input type="text" name="implementation_date" >
        </label>
        <label>
          訓練内容:
          <input type="text" name="training_content">
        </label>
        <label>
          消防機関の参加の有無:
          <input type="text" name="participation_of_fire_depts" >
        </label>
        <label>
          参加職員名:
          <input type="text" name="instructor_name" >
        </label>
        <label>
          備  考:
          <input type="text" name="remarks">
        </label>
        <input type="submit" value="追加">
      
      </div>
    </form>

  
  
</body>
</html>