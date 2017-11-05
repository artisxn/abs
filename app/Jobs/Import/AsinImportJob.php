<?php

namespace App\Jobs\Import;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use League\Csv\Reader;
use League\Csv\Statement;

use App\Model\User;
use App\Model\Watch;
use App\Model\Item;

use App\Jobs\ItemJob;

class AsinImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    public $file_path;

    /**
     * @var int
     */
    public $user_id;

    /**
     * Create a new job instance.
     *
     * @param string $file_path
     * @param int    $user_id
     *
     */
    public function __construct(string $file_path, int $user_id)
    {
        $this->file_path = $file_path;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return array
     */
    public function handle()
    {
        info(self::class);

        /**
         * @var User $user
         */
        $user = User::findOrFail($this->user_id);

        /**
         * @var Reader $reader
         */
        $reader = Reader::createFromPath($this->file_path);
        $records = $reader->getRecords();

        $count = count($reader);

        foreach ($records as $offset => $record) {
            $asin = array_first($record);

            if (strlen($asin) !== 10) {
                continue;
            }

            $watch = Watch::firstOrCreate([
                'user_id' => $this->user_id,
                'asin_id' => $asin,
            ]);

            //未取得のASINなら後で取得しにいく
            if (!$watch->item->exists) {
                ItemJob::dispatch($asin)->delay(now()->addMinutes($offset));
            }
        }

        return $count;
    }
}
