<?php

namespace Sajari\Engine;

use Guzzle\Http\ClientInterface;
use Guzzle\Http\Client as HttpClient;
use Psr\Log\LoggerInterface;
use Sajari\Common\Exception\ExceptionListener;
use Sajari\Common\Exception\InvalidArgumentException;
use Sajari\Common\Exception\RuntimeException;
use Sajari\Engine\Exception\NamespaceExceptionFactory;
use Sajari\Engine\Exception\Parser\EngineExceptionParser;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesser;

class EngineClient
{
    /**
     * @var string
     */
    const DEFAULT_SCHEME = 'https';

    /**
     * @var string
     */
    const DEFAULT_HOST = 'www.sajari.com';

    /**
     * @var string
     */
    const DEFAULT_PATH_PREFIX = 'api';

    /**
     * @var int
     */
    const DEFAULT_PORT = 443;

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var string
     */
    private $scheme;

    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $pathPrefix;

    /**
     * @var string
     */
    private $accessKey;

    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $collectionName;

    /**
     * @var array
     */
    private $options;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private $fingerprintMimeType = 'application/sajari+fingerprint';

    /**
     * @var array
     */
    private $lastErrors = array();

    /**
     * @var mixed
     */
    private $lastRequest;

    /**
     * @var mixed
     */
    private $lastResponse;

    /**
     * @var mixed
     */
    private $lastRawResponse;

    /**
     * Constructor.
     *
     * @param ClientInterface $httpClient
     * @param array           $options
     * @param LoggerInterface $logger
     */
    public function __construct(ClientInterface $httpClient, array $options, LoggerInterface $logger = null)
    {
        $this->httpClient = $httpClient;

        $scheme = isset($options['scheme']) ? $options['scheme'] : static::DEFAULT_SCHEME;
        $host = isset($options['host']) ? $options['host'] : static::DEFAULT_HOST;
        $port = isset($options['port']) ? $options['port'] : static::DEFAULT_PORT;
        $pathPrefix = isset($options['path_prefix']) ? $options['path_prefix'] : static::DEFAULT_PATH_PREFIX;

        $accessKey = isset($options['access_key']) ? $options['access_key'] : null;
        $secretKey = isset($options['secret_key']) ? $options['secret_key'] : null;

        $this->scheme = $scheme;
        $this->host = $host;
        $this->port = $port;
        $this->pathPrefix = $pathPrefix;

        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;

        $this->companyName = isset($options['company']) ? $options['company'] : null;
        $this->collectionName = isset($options['collection']) ? $options['collection'] : null;

        $this->options = $options;

        $this->logger = $logger;

        $exceptionFactory = new NamespaceExceptionFactory(
            new EngineExceptionParser(),
            'Sajari\\Engine\\Exception',
            'Sajari\\Engine\\Exception\\EngineException'
        );

        $this->httpClient->addSubscriber(new StatusCodeListener());
        $this->httpClient->addSubscriber(new ExceptionListener($exceptionFactory));

        $connectTimeout = 10;
        $timeout = 10;

        if (isset($this->options['curl.options']['CURLOPT_CONNECTTIMEOUT'])) {
            $connectTimeout = (integer) $this->options['curl.options']['CURLOPT_CONNECTTIMEOUT'];
        }
        if (isset($this->options['curl.options']['CURLOPT_TIMEOUT'])) {
            $timeout = (integer) $this->options['curl.options']['CURLOPT_TIMEOUT'];
        }

        $this->httpClient->setBaseUrl(sprintf('%s://%s', $this->scheme, $this->host));
        $this->httpClient->setConfig(array(
            HttpClient::SSL_CERT_AUTHORITY => false,
            HttpClient::CURL_OPTIONS => array(
                CURLOPT_CONNECTTIMEOUT => $connectTimeout,
                CURLOPT_TIMEOUT => $timeout,
            ),
        ));
    }

    /**
     * Get info about the engine.
     *
     * @param array $opts
     *
     * @return array The response
     */
    public function info(array $opts = array())
    {
        $opts['_method'] = 'GET';

        return $this->doRequest(array('info'), $opts);
    }

    /**
     * Get the document with the ID given in the "id" field or in the given
     * meta identity field.
     *
     * @param array $opts
     *
     * @return array|null The document or null if not found
     */
    public function get(array $opts)
    {
        $pathParts = array('get');

        if (isset($opts['id'])) {
            $id = $opts['id'];
            unset($opts['id']);
            array_push($pathParts, $id);
        }

        $response = $this->doRequest($pathParts, $opts);

        if ($response) {
            return $response;
        }

        return;
    }

