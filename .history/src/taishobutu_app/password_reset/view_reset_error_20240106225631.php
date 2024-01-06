<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../common/sass/password_reset/password_reset.css">
    <title>防火対象物管理アプリ</title>
</head>
<body>
    <div class="title">パスワードリセット</div>
    <div class="form-wrapper">
        <form action="reset.php" method="POST">
            <ul class="error-reset-password">
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
          <div class="back-button"><input type="button" onclick="history.back()" value="戻る"></div>
        </form>
    </div>
</body>
</html>