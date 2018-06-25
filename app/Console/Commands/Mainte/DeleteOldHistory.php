<?php

namespace App\Console\Commands\Mainte;

use Illuminate\Console\Command;

use App\Model\History;

class DeleteOldHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:delete-old-history';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '古いHistoryを削除';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $items = History::whereDate('updated_at', '<', now()->subDays(190));

        info('Delete Old History: ' . $items->count());

        $items->delete();
    }
}
