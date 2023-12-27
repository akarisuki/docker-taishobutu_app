<?php
// check_user.php

if (isset($_COOKIE['userid'])) {
    // クッキーからユーザーIDを取得
    $userid = $_COOKIE['userid'];

    // ユーザーIDを使用してユーザー情報を取得
    $sql = 'SELECT * FROM firedept_staff WHERE code = :userid';
    $stmt = $db_host->prepare($sql);
    $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // ユーザーが存在する場合、セッションにユーザー情報を保存
        $_SESSION['id'] = $user['code'];
        $_SESSION['name'] = $user['staff_name'];
        $_SESSION['fire_dept_code'] = $user['fire_dept_code'];
    } else {
        // ユーザーが存在しない場合、クッキーを削除
        setcookie('userid', '', time() - 3600);
    }
}