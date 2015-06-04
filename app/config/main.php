<?php

$config = [
	'id' => 'Craft',
	'name' => 'Craft',
	'version' => '3.0',
	'build' => '2663',
	'schemaVersion' => '3.0.1',
	'releaseDate' => '1432752158',
	'minBuildRequired' => '2645',
	'minBuildUrl' => 'http://download.buildwithcraft.com/craft/2.3/2.3.2645/Craft-2.3.2645.zip',
	'track' => 'dev',
	'basePath' => '@craft/app',          // Defines the @app alias
	'runtimePath' => '@storage/runtime', // Defines the @runtime alias
	'controllerNamespace' => 'craft\app\controllers',
];

return $config;
