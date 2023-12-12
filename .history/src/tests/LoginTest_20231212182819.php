<?php
use PHPUnit\Framework\TestCase;

// login_check.phpを実行
require __DIR__ . '/../src/taishobutu_app/login/login_check.php';

class LoginTest extends TestCase
{
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
