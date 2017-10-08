<?php
namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $response = $this->get('/usage');

        $response->assertSee('Amazon');
    }

    public function testWatchRedirect()
    {
        $response = $this->get('/watch');

        $response->assertRedirect('/login');
    }

    public function testExportRedirect()
    {
        $response = $this->get('/export');

        $response->assertRedirect('/login');
    }
}
