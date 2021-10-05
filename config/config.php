<?php

/**
 * Require de l'autoload de composer
 * équivaut à : require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
 * équivaut à : require_once "C:\\dossier\blog\config\..\vendor\autoload.php";
 */
require_once implode(DIRECTORY_SEPARATOR, [__DIR__, "..", "vendor", "autoload.php"]);

/**
 * Définition d'une constante pour la racine du projet
 */
define('ROOT', dirname(__DIR__));

/**
 * Définition d'une constante pour le dossier des vues
 */
define('TEMPLATES', implode(DIRECTORY_SEPARATOR, [ROOT, "views"]));

/**
 * Définition d'une constante pour le fichier de configuration de la base de données
 */
define("MYSQL_FILE_PATH", implode(DIRECTORY_SEPARATOR, [ROOT, 'config', 'mysql.ini']));

/**
 * Définition d'une constante pour la base de données utilisée
 */
define('RDBMS', "mysql");

