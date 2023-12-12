<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    private $htmlContent;

    protected function setUp(): void
    {
        ob_start();
        require_once __DIR__ . '/../taishobutu_app/common/config.php';
        require_once __DIR__ . '/../taishobutu_app/login/login.php';
        $this->htmlContent = ob_get_clean();
    }

    public function testLoginFormExists()
    {
        $this->assertStringContainsString('<form', $this->htmlContent);
        $this->assertStringContainsString('action="login_check.php"', $this->htmlContent);
    }

    public function testStaffNameFieldExists()
    {
        $this->assertStringContainsString('name="name"', $this->htmlContent);
    }

    public function testStaffPasswordFieldExists()
    {
        $this->assertStringContainsString('name="pass"', $this->htmlContent);
    }

    public function testFireDeptCodeFieldExists()
    {
        $this->assertStringContainsString('name="fire_dept_code"', $this->htmlContent);
    }

    public function testLoginFormSubmitButtonExists()
    {
        $this->assertStringContainsString('type="submit"', $this->htmlContent);
        $this->assertStringContainsString('value="ログイン"', $this->htmlContent);
    }

    public function testLoginFormContainsLinkToSignUpPage()
    {
        $this->assertStringContainsString('href="'. BASE_URL .'sign_up/sign_up.php"', $this->htmlContent);
    }
}
