<?php


require_once (_PS_ROOT_DIR_ . '/modules/pagopar/classes/PagoparOrder.php');
session_start();
class PagoparProcessModuleFrontController extends ModuleFrontController {

    public $ssl = true;

    public function postProcess() {
        $this->ajax = true;
        /**
         * @author Grupo M SA <desarrollo@pagopar.com>
         * @copyright Pagopar SA
         * */

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

        $pasarela = empty(Tools::getValue('pasarela')) ? 'null' : Tools::getValue('pasarela');
        $pp_forma_array = explode("-", $pasarela);
        $hash_tarjeta = "";
        if ($pp_forma_array[0] === "catastro") {
            $pasarela = 16;
            $hash_tarjeta = $pp_forma_array[1];
        }

        $num_documento = empty(Tools::getValue('num_documento')) ? 'null' : Tools::getValue('num_documento');
        $razon_social = empty(Tools::getValue('razon_social')) ? 'null' : Tools::getValue('razon_social');
        $tipo_documento = empty(Tools::getValue('ruc')) ? 'null' : Tools::getValue('ruc');
        $check_factura = empty(Tools::getValue('factura')) ? 'null' : Tools::getValue('factura');


        $_SESSION['pagopar_pasarela'] = $pasarela;
        $_SESSION['pagopar_num_documento'] = $num_documento;
        $_SESSION['pagopar_razon_social'] = $razon_social;
        $_SESSION['pagopar_ruc'] = $tipo_documento;
        $_SESSION['check_factura'] = $check_factura;
        $_SESSION['hash_tarjeta'] = $hash_tarjeta;

        echo 'ok';
    }
}