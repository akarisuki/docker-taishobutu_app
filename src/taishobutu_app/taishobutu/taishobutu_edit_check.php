<?php
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
include("../common/header.php");

//政令別表の配列 $appendix_arrayを読み込む
require_once '../common/bettpiyo/bettpiyo_array.php';
require_once '../common/db_operation/db_connect.php';


$post = $_POST;

$code = (int)$post['code'];

$appendix = (int)$post['appendix'];

$taishobutu_name = $post['taishobutu_name'];

$taishobutu_address = $post['taishobutu_address'];

$taishobutu_tel = $post['taishobutu_tel'];

$owners_name = $post['owners_name'];

$owners_tel = $post['owners_tel'];

$raw_total_area = $post['total_area'];
$total_area = round((float)$raw_total_area, 2);
$display_total_area = '';

if (intval($total_area) === $total_area) {
    $display_total_area = intval($total_area);
} else {
    $display_total_area = number_format($total_area, 2, '.', '');
}


$error_appendix = [];

$error_taishobutu_name = [];

$error_taishobutu_address = [];

$error_taishobutu_tel = [];

$error_owners_tel = [];

$error_total_area = [];

if($appendix === 0){
  $error_appendix[] = '用途区分を選択して下さい。';
}

if(empty($taishobutu_name)){
  $error_taishobutu_name[] = '対象物名が入力されていません。';
}

$sql = 'SELECT COUNT(*) FROM taishobutu_main WHERE taishobutu_name = :taishobutu_name AND code <> :code';
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':taishobutu_name', $taishobutu_name, PDO::PARAM_STR);
$stmt->bindValue(':code', $code, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$count = intval($result['COUNT(*)']);

if ($count >= 1) {
    $error_taishobutu_name[] = 'この対象物名は既に使用されています。';
}

if(empty($taishobutu_address)){
  $error_taishobutu_address[] = '対象物所在地が入力されていません。';
}

if(empty($taishobutu_tel)){
  $error_taishobutu_tel[] = '対象物連絡先を入力してください。';
}

if(!preg_match('/^[0-9-]*$/',$taishobutu_tel)){
  $error_taishobutu_tel[] = '対象物連絡先は半角数字に-を含むようにしてください';
}

if(!preg_match('/^[0-9-]*$/',$owners_tel)){
  $error_owners_tel[] = '対象物連絡先は半角数字に-を含むようにしてください';
}


if(empty($raw_total_area)){
  $error_total_area[] = '延べ面積が入力されていません。';
}

if(!preg_match('/^\d+(\.\d{1,2})?$/', $raw_total_area)){
  $error_total_area[] = '延面積は半角数字で小数点第２位の範囲までで入力してください。';
}

$error = array_merge($error_appendix,$error_taishobutu_name,$error_taishobutu_address,
                      $error_taishobutu_tel,$error_owners_tel,$error_total_area);

if (empty($error)) {
        // エラーがなければ自動的にtaishobutu_edit_done.phpにPOST
        echo '<body onload="document.FRM.submit();" >';
        echo '<form name="FRM" method="POST" action="taishobutu_edit_done.php">';
        echo '<input type="hidden" name="code" value="' . $code . '">'; 
        echo '<input type="hidden" name="appendix" value="' . $appendix . '">';
        echo '<input type="hidden" name="taishobutu_name" value="' . htmlspecialchars($taishobutu_name, ENT_QUOTES, 'UTF-8') . '">';
        echo '<input type="hidden" name="taishobutu_address" value="' . htmlspecialchars($taishobutu_address, ENT_QUOTES, 'UTF-8') . '">';
        echo '<input type="hidden" name="taishobutu_tel" value="' . htmlspecialchars($taishobutu_tel, ENT_QUOTES, 'UTF-8') . '">';
        echo '<input type="hidden" name="owners_name" value="' . htmlspecialchars($owners_name, ENT_QUOTES, 'UTF-8') . '">';
        echo '<input type="hidden" name="owners_tel" value="' . htmlspecialchars($owners_tel, ENT_QUOTES, 'UTF-8') . '">';
        echo '<input type="hidden" name="total_area" value="' . $display_total_area . '">';
        echo '</form>';
        echo '</body>';
    } else {
      
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/sass/taishobutu/taishobutu_add.css">
    <link rel="stylesheet" href="../common/sass/common/header.css">
    
    <title>予防１１９</title>
</head>
<body>


<div class="form-wrapper"> 
    <form method="post" action="taishobutu_edit_check.php">

        <label for="code">番号<?php echo $code; ?></label>
        <input type="hidden" name= "code" value="<?= $code ?>">

        <?php include ('../common/bettpiyo/bettpiyo_select_edit_check.php'); ?>
        <a href="http://www.chikuta119.jp/info/ihan_kohyo/pdf/beppyo01.pdf" target="_blank">用途区分ガイド</a><br/>
    
        <label for="taishobutu_name" class="required">対象物名</label>    
        <input type="text" name="taishobutu_name" value="<?= htmlspecialchars($taishobutu_name, ENT_QUOTES, 'UTF-8') ?>"><br/>
        <?php if(!empty($error_taishobutu_name)) : ?>
          <ul class="error-message-tai-name-check">
            <?php foreach($error_taishobutu_name as $err_tai_name) : ?>
              <li><?= htmlspecialchars($err_tai_name, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
  
        <label for="taishobutu_address"class="required">対象物所在地</label>
        <input type="text" name="taishobutu_address" value="<?= htmlspecialchars($taishobutu_address, ENT_QUOTES, 'UTF-8') ?>"><br/>
        <?php if(!empty($error_taishobutu_address)) : ?>
            <ul class="error-message-tai-address-check">
                <?php foreach($error_taishobutu_address as $err_tai_add) : ?>
                  <li><?= htmlspecialchars($err_tai_add, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>  
            </ul>
        <?php endif; ?>
    
        <label for="taishobutu_tel"class="required">対象物連絡先</label>
        <input type="text" name="taishobutu_tel" maxlength="13" value="<?= htmlspecialchars($taishobutu_tel, ENT_QUOTES, 'UTF-8') ?>"><br/>
        <?php if(!empty($error_taishobutu_tel)) : ?>
            <ul class="error-message-tai-tel-check">
                <?php foreach($error_taishobutu_tel as $err_tai_tel) : ?>
                  <li><?= htmlspecialchars($err_tai_tel, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    
        <label for="owners_name"class="optional">所有者名</label>
        <input type="text" name="owners_name" value="<?= htmlspecialchars($owners_name, ENT_QUOTES, 'UTF-8') ?>"><br/>
    
        <label for="owners_tel"class="optional">所有者連絡先</label>
        <input type="text" name="owners_tel" maxlength="14" value="<?= htmlspecialchars($owners_tel, ENT_QUOTES, 'UTF-8') ?>"><br/>
        <?php if(!empty($error_owners_tel)) : ?>
          <ul class="error-message-owners-tel-check">
            <?php foreach($error_owners_tel as $err_owners_tel) : ?>
              <li><?= htmlspecialchars($err_owners_tel, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
    
        <label for="total_area"class="required">延べ面積</label>
        <input type="number" name="total_area" step="0.01" value="<?= $display_total_area ?>">㎡<br/>
        <?php if(!empty($error_total_area)) : ?>
            <ul class="error-message-total-area-check">
                <?php foreach($error_total_area as $err_to_area) : ?>
                  <li><?= htmlspecialchars($err_to_area, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <input type="submit" value="修正する">
        <input type="button" onclick="history.back()" value="戻る">
        
    </form>
</div>
</body>
</html>
<?php } ?>