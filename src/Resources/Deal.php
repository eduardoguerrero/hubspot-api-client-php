<?php

namespace HubSpot\Resources;

use GuzzleHttp\Exception\GuzzleException;
use HubSpot\Http\Response;
use HubSpot\Model\AssociateDeal;

/**
 * Class Deal
 * @package HubSpot\Resources
 * @see https://developers.hubspot.com/docs/api/crm/deals
 * @description In HubSpot, a deal represents an ongoing transaction that a sales team is pursuing with a contact or company.
 */
class Deal extends AbstractResource
{

    /**
     * Read a page of deals. Control what is returned via the properties query param.
     *
     * @param array $queryParams
     * @return Response
     */
    public function getAll(array $queryParams)
    {
        return $this->client->request('GET', self::DEAL_BASE_URI, [], $queryParams);
    }

    /**
     * Read an Object identified by {dealId}. {dealId} refers to the internal object ID by default, or optionally any
     * unique property value as specified by the idProperty query param.
     *
     * @param $dealId
     * @param array $queryParams
     * @return Response
     */
    public function getById($dealId, array $queryParams)
    {
        return $this->client->request('GET', self::DEAL_BASE_URI . '/' . $dealId, [], $queryParams);
    }

    /**
     * Create a deal with the given properties and return a copy of the object, including the ID.
     *
     * @param array $properties
     * @return Response
     */
    public function create(array $properties)
    {
        return $this->client->request('POST', self::DEAL_BASE_URI, $properties);
    }

    /**
     * Perform a partial update of an Object identified by {dealId}.
     *
     * @param $dealId
     * @param array $properties
     * @return Response
     */
    public function updateById($dealId, array $properties)
    {
        return $this->client->request('PATCH', self::DEAL_BASE_URI . '/' . $dealId, $properties);
    }

    /**
     * Associate a deal with another object
     *
     * @param AssociateDeal $associateDeal
     * @return Response
     */
    public function associateWithObject(AssociateDeal $associateDeal)
    {
        return $this->client->request('PUT', self::DEAL_BASE_URI . sprintf("/%d/associations/%s/%d/%s",
                $associateDeal->getDealId(),
                $associateDeal->getToObjectType(),
                $associateDeal->getToObjectId(),
                $associateDeal->getAssociationType()
            )
        );
    }
}
