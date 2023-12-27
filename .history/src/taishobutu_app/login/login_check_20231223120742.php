<?php

session_start();
    try{
        
        //require_once '/home/ubuntu/public_html/taishobutu_app/common/sanitize.php';
        require_once __DIR__ . '/../common/db_operation/db_connect.php';

        $post = $_POST;

        $staff_name = $post['name'];
        $staff_pass = $post['pass'];
        $fire_dept_code = $post['fire_dept_code']; 

        
        if (empty($staff_name)) {
            $error_name = '職員名が入力されていません。';
        }

        if (empty($staff_pass)) {
            $error_pass = 'パスワードが入力されていません。';
        }

        if($fire_dept_code === "0") {
            $error_fire_dept_code = '消防署コードを選択してください。';
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

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/sass/login/login.css">
    <title>防火対象物管理アプリ</title>
</head>

<body>
<div class="title">ログイン画面</div>
    <div class="form-wrapper">
        <form method="post" action="login_check.php">
            <div class="staff_name">
                <label for="name" class="required">職員名</label>
                <input type="text" placeholder="消防太郎" name="name"><br />
                <?php if (!empty($error_name)) : ?>
                    <ul class="error-message-name">
                            <li><?= $error_name ?></li>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="staff_pass">
                <label for="password" class="required">パスワード</label>
                <input type="password" placeholder="半角整数8文字以上で" name="pass"><br /><br/><br/><br/>
                <?php if (!empty($error_pass)) : ?>
                    <ul class="error-message-pass">
                            <li><?= $error_pass ?></li>
                    </ul>
                <?php endif; ?>
                <?php if (!empty($error_name_pass)) : ?>
                <ul class="error-message-name-pass">
                        <li><?= $error_name_pass ?></li>
                </ul>
            <?php endif; ?>
            </div>
            <div class="fire_dept_code">
                <label for="fire_dept_code" class="required">消防署コード</label>
                <select name="fire_dept_code" id="fire_dept_code">
                    <option value=0 selected>選択してください</option>
                    <option value=1>A消防署</option>
                    <option value=2>B消防署</option>
                    <option value=3>C消防署</option>
                    <option value=4>D消防署</option>
                    <option value=5>E消防署</option>
                    <option value=6>F消防署</option>
                </select>
                <?php if (!empty($error_fire_dept_code)) : ?>
                    <ul class="error-fire-dept-code">
                        <li><?= $error_fire_dept_code ?></li>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="link">
                <a class="sign_up" href="<?php echo BASE_URL; ?>sign_up/sign_up.php">登録していない場合はこちら</a><br/>
                <a class="password_reset" href="<?php echo BASE_URL; ?>password_reset/password_reset.php">パスワードを忘れてしまった場合はこちら</a>
            </div>
            <div class="rememberme">
                <input type="checkbox" name="rememberme">ログイン情報を保持する。
            </div>
            
            <input type="submit" value="ログイン">
        </form>
    </div>
</body>

</html>



