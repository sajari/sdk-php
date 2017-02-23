<?php

namespace Sajari\Pipeline {

    class Client {

        private $grpcClient;
        private $callMeta;
        private $pipelineName;

        public function __construct(\Sajari\Api\Pipeline\V1\QueryClient $grpcClient, array $callMeta, $pipelineName) {
            $this->grpcClient = $grpcClient;
            $this->callMeta = $callMeta;
            $this->pipelineName = $pipelineName;
        }

        public function Search($values, $tracking) {
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

            $this->checkForError($status);

            $reply = $reply->getSearchResponse();

            return \Sajari\Query\Response::FromProto($reply->getSearchResponse(), iterator_to_array($reply->getTokens()));
        }

        private function checkForError($status)
        {
            switch ($status->code) {
                case 0:
                    return;
                case 3:
                    // invalid argument
                    throw new \Sajari\Error\MalformedRequestException($status->details, $status->code);
                case 5:
                    // not found
                    throw new \Sajari\Error\NotFoundException($status->details, $status->code);
                case 6:
                    // already exists
                    throw new \Sajari\Error\AlreadyExistsException($status->details, $status->code);
                case 7:
                    // permission denied
                    throw new \Sajari\Error\PermissionDeniedException($status->details, $status->code);
                case 14:
                    // unavailable
                    throw new \Sajari\Error\ServiceUnavailableException($status->details, $status->code);
                case 16:
                    // unauthenticated
                    throw new \Sajari\Error\UnauthenticatedException($status->details, $status->code);;
                default:
                    // generic exception
                    throw new \Sajari\Error\Exception($status->details, $status->code);
            }
        }
    }
}
