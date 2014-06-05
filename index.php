<?php
/**
 * Created by PhpStorm.
 * User: victormanuel
 * Date: 03/06/14
 * Time: 04:05 AM
 */
require_once 'vendor/restler.php';
use Luracast\Restler\Restler;

$r = new Restler(true,true);
$r->addAPIClass('usuario');
$r->addAPIClass('Resources');
$r->handle();