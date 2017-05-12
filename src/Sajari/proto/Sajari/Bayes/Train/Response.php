<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: sajari/bayes/train/train.proto

namespace Sajari\Bayes\Train;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * <pre>
 * Response contains information on a training run with regards to accuracy
 * </pre>
 *
 * Protobuf type <code>sajari.bayes.train.Response</code>
 */
class Response extends \Google\Protobuf\Internal\Message
{
    /**
     * <pre>
     * Errors contains an array of ClassError describing the training success/failure
     * </pre>
     *
     * <code>repeated .sajari.bayes.train.ClassError errors = 1;</code>
     */
    private $errors;
    /**
     * <pre>
     * Total number of correct classifications across all classes for this
     * training run
     * </pre>
     *
     * <code>uint32 correct = 2;</code>
     */
    private $correct = 0;
    /**
     * <pre>
     * Total number of incorrect classifications across all classes for this
     * training run
     * </pre>
     *
     * <code>uint32 incorrect = 3;</code>
     */
    private $incorrect = 0;

    public function __construct() {
        \GPBMetadata\Sajari\Bayes\Train\Train::initOnce();
        parent::__construct();
    }

    /**
     * <pre>
     * Errors contains an array of ClassError describing the training success/failure
     * </pre>
     *
     * <code>repeated .sajari.bayes.train.ClassError errors = 1;</code>
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * <pre>
     * Errors contains an array of ClassError describing the training success/failure
     * </pre>
     *
     * <code>repeated .sajari.bayes.train.ClassError errors = 1;</code>
     */
    public function setErrors(&$var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Sajari\Bayes\Train\ClassError::class);
        $this->errors = $arr;
    }

    /**
     * <pre>
     * Total number of correct classifications across all classes for this
     * training run
     * </pre>
     *
     * <code>uint32 correct = 2;</code>
     */
    public function getCorrect()
    {
        return $this->correct;
    }

    /**
     * <pre>
     * Total number of correct classifications across all classes for this
     * training run
     * </pre>
     *
     * <code>uint32 correct = 2;</code>
     */
    public function setCorrect($var)
    {
        GPBUtil::checkUint32($var);
        $this->correct = $var;
    }

    /**
     * <pre>
     * Total number of incorrect classifications across all classes for this
     * training run
     * </pre>
     *
     * <code>uint32 incorrect = 3;</code>
     */
    public function getIncorrect()
    {
        return $this->incorrect;
    }

    /**
     * <pre>
     * Total number of incorrect classifications across all classes for this
     * training run
     * </pre>
     *
     * <code>uint32 incorrect = 3;</code>
     */
    public function setIncorrect($var)
    {
        GPBUtil::checkUint32($var);
        $this->incorrect = $var;
    }

}

