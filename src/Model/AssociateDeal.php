<?php

namespace HubSpot\Model;

/**
 * Class AssociateDeal
 * @package HubSpot\Model
 * @description Use this model to associate a deal with another object.
 */
class AssociateDeal
{

    /** @var int */
    private $dealId;

    /** @var string */
    private $toObjectType;

    /** @var int */
    private $toObjectId;

    /** @var string */
    private $associationType;

    /**
     * @return int
     */
    public function getDealId()
    {
        return $this->dealId;
    }

    /**
     * @param int $dealId
     * @return AssociateDeal
     */
    public function setDealId($dealId)
    {
        $this->dealId = $dealId;

        return $this;
    }

    /**
     * @return string
     */
    public function getToObjectType()
    {
        return $this->toObjectType;
    }

    /**
     * @param string $toObjectType
     * @return AssociateDeal
     */
    public function setToObjectType($toObjectType)
    {
        $this->toObjectType = $toObjectType;

        return $this;
    }

    /**
     * @return int
     */
    public function getToObjectId()
    {
        return $this->toObjectId;
    }

    /**
     * @param int $toObjectId
     * @return AssociateDeal
     */
    public function setToObjectId($toObjectId)
    {
        $this->toObjectId = $toObjectId;

        return $this;
    }

    /**
     * @return string
     */
    public function getAssociationType()
    {
        return $this->associationType;
    }

    /**
     * @param string $associationType
     * @return AssociateDeal
     */
    public function setAssociationType($associationType)
    {
        $this->associationType = $associationType;

        return $this;
    }
}