    /**
     * Patch the document with the ID given in the "id" field or in the given
     * meta identity field.
     *
     * @param array $opts
     *
     * @return array|null The document or null if not successful
     */
    public function patch(array $opts)
    {
        $pathParts = array('patch');

        if (isset($opts['id'])) {
            $id = $opts['id'];
            unset($opts['id']);
            array_push($pathParts, $id);
        }

        $response = $this->doRequest($pathParts, $opts);

        if ($response) {
            return $response;
        }

        return;
    }

    /**
     * Remove the document with the ID given in the "id" field or in the given
     * meta identity field.
     *
     * @param array $opts
     *
     * @return Boolean True if removed
     */
    public function remove(array $opts)
    {
        $pathParts = array('remove');

        if (isset($opts['id'])) {
            $id = $opts['id'];
            unset($opts['id']);
            array_push($pathParts, $id);
        }

        $response = $this->doRequest($pathParts, $opts);

        return $response && true;
    }

    /**
     * Add a document to the engine.
     *
     * If a file path is specified, the file will be sent along with the input
     * data. In this case, the MIME type should also be specified.
     *
     * @param array $opts
     *
     * @return string|Boolean The ID of the newly added document, otherwise false if the add failed
     */
    public function add(array $opts)
    {
        $response = $this->doRequest(array('add'), $opts);

        if ($response && isset($response['docId'])) {
            return $response['docId'];
        }

        return false;
    }

    /**
     * Put the document with the ID given in the "id" field into the engine.
     *
     * @param array $opts
     *
     * @return Boolean True if put
     *
     * @throws InvalidArgumentException When the option "id" is not provided
     */
    public function put(array $opts)
    {
        if (!isset($opts['id'])) {
            throw new InvalidArgumentException('The option "id" must be provided.');
        }
        $id = $opts['id'];
        unset($opts['id']);

        $response = $this->doRequest(array('put', $id), $opts);

        return $response && true;
    }

    /**
     * Replace the document with the given ID.
     *
     * @param array $opts
     *
     * @return string|Boolean The ID of the replaced document, otherwise false if the replace failed
     */
    public function replace(array $opts)
    {
        $pathParts = array('replace');

        if (isset($opts['id'])) {
            $id = $opts['id'];
            unset($opts['id']);
            array_push($pathParts, $id);
        }

        $response = $this->doRequest($pathParts, $opts);

        if ($response && isset($response['docId'])) {
            return $response['docId'];
        }

        return false;
    }

    /**
     * Get the most recently added documents.
     *
     * @param array $opts
     *
     * @return array The response
     */
    public function recent(array $opts = array())
    {
        return $this->doRequest(array('recent'), $opts);
    }

    /**
     * Get the best documents.
     *
     * @param array $opts
     *
     * @return array The response
     */
    public function best(array $opts = array())
    {
        return $this->doRequest(array('best'), $opts);
    }

    /**
     * Get the most popular documents.
     *
     * @param array $opts
     *
     * @return array The response
     */
    public function popular(array $opts = array())
    {
        return $this->doRequest(array('popular'), $opts);
    }

    /**
     * Get related documents.
     *
     * @param array $opts
     *
     * @return array The response
     */
    public function related(array $opts = array())
    {
        return $this->doRequest(array('related'), $opts);
    }

    /**
     * Find terms matching the given query prefix (i.e. autocomplete / query completion).
     *
     * @param array $opts
     *
     * @return array The response
     */
    public function autocomplete(array $opts = array())
    {
        return $this->doRequest(array('autocomplete'), $opts);
    }

    /**
     * Search for documents matching the given query.
     *
     * @param array $opts
     *
     * @return array The response
     */
    public function search(array $opts)
    {
        $response = $this->doRequest(array('search'), $opts);

        $emptyResult = array(
            'results' => array(),
            'totalMatches' => 0,
            'time' => 0,
        );

        // Since results could be null we use array_key_exists
        if ($response && array_key_exists('results', $response)) {
            return null === $response['results'] ? $emptyResult : array(
                'results' => $response['results'],
                'totalMatches' => isset($response['totalmatches']) ? $response['totalmatches'] : 0,
                'time' => isset($response['msecs']) ? $response['msecs'] : 0,
            );
        }

        return $emptyResult;
    }

