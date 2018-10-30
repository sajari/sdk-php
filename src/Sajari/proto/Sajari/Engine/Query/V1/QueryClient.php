<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Engine\Query\V1;

/**
 * Service Query defines methods for querying a collection.
 */
class QueryClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Search runs a search query over all records in a collection.
     * @param \Sajari\Engine\Query\V1\SearchRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Search(\Sajari\Engine\Query\V1\SearchRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.engine.query.v1.Query/Search',
        $argument,
        ['\Sajari\Engine\Query\V1\SearchResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * Evaluate runs a search query on a single record in a collection.
     * @param \Sajari\Engine\Query\V1\EvaluateRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Evaluate(\Sajari\Engine\Query\V1\EvaluateRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.engine.query.v1.Query/Evaluate',
        $argument,
        ['\Sajari\Engine\Query\V1\SearchResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * Substitute takes a search request and a record and substitutes the record values
     * in the request.
     * @param \Sajari\Engine\Query\V1\SubstituteRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Substitute(\Sajari\Engine\Query\V1\SubstituteRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.engine.query.v1.Query/Substitute',
        $argument,
        ['\Sajari\Engine\Query\V1\SearchRequest', 'decode'],
        $metadata, $options);
    }

    /**
     * Analyse takes an AnalyseRequest (comprised of a search query and a record identifier)
     * and computes the term overlap between the two.
     * @param \Sajari\Engine\Query\V1\AnalyseRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Analyse(\Sajari\Engine\Query\V1\AnalyseRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/sajari.engine.query.v1.Query/Analyse',
        $argument,
        ['\Sajari\Engine\Query\V1\AnalyseResponse', 'decode'],
        $metadata, $options);
    }

}
