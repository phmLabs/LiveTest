<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun\Result;

use LiveTest\TestRun\Test;

use Base\Www\Uri;

/**
 * This class contains all information about a test case run.
 *
 * @author Nils Langner
 */
class Result
{
  const STATUS_SUCCESS = 'success';
  const STATUS_FAILED = 'failure';
  const STATUS_ERROR = 'error';

  /**
   * The test information
   * @var Test
   */
  private $test;

  /**
   * The status of this result.
   * @var string
   */
  private $status;

  /**
   * The error/failure message for this result
   * @var string
   */
  private $message;

  /**
   * The uri the test was run against
   * @var Uri
   */
  private $uri;

  public function __construct(Test $test, $status, $message, Uri $uri)
  {
    $this->test = $test;
    $this->status = $status;
    $this->message = $message;
    $this->uri = $uri;
  }

  /**
   * Returns the test information for this result.
   *
   * @return Test
   */
  public function getTest()
  {
    return $this->test;
  }

  /**
   * Returns the status of this result. If comparing a status always chose the
   * STATUS_* consts.
   *
   * @return string
   */
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * The message for this result. Should be empty if the test case succeeded.
   *
   * @return string
   */
  public function getMessage()
  {
    return $this->message;
  }

  /**
   * Returns the uri of the page the test was run against.
   *
   * @return Uri
   */
  public function getUri()
  {
    return $this->uri;
  }
}
