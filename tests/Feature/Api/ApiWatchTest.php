<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Model\User;
use App\Model\Watch;
use App\Model\BrowseWatch;

use Illuminate\Support\Facades\Bus;

use App\Jobs\Import\JanToAsinJob;

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

    public function testWatchAsinDelete()
    {
        $asin = 'testasin10';

        $watch = factory(Watch::class)->create([
            'user_id' => $this->user->id,
            'asin_id' => $asin,
        ]);

        $response = $this->actingAs($this->user, 'api')
                         ->json('DELETE', '/api/watch/asin/' . $asin);

        $response->assertSuccessful();
    }

    public function testWatchDeleteNotFound()
    {
        $asin = 'testasin10';

        $response = $this->actingAs($this->user, 'api')
                         ->json('DELETE', '/api/watch/asin/' . $asin);

        $response->assertStatus(404);
    }

    public function testWatchStoreBrowse()
    {
        $response = $this->actingAs($this->user, 'api')
                         ->json('POST', '/api/watch/browse', [
                             'browse' => 1,
                         ]);

        $response->assertSuccessful()
                 ->assertJson(
                     [
                         'browse_id' => 1,
                     ]
                 );
    }

    public function testWatchBrowseDelete()
    {
        $watch = factory(BrowseWatch::class)->create([
            'user_id'   => $this->user->id,
            'browse_id' => 1,
        ]);

        $response = $this->actingAs($this->user, 'api')
                         ->json('DELETE', '/api/watch/browse/1');

        $response->assertSuccessful();
    }

    public function testWatchBrowseDeleteNotFound()
    {
        $response = $this->actingAs($this->user, 'api')
                         ->json('DELETE', '/api/watch/browse/1');

        $response->assertStatus(404);
    }
}
