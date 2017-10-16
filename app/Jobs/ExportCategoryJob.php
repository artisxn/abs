<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use DB;

use App\Http\Resources\Csv\Item as ItemResource;

use League\Csv\Writer;

use App\Repository\Browse\BrowseRepositoryInterface as BrowseRepository;
use App\Model\Browse;

class ExportCategoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $file;

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
     * @param string $file
     * @param string $category
     * @param string $order
     * @param string $sort
     * @param int    $limit
     */
    public function __construct(
        string $file,
        string $category,
        string $order = 'updated_at',
        string $sort = 'desc',
        int $limit = 1000
    ) {
        $this->file = $file;
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
        DB::disableQueryLog();

        $writer = Writer::createFromPath($this->file, 'w+');

        $writer->insertOne(config('amazon.csv_header'));

        $items = $repository->exportCursor($this->category, $this->order, $this->sort, $this->limit);

        //        $count = 0;

        foreach ($items as $item) {
            $line = (new ItemResource($item))->toArray(request());

            $writer->insertOne($line);

            //            $count++;
            //            if ($count >= $this->limit) {
            //                break;
            //            }
        }

        return $this->file;
    }
}
