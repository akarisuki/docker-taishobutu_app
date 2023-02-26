<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    

    public function testLoginFormExists()
    {
      require_once(__DIR__ . '/../taishobutu_app/login/login.php' );
      $loginForm = file_get_contents(__DIR__ . '/../taishobutu_app/login/login.php');
        $this->assertNotNull($loginForm);
    }

    public function testLoginFormHasNameField()
    {
      require_once(__DIR__ . '/../taishobutu_app/login/login.php' );
      $loginForm = file_get_contents(__DIR__ . '/../taishobutu_app/login/login.php');
        $this->assertStringContainsString('name', $loginForm);
    }

    public function testLoginFormHasPasswordField()
    {
      require_once(__DIR__ . '/../taishobutu_app/login/login.php' );
      $loginForm = file_get_contents(__DIR__ . '/../taishobutu_app/login/login.php');
        $this->assertStringContainsString('pass', $loginForm);
    }

    public function testLoginFormSubmitButtonExists()
    {
      require_once(__DIR__ . '/../taishobutu_app/login/login.php' );
      $loginForm = file_get_contents(__DIR__ . '/../taishobutu_app/login/login.php');
        $this->assertStringContainsString('ログイン', $loginForm);
    }

    public function testLoginFormContainsLinkToPasswordResetPage()
    {
      require_once(__DIR__ . '/../taishobutu_app/login/login.php' );
        $loginForm = file_get_contents(__DIR__ . '/../taishobutu_app/login/login.php');
        $this->assertStringContainsString('パスワードを忘れた場合', $loginForm);
    }

    public function testLoginFormContainsLinkToSignUpPage()
    {
      require_once(__DIR__ . '/../taishobutu_app/login/login.php' );
      $loginForm = file_get_contents(__DIR__ . '/../taishobutu_app/login/login.php');
        $this->assertStringContainsString('登録していない場合はこちら', $loginForm);
    }

    public function testLoginFormContainsRememberMeCheckbox()
    {
      require_once(__DIR__ . '/../taishobutu_app/login/login.php' );
      $loginForm = file_get_contents(__DIR__ . '/../taishobutu_app/login/login.php');
        $this->assertStringContainsString('ログイン情報を保持する', $loginForm);
    }
}


?>