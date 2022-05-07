<?php

namespace HubSpot\Resources;

use HubSpot\Http\Client;

/**
 * Class AbstractResource
 * @package HubSpot\Resources
 */
abstract class AbstractResource
{
    const CONTACT_BASE_URI = '/crm/v3/objects/contacts';
    const DEAL_BASE_URI = '/crm/v3/objects/deals';

    /** @var Client */
    protected $client;

    /**
     * AbstractResource constructor.
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }
}
