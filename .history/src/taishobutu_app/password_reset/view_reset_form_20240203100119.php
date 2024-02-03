

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/sass/common/reset.css">
    <link rel="stylesheet" href="../common/sass/password_reset/password_reset.css">
    <title>防火対象物管理アプリ</title>
</head>
<body>
    <div class="title">パスワードリセット</div>
    <div class="form-wrapper">
        <form action="reset.php" method="POST">
        <input type="hidden" name="_csrf_token" value="<?= $_SESSION['_csrf_token']; ?>">
        <input type="hidden" name="password_reset_token" value="<?= $passwordResetToken ?>">

            <div class="new_staff_pass">
                <label for="password" class="required">パスワード</label>
                <input type="password" placeholder="半角整数8文字以上で" name="staff_pass">
            </div>
            
            <div class="new_staff_pass_confirm">
                <label for="password_confirm"class="required">パスワード確認</label>
                <input type="password" placeholder="半角整数8文字以上で" name="staff_pass_confirm">
            </div>

            
            
            
            <input type="submit" value="送信">
        </form>
    </div>
</body>
</html>