<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Bayes\Train {

  // Train defines methods used to interact with the bayes training service
  class TrainClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
      parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Train takes a set of training and testing documents representing
     * a set of classes and creates a naive bayes model to represent the
     * training set. The response returns the accuracy of the model using
     * the set of testing documents. See TrainingSet for details on how
     * to create a training set.
     * @param \Sajari\Bayes\Train\Request $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Train(\Sajari\Bayes\Train\Request $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.bayes.train.Train/Train',
      $argument,
      ['\Sajari\Bayes\Train\Response', 'decode'],
      $metadata, $options);
    }

  }

}
