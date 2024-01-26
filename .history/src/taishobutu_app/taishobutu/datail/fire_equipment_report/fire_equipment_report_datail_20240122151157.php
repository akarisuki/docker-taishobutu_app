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
    <link rel="stylesheet" href="../../../common/sass/taishobutu/datail/fire_equipment_report/fire_equipment_report_datail.css">
    <link rel="stylesheet" href="../../../common/sass/common/header.css">
    
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
    <form id="form11" action="../taishobutu_show_datail.php" method="post">
        <input type="hidden" name="code" value="<?php echo $code; ?>">
        <a href="#" onclick="document.getElementById('form11').submit();" class="button" id="taishobutu_show_datail_button">対象物詳細画面へ戻る</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../../../common/script/header_script.js"></script>
    <script src="../../../common/script/datail/fire_equipment_report/fire_equipment_report_script.js"></script>   
    
</body>
</html>