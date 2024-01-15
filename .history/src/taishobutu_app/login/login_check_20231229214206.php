<?php

session_start();
    try{
        
        //require_once '/home/ubuntu/public_html/taishobutu_app/common/sanitize.php';
        require_once __DIR__ . '/../common/db_operation/db_connect.php';

        $post = $_POST;

        $staff_name = $post['name'];
        $staff_pass = $post['pass'];
        $fire_dept_code = $post['fire_dept_code']; 
        $errors = [];
        
        if (empty($staff_name)) {
            $error_name = '職員名が入力されていません。';
        }

        if (empty($staff_pass)) {
            $error_pass = 'パスワードが入力されていません。';
        }

        if($fire_dept_code === "0") {
            $error_fire_dept_code = '消防署コードを選択してください。';
        }

        $errors['職員名エラー'] = $error_name;
        $errors['パスワードエラー'] = $error_pass;
        $errors['消防署コードエラー'] = $error_fire_dept_code;

        
        // エラーメッセージがある場合、login.phpにリダイレクト
        if (!empty($errors)) {
            header('Location: login.php?' . http_build_query($errors));
            exit();
        }
        $hash_pass = password_hash($staff_pass,PASSWORD_DEFAULT);

        $sql = 'SELECT * FROM firedept_staff WHERE staff_name = :staff_name AND fire_dept_code = :fire_dept_code';
        $stmt = $db_host->prepare($sql);
        $stmt->bindValue(':staff_name', $staff_name,PDO::PARAM_STR);
        $stmt->bindValue(':fire_dept_code',$fire_dept_code,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($result) && password_verify($staff_pass, $result['staff_pass'])) {
            $_SESSION['login'] = 1;
            $_SESSION['id'] = $result['code'];
            $_SESSION['name'] = $result['staff_name'];
            $_SESSION['fire_dept_code'] = $result['fire_dept_code'];
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'ログインに成功しました。'
            ];
            // ユーザーがログイン情報を保持するチェックボックスをオンにした場合、クッキーに情報を保存
            if (isset($_POST['rememberme'])) {
                setcookie('userid', $result['code'], time() + (86400 * 30), "/"); // 86400 = 1日
            }
            header('Location: ../taishobutu/taishobutu_index.php');
            exit();
        } else {
            $error_name_pass = 'ユーザー名、又はパスワードが違います。';
        }
    } catch (Exception $e) {
        $error_message = 'ただいま障害により大変ご迷惑をおかけしております。';

    }


?>
