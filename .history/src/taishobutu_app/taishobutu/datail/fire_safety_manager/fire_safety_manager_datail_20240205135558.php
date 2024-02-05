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
  <meta name="viewport" content="width=device-width,initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <link rel="stylesheet" href="../../../common/sass/taishobutu/datail/fire_safety_manager/fire_safety_manager_datail.css">
  <link rel="stylesheet" href="../../../common/sass/common/header.css">
  <link rel="stylesheet" href="https://unpkg.com/scroll-hint@latest/css/scroll-hint.css">


  <title>予防１１９</title>


</head>

<body>
  <div class="taishobutu_show_datail_button">
    <form id="form11" action="../taishobutu_show_datail.php" method="post">
      <input type="hidden" name="code" value="<?php echo $code; ?>">
      <a href="#" onclick="document.getElementById('form11').submit();" class="button" id="taishobutu_show_datail_button">戻る</a>
    </form>
  </div>
  
  <h1>防火管理者一覧</h1>

  <div class="table-container js-scrollable">
    <table>
      <thead>
        <tr>
          <th class="code_area"><button id="toggle-table-view">番号</button></th>
          <th class="hide-on-mobile" id="one_area">職務上の地位</th>
          <th class="two_area">防火管理者名</th>
          <th class="three_area">選任年月日</th>
          <th class="hide-on-mobile" id="four_area">消防計画届年月日</th>
          <th class="five_area">編集・削除</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <?php $i = 1; ?>
        <?php foreach ($results as $row) : ?>
          <tr>
            <td class="code_area"><?php echo $i; ?></td>
            <td class="hide-on-mobile" id="one_area"><span class="display-value"><?php echo isset($row['fire_safety_manager_director']) ? $row['fire_safety_manager_director'] : ''; ?></span></td>
            <td class="two_area"><span class="display-value"><?php echo isset($row['fire_safety_manager_name']) ? $row['fire_safety_manager_name'] : ''; ?></span></td>
            <td class="three_area"><span class="display-value"><?php echo isset($row['appointment_date']) ? $row['appointment_date'] : ''; ?></span></td>
            <td class="hide-on-mobile" id="four_area"><span class="display-value"><?php echo isset($row['fire_plan_date']) ? $row['fire_plan_date'] : ''; ?></span></td>
            <td class="five_area">
              <button class="edit-btn" data-id="<?php echo $row['fire_safety_manager_code']; ?>" <?php echo empty($row['fire_safety_manager_director']) ? 'disabled' : ''; ?>>編集</button>
              <button class="delete-btn" data-id="<?php echo $row['fire_safety_manager_code']; ?>" <?php echo empty($row['fire_safety_manager_director']) ? 'disabled' : ''; ?>>削除</button>
            </td>
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>
        <?php while ($i <= 20) : ?>
          <tr>
            <td class="code_area"><?php echo $i++; ?></td>
            <td class="hide-on-mobile" id="one_area"><span class="display-value"></span></td>
            <td class="two_area"><span class="display-value"></span></td>
            <td class="three_area"><span class="display-value"></span></td>
            <td class="hide-on-mobile" id="four_area"><span class="display-value"></span></td>
            <td class="five_area">
              <button class="edit-btn" disabled>編集</button>
              <button class="delete-btn" disabled>削除</button>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <div class="form-wrapper">
    <form class="existingDataForm" method="post" action="fire_safety_manager_add.php">
      <input type="hidden" name="code" value="<?php echo $code; ?>">
      <input type="hidden" name="fire_safety_manager_code" value="<?php echo $last_fire_safety_manager_code + 1; ?>">

      <div class="fire_safety_manager_director-area">
        <label>職務上の地位:</label>
        <input type="text" name="fire_safety_manager_director">

      </div>
      <div class="fire_safety_manager_name-area">
        <label>防火管理者名: </label>
        <input type="text" name="fire_safety_manager_name">
      </div>
      <div class="appointment_date-area">
        <label>選任年月日: </label>
        <input type="text" name="appointment_date">
      </div>
      <div class="fire_plan_date-area">
        <label>消防計画届年月日:</label>
        <input type="text" name="fire_plan_date">
      </div>
      <div class="submit-button-container">
        <input type="submit" class="submit-button" value="追加">
      </div>

    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/scroll-hint@latest/js/scroll-hint.min.js"></script>
  <script src="../../../common/script/header_script.js"></script>
  <script src="../../../common/script/datail/fire_safety_manager/fire_safety_manager_script.js"></script>
</body>

</html>