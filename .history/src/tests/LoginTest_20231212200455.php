<?php
use PHPUnit\Framework\TestCase;



class LoginTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        require '/var/www/html/taishobutu_app/common/config.php';
        // login.phpを実行
        require '/var/www/html/taishobutu_app/login/login.php';
        // login_check.phpを実行
        require '/var/www/html/taishobutu_app/login/login_check.php';
    }

    public function testLoginForm()
    {
        $_POST = [
            'name' => '消防太郎',
            'pass' => 'password123',
            'fire_dept_code' => 1,
            'rememberme' => true
        ];

        // login_check.phpを実行
        require 'login_check.php';

        // セッション変数やデータベースの状態を確認して、ログインが成功したかどうかをテスト
        // これはあなたのアプリケーションの具体的な実装によります
    }
}
