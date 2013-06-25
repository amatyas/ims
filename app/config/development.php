<?php

// Include this file in local.php on your development system

return array(
    #'theme' => 'classic',
    'import'     => array( #'fullcrud.models.*',
        #'sakila.components.*',
        #'sakila.models.*',
    ),
    // application components
    'components' => array(
        'assetManager' => array(
            #'linkAssets' => true
        ),
        /* 'dbProduction' => array(
          'class' => 'CDbConnection',
          // MySQL
          'connectionString' => 'mysql:host=domain.tld;dbname=p3',
          'emulatePrepare' => true,
          'username' => 'test',
          'password' => 'test',
          'charset' => 'utf8',
          'enableParamLogging' => true
          ), */
        'dbTest' => array(
            // MySQL
            'class'            => 'CDbConnection',
            'tablePrefix'      => '',
            'connectionString' => 'sqlite:' . $applicationDirectory . '/data/test.db',
        ),
        'less'         => array(
            'class'   => 'vendor.crisu83.yii-less.components.Less',
            'mode'    => 'server',
            'files'   => array(
                // register files here or in your in the layout
                'themes/frontend/less/p3.less' => 'themes/frontend/css/p3.css',
                'themes/backend/less/p3.less' => 'themes/backend/css/p3.css',
            ),
            'options' => array(
                //'forceCompile' => true,
                'nodePath'     => '/opt/local/bin/node',
                'compilerPath' => $applicationDirectory . '/../vendor/cloudhead/less.js/bin/lessc',
            ),
        ),
        'log'    => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class'     => 'vendor.malyshev.yii-debug-toolbar.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('127.0.0.1'),
                    'enabled'   => true,
                ),
                array(
                    'class'  => 'CFileLogRoute',
                    'levels' => 'error, warning',
                    #'categories' => 'application',
                ),
            ),
        ),
    ),
    'modules'    => array( #'fullcrud',
        #'sakila',
        #'fullcrudWorld',
    ),
    'params'     => array( // this is used in contact page
        #'adminEmail' => 'webmaster@h17n.de',
    ),
);
?>