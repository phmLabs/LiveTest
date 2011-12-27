<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Test\Unit\LiveTest\TestCases\General\Html;

use Unit\Base\Http\Response\MockUp;

use LiveTest\TestCase\General\Html\ValidMarkup;

use Base\Www\Uri;

/**
 * Unittest class for the markup validator.
 *
 * @author Jan Brinkmann <lucky@the-luckyduck.de>
 */
class ValidMarkupTest extends \PHPUnit_Framework_TestCase
{
  private $_reponseValidDocument = null;
  private $_reponseInvalidDocument = null;

  public function setUp()
  {
    // local fixture dir
    $fixtDir = __DIR__ . '/fixtures';
    
    // fixture: valid html document reponse
    if (file_exists($fixtDir . '/w3responseValid.xml')) {
      $this->_reponseValidDocument = file_get_contents(
        $fixtDir . '/w3responseValid.xml'
      );
    }

    // fixture: invalid html document reponse
    if (file_exists($fixtDir . '/w3responseInvalid.xml')) {
      $this->_reponseValidDocument = file_get_contents(
        $fixtDir . '/w3responseInvalid.xml'
      );
    }
  }

  public function testProcessingOfReponseToValidMarkup()
  {
    $testCase = new ValidMarkup();
    $testCase->init();

    $response = new MockUp();
    $response->setBody( $this->_reponseValidDocument );

    $testCase->test( $response, new Uri( 'http://www.example.com' ));

  }

  public function testProcessingOfReponseToInvalidMarkup()
  {
    $testCase = new ValidMarkup();
    $testCase->init();

    $response = new MockUp();
    $response->setBody( $this->_reponseInvalidDocument );

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }

  public function testInvalidValidatorReponseRaisesException()
  {
    $testCase = new ValidMarkup();
    $testCase->init();

    $response = new MockUp();
    $response->setBody( "no valid validator reponse at all" );

    $this->setExpectedException('LiveTest\TestCase\Exception');
    $testCase->test( $response, new Uri( 'http://www.example.com' ) );
  }
}