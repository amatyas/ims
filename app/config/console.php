<?php

/**
 * Phundament 3 Console Config File
 * Containes predefined yiic console commands for Phundament.
 * Define composer hooks by the following name schema: <vendor>/<packageName>-<action>

 */
// for testing purposes
$migrateCommand = (getenv('PHUNDAMENT_TEST') ? null : array('yiic', 'migrate', '--interactive=1'));

$mainConfig = require('main.php');

return array(
    'aliases' => array(
        'vendor' => dirname(__FILE__) . '/../../vendor',
        'webroot' => dirname(__FILE__) . '/../../www',
    ),
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Phundament Console Application',
    'components' => CMap::mergeArray(
            $mainConfig['components'], array()
    ),
    'modules' => $mainConfig['modules'],
    'commandMap' => array(
        // dev command
        'database' => array(
            'class' => 'vendor.schmunk42.database-command.EDatabaseCommand',
        ),
        // composer callback
        'migrate' => array(
            // alias of the path where you extracted the zip file
            'class' => 'vendor.yiiext.migrate-command.EMigrateCommand',
            // this is the path where you want your core application migrations to be created
            'migrationPath' => 'application.migrations',
            // the name of the table created in your database to save versioning information
            'migrationTable' => 'migration',
            // the application migrations are in a pseudo-module called "core" by default
            'applicationModuleName' => 'core',
            // define all available modules (if you do not set this, modules will be set from yii app config)
            'modulePaths' => array(
                'data' => 'application.migrations.data',
                'rights' => 'vendor.phundament.p3admin.modules-install.rights.migrations',
                'user' => 'vendor.mishamx.yii-user.migrations',
                'p3pages' => 'vendor.phundament.p3pages.migrations',
                'p3widgets' => 'vendor.phundament.p3widgets.migrations',
                'p3media' => 'vendor.phundament.p3media.migrations',
            #'app-demo-data'  => 'vendor.waalzer.app-demo-data.migrations' // data for eg. demo.phundament.com
            ),
            // you can customize the modules migrations subdirectory which is used when you are using yii module config
            'migrationSubPath' => 'migrations',
            // here you can configure which modules should be active, you can disable a module by adding its name to this array
            'disabledModules' => array(
                //'data', // ...
            ),
            // the name of the application component that should be used to connect to the database
            'connectionID' => 'db',
        // alias of the template file used to create new migrations
        #'templateFile' => 'system.cli.migration_template',
        ),
        // composer callback
        'p3bootstrap' => array(
            'class' => 'vendor.phundament.p3bootstrap.commands.P3BootstrapCommand',
            'themePath' => 'application.themes',
            'publicThemePath' => 'webroot.themes',
        ),
        // composer callback
        'p3media' => array(
            'class' => 'vendor.phundament.p3media.commands.P3MediaCommand',
        ),
        // composer callback
        'less-setup' => array(
            'class' => 'vendor.crisu83.yii-less.commands.LessSetupCommand',
        ),
        // media file sync
        'rsync' => array(
            'class' => 'vendor.phundament.p3extensions.commands.P3RsyncCommand',
            'servers' => array(
                'dev' => realpath(dirname(__FILE__) . '/..'),
                'prod' => 'user@example.com:/path/to/phundament/app',
            ),
            'aliases' => array(
                'p3media' => 'application.data.p3media' # Note: This setting syncs P3Media Files
            ),
        #'params' => '--rsh="ssh -p222"',
        ),
        // composer callback
        'webapp' => array(
            'class' => 'application.commands.P3WebAppCommand',
        ),
    ),
    'params' => array(
        'composer.callbacks' => array(
            // args for Yii command runner
            'post-update' => $migrateCommand,
            'post-install' => $migrateCommand,
            'yiisoft/yii-install' => array('yiic', 'webapp', 'create',
                realpath(dirname(__FILE__) . '/../../'),
                'git',
                '--interactive=0'),
            'phundament/p3bootstrap-install' => array('yiic', 'p3bootstrap'),
            'phundament/p3media-install' => array('yiic', 'p3media'),
            'crisu83/yii-less-install' => array('yiic', 'less-setup'),
        ),
    )
);