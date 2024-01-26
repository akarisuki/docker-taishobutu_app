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
    <link rel="stylesheet" href="../../../common/sass/taishobutu/datail/fire_figthing_training/fire_figthing_training_datail.css">
    <link rel="stylesheet" href="../../../common/sass/common/header.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="../../../common/script.js"></script>
    <!-- Bootstrap CSS -->

    <title>予防１１９</title>
    <script>
  
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
    <div class="table-container js-scrollable">
        <table>
            <thead>
              <tr>
                <th class="code_area"><button id="toggle-table-view">番号</th>
                <th class="one_area">実施年月日</th>
                <th class="two_area">実施した訓練内容</th>
                <th class="hide-on-mobile" id="three_area">消防機関の参加</th>
                <th class="hide-on-mobile" id="four_area">参加職員名</th>
                <th class="hide-on-mobile" id="five_area">備    考</th>
                <th class="six_area">編集・削除</th>
              </tr>
            </thead>
            <tbody id="tableBody">
              <?php $i = 1; ?>
              <?php foreach ($results as $row): ?>
                <tr>
                  <td class="code_area"><?php echo $i; ?></td>
                  <td class="one_area"><span class="display-value"><?php echo isset($row['implementation_date']) ? $row['implementation_date'] : ''; ?></span></td>
                  <td class="two_area"><span class="display-value"><?php echo isset($row['training_content']) ? $row['training_content'] : ''; ?></span></td>
                  <td class="hide-on-mobile" id="three_area"><?php echo isset($row['participation_of_fire_depts']) ? $row['participation_of_fire_depts'] : ''; ?></span></td>
                  <td class="hide-on-mobile" id="four_area"><span class="display-value"><?php echo isset($row['instructor_name']) ? $row['instructor_name'] : ''; ?></span></td>
                  <td class="hide-on-mobile" id="five_area"><span class="display-value"><?php echo isset($row['remarks']) ? $row['remarks'] : ''; ?></span></td>
                  <td class="six_area">
                    <button class="edit-btn" data-id="<?php echo $row['fire_fighting_training_code']; ?>" <?php echo empty($row['implementation_date']) ? 'disabled' : ''; ?>>編集</button>
                    <button class="delete-btn" data-id="<?php echo $row['fire_fighting_training_code']; ?>" <?php echo empty($row['implementation_date']) ? 'disabled' : ''; ?>>削除</button>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endforeach; ?>
              <?php while ($i <= 20): ?>
                <tr>
                  <td class="code_area"><?php echo $i++; ?></td>
                  <td class="one_area"><span class="display-value"></span></td>
                  <td class="two_area"><span class="display-value"></span></td>
                  <td class="hide-on-mobile" id="three_area"><span class="display-value"></span></td>
                  <td class="hide-on-mobile" id="four_area"><span class="display-value"></span></td>
                  <td class="hide-on-mobile" id="five_area"><span class="display-value"></span></td>
                  <td class="six_area">
                    <button class="edit-btn" disabled>編集</button>
                    <button class="delete-btn" disabled>削除</button>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
      </table>
    </div>
  <div class="form-wrapper">
    <form class="existingDataForm" method="post" action="fire_fighting_training_add.php">
      <input type="hidden" name="code" value="<?php echo $code; ?>">
      <input type="hidden" name="fire_fighting_training_code" value="<?php echo $last_fire_fighting_training_code + 1; ?>">
      <div class="input-form-container">
        <div class="form-field-container">
            <label class="form-field">
              実施年月日:
              <input type="text" name="implementation_date" >
            </label>
        </div>
        <div class="form-field-container">
            <label class="form-field">
              訓練内容:
              <input type="text" name="training_content">
            </label>
        </div>
        <div class="form-field-container">
            <label class="form-field">
              消防機関の参加の有無:
              <input type="text" name="participation_of_fire_depts" >
            </label>
        </div>
        <div class="form-field-container">
            <label class="form-field">
              参加職員名:
              <input type="text" name="instructor_name" >
            </label>
        </div>
        <div class="form-field-container">
            <label class="form-field">
              備  考:
              <input type="text" name="remarks">
            </label>
        </div>
        <div class="submit-button-container">
            <input type="submit" value="追加">
        </div>
      </div>
    </form>
  </div>
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
      <script src="../../../common/script/header_script.js"></script>
      <script src="../../../common/script/datail/fire_fighting_training/fire_fighting_training_script.js"></script>   
</body>
</html>