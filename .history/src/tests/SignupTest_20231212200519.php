<?php
use PHPUnit\Framework\TestCase;



class SignUpTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        require '/var/www/html/taishobutu_app/common/config.php';
        // login.phpを実行
        require  '/var/www/html/taishobutu_app/sign_up/sign_up.php';
        // sign_up_check.phpを実行
        require  '/var/www/html/taishobutu_app/sign_up/sign_up_check.php';
    }

    public function testSignUpForm()
    {
        $_POST = [
            'name' => '新規太郎',
            'pass' => 'newpassword123',
            'fire_dept_code' => 2
        ];

        // sign_up_check.phpを実行
        require 'sign_up_check.php';

        // セッション変数やデータベースの状態を確認して、登録が成功したかどうかをテスト
        // これはあなたのアプリケーションの具体的な実装によります
    }
}