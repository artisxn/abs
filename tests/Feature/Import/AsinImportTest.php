<?php

namespace Tests\Feature\Import;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;

use App\Model\User;
use App\Model\Item;

use App\Jobs\Import\AsinImportJob;
use App\Jobs\ItemJob;

class AsinImportTest extends TestCase
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

    public function testAsinCsvUpload()
    {
        Bus::fake();

        $file = UploadedFile::fake()->create('asin.csv');

        $response = $this->actingAs($this->user)
                         ->post('/import/asin', [
                             'csv' => $file,
                         ]);

        Bus::assertDispatched(AsinImportJob::class, function ($job) use ($file) {
            return $job->file_path === $file->path();
        });

        $response->assertSuccessful()
                 ->assertViewIs('import.start')
                 ->assertViewHas([
                     'csv_count',
                 ]);
    }

    public function testAsinCsvUploadFail()
    {
        Bus::fake();

        $response = $this->actingAs($this->user)
                         ->post('/import/asin');

        Bus::assertNotDispatched(AsinImportJob::class);

        $response->assertSessionHasErrors([
            'csv',
        ])->assertRedirect();
    }

    public function testAsinImportJob()
    {
        Bus::fake();

        $job = new AsinImportJob(base_path('tests/fixture/asin.csv'), $this->user->id);

        $count = $job->handle();

        $this->assertDatabaseHas('watches', [
            'user_id' => $this->user->id,
            'asin_id' => '0000000000',
        ]);

        Bus::assertDispatched(ItemJob::class, function ($job) {
            return $job->asin === '0000000000';
        });

        Bus::assertDispatched(ItemJob::class, function ($job) {
            return $job->asin === '1111111111';
        });

        $this->assertEquals($count, 3);
    }

    /**
     * すでに取得済の場合は再取得しない
     */
    public function testAsinImportJobExists()
    {
        Bus::fake();

        $watch = factory(Item::class)->create([
            'asin' => '0000000000',
        ]);

        $job = new AsinImportJob(base_path('tests/fixture/asin.csv'), $this->user->id);

        $count = $job->handle();

        $this->assertDatabaseHas('watches', [
            'user_id' => $this->user->id,
            'asin_id' => '0000000000',
        ]);

        Bus::assertNotDispatched(ItemJob::class, function ($job) {
            return $job->asin === '0000000000';
        });

        Bus::assertDispatched(ItemJob::class, function ($job) {
            return $job->asin === '1111111111';
        });

        $this->assertEquals($count, 3);
    }
}
