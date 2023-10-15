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

class SignUpCheckTest extends TestCase {
  public function testUserNameValidation()
  {
      // PDOのモックを作成
      $pdo = $this->createMock(PDO::class);
      
      // PDOStatementのモックを作成
      $stmt = $this->createMock(PDOStatement::class);

      // PDO::prepareが呼ばれたらPDOStatementのモックを返す
      $pdo->method('prepare')
          ->willReturn($stmt);

      // PDOStatement::bindValueが呼ばれたらtrueを返す
      $stmt->method('bindValue')
          ->willReturn(true);

      // PDOStatement::executeが呼ばれたらtrueを返す
      $stmt->method('execute')
          ->willReturn(true);

      // PDOStatement::fetchが呼ばれたら['COUNT(*)' => 0]を返す（ユーザ名が存在しない場合）
      $stmt->method('fetch')
          ->willReturn(['COUNT(*)' => 0]);

      // $_POSTのモック
      $_POST = [
          'name' => 'valid_user_name',
          'pass' => 'valid_password'
      ];

      // テスト対象のスクリプトを実行
      ob_start();  // 出力バッファリング開始
      include '/../taishobutu_app/sign_up/sign_up.php';
      $output = ob_get_clean();  // 出力内容を取得してバッファリング終了
      
      // アサーション（ここではエラーが存在しないことを確認）
      $this->assertStringNotContainsString('error', $output);
  } 
}
?>
