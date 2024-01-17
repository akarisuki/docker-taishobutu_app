<?php 
session_start();
session_regenerate_id(true);
$isLoggedIn = isset($_SESSION['name']);  // 例: $_SESSION['name'] にユーザーIDが保存されている場合をログイン済みとみなす
require_once '../common/config.php';
include("../common/header.php");

//政令別表の配列 $appendix_arrayを読み込む
require_once '../common/bettpiyo/bettpiyo_array.php';
require_once '../common/db_operation/db_connect.php';


$post = $_POST;

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

$sql = 'SELECT COUNT(*) FROM taishobutu_main WHERE taishobutu_name = :taishobutu_name';
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':taishobutu_name', $taishobutu_name, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$result = array_map('intval', $result);

if($result['COUNT(*)'] >= 1) {
  $error_taishobutu_name[] = 'この対象物名は既に使用されています。';
}


if(empty($taishobutu_address)){
  $error_taishobutu_address[] = '対象物所在地が入力されていません。';
}

if(empty($taishobutu_tel)){
  $error_taishobutu_tel[] = '対象物連絡先を入力してください。';
}

if(!preg_match('/^\d+$/',$taishobutu_tel)){
  $error_taishobutu_tel[] = '対象物連絡先は半角整数のみにしてください';
}


if(!preg_match('/^\d+$/',$owners_tel)){
  $error_owners_tel[] = '所有者連絡先は半角整数のみしてください';
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
        // エラーがなければ自動的にtaishobutu_done.phpにPOST
        echo '<body onload="document.FRM.submit();" >';
        echo '<form name="FRM" method="POST" action="taishobutu_done.php">';
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
    <form method="post" action="taishobutu_check.php">

        <?php include ('../common/bettpiyo/bettpiyo_select_check.php'); ?>
        <a href="http://www.chikuta119.jp/info/ihan_kohyo/pdf/beppyo01.pdf" target="_blank">用途区分ガイド</a><br/>
    
        <label for="taishobutu_name" class="required">対象物名</label>    
        <input type="text" name="taishobutu_name" value="<?= htmlspecialchars($taishobutu_name, ENT_QUOTES, 'UTF-8') ?>" <?php if(empty($taishobutu_name)){ echo 'placeholder="例: ○○消防署"'; } ?>><br/>
  
        <?php if(!empty($error_taishobutu_name)) : ?>
            <ul class="error-message-tai-name">
                <?php foreach($error_taishobutu_name as $err_tai_name) : ?>
                    <li><?= $err_tai_name ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
  
        <label for="taishobutu_address"class="required">対象物所在地</label>
        <input type="text" name="taishobutu_address" value="<?= htmlspecialchars($taishobutu_address, ENT_QUOTES, 'UTF-8') ?>" <?php if(empty($taishobutu_address)){ echo 'placeholder="例: 東京都千代田区1-1-1"'; } ?>><br/>
        <?php if(!empty($error_taishobutu_address)) : ?>
            <ul class="error-message-tai-address">
                <?php foreach($error_taishobutu_address as $err_tai_add) : ?>
                    <li><?= $err_tai_add ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    
        <label for="taishobutu_tel"class="required">対象物連絡先</label>
        <input type="text" name="taishobutu_tel" maxlength="14" value="<?= htmlspecialchars($taishobutu_tel, ENT_QUOTES, 'UTF-8') ?>" <?php if(empty($taishobutu_tel)){ echo 'placeholder="例: 0312345678"'; } ?>><br/>
        <?php if(!empty($error_taishobutu_tel)) : ?>
            <ul class="error-message-tai-tel">
                <?php foreach($error_taishobutu_tel as $err_tai_tel) : ?>
                    <li><?= $err_tai_tel ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    
        <label for="owners_name"class="optional">所有者名</label>
        <input type="text" name="owners_name" value="<?= htmlspecialchars($owners_name, ENT_QUOTES, 'UTF-8') ?>" <?php if(empty($owners_name)){ echo 'placeholder="例: 消防太郎"'; } ?>><br/>
    
        <label for="owners_tel"class="optional">所有者連絡先</label>
        <input type="text" name="owners_tel" maxlength="13" value="<?= htmlspecialchars($owners_tel, ENT_QUOTES, 'UTF-8') ?>" <?php if(empty($owners_tel)){ echo 'placeholder="例: 09012345678"'; } ?>><br/>
        <?php if(!empty($error_owners_tel)) : ?>
            <ul class="error-message-owners-tel">
                <?php foreach($error_owners_tel as $err_owners_tel) :?>
                    <li><?= $err_owners_tel ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    
        <label for="total_area"class="required">延べ面積</label>
        <input type="number" name="total_area" step="0.01" value="<?= $display_total_area ?>" <?php if(empty($display_total_area)){ echo 'placeholder="例: 100.50"'; } ?>>㎡<br/>
        <?php if(!empty($error_total_area)) : ?>
            <ul class="error-message-total-area">
                <?php foreach($error_total_area as $err_to_area) : ?>
                    <li><?= $err_to_area ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    
        <input type="submit" value="追加する">
        <input type="button" onclick="history.back()" value="戻る">
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="../common/script.js"></script>
</body>
</html>
<?php } ?>