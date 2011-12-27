<?php

namespace Unit\LiveTest\Packages\Runner\Listeners;

use LiveTest\Event\Dispatcher;

use Base\Config\Yaml;
use Base\Www\Uri;

use LiveTest\TestRun\Properties;
use LiveTest\Packages\Runner\Listeners\InfoHeader;

class InfoHeaderTest extends \PHPUnit_Framework_TestCase
{
  private $yamlTestSuiteConfig = '/fixtures/InfoHeaderTestSuiteConfig.yml';

  private $listener;

  protected function setUp()
  {
    $this->listener = new InfoHeader('', new Dispatcher());
  }

  public function testPreRun( )
  {
    $properties = Properties::createByYamlFile(__DIR__.$this->yamlTestSuiteConfig, new Uri('http://www.example.com'));

    ob_start();
    $this->listener->preRun($properties);
    $output = ob_get_contents();
    ob_clean();

    $expected = "  Default Domain  : http://www.example.com\n  Start Time      : 2011-02-14 16:43:09\n\n".
                "  Number of URIs  : 3\n  Number of Tests : 6\n\n";

    $output = explode("\n", $output);

    $this->assertEquals( '  Default Domain  : http://www.example.com', $output[0] );
    $this->assertEquals( '  Number of URIs  : 3', $output[3] );
    $this->assertEquals( '  Number of Tests : 6', $output[4] );
  }
}