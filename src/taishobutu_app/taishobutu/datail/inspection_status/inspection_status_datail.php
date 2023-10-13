<?php
session_start();
session_regenerate_id(true);

include("/var/www/html/taishobutu_app/common/header.php"); // この行をセッションの処理の前に移動
require_once '/var/www/html/taishobutu_app/common/db_operation/db_connect.php';
require_once '/var/www/html/taishobutu_app/common/function.php';

$_SESSION['flash'] = $_SESSION['flash'] ?? null;

$code = isset($_POST['code']) ? $_POST['code'] : (isset($_GET['code']) ? $_GET['code'] : (isset($_SESSION['code']) ? $_SESSION['code'] : ''));
$sql = "SELECT * FROM inspection_status WHERE code = :code ORDER BY inspection_status_code ASC";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $code, PDO::PARAM_INT);

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT inspection_status_code FROM inspection_status WHERE code = :code ORDER BY inspection_status_code DESC LIMIT 1";
$stmt2 = $db_host->prepare($sql2);
$stmt2->bindValue(':code', $code, PDO::PARAM_INT);
$stmt2->execute();
$last_code_row = $stmt2->fetch(PDO::FETCH_ASSOC);
$last_inspection_status_code = isset($last_code_row['inspection_status_code']) ? $last_code_row['inspection_status_code'] : 0;

?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost:50080/taishobutu_app/common/sass/taishobutu/datail/inspection_status/inspection_status_datail.css">
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
    const inspection_date = row.find("td:eq(1) .display-value").text();
    const inspection_name = row.find("td:eq(2) .display-value").text();
    const instructions = row.find("td:eq(3) .display-value").text();
    const remarks = row.find("td:eq(4) .display-value").text();

    $("input[name='inspection_date']").val(inspection_date);
    $("input[name='inspection_name']").val(inspection_name);
    $("input[name='instructions']").val(instructions);
    $("input[name='remarks']").val(remarks);

    $("input[name='inspection_status_code']").val(id);
    $("input[type='submit']").val("更新");
  });

  $(".delete-btn").on("click", function () {
    const id = $(this).data("id");

    if (confirm("本当に削除しますか？")) {
      $.post("inspection_status_delete.php", 
      { inspection_status_code: id }, 
        function (data) {
        location.reload();
      });
    }
  });

  $(".existingDataForm").on("submit", function (e) {
    
      e.preventDefault();

      const url =  editMode ? "inspection_status_update.php" : "inspection_status_add.php";
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
                <th>査察実施日</th>
                <th>査察職員名</th>
                <th>指示事項の有無</th>
                <th>備  考</th>
                <th>編集・削除</th>
              </tr>
            </thead>
            <tbody id="tableBody">
              <?php $i = 1; ?>
              <?php foreach ($results as $row): ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><span class="display-value"><?php echo isset($row['inspection_date']) ? $row['inspection_date'] : ''; ?></span></td>
                  <td><span class="display-value"><?php echo isset($row['inspection_name']) ? $row['inspection_name'] : ''; ?></span></td>
                  <td><span class="display-value"><?php echo isset($row['instructions']) ? $row['instructions'] : ''; ?></span></td>
                  <td><span class="display-value"><?php echo isset($row['remarks']) ? $row['remarks'] : ''; ?></span></td>
                  <td>
                    <button class="edit-btn" data-id="<?php echo $row['inspection_status_code']; ?>" <?php echo empty($row['inspection_date']) ? 'disabled' : ''; ?>>編集</button>
                    <button class="delete-btn" data-id="<?php echo $row['inspection_status_code']; ?>" <?php echo empty($row['inspection_date']) ? 'disabled' : ''; ?>>削除</button>
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
    
    <form class="existingDataForm" method="post" action="http://localhost:50080/taishobutu_app/taishobutu/datail/inspection_status/inspection_status_add.php">
      <input type="hidden" name="code" value="<?php echo $code; ?>">
      <input type="hidden" name="inspection_status_code" value="<?php echo $last_inspection_status_code + 1; ?>">
      <div class="input-form-container">
        <label>
          査察年月日:
          <input type="text" name="inspection_date" >
        </label>
        <label>
          査察職員名:
          <input type="text" name="inspection_name">
        </label>
        <label>
          指示事項の有無:
          <input type="text" name="instructions" >
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