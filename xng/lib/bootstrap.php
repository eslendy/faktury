<?php
/*
error_reporting(E_ALL | E_STRICT);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
*/

// Register autoloader
require_once($_SERVER['DOCUMENT_ROOT'].'xng/lib/Faktury/Autoloader.php');
spl_autoload_register(array('\Faktury\Autoloader', 'autoload'));
\Faktury\Autoloader::$basePath = __DIR__;
\Faktury\Autoloader::$prefixes[] = 'Faktury';