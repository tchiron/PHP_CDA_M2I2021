<?php

// require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

use core\Database;

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, "..", "vendor", "autoload.php"]);
// require_once "C:\\dossier\blog\config\..\vendor\autoload.php";

define('ROOT', dirname(__DIR__));
define('TEMPLATES', implode(DIRECTORY_SEPARATOR, [ROOT, "views"]));
define("MYSQL_FILE_PATH", implode(DIRECTORY_SEPARATOR, [ROOT, 'config', 'mysql.ini']));

Database::getInstance()->setDatabase('mysql', MYSQL_FILE_PATH)->init([PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
