<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Model\User;
use App\Model\Watch;
use App\Model\WorldItem;

use Illuminate\Support\Facades\Bus;
use App\Jobs\World\WorldWatchJob;
use App\Jobs\Watch\JanToAsinJob;

class ApiTest extends TestCase
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

        $watch = factory(Watch::class)->create([
            'user_id' => $this->user->id,
            'asin_id' => 'test_asin',
        ]);

        $item = factory(WorldItem::class)->create([
            'asin' => 'test_asin',
            'ean'  => 'test_ean',
        ]);

        config(['amazon-feature.world' => true]);
    }

    public function testWorldIndex()
    {
        $response = $this->actingAs($this->user, 'api')
                         ->json('GET', '/api/world');

        $response->assertSuccessful()
                 ->assertJson([
                     'data' => [
                         [
                             'id'   => true,
                             'asin' => 'test_asin',
                         ],
                     ],
                 ]);
    }

    public function testWorldShowAsin()
    {
        $response = $this->actingAs($this->user, 'api')
                         ->json('GET', '/api/world/asin/test_asin');

        $response->assertSuccessful()
                 ->assertJson([
                     'data' => [
                         [
                             'id'   => true,
                             'asin' => 'test_asin',
                         ],
                     ],
                 ]);
    }

    public function testWorldShowEan()
    {
        $response = $this->actingAs($this->user, 'api')
                         ->json('GET', '/api/world/ean/test_ean');

        $response->assertSuccessful()
                 ->assertJson([
                     'data' => [
                         [
                             'id'  => true,
                             'ean' => 'test_ean',
                         ],
                     ],
                 ]);
    }

    public function testWorldNew()
    {
        $response = $this->actingAs($this->user, 'api')
                         ->json('GET', '/api/world/new');

        $response->assertSuccessful()
                 ->assertJson([
                     'data' => [
                         [
                             'id'   => true,
                             'asin' => true,
                         ],
                     ],
                 ]);
    }

    public function testWorldUpdate()
    {
        Bus::fake();

        $asin = 'test_asin_';

        $item = factory(WorldItem::class)->create([
            'asin'    => $asin,
            'country' => 'JP',
        ]);

        $asins = [$asin];
        $country = 'JP';

        $response = $this->actingAs($this->user, 'api')
                         ->json('POST', '/api/world/update', [
                             'asin'    => $asin,
                             'country' => 'JP',
                         ]);

        Bus::assertDispatched(WorldWatchJob::class, function ($job) use ($asins, $country) {
            return $job->asins === $asins and $job->country === $country;
        });

        $response->assertSuccessful()
                 ->assertJson([
                     'data' => [
                         [
                             'id'      => true,
                             'asin'    => $asin,
                             'country' => 'JP',
                         ],
                     ],
                 ]);
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
}
