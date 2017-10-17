<?php

namespace App\Jobs\Download;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Http\Resources\Csv\Item as ItemResource;

use League\Csv\Writer;

use App\Repository\Browse\BrowseRepositoryInterface as BrowseRepository;
use App\Model\User;

use App\Notifications\CsvEported;

use Storage;

class ExportCategoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var string
     */
    protected $order;

    /**
     * @var string
     */
    protected $sort;

    /**
     * @var integer
     */
    protected $limit;

    /**
     * Create a new job instance.
     *
     * @param User   $user
     * @param string $category
     * @param string $order
     * @param string $sort
     * @param int    $limit
     */
    public function __construct(
        User $user,
        string $category,
        string $order = 'updated_at',
        string $sort = 'desc',
        int $limit = 1000
    ) {
        $this->user = $user;
        $this->category = $category;
        $this->order = $order;
        $this->sort = $sort;
        $this->limit = $limit;
    }

    /**
     * Execute the job.
     *
     * @param BrowseRepository $repository
     *
     * @return string
     */
    public function handle(BrowseRepository $repository)
    {
        \DB::disableQueryLog();

        $file_name = 'abs-category-' . $this->category . '-' . today()->toDateString() . '.csv';

        $path = 'csv/' . $this->user->id . '/';

        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }

        $file = Storage::path($path . $file_name);
        info($file);

        $writer = Writer::createFromPath($file, 'w');

        $writer->insertOne(config('amazon.csv_header'));

        $items = $repository->exportCursor($this->category, $this->order, $this->sort, $this->limit);

        foreach ($items as $item) {
            $line = (new ItemResource($item))->toArray(request());

            $writer->insertOne($line);
        }

        $this->user->notify(new CsvEported('CSVダウンロード(カテゴリー)', $file_name));
    }
}
