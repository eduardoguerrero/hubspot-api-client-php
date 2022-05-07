<?php

namespace HubSpot\Http;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class Response
 * @package HubSpot\Http
 */
class Response implements ResponseInterface
{

    const HTTP_CONTINUE = 100;
    const HTTP_SWITCHING_PROTOCOLS = 101;
    const HTTP_PROCESSING = 102;                        // RFC2518
    const HTTP_EARLY_HINTS = 103;                       // RFC8297
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_ACCEPTED = 202;
    const HTTP_NON_AUTHORITATIVE_INFORMATION = 203;
    const HTTP_NO_CONTENT = 204;
    const HTTP_RESET_CONTENT = 205;
    const HTTP_PARTIAL_CONTENT = 206;
    const HTTP_MULTI_STATUS = 207;                      // RFC4918
    const HTTP_ALREADY_REPORTED = 208;                  // RFC5842
    const HTTP_IM_USED = 226;                           // RFC3229
    const HTTP_MULTIPLE_CHOICES = 300;
    const HTTP_MOVED_PERMANENTLY = 301;
    const HTTP_FOUND = 302;
    const HTTP_SEE_OTHER = 303;
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_USE_PROXY = 305;
    const HTTP_RESERVED = 306;
    const HTTP_TEMPORARY_REDIRECT = 307;
    const HTTP_PERMANENTLY_REDIRECT = 308;              // RFC7238
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_PAYMENT_REQUIRED = 402;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
    const HTTP_REQUEST_TIMEOUT = 408;
    const HTTP_CONFLICT = 409;
    const HTTP_GONE = 410;
    const HTTP_LENGTH_REQUIRED = 411;
    const HTTP_PRECONDITION_FAILED = 412;
    const HTTP_REQUEST_ENTITY_TOO_LARGE = 413;
    const HTTP_REQUEST_URI_TOO_LONG = 414;
    const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
    const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const HTTP_EXPECTATION_FAILED = 417;
    const HTTP_I_AM_A_TEAPOT = 418;                     // RFC2324
    const HTTP_MISDIRECTED_REQUEST = 421;               // RFC7540
    const HTTP_UNPROCESSABLE_ENTITY = 422;              // RFC4918
    const HTTP_LOCKED = 423;                            // RFC4918
    const HTTP_FAILED_DEPENDENCY = 424;                 // RFC4918

    /** @var mixed|null */
    public $data;

    /** @var ResponseInterface */
    protected $response;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->data = $this->getDataFromResponse($response);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data->{$name};
    }

    /**
     * @return mixed|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        return json_decode(json_encode($this->data), true);
    }

    /**
     * Retrieves the HTTP protocol version as a string.
     *
     * @return mixed
     */
    public function getProtocolVersion()
    {
        return $this->response->getProtocolVersion();
    }

    /**
     * Return an instance with the specified HTTP protocol version.
     *
     * @param $version
     * @return mixed
     */
    public function withProtocolVersion($version)
    {
        return $this->response->withProtocolVersion($version);
    }

    /**
     * Retrieves all message header values.
     *
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->response->getHeaders();
    }

    /**
     * Checks if a header exists by the given case-insensitive name.
     *
     * @param $name
     * @return mixed
     */
    public function hasHeader($name)
    {
        return $this->response->hasHeader($name);
    }

    /**
     * Retrieves a message header value by the given case-insensitive name.
     *
     * @param $name
     * @return mixed
     */
    public function getHeader($name)
    {
        return $this->response->getHeader($name);
    }

    /**
     * Retrieves a comma-separated string of the values for a single header.
     *
     * @param $name
     * @return mixed
     */
    public function getHeaderLine($name)
    {
        return $this->response->getHeaderLine($name);
    }

    /**
     * Return an instance with the provided value replacing the specified header.
     *
     * @param $name
     * @param $value
     * @return mixed
     */
    public function withHeader($name, $value)
    {
        return $this->response->withHeader($name, $value);
    }

    /**
     * Return an instance with the specified header appended with the given value.
     *
     * @param $name
     * @param $value
     * @return mixed
     */
    public function withAddedHeader($name, $value)
    {
        return $this->response->withAddedHeader($name, $value);
    }

    /**
     * Return an instance without the specified header.
     *
     * @param $name
     * @return mixed
     */
    public function withoutHeader($name)
    {
        return $this->response->withoutHeader($name);
    }

    /**
     * Gets the body of the message.
     *
     * @return mixed
     */
    public function getBody()
    {
        return $this->response->getBody();
    }

    /**
     * Return an instance with the specified message body.
     *
     * @param StreamInterface $body
     * @return mixed
     */
    public function withBody(StreamInterface $body)
    {
        return $this->response->withBody($body);
    }

    /**
     * Gets the response status code.
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->response->getStatusCode();

    }

    /**
     * Return an instance with the specified status code and, optionally, reason phrase.
     *
     * @param $code
     * @param $reasonPhrase
     * @return void
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        $this->response = $this->response->withStatus($code, $reasonPhrase);
    }

    /**
     * Gets the response reason phrase associated with the status code.
     *
     * @return mixed
     */
    public function getReasonPhrase()
    {
        return $this->response->getReasonPhrase();
    }

    /**
     * @param ResponseInterface $response
     * @return mixed|null
     */
    private function getDataFromResponse(ResponseInterface $response)
    {
        $contents = $response->getBody()->getContents();
        if ($contents) {
            $contents = json_decode($contents);
            if (is_array($contents) && count($contents) === 1) {
                return $contents[0];
            }
            return $contents;
        }
        return null;
    }

}
