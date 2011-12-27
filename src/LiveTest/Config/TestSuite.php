<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config;

/**
 * This class contains all information about the tests and the depending pages.
 *
 * @author Nils Langner
 */
use LiveTest\Config\PageManipulator\PageManipulator;

class TestSuite implements Config
{
  /**
   * Pages that are included
   * @var string[]
   */
  private $includedPages = array ();

  /**
   * Pages that are excluded
   * @var string[]
   */
  private $excludedPages = array ();

  /**
   * The created tests.
   * @var array
   */
  private $testCases = array ();

  /**
   * This flag indicates if this config file should inherit the pages from its
   * parent.
   *
   * @var bool
   */
  private $inherit = true;

  /**
   * The directory of the yaml file this configuration was created from
   * @var string
   */
  private $baseDir;

  /**
   * The parent configuration. Used to inherit pages.
   * @var TestSuite
   */
  private $parentConfig;

  private $pageManipulators = array ();

  /**
   * Set the parent config if needed.
   *
   * @param TestSuite $parentConfig
   */
  public function __construct(TestSuite $parentConfig = null)
  {
    $this->parentConfig = $parentConfig;
  }

  /**
   * Used to add a page manipulator. These manipulators are used to manipulate the
   * pages (url strings) registered in this config file.

   * @param PageManipulator $pageManipulator
   */
  public function addPageManipulator(PageManipulator $pageManipulator)
  {
    $this->pageManipulators[] = $pageManipulator;
  }

  /**
   * Sets the base dir. This is needed because some tags need the path to the config
   * entry file.
   *
   * @param string $baseDir
   */
  public function setBaseDir($baseDir)
  {
    $this->baseDir = $baseDir;
  }

  /**
   * Returns the base directory of the config file.
   *
   * @return string
   */
  public function getBaseDir()
  {
    if (is_null($this->baseDir))
    {
      return $this->parentConfig->getBaseDir();
    }
    return $this->baseDir;
  }

  /**
   * Include an additional page to the config.
   *
   * @param string $page
   */
  public function includePage($page)
  {
    $this->includedPages[$page] = $page;
  }

  /**
   * Includes an array containing pages to the config.
   *
   * @param string[] $pages
   */
  public function includePages($pages)
  {
    foreach ( $pages as $page )
    {
      $this->includePage(trim($page));
    }
  }

  /**
   * Removes a page from the config.
   *
   * @param string $page
   */
  public function excludePage($page)
  {
    $this->excludedPages[$page] = $page;
  }

  /**
   * Removes a set of pages from this config.
   *
   * @param string[] $pages
   */
  public function excludePages($pages)
  {
    foreach ( $pages as $page )
    {
      $this->excludePage($page);
    }
  }

  /**
   * This function is called if this config should not inherit the pages from its parent.
   */
  public function doNotInherit()
  {
    $this->inherit = false;
  }

  /**
   * This function adds a test to the config and returns a new config connected to the
   * test.
   *
   * @todo we should use the Test class for this
   *
   * @param string $name
   * @param string $className
   * @param array $parameters
   */
  public function createTestCase($name, $className, array $parameters)
  {
    $config = new self($this);

    $this->testCases[] = array ('config' => $config, 'name' => $name, 'className' => $className, 'parameters' => $parameters );

    return $config;
  }

  /**
   * Returns the list of pages.
   *
   * @return string[]
   */
  public function getPages()
  {
    if ($this->inherit && !is_null($this->parentConfig))
    {
      $result = array_merge($this->includedPages, $this->parentConfig->getPages());
    }
    else
    {
      $result = $this->includedPages;
    }

    $pages = array_diff($result, $this->excludedPages);

    foreach( $this->pageManipulators as $manipulator )
    {
      foreach( $pages as &$page )
      {
        $page = $manipulator->manipulate($page);
      }
    }

    return $pages;
  }

  /**
   * Returns the tests.
   *
   * @return array
   */
  public function getTestCases()
  {
    return $this->testCases;
  }
}