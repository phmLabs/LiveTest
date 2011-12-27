<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\Parser;

/**
 * This tag sets a list of pages to the configuration and stops the inheritance of the config file. If
 * you want to inherit use the IncludePages tag.
 *
 * @example
 *  Pages:
 *   - /
 *   - http://www.example.com
 *
 * @author Nils Langner
 */
class Pages extends Base
{
  /**
   * @see LiveTest\Config\Tags\TestSuite.Base::doProcess()
   */
  protected function doProcess(\LiveTest\Config\TestSuite $config, array $parameters)
  {
    $config->doNotInherit();
    $config->includePages($parameters);
  }
}