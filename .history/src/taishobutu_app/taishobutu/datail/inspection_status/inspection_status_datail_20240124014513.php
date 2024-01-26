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
    <link rel="stylesheet" href="../../../common/sass/taishobutu/datail/inspection_status/inspection_status_datail.css">
    <link rel="stylesheet" href="../../../common/sass/common/header.css">
    
    <!-- Bootstrap CSS -->

    <title>予防１１９</title>
    
</head>

<body>
    <div class="taishobutu_show_datail_button">
        <form id="form11" action="../taishobutu_show_datail.php" method="post">
            <input type="hidden" name="code" value="<?php echo $code; ?>">
            <a href="#" onclick="document.getElementById('form11').submit();" class="button" id="taishobutu_show_datail_button">戻る</a>
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
    <div class="table-container js-scrollable">
        <table>
            <thead>
              <tr>
                <th class="code_area"><button id="toggle-table-view">番号</th>
                <th class="one_area">査察実施日</th>
                <th class="two_area">査察職員名</th>
                <th class="hide-on-mobile" id="three_area">指示事項の有無</th>
                <th class="hide-on-mobile" id="four_area">備  考</th>
                <th class="five_area">編集・削除</th>
              </tr>
            </thead>
            <tbody id="tableBody">
              <?php $i = 1; ?>
              <?php foreach ($results as $row): ?>
                <tr>
                  <td class="code_area"><?php echo $i; ?></td>
                  <td class="one_area"><span class="display-value"><?php echo isset($row['inspection_date']) ? $row['inspection_date'] : ''; ?></span></td>
                  <td class="two_area"><span class="display-value"><?php echo isset($row['inspection_name']) ? $row['inspection_name'] : ''; ?></span></td>
                  <th class="hide-on-mobile" id="three_area"><span class="display-value"><?php echo isset($row['instructions']) ? $row['instructions'] : ''; ?></span></td>
                  <th class="hide-on-mobile" id="four_area"><span class="display-value"><?php echo isset($row['remarks']) ? $row['remarks'] : ''; ?></span></td>
                  <td class="five_area">
                    <button class="edit-btn" data-id="<?php echo $row['inspection_status_code']; ?>" <?php echo empty($row['inspection_date']) ? 'disabled' : ''; ?>>編集</button>
                    <button class="delete-btn" data-id="<?php echo $row['inspection_status_code']; ?>" <?php echo empty($row['inspection_date']) ? 'disabled' : ''; ?>>削除</button>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endforeach; ?>
              <?php while ($i <= 20): ?>
                <tr>
                  <td class="code_area"><?php echo $i++; ?></td>
                  <td class="one_area"><span class="display-value"></span></td>
                  <td class="two_area"><span class="display-value"></span></td>
                  <th class="hide-on-mobile" id="three_area"><span class="display-value"></span></td>
                  <th class="hide-on-mobile" id="four_area"><span class="display-value"></span></td>
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
      <form class="existingDataForm" method="post" action="inspection_status_add.php">
        <input type="hidden" name="code" value="<?php echo $code; ?>">
        <input type="hidden" name="inspection_status_code" value="<?php echo $last_inspection_status_code + 1; ?>">
        <div class="input-form-container">
           <div class="form-field-container">
           <label class="form-field">
                査察年月日:
                <input type="text" name="inspection_date" >
              </label>
          </div>
           <div class="form-field-container">
           <label class="form-field">
                査察職員名:
                <input type="text" name="inspection_name">
              </label>
          </div>
          <div class="form-field-container">
          <label class="form-field">
                指示事項の有無:
                <input type="text" name="instructions" >
              </label>
          </div>
          <div class="form-field-container">
          <label class="form-field">
                備考:
                <input type="text" name="remarks">
              </label>
          </div>
              <input type="submit" value="追加">
        
        </div>
      </form>
   </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
      <script src="../../../common/script/header_script.js"></script>
      <script src="../../../common/script/datail/inspection_status/inspection_status_script.js"></script>  
  
  
</body>
</html>