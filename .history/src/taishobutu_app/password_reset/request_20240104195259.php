<?php

session_start();

$csrfToken = filter_input(INPUT_POST, '_csrf_token');

var_dump($csrfToken);
?>
