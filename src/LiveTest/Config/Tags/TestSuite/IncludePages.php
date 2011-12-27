<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\TestSuite as TestSuiteConfig;

/**
 * This tag includes a list of pages.
 *
 * @example
 *  IncludePages:
 *   - /impressum.html
 *   - http://www.example.com
 *
 * @author Nils Langner
 */
class IncludePages extends Base
{
  /**
   * @see LiveTest\Config\Tags\TestSuite.Base::doProcess()
   */
  protected function doProcess(TestSuiteConfig $config, array $parameters)
  {
    $config->includePages($parameters);
  }
}