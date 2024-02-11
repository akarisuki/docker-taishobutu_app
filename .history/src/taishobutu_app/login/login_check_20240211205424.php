<?php

session_start();
        
        
        //require_once '/home/ubuntu/public_html/taishobutu_app/common/sanitize.php';
        require_once __DIR__ . '/../common/db_operation/db_connect.php';

        $post = $_POST;

        $staff_name = $post['name'];
        $staff_pass = $post['pass'];
        $fire_dept_code = $post['fire_dept_code']; 
        $errors = [];
        
        if (empty($staff_name)) {
            $errors['職員名エラー'] = '職員名が入力されていません';
        }
        
        if (empty($staff_pass)) {
            $errors['パスワードエラー'] = 'パスワードが入力されていません。';
        }
        
        if (empty($fire_dept_code)) {
            $errors['消防署コードエラー'] = '消防署コードが入力されていません。';
        }

       
       
        
        $hash_pass = password_hash($staff_pass,PASSWORD_DEFAULT);

        $sql = 'SELECT * FROM firedept_staff WHERE staff_name = :staff_name AND fire_dept_code = :fire_dept_code';
        $stmt = $db_host->prepare($sql);
        $stmt->bindValue(':staff_name', $staff_name,PDO::PARAM_STR);
        $stmt->bindValue(':fire_dept_code',$fire_dept_code,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            if (password_verify($staff_pass, $result['staff_pass'])) {
                $_SESSION['login'] = 1;
                $_SESSION['id'] = $result['staff_id'];
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
                $errors['パスワードエラー'] = 'パスワードが間違っています。';
            }
        } else {
            $errors['ユーザーエラー'] = 'ユーザー名、又は消防署コードが違います。';
        }

        //エラーメッセージがある場合、login.phpにリダイレクト
        if (!empty($errors)) {
            header('Location: login.php?' . http_build_query($errors));
            exit();
        }
   

?>

