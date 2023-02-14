<?php session_start();
      session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,
          maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/header.css">


    <title>防火対象物管理アプリ</title>
</head>
<body>
<?php

    

//ヘッダーを読み込み
include("/var/www/html/taishobutu_app/common/header.php");
//政令別表の配列 $appendix_arrayを読み込む
require_once '/var/www/html/taishobutu_app/common/bettpiyo_array.php';

//変数で受け取る
//それからそれぞれバリデーションする 対象：用途区分、対象物名、
//ガチガチにはバリデーションしない。
//用途区分についてのバリデーション　例選択しない場合の
$error = [];

$post = $_POST;



$code = (int)$post['code'];

$appendix = (int)$post['appendix'];

$taishobutu_name = $post['taishobutu_name'];

$taishobutu_address = $post['taishobutu_address'];

$taishobutu_tel = $post['taishobutu_tel'];

$owners_name = $post['owners_name'];

$owners_tel = $post['owners_tel'];

$total_area = (double)$post['total_area'];



if(!preg_match('/^[0-9-]*$/',$taishobutu_tel)){
  $error[] = '対象物連絡先は半角数字に-を含むようにしてください';
}

if(!preg_match('/^[0-9-]*$/',$owners_tel)){
  $error[] = '関係者連絡先は半角数字に-を含むようにしてください';
}

if($appendix === 0){
  $error[] = '用途区分を選択して下さい。';
}

if($taishobutu_name === ''){
  $error[] = '対象物名が入力されていません。';
}

if(!preg_match('/^\d+(\.\d{1,2})?$/',$total_area)){
  $error[] = '延面積は半角数字で小数点第２位の範囲までで入力してください。';
}

if(count($error) > 0){
  foreach($error as $value){
    print '・'.$value. '<br>';
  }
  print '<form>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '<form>';
} else {
  print '番号:'.$code.'<br/>';
  print '用途区分:'.$appendix_array[$appendix].'<br>';
  print '対象物名:'.$taishobutu_name.'<br>';
  print '対象物所在地:'.$taishobutu_address.'<br>';
  print '対象物連絡先:'.$taishobutu_tel.'<br>';
  print '関係者名:'.$owners_name.'<br>';
  print '関係者連絡先:'.$owners_tel.'<br>';          
  print '延べ面積:'.$total_area.'<br>';
  print '<form method="post" action="taishobutu_edit_done.php">';
  print '<input type="hidden" name="code" value="'.$code.'">';
  print'<input type="hidden" name="appendix" value="'.$appendix.'">';
  print'<input type="hidden" name="taishobutu_name" value="'.$taishobutu_name.'">';
  print'<input type="hidden" name="taishobutu_address" value="' .$taishobutu_address.'">';
  print'<input type="hidden" name="taishobutu_tel" value="' .$taishobutu_tel.'">';
  print'<input type="hidden" name="owners_name" value="' .$owners_name.'">';
  print'<input type="hidden" name="owners_tel" value="' .$owners_tel.'">';
  print'<input type="hidden" name="total_area" value="' .$total_area.'">';
  print'修正してもよろしいですか？';
  print'<input type="submit" value="OK">';
  print'<input type="button" onclick="history.back()"value="戻る">';
  print'</form>';
}



?>






</body>
</html>