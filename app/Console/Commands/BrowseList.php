<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

use File;

class BrowseList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'abs:browselist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ブラウズリストを更新';

    /**
     * 除外リスト
     *
     * @var array
     */
    protected $except = [
        '3036192051',
        '2113286051',
        '3684885051',
        '2632478051',
        '2443898051',
        '4436137051',
        '4643094051',
        '4152300051',
        '2443897051',
        '2443896051',
    ];

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
     * @param Client $client
     *
     * @return mixed
     */
    public function handle(Client $client)
    {
        $url = "https://www.amazon.co.jp/gp/site-directory/";

        $list = [];

        $crawler = $client->request('GET', $url);

        $crawler->filter('#shopAllLinks a.nav_a')->each(function (Crawler $node) use (&$list) {
            $name = $node->text();

            $href = $node->attr('href');
            if (str_contains($href, '&node=')) {
                $href = str_after($href, '&node=');

                if (!in_array($href, $this->except)) {
                    $list = array_add($list, trim($name), $href);
                }
            }
        });

        $config = '<?php' . PHP_EOL . 'return ';
        $config .= var_export($list, true) . ';';

        return File::put(config_path('amazon-browse.php'), $config);
    }
}
