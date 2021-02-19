<?php

/**
 * @author Grupo M SA <desarrollo@pagopar.com>
 * @copyright Pagopar SA
 * */
ob_start();

session_start();

$_SESSION['pagopar_pasarela'] = null;
$_SESSION['pagopar_num_documento'] = null;
$_SESSION['pagopar_razon_social'] = null;
$_SESSION['pagopar_ruc'] = null;
$_SESSION['check_factura'] = null;

unset($_SESSION['pagopar_pasarela']);
unset($_SESSION['pagopar_num_documento']);
unset($_SESSION['pagopar_razon_social']);
unset($_SESSION['pagopar_ruc']);
unset($_SESSION['check_factura']);



$pasarela = empty($_POST['pasarela']) ? 'null' : $_POST['pasarela'];
$num_documento = empty($_POST['num_documento']) ? 'null' : $_POST['num_documento'];
$razon_social = empty($_POST['razon_social']) ? 'null' : $_POST['razon_social'];
$tipo_documento = empty($_POST['ruc']) ? 'null' : $_POST['ruc'];
$check_factura = empty($_POST['factura']) ? 'null' : $_POST['factura'];


$_SESSION['pagopar_pasarela'] = $pasarela;
$_SESSION['pagopar_num_documento'] = $num_documento;
$_SESSION['pagopar_razon_social'] = $razon_social;
$_SESSION['pagopar_ruc'] = $tipo_documento;
$_SESSION['check_factura'] = $check_factura;

echo 'ok';
