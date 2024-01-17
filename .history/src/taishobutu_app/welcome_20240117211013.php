<?php

require_once 'common/config.php';

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予防119</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        .bg-image {
            /* 背景画像 */
            background-image: url('common/image/flames-engulfed-the-burning-building-firefighters-worked-urgently-generated-by-ai_188544-40616.jpeg');
            
            /* フルハイト */
            height: 100%; 

            /* 背景画像を常にカバー */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
        }

        .content h1 {
            @media (max-width: 480px) {
                
                font-size: 23px; 
            }
            font-size: 50px;
            margin-bottom: 175px;
        }

        .content a {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .content a:hover {
            background-color: #0056b3;
        }

        .alert-success {
            position: absolute;
            font-size: 40px;
            top: 142px;
            left: 50px;
            color: #35cb07;
        }
    </style>
</head>
<body>

<div class="bg-image">
    <div class="content">
        <h1>ようこそ、予防119へ</h1>
        <?php
            if (isset($_GET['message'])) {
                $message = htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8');
                echo "<div class='alert-success'>{$message}</div>";
            }
            
        ?>
        <br/>
        <a href="<?php echo BASE_URL;?>/login/login.php">ログイン画面へ</a>
    </div>
</div>

</body>
</html>
