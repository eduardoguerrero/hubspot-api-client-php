<?php

namespace HubSpot\Model;

/**
 * Class DealStatus
 * @package HubSpot\Model
 */
class DealStatus
{
    /** @var string */
    private $dealStage;

    /** @var string */
    private $fulfillmentStatus;

    /** @var string */
    private $lastModifiedDate;

    /** @var string */
    private $orderStatus;

    /**
     * @return string
     */
    public function getDealStage()
    {
        return $this->dealStage;
    }

    /**
     * @param string $dealStage
     * @return DealStatus
     */
    public function setDealStage($dealStage)
    {
        $this->dealStage = $dealStage;

        return $this;
    }

    /**
     * @return string
     */
    public function getFulfillmentStatus()
    {
        return $this->fulfillmentStatus;
    }

    /**
     * @param string $fulfillmentStatus
     * @return DealStatus
     */
    public function setFulfillmentStatus($fulfillmentStatus)
    {
        $this->fulfillmentStatus = $fulfillmentStatus;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastModifiedDate()
    {
        return $this->lastModifiedDate;
    }

    /**
     * @param string $lastModifiedDate
     * @return DealStatus
     */
    public function setLastModifiedDate($lastModifiedDate)
    {
        $this->lastModifiedDate = $lastModifiedDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * @param $orderStatus
     * @return $this
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

}
