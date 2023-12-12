<?php
use PHPUnit\Framework\TestCase;

class LoginCheckTest extends TestCase
{
    public function testSuccessfulLogin()
    {
        $_POST = [
            'name' => '正しいユーザー名',
            'pass' => '正しいパスワード',
            'fire_dept_code' => 1
        ];

        // login_check.phpを実行
        require '/var/www/html/src/taishobutu_app/login/login_check.php';

        // ログインが成功したことを確認
        $this->assertEquals(1, $_SESSION['login']);
        $this->assertEquals('正しいユーザー名', $_SESSION['name']);
        // その他のセッション変数も適切に設定されていることを確認
    }

    public function testFailedLogin()
    {
        $_POST = [
            'name' => '間違ったユーザー名',
            'pass' => '間違ったパスワード',
            'fire_dept_code' => 1
        ];

        // login_check.phpを実行
        require '/var/www/html/src/taishobutu_app/login/login_check.php';

        // ログインが失敗したことを確認
        $this->assertEquals('ユーザー名、又はパスワードが違います。', $error_name_pass);
    }
}