<?php

namespace Tests\Feature\Import;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;

use App\Model\User;

use App\Jobs\Import\JanImportJob;
use App\Jobs\Import\JanToAsinJob;

class JanImportTest extends TestCase
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

    public function testJanCsvUpload()
    {
        Bus::fake();

        $file = UploadedFile::fake()->create('jan.csv');

        $response = $this->actingAs($this->user)
                         ->post('/import/jan', [
                             'csv' => $file,
                         ]);

        Bus::assertDispatched(JanImportJob::class, function ($job) use ($file) {
            return $job->file_path === $file->path();
        });

        $response->assertSuccessful()
                 ->assertViewIs('import.start')
                 ->assertViewHas('csv_count');
    }

    public function testJanCsvUploadFail()
    {
        Bus::fake();

        $response = $this->actingAs($this->user)
                         ->post('/import/jan');

        Bus::assertNotDispatched(JanImportJob::class);

        $response->assertSessionHasErrors([
            'csv',
        ])->assertRedirect();
    }

    public function testJanImportJob()
    {
        Bus::fake();

        $job = new JanImportJob(base_path('tests/fixture/jan.csv'), $this->user->id);

        $count = $job->handle();

        Bus::assertDispatched(JanToAsinJob::class, function ($job) {
            return $job->jan_lists === ['0000000000000','1111111111111'];
        });

        $this->assertEquals($count, 3);
    }
}
