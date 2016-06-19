<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use \Mockery as m;

use App\Service\AmazonService;

class AmazonServiceTest extends TestCase
{
    /**
     * @var \ApaiIO\ApaiIO
     */
    protected $apai;
    /**
     * @var  \ApaiIO\Operations\Search
     */
    protected $search;
    /**
     * @var \ApaiIO\Operations\Lookup
     */
    protected $lookup;
    /**
     * @var \ApaiIO\Operations\BrowseNodeLookup
     */
    protected $browse;

    /**
     * @var AmazonService
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();

        $this->apai = m::mock('ApaiIO\ApaiIO');
        $this->search = m::mock('ApaiIO\Operations\Search');
        $this->lookup = m::mock('ApaiIO\Operations\Lookup');
        $this->browse = m::mock('ApaiIO\Operations\BrowseNodeLookup');

        $this->service = new AmazonService($this->apai, $this->search, $this->lookup, $this->browse);
    }

    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    public function testAmazonSearch()
    {
        $category = 'All';
        $keyword = 'amazon';
        $page = 1;

        $this->search->shouldReceive('setCategory')->once();
        $this->search->shouldReceive('setKeywords')->once();
        $this->search->shouldReceive('setPage')->once();
        $this->search->shouldReceive('setResponseGroup')->once();

        $this->apai->shouldReceive('runOperation')
            ->once()
            ->andReturn(collect(['test']));

        $result = $this->service->search($category, $keyword, $page);

        $this->assertEquals(collect(['test']), $result);
    }

    public function testAmazonBrowse()
    {
        $node = '1';

        $this->browse->shouldReceive('setNodeId')->once();
        $this->browse->shouldReceive('setResponseGroup')->once();

        $this->apai->shouldReceive('runOperation')
            ->once()
            ->andReturn(collect(['test']));

        $result = $this->service->browse($node);

        $this->assertEquals(collect(['test']), $result);
    }

    public function testAmazonItem()
    {
        $asin = '1';

        $this->lookup->shouldReceive('setItemId')->once();
        $this->lookup->shouldReceive('setResponseGroup')->once();

        $this->apai->shouldReceive('runOperation')
            ->once()
            ->andReturn(collect(['test']));

        $result = $this->service->item($asin);

        $this->assertEquals(collect(['test']), $result);
    }
}
