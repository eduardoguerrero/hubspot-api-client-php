<?php

namespace HubSpot\Resources;

use GuzzleHttp\Exception\GuzzleException;
use HubSpot\Http\Response;

/**
 * Class Contact
 * @package HubSpot\Resources
 * @see https://developers.hubspot.com/docs/api/crm/contacts
 * @description In HubSpot, contacts store information about individuals.
 */
class Contact extends AbstractResource
{

    /**
     * Read a page of contacts. Control what is returned via the properties query param.
     *
     * @param array $queryParams
     * @return Response
     */
    public function getAll(array $queryParams)
    {
        return $this->client->request('GET', self::CONTACT_BASE_URI, [], $queryParams);
    }

    /**
     * Read an Object identified by {contactId}. {contactId} refers to the internal object ID by default.
     *
     * @param $contactId
     * @param array $queryParams
     * @return Response
     */
    public function getById($contactId, array $queryParams)
    {
        return $this->client->request('GET', self::CONTACT_BASE_URI . '/' . $contactId, [], $queryParams);
    }


    /**
     * Filter, sort, and search CRM Objects.
     *
     * @param array $options
     * @return Response
     */
    public function getByProperty(array $options)
    {
        return $this->client->request('POST', self::CONTACT_BASE_URI . '/search', $options);
    }

    /**
     * Create a contact with the given properties and return a copy of the object, including the ID.
     *
     * @param array $properties
     * @return Response
     */
    public function create(array $properties)
    {
        return $this->client->request('POST', self::CONTACT_BASE_URI, $properties);
    }

}
