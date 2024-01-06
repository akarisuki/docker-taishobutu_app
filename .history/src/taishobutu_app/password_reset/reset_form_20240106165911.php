<?php
session_start();


require_once __DIR__ . '/../common/db_operation/db_connect.php';


// クエリからtokenを取得
$passwordResetToken = filter_input(INPUT_GET, 'token');

var_dump($passwordResetToken);