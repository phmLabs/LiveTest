<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Parser;

use LiveTest\ConfigurationException;

class UnknownTagException extends ConfigurationException
{
	private $tagName;
	
	public function __construct($message, $tagName, $code = null, $previous = null)
	{
		parent::__construct($message, $code, $previous);
		$this->tagName = $tagName;
	}
	
	public function getTagName( )
	{
		return $this->tagName;
	}
}