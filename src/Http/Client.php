<?php

namespace HubSpot\Http;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Class Client
 * @package HubSpot\Http
 */
class Client
{
    /** @var string */
    public $apikey;

    /** @var GuzzleClient */
    public $client;

    /**
     * Guzzle allows options into its request method. Prepare for some defaults.
     *
     * @var array
     */
    protected $clientOptions = [];

    /**
     * if set to false, no Response object is created, but the one from Guzzle is directly returned comes in handy own
     * error handling.
     *
     * @var bool
     */
    protected $wrapResponse = true;

    /** @var array|false|mixed|string */
    private $baseUrl;

    /**
     * Client constructor.
     *
     * @param array $config Configuration array
     * @param null $client GuzzleClient $client The Http Client (Defaults to Guzzle)
     * @param array $clientOptions Options to be passed to Guzzle upon each request
     * @param bool $wrapResponse wrap request response in own Response object
     */
    public function __construct($config = [], $client = null, $clientOptions = [], $wrapResponse = true)
    {
        $this->clientOptions = $clientOptions;
        $this->wrapResponse = $wrapResponse;
        // Take baseUrl parameter,otherwise, gets the value of an environment variable
        $this->baseUrl = isset($config['baseUrl']) ? $config['baseUrl'] : getenv('HUBSPOT_URL');
        if (!$this->baseUrl) {
            throw new \InvalidArgumentException('BaseUrl is required');
        }
        // Take apikey parameter,otherwise, gets the value of an environment variable
        $this->apikey = isset($config['apikey']) ? $config['apikey'] : getenv('HUBSPOT_APIKEY');
        if (!$this->apikey) {
            throw new \InvalidArgumentException('Apikey is required');
        }
        if (!$client) {
            $client = new GuzzleClient($config);
        }
        $this->client = $client;
    }

    /**
     * Execute a request to hubspot API.
     *
     * @param $method The HTTP request verb
     * @param $uri The Hubspot API uri
     * @param array $options An array of options to send with the request
     * @param array $queryParams Query params
     * @return Response
     */
    public function request($method, $uri, array $options = [], array $queryParams = [])
    {
        $url = sprintf("%s%s?hapikey=%s", $this->baseUrl, $uri, $this->apikey);
        // If there are query parameters, concatenate with current hubspot url
        if ($queryParams) {
            $url .= '&' . http_build_query($queryParams);
        }
        // Set to true to enable debug output with the handler used to send a request.
        $options['debug'] = false;
        $options['headers'] = ['Content-Type' => 'application/json'];
        // Set timeout if hubspot is not responding
        $options['timeout'] = 20;           // Response timeout
        $options['connect_timeout'] = 20;   // Connection timeout
        $options['http_errors'] = false;    // http_errors to false and get the status code to handle exception
        if (isset($options['body'])) {
            $options['body'] = json_encode($options['body']);
        }

        return new Response($this->client->request($method, $url, $options));
    }
}
