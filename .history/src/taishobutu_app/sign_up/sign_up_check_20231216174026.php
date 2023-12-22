<?php

use PHP_CodeSniffer\Tokenizers\PHP;

require_once __DIR__ . '/../common/db_operation/db_connect.php';


    $post = $_POST;

    $staff_name = $post['name'];
    $staff_pass = $post['pass'];
    $fire_dept_code = (int)$post['fire_dept_code'];
    $security_question = $post['security_question'];
    $security_answer = $post['security_answer'];

    
    //ユーザー名の重複
    $sql = 'SELECT COUNT(*) FROM firedept_staff WHERE staff_name = :staff_name';
    $stmt = $db_host->prepare($sql);
    $stmt->bindValue(':staff_name', $staff_name, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $result = array_map('intval', $result);

    $error_name = [];
    $error_pass = [];
    $error_security = [];

    if ($result['COUNT(*)'] >= 1) {
        $error_name['重複'] = 'この職員名は既に使用されています。';
    }

    if (empty($staff_name)) {
        $error_name['未入力'] = '職員名が入力されていません。';
    }

    if (empty($staff_pass)) {
        $error_pass['未入力'] = 'パスワードが入力されていません。';
    }


    if (!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,20}+\z/i', $staff_pass)) {
        $error_pass['規則性違反'] = 'パスワードは８文字以上20文字以下に英数字を最低１文字含むようにしてください。';
    }

    if($fire_dept_code === 0) {
        $error_fire_dept_code = '消防署コードを選択してください。';
    }

    if (isset($error_fire_dept_code)) {
        $error_fire_dept_code = ['fire_dept_code' => $error_fire_dept_code];
    } else {
        $error_fire_dept_code = [];
    }

    if (empty($security_question)) {
        $error_security['未入力'] = '秘密の質問が選択されていません。';
    }
    
    if (empty($security_answer)) {
        $error_security['未入力'] = '秘密の質問の答えが入力されていません。';
    }
    
    if (isset($error_security)) {
        $error_security = ['security' => $error_security];
    } else {
        $error_security = [];
    }

    $error = array_merge($error_name, $error_pass,$error_fire_dept_code,$error_security);

    

    if (empty($error)) {
        // エラーがなければ自動的にsign_up_done.phpにPOST
        echo '<body onload="document.FRM.submit();" >';
        echo '<form name="FRM" method="POST" action="sign_up_done.php">';
        echo '<input type="hidden" name="name" value="' . htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8') . '">';
        echo '<input type="hidden" name="pass" value="' . htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8') . '">';
        echo '<input type="hidden" name="fire_dept_code" value="' . $fire_dept_code . '">';
        echo '<input type="hidden" name="security_question" value="' . $security_question . '">';
        echo '<input type="hidden" name="security_answer" value="' . $security_answer . '">';
        echo '</form>';
        echo '</body>';
    } else {

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/sass/sign_up/sign_up.css">
    <title>防火対象物管理アプリ</title>
</head>

<body>
    <div class="title">職員登録画面</div>
    <div class="form-wrapper">
        <form method="post" action="sign_up_check.php">
            <div class="staff_name">
                <label for="name"class="required">職員名</label>
                <input type="text" placeholder="消防太郎" name="name" value="<?php 
                    if(isset($staff_name['重複'])) {
                        echo '';
                    } else {
                        echo htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
                    } 
                ?>">
            
                <?php if (!empty($error_name)) : ?>
                    <ul class="error-message-name">
                        <?php foreach ($error_name as $err_name) : ?>
                            <li><?= $err_name ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="staff_pass">
                <label for="password"class="required">パスワード</label>
                <input type="password" placeholder="半角整数8文字以上で" name="pass" value="<?php
                    if(isset($staff_pass['規則性違反'])) {
                        echo '';
                    } else {
                        echo htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');
                    }
                ?>">
                <?php if (!empty($error_pass)) : ?>
                    <ul class="error-message-pass">
                        <?php foreach ($error_pass as $err_pass) : ?>
                            <li><?= $err_pass ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="staff_pass_confirm">
                <label for="password_confirm"class="required">パスワード確認</label>
                <input type="password" placeholder="半角整数8文字以上で" name="pass_confirm">
                <?php if (!empty($error_pass_confirm)) : ?>
                    <ul class="error-message-pass-confirm">
                        <?php foreach ($error_pass_confirm as $err_pass_confirm) : ?>
                            <li><?= $err_pass_confirm ?></li>
                        <?php endforeach; ?>
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
                    <ul><li class="error-fire-dept-code">消防署コードを選択してください。</li></ul>
                <?php endif ?>
            </div>
            <div class="security_question">
                <select name="security_question">
                    <option value="">秘密の質問を選択してください</option>
                    <option value="q1">初めて飼ったペットの名前は何ですか？</option>
                    <option value="q2">母親の旧姓は何ですか？</option>
                    <option value="q3">生まれた都市は何ですか？</option>
                    <!-- 他の質問を追加することも可能です -->
                </select>
                <input type="hidden" id="hidden_question" name="hidden_question">
                <input type="text" name="security_answer" placeholder="あなたの答え">
                <?php if (!empty($error_security)) : ?>
                    <ul class="error-message-security">
                        <?php foreach ($error_security as $err_security) : ?>
                            <li><?= $err_security ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <input type="submit" value="登録" >
            <input type="button" onclick="history.back()" value="戻る">
            
        </form>
    </div>
</body>
</html>
<?php } ?>