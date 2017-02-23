<?php

namespace Sajari\Pipeline {

    class Pipeline {

        private $name = '';

        private $values = [];

        public function __construct($name) {
            $this->name = $name;
        }

        public function Search($values, $tracking) {
            // ... 
        }

        public function ToProto() {
            $pipeline = new \Sajari\Api\Pipeline\V1\Pipeline();
            $pipeline->setname($this->name);

            $searchRequest = new \Sajari\Api\Pipeline\V1\SearchRequest();
            $searchRequest->setPipeline($pipeline);
            $searchRequest->setValues($this->values);
            if (!is_null($this->tracking)) {
                $searchRequest->setTracking($this->tracking);
            } else {
                $searchRequest->setTracking((new \Sajari\Query\Tracking())->Proto());
            }

            return $searchRequest;
        }
    }

}
