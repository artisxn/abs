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
        '3544982051',
        '3535604051',
        '3571215051',
        '3666867051',
        '3589137051',
        '3232648051',
        '3211799051',
        '4477209051',
        '3485873051',
        '2799399051',
        '3485688051',
        '3465706051',
        '76366051',
        '2199930051',
        '4097695051',
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
        $config .= var_export($list, true);
        $config = str_replace('array (', '[', $config);
        $config = str_replace(')', ']', $config);
        $config .= ';' . PHP_EOL;

        return File::put(config_path('amazon-browse.php'), $config);
    }
}
