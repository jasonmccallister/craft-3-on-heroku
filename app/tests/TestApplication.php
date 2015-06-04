<?php
/**
 * @link http://buildwithcraft.com/
 * @copyright Copyright (c) 2015 Pixel & Tonic, Inc.
 * @license http://buildwithcraft.com/license
 */

namespace craft\app\tests;

use Craft;
use craft\app\web\Application;

/**
 * Class TestApplication
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 3.0
 */
class TestApplication extends Application
{
	// Public Methods
	// =========================================================================

	/**
	 * @param null $config
	 *
	 * @return TestApplication
	 */
	public function __construct($config = null)
	{
		Craft::setApplication(null);
		clearstatcache();

		parent::__construct($config);
	}

	/**
	 * @return null
	 */
	public function loadGlobalState()
	{
		parent::loadGlobalState();
	}

	/**
	 * @return null
	 */
	public function saveGlobalState()
	{
		parent::saveGlobalState();
	}
}
