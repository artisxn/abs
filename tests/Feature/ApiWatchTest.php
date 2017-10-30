<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Model\User;

use Illuminate\Support\Facades\Bus;

use App\Jobs\Watch\JanToAsinJob;

class ApiWatchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    protected $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testWatchStoreAsin()
    {
        $asin = 'testasin10';

        $response = $this->actingAs($this->user, 'api')
                         ->json('POST', '/api/watch/asin', [
                             'asin'     => $asin,
                             'priority' => 1,
                         ]);

        $response->assertSuccessful()
                 ->assertJson(
                     [
                         'asin_id'  => $asin,
                         'priority' => 1,
                     ]
                 );
    }

    public function testWatchStoreAsinValidateError()
    {
        $asin = 'testasin10_';

        $response = $this->actingAs($this->user, 'api')
                         ->json('POST', '/api/watch/asin', [
                             'asin'     => $asin,
                             'priority' => 2,
                         ]);

        $response->assertStatus(422)
                 ->assertJson(
                     [
                         'message' => true,
                         'errors'  => true,
                     ]
                 );
    }

    public function testWatchStoreJan()
    {
        Bus::fake();

        $ean = 'test_ean___13';

        $response = $this->actingAs($this->user, 'api')
                         ->json('POST', '/api/watch/ean', [
                             'ean' => $ean,
                         ]);

        Bus::assertDispatched(JanToAsinJob::class, function ($job) use ($ean) {
            return $job->jan_lists === [$ean];
        });

        $response->assertSuccessful()
                 ->assertJson(
                     [
                         'message' => true,
                     ]
                 );
    }

    public function testWatchStoreJanValidateError()
    {
        Bus::fake();

        $ean = 'test_ean___13_';

        $response = $this->actingAs($this->user, 'api')
                         ->json('POST', '/api/watch/ean', [
                             'ean' => $ean,
                         ]);

        Bus::assertNotDispatched(JanToAsinJob::class);

        $response->assertStatus(422)
                 ->assertJson(
                     [
                         'message' => true,
                         'errors'  => true,
                     ]
                 );
    }
}
