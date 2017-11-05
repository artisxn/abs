<?php

namespace App\Jobs\Import;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use League\Csv\Reader;
use League\Csv\Statement;

class JanImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $file_path;

    /**
     * @var int
     */
    protected $user_id;

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
         * @var Reader $reader
         */
        $reader = Reader::createFromPath($this->file_path);
        $records = $reader->getRecords();

        $count = count($reader);

        $jan_lists = [];

        $delay = 0;

        foreach ($records as $offset => $record) {
            $jan = array_first($record);
            $jan = preg_replace('/[^\d]/', '', $jan);

            if (strlen($jan) === 13) {
                $jan_lists[] = $jan;
            }

            if ($offset === $count - 1 or count($jan_lists) >= 10) {
                JanToAsinJob::dispatch($jan_lists, $this->user_id)->delay(now()->addSeconds($delay * 30));

                $delay++;
                $jan_lists = [];
            }
        }

        return $count;
    }
}
