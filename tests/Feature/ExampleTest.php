<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends BrowserKitTest
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
            ->see('Amazon');
    }

    public function testSearch()
    {
        $this->visit('/')
            ->type('amazon', 'keyword')
            ->select('Electronics', 'category')
            ->press('search_button')
            ->seePageIs('/search?category=Electronics&keyword=amazon')
            ->seeElement('h2')
            ->assertResponseOk();
    }

    public function testBrowseList()
    {
        $this->visit('/')
            ->click('ブラウズリスト')
            ->seePageIs('/browse')
            ->seeElement('li');

        $this->assertGreaterThan(50, mb_substr_count($this->response->content(), '<li>', 'utf-8'));
    }
}
