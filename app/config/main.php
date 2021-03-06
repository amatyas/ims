<?php

define('DS', DIRECTORY_SEPARATOR);

/**
 * Phundament 3 Application Config File
 *
 * All modules and components have to be declared before installing a new package via composer.
 * See also config.php, for composer installation and update "hooks"
 */
$applicationDirectory = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$baseUrl = (dirname($_SERVER['SCRIPT_NAME']) == '/' || dirname($_SERVER['SCRIPT_NAME']) == '\\') ? '' : dirname($_SERVER['SCRIPT_NAME']);

$mainConfig = array(
    'basePath' => $applicationDirectory,
    'name' => 'GRID',
    'theme' => 'frontend', // theme is copied from extensions/phundament/p3bootstrap
    'language' => 'en', // default language, see also components.langHandler
    'preload' => array(
        'log',
        'langHandler',
        'bootstrap',
    ),
    'aliases' => array(
// composer
        'root' => $applicationDirectory . '/..',
        'webroot' => $applicationDirectory . '/../www',
        'vendor' => $applicationDirectory . '/../vendor',
        'bootstrap' => 'vendor.clevertech.yiibooster.src',
        // p3widgets
        'jsonEditorView' => 'vendor.phundament.p3extensions.widgets.jsonEditorView',
        'ckeditor' => 'vendor.phundament.p3extensions.widgets.ckeditor',
        // p3media
        'jquery-file-upload' => 'vendor.phundament.jquery-file-upload',
        'jquery-file-upload-widget' => 'vendor.phundament.p3extensions.widgets.jquery-file-upload',
        // fixing 'hardcoded aliases' from extension (note: you have to use the full path)
        'application.modules.user.views.asset' => 'vendor.mishamx.yii-user.views.asset',
        'application.modules.user.components' => 'vendor.mishamx.yii-user.components',
        'ext.editable.assets.js.locales' => 'vendor.vitalets.yii-bootstrap-editable.assets.js.locales',
        'ext.editable.assets' => 'vendor.vitalets.yii-bootstrap-editable.assets',
        'gii-template-collection' => 'vendor.phundament.gii-template-collection',
        'echosen' => 'vendor.ifdattic.echosen',
        'echosen.EChosen' => 'vendor.ifdattic.echosen.EChosen',
        'ext.EChosen' => 'vendor.ifdattic.echosen',
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'zii.widgets.*',
        'vendor.phundament.gii-template-collection.components.*', // Relation Widget
        'vendor.phundament.p3widgets.components.*', // P3WidgetContainer
        'vendor.phundament.p3extensions.components.*', // shared classes
        'vendor.phundament.p3extensions.behaviors.*', // shared classes
        'vendor.phundament.p3extensions.widgets.*', // shared classes
        'vendor.phundament.p3extensions.helpers.*', // shared classes - P3StringHelper
        'vendor.phundament.p3pages.models.*', // Meta description and keywords (P3Media)
        'vendor.mishamx.yii-user.models.*', // User Model
        'vendor.crisu83.yii-rights.components.*', // RWebUser
        'vendor.clevertech.yiibooster.src.widgets.*', // Bootstrap UI
        'vendor.yiiext.fancybox-widget.*', // Fancybox Widget
        'vendor.vitalets.yii-bootstrap-editable.*', // p3media
        'vendor.z_bodya.galleryManager.*', //gallery
        'vendor.z_bodya.galleryManager.models.*',
        'vendor.gnuheike.notificator.*'
    ),
    'modules' => array(
// uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'p3',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'vendor.phundament.gii-template-collection', // giix generators
            ),
        ),
        'p3admin' => array(
            'class' => 'vendor.phundament.p3admin.P3AdminModule',
            'params' => array('install' => false),
        ),
        'oims' => array(
            'class' => 'vendor.gnuheike.oims.OimsModule',
            'defaultController' => 'product',
            'controllerMap' => array(
                'gallery' => array(
                    'class' => 'vendor.z_bodya.galleryManager.GalleryController',
                    'pageTitle' => 'Gallery administration',
                ),
            ),
        ),
        'p3widgets' => array(
            'class' => 'vendor.phundament.p3widgets.P3WidgetsModule',
            'params' => array(
                'widgets' => array(
                    'CWidget' => 'Basic HTML Widget',
                    'TbCarousel' => 'Bootstrap Carousel',
                    'EFancyboxWidget' => 'Fancy Box',
                // use eg. $> php composer.phar require yiiext/swf-object-widget to get the
// widget source; import widget class or set an alias.
#'P3MarkdownWidget' => 'Markdown Widget'
#'ESwfObjectWidget' => 'SWF Object',
                ),
            ),
        ),
        'p3media' => array(
            'class' => 'vendor.phundament.p3media.P3MediaModule',
            'params' => array(
                'publicRuntimePath' => 'www/runtime/p3media',
                'publicRuntimeUrl' => '/runtime/p3media',
                'protectedRuntimePath' => 'runtime/p3media',
                'presets' => array(
                    'large' => array(
                        'name' => 'Large 1600px',
                        'commands' => array(
                            'resize' => array(1600, 1600, 2),
                            'quality' => '85',
                        ),
                        'type' => 'jpg',
                    ),
                    'medium' => array(
                        'name' => 'Medium 800px',
                        'commands' => array(
                            'resize' => array(800, 800, 2),
                            'quality' => '85',
                        ),
                        'type' => 'jpg',
                    ),
                    'medium-crop' => array(
                        'name' => 'Medium cropped 800x600px',
                        'commands' => array(
                            'resize' => array(800, 600, 7), // crop
                            'quality' => '85',
                        ),
                        'type' => 'jpg',
                    ),
                    'small' => array(
                        'name' => 'Small 400px',
                        'commands' => array(
                            'resize' => array(400, 400, 2),
                            'quality' => '85',
                        ),
                        'type' => 'jpg',
                    ),
                    'icon-32' => array(
                        'name' => 'Icon 32x32',
                        'commands' => array(
                            'resize' => array(32, 32),
                        ),
                        'type' => 'png'
                    ),
                    'original' => array(
                        'name' => 'Original File',
                        'originalFile' => true,
                    ),
                    'original-public' => array(
                        'name' => 'Original File Public',
                        'originalFile' => true,
                        'savePublic' => true,
                    ),
                    'download' => array(
                        'name' => 'Download File',
                        'originalFile' => true,
                        'attachment' => true,
                    ),
                    'p3media-ckbrowse' => array(
                        'commands' => array(
                            'resize' => array(150, 120),
                        ),
                        'type' => 'png'
                    ),
                    'p3media-manager' => array(
                        'commands' => array(
                            'resize' => array(300, 200),
                        ),
                        'type' => 'png'
                    ),
                    'p3media-upload' => array(
                        'commands' => array(
                            'resize' => array(60, 30),
                        ),
                        'type' => 'png'
                    ),
                )
            ),
        ),
        'p3pages' => array(
            'class' => 'vendor.phundament.p3pages.P3PagesModule',
            'params' => array(
                'availableLayouts' => array(
                    '//layouts/main' => 'Main Layout',
                ),
                'availableViews' => array(
                    '//p3pages/column1' => 'One Column',
                    '//p3pages/column2' => 'Two Columns',
                )
            ),
        ),
        'rights' => array(
            'class' => 'vendor.crisu83.yii-rights.RightsModule',
            'appLayout' => '//layouts/main',
            'userIdColumn' => 'id',
            'userClass' => 'User',
            'cssFile' => '/themes/backend/css/yii-rights.css'
#'install' => true, // Enables the installer.
#'superuserName' => 'admin'
        ),
        'user' => array(
            'class' => 'vendor.mishamx.yii-user.UserModule',
            'activeAfterRegister' => false,
        ),
    ),
    // application components
    'components' => array(
        'clientScript' => array(
            'class' => 'vendor.nlac.nls.NLSClientScript',
            //'excludePattern' => '/\.tpl/i', //js regexp, files with matching paths won't be filtered is set to other than 'null'
//'includePattern' => '/\.php/', //js regexp, only files with matching paths will be filtered if set to other than 'null'
            'mergeJs' => false, //def:true
            'compressMergedJs' => false, //def:false
            'mergeCss' => false, //def:true
            'compressMergedCss' => false, //def:false
            'mergeJsExcludePattern' => '/edit_area/', //won't merge js files with matching names
            'mergeIfXhr' => false, //def:false, if true->attempts to merge the js files even if the request was xhr (if all other merging conditions are satisfied)
            'serverBaseUrl' => '', //can be optionally set here
            'mergeAbove' => 1, //def:1, only "more than this value" files will be merged,
            'curlTimeOut' => 10, //def:10, see curl_setopt() doc
            'curlConnectionTimeOut' => 10, //def:10, see curl_setopt() doc
            'appVersion' => 1.0 //if set, it will be appended to the urls of the merged scripts/css
        ),
        'authManager' => array(
            'class' => 'RDbAuthManager', // Provides support authorization item sorting.
            'defaultRoles' => array('Authenticated', 'Guest'), // see correspoing business rules, note: superusers always get checkAcess == true
        ),
        'bootstrap' => array(
            'class' => 'vendor.clevertech.yiibooster.src.components.Bootstrap',
            'coreCss' => false, // whether to register the Bootstrap core CSS (bootstrap.min.css), defaults to true
            'responsiveCss' => false, // whether to register the Bootstrap responsive CSS (bootstrap-responsive.min.css), default to false
            'plugins' => array(
// Optionally you can configure the "global" plugins (button, popover, tooltip and transition)
// To prevent a plugin from being loaded set it to false as demonstrated below
                'transition' => false, // disable CSS transitions
                'tooltip' => array(
                    'selector' => 'a.tooltip', // bind the plugin tooltip to anchor tags with the 'tooltip' class
                    'options' => array(
                        'placement' => 'bottom', // place the tooltips below instead
                    ),
                ),
            // If you need help with configuring the plugins, please refer to Bootstrap's own documentation:
// http://twitter.github.com/bootstrap/javascript.html
            ),
        ),
        'cache' => array(
            'class' => 'CDummyCache',
        ),
        'db' => array(
            'tablePrefix' => '',
            'connectionString' => 'mysql:host=localhost;dbname=p3',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ), 
        'errorHandler' => array(
// use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'image' => array(
            'class' => 'vendor.z_bodya.yii-image.CImageComponent',
            'driver' => 'GD',
            //'params'=>array('directory'=>'/usr/bin'),
        ),
        'returnUrl' => array(
            'class' => 'vendor.phundament.p3extensions.components.P3ReturnUrl',
        ),
        'langHandler' => array(
            'class' => 'vendor.phundament.p3extensions.components.P3LangHandler',
            'languages' => array('en', 'de', 'fr') // available languages 'ru', 'fr'
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
        'themeManager' => array(
            'class' => 'vendor.schmunk42.multi-theme.EMultiThemeManager',
            'basePath' => $applicationDirectory . '/themes',
            'baseUrl' => $baseUrl . '/themes',
            'rules' => array(
                '^p3pages/default/page' => 'frontend',
                '^p3(.*)' => 'backend',
                '^user/default/index' => 'frontend',
                '^user/login/(.*)' => 'frontend',
                '^user/profile/(.*)' => 'frontend',
                '^user/registration/(.*)' => 'frontend',
                '^user/recovery/(.*)' => 'frontend',
                '^user/activation/(.*)' => 'frontend',
                '^user/(.*)' => 'backend',
                '^rights/(.*)' => 'backend',
            )
        ),
        'urlManager' => array(
            'class' => 'vendor.phundament.p3extensions.components.P3LangUrlManager',
            'showScriptName' => true,
            'appendParams' => false, // in general more error resistant
            'urlFormat' => 'path', // use 'path', otherwise rules below won't work
            'rules' => array(
// disabling standard login page
                '<lang:[a-z]{2}>/site/login' => 'user/login',
                'site/login' => 'user/login',
                // convenience rules
                'admin' => 'p3admin',
                '<lang:[a-z]{2}>/pages/<view:\w+>' => 'site/page',
                // p3pages - SEO
                '<lang:[a-z]{2}>/<pageName:[a-zA-Z0-9-._]*>-<pageId:\d+>.html' => 'p3pages/default/page',
                // p3media - SEO
                '<lang:[a-z]{2}>/img/<preset:[a-zA-Z0-9-._]+>/<title:.+>_<id:\d+><extension:.[a-zA-Z0-9]{1,}+>' => 'p3media/file/image', // p3media images, TESTING: disable in case of problems
// Yii
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                // general language and route handling
                '<lang:[a-z]{2}>' => '',
                '<lang:[a-z]{2}>/<_c>' => '<_c>',
                '<lang:[a-z]{2}>/<_c>/<_a>' => '<_c>/<_a>',
                '<lang:[a-z]{2}>/<_m>/<_c>/<_a>' => '<_m>/<_c>/<_a>',
            ),
        ),
        'user' => array(
// enable cookie-based authentication
            'class' => 'RWebUser', // crisu83/yii-rights: Allows super users access implicitly.
            'behaviors' => array('vendor.schmunk42.web-user-behavior.WebUserBehavior'), // compatibility behavior for yii-user and yii-rights
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
        ),
        'widgetFactory' => array(
            'class' => 'CWidgetFactory',
            'enableSkin' => true,
            'widgets' => array(
                'TbEditableField' => array(
                    'mode' => 'inline',
                ),
            ),
        ),
        'mail' => array(
            'class' => 'vendor.jonah.mail.YiiMail',
            'viewPath' => 'app.themes.emails',
            'transportType' => 'php',
            'logging' => true,
            'dryRun' => false
        ),
        'ePdf' => array(
            'class' => 'vendor.bolares.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'vendor.mpdf.*', 
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf', // the literal class filename to be loaded from the vendors folder
                    'defaultParams' => array(// More info: http://mpdf1.com/manual/index.php?tid=184
                        'mode' => '', //  This parameter specifies the mode of the new document.
                        'format' => 'A4', // format A4, A5, ...
                        'default_font_size' => 10, // Sets the default document font size in points (pt)
                        'default_font' => 'Helvetica', // Sets the default font-family for the new document.
                        'mgl' => 15, // margin_left. Sets the page margins for the new document.
                        'mgr' => 15, // margin_right
                        'mgt' => 16, // margin_top
                        'mgb' => 16, // margin_bottom
                        'mgh' => 9, // margin_header
                        'mgf' => 9, // margin_footer
                        'orientation' => 'P', // landscape or portrait orientation
                    )
                ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
// using Yii::app()->params['paramName']
    'params' => array(
// this is used in contact page
        'adminEmail' => 'gnuheike@gmail.com',
        'defaultPageSize' => 20,
        // global Phundament 3 parameters
        'p3.backendTheme' => 'backend', // defaults to 'backend'
        'p3.fallbackLanguage' => 'en', // defaults to 'en'
        'ext.ckeditor.options' => array(
            'type' => 'fckeditor',
            'height' => 400,
            'filebrowserWindowWidth' => '990',
            'filebrowserWindowHeight' => '800',
            'resize_minWidth' => '150',
            /* Toolbar */
            'toolbar_Custom' => array(
                array('Templates', '-', 'Maximize', 'Source', 'ShowBlocks', '-', 'Undo', 'Redo', '-', 'PasteText', 'PasteFromWord'),
                array('JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'NumberedList', 'BulletedList', '-', 'BidiLtr', 'BidiRtl'),
                array('Table', 'Blockquote'),
                '/',
                array('Image', 'Flash', '-', 'Link', 'Unlink'),
                array('Bold', 'Italic', 'Underline', '-', 'UnorderedList', 'OrderedList', '-', 'RemoveFormat'),
                array('CreateDiv', 'Format', 'Styles')),
            'toolbar' => "Custom",
            /* Settings */
            'startupOutlineBlocks' => true,
            'pasteFromWordRemoveStyle' => true,
            'pasteFromWordKeepsStructure' => true,
            'templates_replaceContent' => false,
            'ignoreEmptyParagraph' => true,
            'autoParagraph' => true,
            'forcePasteAsPlainText' => true,
            'enterMode' => 3, // use <div>s per default, since they usually have no height or margin
            'shiftEnterMode' => 2,
            'fillEmptyBlocks' => false, // do not insert &nbsp; into empty blocks
            'contentsCss' => $baseUrl . '/themes/frontend/ckeditor/ckeditor.css',
            'bodyId' => 'ckeditor',
            'bodyClass' => 'ckeditor',
            /* Assets will be published with publishAsset() */
            'templates_files' => array($baseUrl . '/themes/frontend/ckeditor/cktemplates.js'),
            'stylesCombo_stylesSet' => 'my_styles:' . $baseUrl . '/themes/frontend/ckeditor/ckstyles.js',
            /* Standard-way to specify URLs - deprecated */
            /* 'filebrowserBrowseUrl' => '/p3media/ckeditor',
              'filebrowserImageBrowseUrl' => '/p3media/ckeditor/image',
              'filebrowserFlashBrowseUrl' => '/p3media/ckeditor/flash',
              'filebrowserUploadUrl' => $baseUrl . '/p3media/import/ckeditorUpload', */
            /* URLs will be parsed with createUrl() */
            'filebrowserBrowseCreateUrl' => array('/p3media/ckeditor'),
            'filebrowserImageBrowseCreateUrl' => array('/p3media/ckeditor/image'),
            'filebrowserFlashBrowseCreateUrl' => array('/p3media/ckeditor/flash'),
            'filebrowserUploadCreateUrl' => array('/p3media/import/ckeditorUpload'),
        ),
    ),
);


// also includes environment config file, eg. 'development' or 'production'
$localConfigFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'local.php';
if (is_file($localConfigFile)) {
    return CMap::mergeArray($mainConfig, require($localConfigFile));
} else {
    return $mainConfig;
}
