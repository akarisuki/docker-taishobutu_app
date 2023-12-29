<?php
use PHPUnit\Framework\TestCase;

class TaishobutuIndexTest extends TestCase
{
    public function testFormSubmission()
    {
        // $_POSTをモック
        $_POST = [
            'search' => true,
            'search_appendix' => '1',
            'search_taishobutu_name' => 'test_name',
            'search_taishobutu_address' => 'test_address',
            'search_total_area' => '100',
        ];

        // テスト対象のスクリプトを実行
        require '/var/www/html/taishobutu_app/taishobutu/taishoutu_index.php';

        // セッション変数が期待通りに設定されていることを確認
        $this->assertEquals(1, $_SESSION['search_appendix']);
        $this->assertEquals('test_name', $_SESSION['search_taishobutu_name']);
        $this->assertEquals('test_address', $_SESSION['search_taishobutu_address']);
        $this->assertEquals(100, $_SESSION['search_total_area']);
    }
}