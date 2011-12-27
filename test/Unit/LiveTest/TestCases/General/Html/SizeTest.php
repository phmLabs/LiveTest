<?php

namespace Test\Unit\LiveTest\TestCases\General\Html;

use Unit\Base\Http\Response\MockUp;

use Base\Www\Uri;
use LiveTest\TestCase\General\Html\Size;

class SizeTest extends \PHPUnit_Framework_TestCase
{
  public function testBadConfiguration( )
  {
    $testCase = new Size();

    $this->setExpectedException('\LiveTest\ConfigurationException');
    $testCase->init();
  }

  public function testBadMinSize( )
  {
    $testCase = new Size();
    $testCase->init( 10 );

    $response = new MockUp();
    $response->setBody('<body>');

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, new Uri('http://www.example.com') );
  }

  public function testGoodMinSize( )
  {
    $testCase = new Size();
    $testCase->init( 2 );

    $response = new MockUp();
    $response->setBody('<body>');

    $testCase->test( $response, new Uri('http://www.example.com') );
  }

  public function testBadMaxSize( )
  {
    $testCase = new Size();
    $testCase->init( null, 2 );

    $response = new MockUp();
    $response->setBody('<body>');

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, new Uri('http://www.example.com') );
  }

  public function testGoodMaxSize( )
  {
    $testCase = new Size();
    $testCase->init( null, 10 );

    $response = new MockUp();
    $response->setBody('<body>');

    $testCase->test( $response, new Uri('http://www.example.com') );
  }
}