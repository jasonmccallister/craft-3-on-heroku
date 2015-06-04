<?php
/**
 * @link http://buildwithcraft.com/
 * @copyright Copyright (c) 2015 Pixel & Tonic, Inc.
 * @license http://buildwithcraft.com/license
 */

namespace craft\app\tests;

use Craft;
use Mockery as m;

/**
 * Base test class.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 3.0
 */
abstract class BaseTest extends \CTestCase
{
	// Properties
	// =========================================================================

	/**
	 * @var
	 */
	private $_originalComponentValues;

	/**
	 * @var
	 */
	private $_originalApplication;

	// Public Methods
	// =========================================================================

	/**
	 * Tear down once all tests have been run.
	 *
	 * @return null
	 */
	public function tearDown()
	{
		// Restore any modified component values. Go backwards in case the same component was set twice.
		if (isset($this->_originalComponentValues))
		{
			for ($i = count($this->_originalComponentValues)-1; $i >= 0; $i--)
			{
				$obj = $this->_originalComponentValues[$i][0];
				$name = $this->_originalComponentValues[$i][1];
				$val = $this->_originalComponentValues[$i][2];

				$obj->set($name, $val);
			}
		}

		// Restore the original app
		if (isset($this->_originalApplication))
		{
			$this->setApplication($this->_originalApplication);
		}

		// Clean up the Mockery container for this test, and run any verification tasks needed for the expectations.
		// @see https://github.com/padraic/mockery#phpunit-integration
		m::close();
	}

	// Protected Methods
	// =========================================================================

	/**
	 * Sets a component, while taking care to restore it in the tear down.
	 *
	 * @param \CModule $obj
	 * @param string   $name
	 * @param mixed    $val
	 *
	 * @return null
	 */
	protected function setComponent(\CModule $obj, $name, $val)
	{
		// Save the original value for tearDown()
		$this->_originalComponentValues[] = [$obj, $name, $obj->get($name)];

		// Set the new one
		$obj->set($name, $val);
	}

	/**
	 * @param $val
	 *
	 * @return null
	 */
	protected function setApplication($val)
	{
		// Save the original one for tearDown()
		if (!isset($this->_originalApplication))
		{
			$this->_originalApplication = Craft::$app;
		}

		// Call null to clear the app singleton.
		Craft::setApplication(null);

		// Set the new one.
		Craft::setApplication($val);
	}

	/**
	 * @return mixed
	 */
	protected function mockApplication()
	{
		$app = m::mock('craft\app\web\Application')->makePartial();
		$this->setApplication($app);
		return $app;
	}

	/**
	 * Returns an accessible ReflectionMethod for a given class/object and method name.
	 *
	 * @param mixed  $obj
	 * @param string $name
	 *
	 * @return \ReflectionMethod
	 */
	protected function getMethod($obj, $name)
	{
		$class = new \ReflectionClass($obj);
		$method = $class->getMethod($name);
		$method->setAccessible(true);
		return $method;
	}
}
