<?php

namespace App\Jobs\Watch;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Jobs\CreateHistoryJob;

use App\Model\User;
use App\Model\Watch;
use App\Repository\Item\ItemRepositoryInterface as Item;

class SaveJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $item;

    /**
     * @var string
     */
    protected $asin;

    /**
     * @var int
     */
    protected $user_id;

    /**
     * Create a new job instance.
     *
     * @param array $item
     * @param int   $user_id
     *
     */
    public function __construct(array $item, int $user_id)
    {
        $this->item = $item;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @param Item $repository
     *
     * @return void
     */
    public function handle(Item $repository)
    {
        $asin = array_get($this->item, 'ASIN');

        if (empty($asin)) {
            return;
        }

        $user = User::findOrFail($this->user_id);

        $repository->create($this->item);

        dispatch_now(new CreateHistoryJob($this->item));

        $watch = Watch::firstOrCreate([
            'user_id' => $this->user_id,
            'asin_id' => $asin,
        ]);

        //優先度。最初にインポートする時だけ1にする。
        $watch->priority = config('amazon.default_priority', 0);

        $user->watches()->save($watch);
    }
}
