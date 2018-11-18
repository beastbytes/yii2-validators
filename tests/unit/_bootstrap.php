<?php
/**
 * Bootstrap for all test suites
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2016 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 */

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

defined('VENDOR_PATH') or define('VENDOR_PATH', '../..');
defined('YII_BASE_PATH') or define('YII_BASE_PATH', VENDOR_PATH . '/yiisoft/yii2');

echo realpath(VENDOR_PATH);
require_once VENDOR_PATH . '/autoload.php';
require_once YII_BASE_PATH . '/Yii.php';
