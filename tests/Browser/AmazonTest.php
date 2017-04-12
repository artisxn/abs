<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AmazonTest extends DuskTestCase
{
    public function testSearch()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                    ->type('keyword', 'amazon')
                    ->select('category', 'Electronics')
                    ->click('#search_icon')
                    ->assertPathIs('/search')
                    ->assertQueryStringHas('category', 'Electronics')
                    ->assertQueryStringHas('keyword', 'amazon')
                    ->assertInputValue('keyword', 'amazon');
        });
    }

    public function testBrowseList()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                    ->clickLink('ブラウズリスト')
                    ->assertSee('ブラウズリスト')
                    ->assertPathIs('/browse');
        });
    }

    public function testAsin()
    {
        $this->browse(function ($browser) {
            $browser->visit('/asin/B004N3APGO')
                    ->assertSee('Amazonギフト券')
                    ->assertPathIs('/asin/B004N3APGO');
        });
    }
}
