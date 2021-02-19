<?php

ob_start();
require_once dirname(dirname(dirname(__FILE__))) . '/config/config.inc.php';
require_once dirname(dirname(dirname(__FILE__))) . '/init.php';
require_once dirname(__FILE__) . '/pagopar.php';


$hash = pSQL($_GET['hash']);

/* $host = 'http://';
  if($_SERVER['SERVER_PROTOCOL'] != 'HTTP/1.1'){
  $host = 'https://';
  } */

//$url = $_SERVER['HTTP_REFERER'].'/index.php?fc=module&module=pagopar&controller=pedido&hash='.$hash;
$url = _PS_BASE_URL_ . __PS_BASE_URI__ . '/index.php?fc=module&module=pagopar&controller=pedido&hash=' . $hash;

header('Location: ' . $url);
exit();
