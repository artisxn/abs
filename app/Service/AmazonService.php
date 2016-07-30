<?php
namespace App\Service;

use ApaiIO\Operations\Search;
use ApaiIO\Operations\Lookup;
use ApaiIO\Operations\BrowseNodeLookup;

use ApaiIO\ApaiIO;

class AmazonService
{
    /**
     * @var ApaiIO
     */
    protected $apai;

    /**
     * @var Search
     */
    protected $search;

    /**
     * @var Lookup
     */
    protected $lookup;

    /**
     * @var BrowseNodeLookup
     */
    protected $browse;

    /**
     * AmazonService constructor.
     *
     * @param ApaiIO $apai
     * @param Search $search
     * @param Lookup $lookup
     * @param BrowseNodeLookup $browse
     */
    public function __construct(ApaiIO $apai, Search $search, Lookup $lookup, BrowseNodeLookup $browse)
    {
        $this->apai = $apai;
        $this->search = $search;
        $this->lookup = $lookup;
        $this->browse = $browse;
    }

    /**
     * @param string $category
     * @param string $keyword
     * @param int $page
     *
     * @return \Illuminate\Support\Collection|mixed
     */
    public function search($category, $keyword, $page)
    {
        try {
            $this->search->setCategory($category);
            $this->search->setKeywords($keyword);
            if ($page > 0) {
                $this->search->setPage($page);
            }
            $this->search->setResponseGroup(['Large']);
            $result = $this->apai->runOperation($this->search);
        } catch (\Exception $e) {
            $result = collect([]);
        }

        return $result;
    }

    /**
     * @param string $node
     *
     * @return \Illuminate\Support\Collection|mixed
     */
    public function browse($node)
    {
        try {
            $this->browse->setNodeId($node);
            $this->browse->setResponseGroup(['TopSellers']);
            $result = $this->apai->runOperation($this->browse);
        } catch (\Exception $e) {
            $result = collect([]);
        }

        return $result;
    }

    /**
     * @param string $asin
     *
     * @return \Illuminate\Support\Collection|mixed
     */
    public function item($asin)
    {
        try {
            $this->lookup->setItemId($asin);
            $this->lookup->setResponseGroup(['Large']);
            $result = $this->apai->runOperation($this->lookup);
        } catch (\Exception $e) {
            $result = collect([]);
        }

        return $result;
    }
}
