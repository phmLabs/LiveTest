<?php

namespace Test\Unit\LiveTest\Config\Parser;

use LiveTest\Config\TestSuite;
use LiveTest\Config\Parser\Parser;

use Base\Config\Yaml;

class ParserTest extends \PHPUnit_Framework_TestCase
{
  public function testParser()
  {
    $config = new TestSuite();
    $config->setBaseDir(__DIR__ . '/fixtures/');
    $configYaml = new Yaml(__DIR__ . '/fixtures/testsuite.yml');

    $parser = new Parser('LiveTest\\Config\\Tags\\TestSuite\\');
    $parsedConfig = $parser->parse($configYaml->toArray(), $config);

   //    foreach ($parsedConfig->getTestCases() as $testCase)
  //    {
  //      \Base\Debug\DebugHelper::doVarDump($testCase['className']);
  //      \Base\Debug\DebugHelper::doVarDump($testCase['config']->getPages());
  //    }
  //
  //    \Base\Debug\DebugHelper::doVarDump($parsedConfig->getPages());
  }

  public function testUnknownTag()
  {
    $config = new TestSuite();
    $config->setBaseDir(__DIR__ . '/fixtures/');
    $configYaml = new Yaml(__DIR__ . '/fixtures/badtestsuite.yml');

    $parser = new Parser('LiveTest\\Config\\Tags\\TestSuite\\');
    $this->setExpectedException('LiveTest\Config\Parser\UnknownTagException');
    $parsedConfig = $parser->parse($configYaml->toArray(), $config);
  }
}