<?php

namespace App\Console\Commands\World;

use Illuminate\Console\Command;

use App\Model\User;
use App\Notifications\World\InfoNotification;

class ChatWorkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:world-chatwork';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ChatWorkへ通知';

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
        /**
         * @var User $user
         */
        $user = User::findOrFail(config('feature.world_user_id'));

        $user->notify(new InfoNotification());
    }
}
