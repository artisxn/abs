<?php

namespace App\Console\Commands\Mainte;

use Illuminate\Console\Command;

use App\Model\History;
use App\Model\Availability;

class UpdateAvailabilityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:update-availability';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Availability変換コマンド';

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
        $histories = History::doesntHave('availability')->limit(5000)->get();

        info('Update Availability: Start ' . $histories->count());

        foreach ($histories as $history) {
            $availability = data_get($history, 'availability', '');

            $ava = Availability::firstOrCreate([
                'availability' => $availability,
            ]);

            $history->availability()->associate($ava)->save();
        }

        info('Update Availability: End');
    }
}
