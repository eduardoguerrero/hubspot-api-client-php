<?php

namespace src\Model;

use HubSpot\Model\AssociateDeal;
use HubSpot\Model\DealStatus;
use PHPUnit\Framework\TestCase;

/**
 * Class DealStatusTest
 * @package src\Model
 */
class DealStatusTest extends TestCase
{

    /** @var DealStatus */
    protected $dealStatus;

    /**
     * This method is called before each test.
     */
    protected function setUp()
    {
        $this->dealStatus = new DealStatus();
    }

    /**
     * Run after each test
     * @return void
     */
    protected function tearDown()
    {
        $this->dealStatus = null;
    }

    /**
     * @return void
     */
    public function testDealStatusModel()
    {
        $this->dealStatus
            ->setOrderStatus('processing')
            ->setLastModifiedDate('2019-12-07T16:50:06.678Z')
            ->setFulfillmentStatus('processing')
            ->setDealStage('dealStage');
        $this->assertEquals('processing', $this->dealStatus->getOrderStatus());
        $this->assertEquals('2019-12-07T16:50:06.678Z', $this->dealStatus->getLastModifiedDate());
        $this->assertEquals('processing', $this->dealStatus->getFulfillmentStatus());
        $this->assertEquals('dealStage', $this->dealStatus->getDealStage());
    }
}
