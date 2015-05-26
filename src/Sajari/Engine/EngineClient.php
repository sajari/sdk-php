<?php

namespace Sajari\Engine;

use Guzzle\Http\ClientInterface;
use Guzzle\Http\Client as HttpClient;
use Psr\Log\LoggerInterface;
use Sajari\Common\Exception\ExceptionListener;
use Sajari\Common\Exception\InvalidArgumentException;
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
     * Get the document with the ID given in the "id" field.
     *
     * @param array $opts
     *
     * @return array|null The document or null if not found
     *
     * @throws InvalidArgumentException When the option "id" is not provided
     */
    public function get(array $opts)
    {
        if (!isset($opts['id'])) {
            throw new InvalidArgumentException('The option "id" must be provided.');
        }
        $id = $opts['id'];
        unset($opts['id']);

        $response = $this->doRequest(array('get', $id), $opts);

        if ($response) {
            return $response;
        }

        return;
    }

    /**
     * Remove the document with the ID given in the "id" field.
     *
     * @param array $opts
     *
     * @return Boolean True if removed
     *
     * @throws InvalidArgumentException When the option "id" is not provided
     */
    public function remove(array $opts)
    {
        if (!isset($opts['id'])) {
            throw new InvalidArgumentException('The option "id" must be provided.');
        }
        $id = $opts['id'];
        unset($opts['id']);

        $response = $this->doRequest(array('remove', $id), $opts);

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
     *
     * @throws InvalidArgumentException When the option "id" is not provided
     */
    public function replace(array $opts)
    {
        if (!isset($opts['id'])) {
            throw new InvalidArgumentException('The option "id" must be provided.');
        }
        $id = $opts['id'];
        unset($opts['id']);

        $response = $this->doRequest(array('replace', $id), $opts);

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
     * @throws InvalidArgumentException When the options "id", "fingerprint", "pos" or "neg" are not provided
     */
    public function weightFingerprint(array $opts = array())
    {
        foreach (array('id', 'fingerprint', 'pos', 'neg') as $key) {
            if (!isset($opts[$key])) {
                throw new InvalidArgumentException(sprintf('The option "%s" must be provided.', $key));
            }
        }
        $id = $opts['id'];
        unset($opts['id']);
        $pos = $opts['pos'];
        unset($opts['pos']);
        $neg = $opts['neg'];
        unset($opts['neg']);

        return $this->doRequest(array('fingerprint/weight', $id, $pos, $neg), $opts);
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
        if (isset($data['cols'])) {
            $data['cols'] = $this->encodeColumns($data['meta']);
        }
        if (isset($data['scales'])) {
            $data['scales'] = $this->encodeScales($data['scales']);
        }
        if (isset($opts['filters'])) {
            $data['filters'] = $this->encodeFilters($data['filters']);
        }

        $url = sprintf('%s/%s', $this->pathPrefix, implode('/', $pathParts));

        if (isset($data['models']) && count($data['models'])) {
            $url = sprintf('%s/%s', $url, $this->encodeModels($data['models']));
        }

        $useGET = !count($data);
        if (isset($data['_method']) && $data['_method'] === 'GET') {
            $useGET = true;
            unset($data['_method']);
        }

        if ($useGET) {
            $request = $this->httpClient->get($url);
            $query = $request->getQuery();
            $query->merge($data);
        } else {
            $request = $this->httpClient->post($url);

            if (count($data)) {
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
            foreach ($filter as $key => $value) {
                if (!is_array($value)) {
                    $value = array((string) $value);
                }

                $output[] = implode(',', array($key, implode(',', $value)));
            }
        }

        return implode('|', $output);
    }
}
