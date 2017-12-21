<?php

namespace App\Http\Controllers\Browse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jobs\BrowseJob;

class BrowseController extends Controller
{
    /**
     * Browse TopSellers
     *
     * @param string $browse
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $browse)
    {
        $browse_data = dispatch_now(new BrowseJob($browse));

        /**
         * $browse_data は array なのでそのまま渡す
         * [
         * 'browse_name'  => $browse_name,
         * 'browse_items' => collect($browse_items),
         * 'browse_id'    => $this->browse_id,
         * ];
         */

        return view('browse.index')->with($browse_data);
    }
}
