<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
            'assetManager' => array(
              'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR."../../www/assets", // needed when running from global codecept.phar installation
            ),
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			// provide test database connection
			'db'=>array(
                'tablePrefix' => '',
                'connectionString' => 'sqlite:' . $applicationDirectory . '/data/test.db',
			),

		),
	)
);
