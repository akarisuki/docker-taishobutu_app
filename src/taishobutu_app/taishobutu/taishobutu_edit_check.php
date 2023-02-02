<?php

    

//ヘッダーを読み込み
require_once '/home/ubuntu/public_html/taishobutu_app/common/header.php';
//政令別表の配列 $appendix_arrayを読み込む
require_once '/home/ubuntu/public_html/taishobutu_app/common/bettpiyo_array.php';

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

$concern_name = $post['concern_name'];

$concern_tel = $post['concern_tel'];

$total_area = (double)$post['total_area'];



if(!preg_match('/^[0-9-]*$/',$taishobutu_tel)){
  $error[] = '対象物連絡先は半角数字に-を含むようにしてください';
}

if(!preg_match('/^[0-9-]*$/',$concern_tel)){
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
  print '関係者名:'.$concern_name.'<br>';
  print '関係者連絡先:'.$concern_tel.'<br>';          
  print '延べ面積:'.$total_area.'<br>';
  print '<form method="post" action="taishobutu_edit_done.php">';
  print '<input type="hidden" name="code" value="'.$code.'">';
  print'<input type="hidden" name="appendix" value="'.$appendix.'">';
  print'<input type="hidden" name="taishobutu_name" value="'.$taishobutu_name.'">';
  print'<input type="hidden" name="taishobutu_address" value="' .$taishobutu_address.'">';
  print'<input type="hidden" name="taishobutu_tel" value="' .$taishobutu_tel.'">';
  print'<input type="hidden" name="concern_name" value="' .$concern_name.'">';
  print'<input type="hidden" name="concern_tel" value="' .$concern_tel.'">';
  print'<input type="hidden" name="total_area" value="' .$total_area.'">';
  print'修正してもよろしいですか？';
  print'<input type="submit" value="OK">';
  print'<input type="button" onclick="history.back()"value="戻る">';
  print'</form>';
}



?>






</body>
</html>