<?php

namespace Sajari\Pipeline {

    class Request {

        private $label = '';

        private $values = [];

        public function __construct($label, $values, $tracking = null) {
            $this->label = $label;
            $this->values = $values;
            $this->tracking = $tracking;
        }

        public function ToProto() {
            $pipeline = new \Sajari\Api\Pipeline\V1\Pipeline();
            $pipeline->setLabel($this->label);

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
