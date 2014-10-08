<?php
// Use this file as local.php to override settings only on your local machine
//
// DO NOT COMMIT THIS FILE !!!
// include 'development' or 'production'
$environmentConfigFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'development.php';


$localConfig = array(
    'params' => array(
        'foo' => 'bar'
    ),
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=p3',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '753951',
            'charset' => 'utf8',
        ),
        'urlManager' => array(
            'showScriptName' => true,
        ),
        'mail' => array(
            'transportType' => 'smtp',
            'transportOptions' => array(
                'host' => 'smtp.gmail.com',
                'username' => '',
                'password' => '',
                'port' => '465',
                'encryption' => 'ssl'
            ),
            'logging' => true,
        ),
    )
);


if (is_file($environmentConfigFile)) {
    return CMap::mergeArray(require($environmentConfigFile), $localConfig);
} else {
    return $localConfig;
}
?>

?>
