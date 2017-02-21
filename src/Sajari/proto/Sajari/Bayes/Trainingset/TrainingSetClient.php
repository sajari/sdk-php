<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Sajari\Bayes\Trainingset {

  // TrainingSet defines methods used to interact with the bayes training set service
  class TrainingSetClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
      parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Uploads a training/testing document for the specified training set name and known class name
     * @param \Sajari\Bayes\Trainingset\UploadRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Upload(\Sajari\Bayes\Trainingset\UploadRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.bayes.trainingset.TrainingSet/Upload',
      $argument,
      ['\Sajari\Bayes\Trainingset\UploadResponse', 'decode'],
      $metadata, $options);
    }

    /**
     * Creates a new training set
     * @param \Sajari\Bayes\Trainingset\CreateRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Create(\Sajari\Bayes\Trainingset\CreateRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.bayes.trainingset.TrainingSet/Create',
      $argument,
      ['\Sajari\Rpc\GPBEmpty', 'decode'],
      $metadata, $options);
    }

    /**
     * Returns information on the specified training est
     * @param \Sajari\Bayes\Trainingset\InfoRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Info(\Sajari\Bayes\Trainingset\InfoRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.bayes.trainingset.TrainingSet/Info',
      $argument,
      ['\Sajari\Bayes\Trainingset\InfoResponse', 'decode'],
      $metadata, $options);
    }

    /**
     * Adds a new class to the training set
     * @param \Sajari\Bayes\Trainingset\AddClassRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function AddClass(\Sajari\Bayes\Trainingset\AddClassRequest $argument,
      $metadata = [], $options = []) {
      return $this->_simpleRequest('/sajari.bayes.trainingset.TrainingSet/AddClass',
      $argument,
      ['\Sajari\Rpc\GPBEmpty', 'decode'],
      $metadata, $options);
    }

  }

}
