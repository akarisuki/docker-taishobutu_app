<?php

session_start();

$csrfToken = filter_input(INPUT_POST, '_csrf_token');

// csrf tokenを検証
if (
  empty($csrfToken)
  || empty($_SESSION['_csrf_token'])
  || $csrfToken !== $_SESSION['_csrf_token']
) {
  exit('不正なリクエストです');
}


// 本来はここでemailのバリデーションもかける
$mail_address = filter_input(INPUT_POST, 'mail_address');

require_once __DIR__ . '/../common/db_operation/db_connect.php';

$sql = 'SELECT * FROM firedept_staff WHERE mail_address = :mail_address ';

?>
