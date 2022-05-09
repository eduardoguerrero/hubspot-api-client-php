<?php

namespace src\Model;

use HubSpot\Model\AssociateDeal;
use PHPUnit\Framework\TestCase;

/**
 * Class AssociateDealTest
 * @package src\Model
 */
class AssociateDealTest extends TestCase
{

    /** @var AssociateDeal */
    protected $associateDeal;

    /**
     * This method is called before each test.
     */
    protected function setUp()
    {
        $this->associateDeal = new AssociateDeal();
    }

    /**
     * Run after each test
     * @return void
     */
    protected function tearDown()
    {
        $this->associateDeal = null;
    }

    /**
     * @return void
     */
    public function testDealStatusModel()
    {
        $this->associateDeal
            ->setToObjectType('objectType')
            ->setToObjectId(100001)
            ->setDealId(100002)
            ->setAssociationType('association');
        $this->assertEquals('objectType', $this->associateDeal->getToObjectType());
        $this->assertEquals(100001, $this->associateDeal->getToObjectId());
        $this->assertEquals(100002, $this->associateDeal->getDealId());
        $this->assertEquals('association', $this->associateDeal->getAssociationType());
    }
}
