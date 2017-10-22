<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Model\User;
use App\Model\Watch;
use App\Model\WorldItem;

use Illuminate\Support\Facades\Bus;
use App\Jobs\World\WorldWatchJob;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    protected $user;

    public function setUp()
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
                             'asin' => true,
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

        $item = factory(WorldItem::class)->create([
            'asin'    => 'test_asin_',
            'country' => 'JP',
        ]);

        $asins = ['test_asin_'];
        $country = 'JP';

        $response = $this->actingAs($this->user, 'api')
                         ->json('POST', '/api/world/update', [
                             'asin'    => 'test_asin_',
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
                             'asin'    => 'test_asin_',
                             'country' => 'JP',
                         ],
                     ],
                 ]);
    }
}
