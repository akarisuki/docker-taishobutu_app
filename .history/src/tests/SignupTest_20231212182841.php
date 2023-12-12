<?php
use PHPUnit\Framework\TestCase;


// sign_up_check.phpを実行
require __DIR__ . '/../src/taishobutu_app/sign_up/sign_up_check.php';
class SignUpTest extends TestCase
{
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