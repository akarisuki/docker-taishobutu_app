<?php
    try{
        
            
            require_once '../common/config.php';
            //データベースに接続するファイルを呼び出す。
            require_once '../common/db_operation/db_connect.php';
            //登録フォームから入力したデータを$postに格納する
            $post = $_POST;

            $staff_name = $post['name'];
            $staff_pass = $post['pass'];
            $fire_dept_code = $post['fire_dept_code'];
            $security_question = $post['security_question'];
            $security_answer = $post['security_answer'];
            //パスワードの暗号化
            $hash_pass = password_hash($staff_pass, PASSWORD_DEFAULT);

            $sql = 'INSERT INTO firedept_staff SET staff_name = :staff_name,staff_pass = :staff_pass ,fire_dept_code = :fire_dept_code,security_question = :security_question,security_answer = :security_answer';
            $stmt = $db_host->prepare($sql);
            $stmt->bindValue(':staff_name', $staff_name, PDO::PARAM_STR);
            $stmt->bindValue(':staff_pass', $hash_pass, PDO::PARAM_STR);
            $stmt->bindValue(':fire_dept_code', $fire_dept_code, PDO::PARAM_INT);
            $stmt->bindValue(':security_question', $security_question,PDO::PARAM_STR);
            $stmt->bindValue(':security_answer', $security_answer,PDO::PARAM_STR);
            $stmt->execute();
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => '登録が完了しました。'
            ];

            header('Location: ' .BASE_URL. 'welcome.php');
            exit;
            

            /*
            //登録後、即座にログイン処理
            $sql = " SELECT * FROM firedept_staff WHERE staff_name = :staff_name";
            $stmt = $db_host->prepare($sql);
            $stmt->bindValue(':staff_name',$staff_name, PDO::PARAM_STR);
            $stmt->execute();
            $result  =  $stmt->fetch(PDO::FETCH_ASSOC);

            

            if (password_verify($staff_pass, $hash_pass)) {
                //ログイン成功の場合、セッションにログイン情報を格納
                session_start();  
                $_SESSION['login'] = 1;
                $_SESSION['id'] = $result['code'];
                $_SESSION['name'] = $result['staff_name'];
                header('Location: ../taishobutu/taishobutu_index.php');
                exit;
            } else {
                //ログイン失敗の場合、エラーメッセージを表示し、ログイン画面に戻す
                echo "ログインに失敗しました。入力された情報をご確認ください。";
                echo '<a href="login.php">ログイン画面に戻る</a>';
            }
            */
            
        

    } catch (PDOException  $e) {
            print $e->getMessage().'ただいま障害により大変ご迷惑をおかけしております。';
            exit();
    }

        
    
?> 