<?php
use PHPUnit\Framework\TestCase;

class SignUpTest extends TestCase
{
    private $signUpForm;
    
    protected function setUp(): void {
        // 一度読み込んで、その内容をテストする
        $this->signUpForm = file_get_contents(__DIR__ . '/../taishobutu_app/sign_up/sign_up.php');
    }

    

    public function testFormExists()
    {
        $formHtml = file_get_contents(__DIR__ . '/../taishobutu_app/sign_up/sign_up.php');
        error_log($formHtml);  // Log the HTML content
        $this->assertStringContainsString('<form', $formHtml);
    }

    public function testFormHasNameField()
    {
        $this->assertStringContainsString('name="name"', $this->signUpForm);
    }

    public function testFormHasPasswordField()
    {
        $this->assertStringContainsString('name="pass"', $this->signUpForm);
    }

    public function testFormHasCorrectAction()
    {
        $this->assertStringContainsString('action="sign_up_check.php"', $this->signUpForm);
    }

    public function testFormHasSubmitButton()
    {
        $this->assertStringContainsString('type="submit"', $this->signUpForm);
    }

    // その他、フォームの要素が正しく設定されているかのテスト...
}
?>
