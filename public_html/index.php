<?php

define('DS', DIRECTORY_SEPARATOR);
$autoload = realpath( dirname(__FILE__) . '/../vendor/autoload.php' );
require_once( $autoload );

use System\Core\Environment;
use System\Core\Route;
use System\Core\Xarvis;

Environment::prepare();

$xarvis = new Xarvis( new Route() );
$xarvis->layers();
$xarvis->prepare();
$xarvis->attend();
