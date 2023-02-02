<?php

    

require_once '/home/ubuntu/public_html/taishobutu_app/common/header.php';

require_once '/home/ubuntu/public_html/taishobutu_app/common/db_connect.php';

require_once '/home/ubuntu/public_html/taishobutu_app/common/bettpiyo_array.php';

$code = $_GET['code'];
$sql = "SELECT * FROM taishobutu_main WHERE code = :code";
$stmt = $db_host->prepare($sql);
$stmt->bindValue(':code', $code, PDO::PARAM_INT);
$stmt->execute();
$delete_data = $stmt->fetch(PDO::FETCH_ASSOC);

$code = (int)$delete_data['code'];

$appendix = (int)$delete_data['appendix'];

$taishobutu_name = $delete_data['taishobutu_name'];

$taishobutu_address = $delete_data['taishobutu_address'];

$taishobutu_tel = $delete_data['taishobutu_tel'];

$concern_name = $delete_data['concern_name'];

$concern_tel = $delete_data['concern_tel'];

$total_area = (double)$delete_data['total_area'];

print '番号:'.$code.'<br/>';
print '用途区分:'.$appendix_array[$appendix].'<br>';
print '対象物名:'.$taishobutu_name.'<br>';
print '対象物所在地:'.$taishobutu_address.'<br>';
print '対象物連絡先:'.$taishobutu_tel.'<br>';
print '関係者名:'.$concern_name.'<br>';
print '関係者連絡先:'.$concern_tel.'<br>';          
print '延べ面積:'.$total_area.'<br>';
print '<form method="post" action="taishobutu_delete_done.php">';
print '<input type="hidden" name="code" value="'.$code.'">';
print'削除してもよろしいですか？';
print'<input type="submit" value="OK">';
print'<input type="button" onclick="history.back()"value="戻る">';
print'</form>';

?>
