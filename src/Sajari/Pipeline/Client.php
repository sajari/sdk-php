<?php

namespace Sajari\Pipeline {

    \Sajari\Internal\Utils::_require_all(__DIR__.'/../proto', 10);

    class Client {

        private $grpcClient;
        private $callMeta;
        private $pipelineName;

        public function __construct(\Sajari\Api\Pipeline\V1\QueryClient $grpcClient, array $callMeta, $pipelineName) {
            $this->grpcClient = $grpcClient;
            $this->callMeta = $callMeta;
            $this->pipelineName = $pipelineName;
        }

        public function Search($values, $tracking = null) {
            $stringValues = [];
            foreach ($values as $key => $value) {
                $stringValues[$key] = (string)$value;
            }

            $pipeline = new \Sajari\Api\Pipeline\V1\Pipeline();
            $pipeline->setName($this->pipelineName);

            $searchRequest = new \Sajari\Api\Pipeline\V1\SearchRequest();
            $searchRequest->setPipeline($pipeline);
            $searchRequest->setValues($stringValues);
            if (!is_null($tracking)) {
                $searchRequest->setTracking($tracking->Proto());
            } else {
                $searchRequest->setTracking((new \Sajari\Query\Tracking())->Proto());
            }

            list($reply, $status) = $this->grpcClient->Search($searchRequest, $this->callMeta)->wait();

            \Sajari\Internal\Utils::checkForError($status);

            return \Sajari\Query\Response::FromProto($reply->getSearchResponse(), iterator_to_array($reply->getTokens()));
        }
    }
}