    /**
     * Multi search.
     *
     * @param array $opts
     *
     * @return array The response
     *
     * @throws RuntimeException When the given options cannot be JSON encoded
     */
    public function multiSearch(array $opts)
    {
        if (isset($opts['timeout'])) {
            $opts['timeout'] = (int) $opts['timeout'];
        }
        if (isset($opts['all']) && is_array($opts['all'])) {
            if (isset($opts['all']['maxresults'])) {
                $opts['all']['maxresults'] = (int) $opts['all']['maxresults'];
            }
            if (isset($opts['all']['page'])) {
                $opts['all']['page'] = (int) $opts['all']['page'];
            }
        }
        if (isset($opts['requests'])) {
            foreach ($opts['requests'] as $i => $r) {
                if (isset($r['maxresults'])) {
                    $r['maxresults'] = (int) $r['maxresults'];
                }
                if (isset($r['page'])) {
                    $r['page'] = (int) $r['page'];
                }
                if (isset($r['scales'])) {
                    foreach ($r['scales'] as $scaleIndex => $scale) {
                        foreach ($scale as $k => $v) {
                            $scale[$k] = (string) $v;
                        }
                        $r['scales'][$scaleIndex] = $scale;
                    }
                }
                $opts['requests'][$i] = $r;
            }
        }
        $encodedJson = json_encode($opts, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $lastErr = json_last_error();
        if (JSON_ERROR_NONE !== $lastErr) {
            throw new RuntimeException($lastErr);
        }
        $opts = array(
            'json' => $encodedJson,
        );
        $response = $this->doRequest(array('multisearch'), $opts);

        $emptyResult = array(
            'results' => array(),
            'totalMatches' => 0,
            'time' => 0,
            'queryId' => '',
        );

        // Since results could be null we use array_key_exists
        if ($response && array_key_exists('results', $response)) {
            return null === $response['results'] ? $emptyResult : array(
                'results' => $response['results'],
                'totalMatches' => isset($response['totalmatches']) ? $response['totalmatches'] : 0,
                'time' => isset($response['msecs']) ? $response['msecs'] : 0,
                'queryId' => isset($response['queryID']) ? $response['queryID'] : '',
            );
        }

        return $emptyResult;
    }

    public function fingerprint(array $opts)
    {
        $response = $this->doRequest(array('fingerprint'), $opts);

        if (!$response) {
            return false;
        }
        if (isset($opts['decoded']) && true === $opts['decoded']) {
            return $response;
        }

        return $response['fingerprint'];
    }

    /**
     * Reset the given fingerprint.
     *
     * @param array $opts
     *
     * @return array The response
     *
     * @throws InvalidArgumentException When the option "fingerprint" is not provided
     */
    public function resetFingerprint(array $opts = array())
    {
        if (!isset($opts['fingerprint'])) {
            throw new InvalidArgumentException('The option "fingerprint" must be provided.');
        }

        return $this->doRequest(array('fingerprint/reset'), $opts);
    }

    /**
     * Weight the given fingerprint by document ID.
     *
     * @param array $opts
     *
     * @return array The response
     *
     * @throws InvalidArgumentException When the options "fingerprint", "pos" or "neg" are not provided
     */
    public function weightFingerprint(array $opts = array())
    {
        foreach (array('fingerprint', 'pos', 'neg') as $key) {
            if (!isset($opts[$key])) {
                throw new InvalidArgumentException(sprintf('The option "%s" must be provided.', $key));
            }
        }

        $pathParts = array('fingerprint', 'weight');

        if (isset($opts['id'])) {
            $id = $opts['id'];
            unset($opts['id']);
            array_push($pathParts, $id);
        }

        return $this->doRequest($pathParts, $opts);
    }

    /**
     * Get info about all models.
     *
     * Specify the "models" array option to get info about specific models.
     *
     * @param array $opts
     *
     * @return array The response
     */
    public function modelInfo(array $opts = array())
    {
        return $this->doRequest(array('model/info'), $opts);
    }

    /**
     * Classify one or more models for given input text "q" or "inputfile".
     *
     * @param array $opts
     *
     * @return array The response
     *
     * @throws InvalidArgumentException When the option "models" is not provided
     */
    public function classify(array $opts = array())
    {
        if (!isset($opts['models'])) {
            throw new InvalidArgumentException('The option "models" must be provided.');
        }

        return $this->doRequest(array('model/classify'), $opts);
    }

    /**
     * Load the model given by the "model" option (i.e. make it live, put it into an "active" state).
     *
     * @param array $opts
     *
     * @return array The response
     *
     * @throws InvalidArgumentException When the option "model" is not provided
     */
    public function loadModel(array $opts = array())
    {
        if (!isset($opts['model'])) {
            throw new InvalidArgumentException('The option "model" must be provided.');
        }
        $model = $opts['model'];
        unset($opts['model']);

        return $this->doRequest(array('model/load', $model), $opts);
    }

    /**
     * Add a document given by the "inputfile" option to a particular class.
     *
     * @param array $opts
     *
     * @return array The response
     *
     * @throws InvalidArgumentException When the options "model" or "class" are not provided
     */
    public function trainModel(array $opts = array())
    {
        foreach (array('model', 'class') as $key) {
            if (!isset($opts[$key])) {
                throw new InvalidArgumentException(sprintf('The option "%s" must be provided.', $key));
            }
        }
        $model = $opts['model'];
        unset($opts['model']);
        $class = $opts['class'];
        unset($opts['class']);

        return $this->doRequest(array('model/train', $model, $class), $opts);
    }

    /**
     * Process the model given by the "model" option (i.e. initiates a re-crunch of the training data to create a new model).
     *
     * @param array $opts
     *
     * @return array The response
     *
     * @throws InvalidArgumentException When the option "model" is not provided
     */
    public function processModel(array $opts = array())
    {
        if (!isset($opts['model'])) {
            throw new InvalidArgumentException('The option "model" must be provided.');
        }
        $model = $opts['model'];
        unset($opts['model']);

        return $this->doRequest(array('model/process', $model), $opts);
    }

    /**
     * Set an engine configuration option.
     *
     * @param array $opts
     *
     * @return array The response
     */
    public function setConfig(array $opts = array())
    {
        if (!isset($opts['option'])) {
            throw new InvalidArgumentException('The option "option" must be provided.');
        }
        if (!isset($opts['value'])) {
            throw new InvalidArgumentException('The option "value" must be provided.');
        }
        $opts['_method'] = 'POST';

        return $this->doRequest(array('engine/config'), $opts);
    }

    /**
     * Delete an engine configuration option.
     *
     * @param array $opts
     *
     * @return array The response
     */
    public function deleteConfig(array $opts = array())
    {
        if (!isset($opts['id'])) {
            throw new InvalidArgumentException('The option "id" must be provided.');
        }
        $company = $this->companyName;
        if (isset($data['company'])) {
            $company = $data['company'];
        }
        if (!$company) {
            throw new InvalidArgumentException('The option "company" must be provided.');
        }
        $collection = $this->collectionName;
        if (isset($data['collection'])) {
            $collection = $data['collection'];
        }
        if (!$collection) {
            throw new InvalidArgumentException('The option "collection" must be provided.');
        }
        $id = $opts['id'];
        unset($opts['id']);

        $opts['_method'] = 'DELETE';

        return $this->doRequest(array('engine', $company, $collection, 'config', $id), $opts);
    }

    /**
     * List all engine configuration options.
     *
     * @param array $opts
     *
     * @return array The response
     */
    public function listConfig(array $opts = array())
    {
        $opts['_method'] = 'GET';

        return $this->doRequest(array('engine/config'), $opts);
    }

    /**
     * Flush an engine.
     *
     * @param array $opts
     *
     * @return array The response
     */
    public function flushEngine(array $opts = array())
    {
        $company = $this->companyName;
        if (isset($data['company'])) {
            $company = $data['company'];
        }
        if (!$company) {
            throw new InvalidArgumentException('The option "company" must be provided.');
        }
        $collection = $this->collectionName;
        if (isset($data['collection'])) {
            $collection = $data['collection'];
        }
        if (!$collection) {
            throw new InvalidArgumentException('The option "collection" must be provided.');
        }
        $opts['_method'] = 'GET';

        return $this->doRequest(array('engine', $company, $collection, 'flush'), $opts);
    }

    public function getLastErrors()
    {
        return $this->lastErrors;
    }

    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    public function getLastRawResponse()
    {
        return $this->lastRawResponse;
    }

    /**
     * @throws InvalidArgumentException When any of the options "company", "collection" are not provided
     */
    private function doRequest(array $pathParts, $data = array())
    {
        $this->lastErrors = array();

        if (!isset($data['company'])) {
            $data['company'] = $this->companyName;
        }
        if (!isset($data['collection'])) {
            $data['collection'] = $this->collectionName;
        }
        foreach (array('company', 'collection') as $key) {
            if (!isset($data[$key])) {
                throw new InvalidArgumentException(sprintf('The option "%s" must be provided.', $key));
            }
        }
        if (isset($data['maxresults'])) {
            $data['maxresults'] = (int) $data['maxresults'];
        }
        if (isset($data['page'])) {
            $data['page'] = (int) $data['page'];
        }
        if (isset($data['meta'])) {
            $data['meta'] = $this->encodeMeta($data['meta']);
        }
        if (isset($data['cols'])) {
            $data['cols'] = $this->encodeColumns($data['meta']);
        }
        if (isset($data['scales'])) {
            $data['scales'] = $this->encodeScales($data['scales']);
        }
        if (isset($data['filters'])) {
            $data['filters'] = $this->encodeFilters($data['filters']);
        }

        $url = sprintf('%s/%s', $this->pathPrefix, implode('/', $pathParts));

        if (isset($data['models']) && count($data['models'])) {
            $url = sprintf('%s/%s', $url, $this->encodeModels($data['models']));
        }

        $method = 'post';
        if (isset($data['_method'])) {
            $method = strtolower($data['_method']);
            unset($data['_method']);
        }
        $useGET = !count($data);
        if ($method === 'get') {
            $useGET = true;
        }

        if ($useGET) {
            $request = $this->httpClient->get($url);
            $query = $request->getQuery();
            $query->merge($data);
        } else {
            $request = $this->httpClient->{$method}($url);

            if (count($data) && $method !== 'delete') {
                $request->addPostFields($data);
            }

            if (isset($data['inputfile']) && $data['inputfile']) {
                $inputFile = $data['inputfile'];
                $mimeType = MimeTypeGuesser::getInstance()->guess($inputFile);
                $request->addPostFile('inputfile', $inputFile, $mimeType);
            }
        }

        $request->setPort($this->port);

        if ($this->accessKey && $this->secretKey) {
            $request->setAuth($this->accessKey, $this->secretKey);
        }

        if (null !== $this->logger) {
            $this->logger->debug(sprintf('Sending request to Sajari engine: %s', $request));
        }

        $response = $request->send();

        if (null !== $this->logger) {
            $this->logger->debug(sprintf('Received response from Sajari engine: %s', $response->getBody(true)));
        }

        $this->lastRawResponse = $response->getBody(true);

        $jsonResponse = $response->json();

        $this->lastResponse = $response;

        if (!$jsonResponse) {
            $this->lastErrors[] = 'No response';

            return false;
        }

        $statusCode = (integer) $jsonResponse['statusCode'];

        if ($statusCode === 200) {
            $result = true;

            if (isset($jsonResponse['response'])) {
                $result = $jsonResponse['response'];

                if (isset($jsonResponse['msecs'])) {
                    $result['msecs'] = $jsonResponse['msecs'];
                }
            }

            return $result;
        }

        $errors = isset($jsonResponse['errors']) ? $jsonResponse['errors'] : array('Unknown error');

        $this->lastErrors = array_merge($this->lastErrors, $errors);

        return false;
    }

    private function encodeMeta(array $meta)
    {
        $output = array();

        foreach ($meta as $key => $value) {
            $output[$key] = $this->encodeMetaValue($value);
        }

        return $output;
    }

    private function encodeMetaValue($value)
    {
        if (is_array($value)) {
            $value = implode($value, ';');
        }

        return $value;
    }

    private function encodeModels(array $models)
    {
        return implode(';', $models);
    }

    private function encodeColumns(array $columns)
    {
        return implode(',', $columns);
    }

    private function encodeScales(array $scales)
    {
        $output = array();

        foreach ($scales as $scale) {
            if (is_array($scale) &&
                isset($scale['meta']) &&
                isset($scale['center']) &&
                isset($scale['radius']) &&
                isset($scale['start']) &&
                isset($scale['end'])
            ) {
                $output[] = sprintf(
                    '%s,%d,%d,%.2f,%.2f',
                    $scale['meta'],
                    $scale['center'],
                    $scale['radius'],
                    $scale['start'],
                    $scale['end']
                );
            } else {
                throw new InvalidArgumentException(sprintf('Invalid scale: %s.', var_export($scale, true)));
            }
        }

        return implode('|', $output);
    }

    private function encodeFilters(array $filters)
    {
        $output = array();

        foreach ($filters as $filter) {
            $output[] = $this->encodeFilter($filter);
        }

        return implode('|', $output);
    }

    private function encodeFilter(array $filter)
    {
        $operator = $filter['op'];
        $key = $filter['key'];
        $value = $filter['val'];
        if (is_array($value)) {
            $value = implode($value, ';');
        }

        return sprintf('%s%s,%s', $operator, $key, $value);
    }
}
