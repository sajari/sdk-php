<?php
/**
 * EventsApi
 * PHP version 7.2
 *
 * @category Class
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Sajari API
 *
 * Sajari is a smart, highly-configurable, real-time search service that enables thousands of businesses worldwide to provide amazing search experiences on their websites, stores, and applications.
 *
 * The version of the OpenAPI document: v4
 * Contact: support@sajari.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.0.0-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Sajari\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Sajari\ApiException;
use Sajari\Configuration;
use Sajari\HeaderSelector;
use Sajari\ObjectSerializer;

/**
 * EventsApi Class Doc Comment
 *
 * @category Class
 * @package  Sajari
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class EventsApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * The value to use for the Sajari-Client-User-Agent header
     *
     * @var string
     */
    protected $clientUserAgent;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;

        $composer = json_decode(
            file_get_contents(dirname(__FILE__) . "/../../composer.json"),
            true
        );

        $clientUserAgent = "sajari-sdk-php";
        if ($composer["version"]) {
            $clientUserAgent = $clientUserAgent . "/" . $composer["version"];
        }
        $this->clientUserAgent = $clientUserAgent;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex)
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation sendEvent
     *
     * Send event
     *
     * @param  \Sajari\Model\SendEventRequest $send_event_request send_event_request (required)
     *
     * @throws \Sajari\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error
     */
    public function sendEvent($send_event_request)
    {
        list($response) = $this->sendEventWithHttpInfo($send_event_request);
        return $response;
    }

    /**
     * Operation sendEventWithHttpInfo
     *
     * Send event
     *
     * @param  \Sajari\Model\SendEventRequest $send_event_request (required)
     *
     * @throws \Sajari\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function sendEventWithHttpInfo($send_event_request)
    {
        $request = $this->sendEventRequest($send_event_request);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse()
                        ? (string) $e->getResponse()->getBody()
                        : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        "[%d] Error connecting to the API (%s)",
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch ($statusCode) {
                case 200:
                    if ("object" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, "object", []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ("\Sajari\Model\Error" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            "\Sajari\Model\Error",
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ("\Sajari\Model\Error" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            "\Sajari\Model\Error",
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ("\Sajari\Model\Error" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            "\Sajari\Model\Error",
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 404:
                    if ("\Sajari\Model\Error" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            "\Sajari\Model\Error",
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ("\Sajari\Model\Error" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            "\Sajari\Model\Error",
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                default:
                    if ("\Sajari\Model\Error" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            "\Sajari\Model\Error",
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = "object";
            $responseBody = $response->getBody();
            if ($returnType === "\SplFileObject") {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "object",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "\Sajari\Model\Error",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "\Sajari\Model\Error",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "\Sajari\Model\Error",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "\Sajari\Model\Error",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "\Sajari\Model\Error",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "\Sajari\Model\Error",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation sendEventAsync
     *
     * Send event
     *
     * @param  \Sajari\Model\SendEventRequest $send_event_request (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendEventAsync($send_event_request)
    {
        return $this->sendEventAsyncWithHttpInfo($send_event_request)->then(
            function ($response) {
                return $response[0];
            }
        );
    }

    /**
     * Operation sendEventAsyncWithHttpInfo
     *
     * Send event
     *
     * @param  \Sajari\Model\SendEventRequest $send_event_request (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendEventAsyncWithHttpInfo($send_event_request)
    {
        $returnType = "object";
        $request = $this->sendEventRequest($send_event_request);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            $returnType,
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            "[%d] Error connecting to the API (%s)",
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'sendEvent'
     *
     * @param  \Sajari\Model\SendEventRequest $send_event_request (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function sendEventRequest($send_event_request)
    {
        // verify the required parameter 'send_event_request' is set
        if (
            $send_event_request === null ||
            (is_array($send_event_request) && count($send_event_request) === 0)
        ) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $send_event_request when calling sendEvent'
            );
        }

        $resourcePath = "/v4/events:send";
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = "";
        $multipart = false;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart([
                "application/json",
            ]);
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ["application/json"],
                ["application/json"]
            );
        }

        // for model (json/xml)
        if (isset($send_event_request)) {
            if ($headers["Content-Type"] === "application/json") {
                $httpBody = \GuzzleHttp\json_encode(
                    ObjectSerializer::sanitizeForSerialization(
                        $send_event_request
                    )
                );
            } else {
                $httpBody = $send_event_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue)
                        ? $formParamValue
                        : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            "name" => $formParamName,
                            "contents" => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers["Content-Type"] === "application/json") {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (
            !empty($this->config->getUsername()) ||
            !empty($this->config->getPassword())
        ) {
            $headers["Authorization"] =
                "Basic " .
                base64_encode(
                    $this->config->getUsername() .
                        ":" .
                        $this->config->getPassword()
                );
        }

        $defaultHeaders = [];
        if ($this->clientUserAgent) {
            $defaultHeaders["Sajari-Client-User-Agent"] =
                $this->clientUserAgent;
        }
        if ($this->config->getUserAgent()) {
            $defaultHeaders["User-Agent"] = $this->config->getUserAgent();
        }

        $headers = array_merge($defaultHeaders, $headerParams, $headers);

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            "POST",
            $this->config->getHost() .
                $resourcePath .
                ($query ? "?{$query}" : ""),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation sendEvent2
     *
     * Send event
     *
     * @param  \Sajari\Model\SendEventRequest $send_event_request send_event_request (required)
     *
     * @throws \Sajari\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error
     */
    public function sendEvent2($send_event_request)
    {
        list($response) = $this->sendEvent2WithHttpInfo($send_event_request);
        return $response;
    }

    /**
     * Operation sendEvent2WithHttpInfo
     *
     * Send event
     *
     * @param  \Sajari\Model\SendEventRequest $send_event_request (required)
     *
     * @throws \Sajari\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error|\Sajari\Model\Error, HTTP status code, HTTP response headers (array of strings)
     */
    public function sendEvent2WithHttpInfo($send_event_request)
    {
        $request = $this->sendEvent2Request($send_event_request);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse()
                        ? (string) $e->getResponse()->getBody()
                        : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        "[%d] Error connecting to the API (%s)",
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch ($statusCode) {
                case 200:
                    if ("object" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, "object", []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ("\Sajari\Model\Error" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            "\Sajari\Model\Error",
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ("\Sajari\Model\Error" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            "\Sajari\Model\Error",
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ("\Sajari\Model\Error" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            "\Sajari\Model\Error",
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 404:
                    if ("\Sajari\Model\Error" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            "\Sajari\Model\Error",
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ("\Sajari\Model\Error" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            "\Sajari\Model\Error",
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                default:
                    if ("\Sajari\Model\Error" === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            "\Sajari\Model\Error",
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = "object";
            $responseBody = $response->getBody();
            if ($returnType === "\SplFileObject") {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "object",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "\Sajari\Model\Error",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "\Sajari\Model\Error",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "\Sajari\Model\Error",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "\Sajari\Model\Error",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "\Sajari\Model\Error",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        "\Sajari\Model\Error",
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation sendEvent2Async
     *
     * Send event
     *
     * @param  \Sajari\Model\SendEventRequest $send_event_request (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendEvent2Async($send_event_request)
    {
        return $this->sendEvent2AsyncWithHttpInfo($send_event_request)->then(
            function ($response) {
                return $response[0];
            }
        );
    }

    /**
     * Operation sendEvent2AsyncWithHttpInfo
     *
     * Send event
     *
     * @param  \Sajari\Model\SendEventRequest $send_event_request (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendEvent2AsyncWithHttpInfo($send_event_request)
    {
        $returnType = "object";
        $request = $this->sendEvent2Request($send_event_request);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === "\SplFileObject") {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize(
                            $content,
                            $returnType,
                            []
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            "[%d] Error connecting to the API (%s)",
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'sendEvent2'
     *
     * @param  \Sajari\Model\SendEventRequest $send_event_request (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function sendEvent2Request($send_event_request)
    {
        // verify the required parameter 'send_event_request' is set
        if (
            $send_event_request === null ||
            (is_array($send_event_request) && count($send_event_request) === 0)
        ) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $send_event_request when calling sendEvent2'
            );
        }

        $resourcePath = "/v4/events:sendEvent";
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = "";
        $multipart = false;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart([
                "application/json",
            ]);
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ["application/json"],
                ["application/json"]
            );
        }

        // for model (json/xml)
        if (isset($send_event_request)) {
            if ($headers["Content-Type"] === "application/json") {
                $httpBody = \GuzzleHttp\json_encode(
                    ObjectSerializer::sanitizeForSerialization(
                        $send_event_request
                    )
                );
            } else {
                $httpBody = $send_event_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue)
                        ? $formParamValue
                        : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            "name" => $formParamName,
                            "contents" => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers["Content-Type"] === "application/json") {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (
            !empty($this->config->getUsername()) ||
            !empty($this->config->getPassword())
        ) {
            $headers["Authorization"] =
                "Basic " .
                base64_encode(
                    $this->config->getUsername() .
                        ":" .
                        $this->config->getPassword()
                );
        }

        $defaultHeaders = [];
        if ($this->clientUserAgent) {
            $defaultHeaders["Sajari-Client-User-Agent"] =
                $this->clientUserAgent;
        }
        if ($this->config->getUserAgent()) {
            $defaultHeaders["User-Agent"] = $this->config->getUserAgent();
        }

        $headers = array_merge($defaultHeaders, $headerParams, $headers);

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            "POST",
            $this->config->getHost() .
                $resourcePath .
                ($query ? "?{$query}" : ""),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen(
                $this->config->getDebugFile(),
                "a"
            );
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException(
                    "Failed to open the debug file: " .
                        $this->config->getDebugFile()
                );
            }
        }

        return $options;
    }
}
