<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    require_once(__DIR__ . '/login/' )

    public function testLoginFormExists()
    {
        $loginForm = file_get_contents('../login/login.php');
        $this->assertNotNull($loginForm);
    }

    public function testLoginFormHasNameField()
    {
        $loginForm = file_get_contents('../login/login.php');
        $this->assertStringContainsString('name', $loginForm);
    }

    public function testLoginFormHasPasswordField()
    {
        $loginForm = file_get_contents('../login/login.php');
        $this->assertStringContainsString('pass', $loginForm);
    }

    public function testLoginFormSubmitButtonExists()
    {
        $loginForm = file_get_contents('../login/login.php');
        $this->assertStringContainsString('ログイン', $loginForm);
    }

    public function testLoginFormContainsLinkToPasswordResetPage()
    {
        $loginForm = file_get_contents('../login/login.php');
        $this->assertStringContainsString('パスワードを忘れた場合', $loginForm);
    }

    public function testLoginFormContainsLinkToSignUpPage()
    {
        $loginForm = file_get_contents('../login/login.php');
        $this->assertStringContainsString('登録していない場合はこちら', $loginForm);
    }

    public function testLoginFormContainsRememberMeCheckbox()
    {
        $loginForm = file_get_contents('../login/login.php');
        $this->assertStringContainsString('ログイン情報を保持する', $loginForm);
    }
}


?>