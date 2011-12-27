<?php
namespace Unit\LiveTest\TestRun\Helper;

use LiveTest\TestRun\Properties;
use Base\Http\Response\Response;
use LiveTest\TestRun\Result\Result;
use LiveTest\Event\Dispatcher;
use LiveTest\Listener\Listener;

class PreRunListener implements Listener
{
  private $preRunCalled = false;
  private $properties;

  public function __construct($runId, Dispatcher $eventDispatcher)
  {

  }

  /**
   * @Event("LiveTest.Run.PreRun")
   */
  public function preRun(Properties $properties)
  {
    $this->preRunCalled = true;
    $this->properties = $properties;
  }

  public function isPreRunCalled()
  {
    return $this->preRunCalled;
  }

  public function getProperties( )
  {
    return $this->properties;
  }
}