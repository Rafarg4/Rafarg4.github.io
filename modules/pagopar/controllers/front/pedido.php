<?php

/**
 * 2015-2020 PrestaShop
 *
 */
class PagoparPedidoModuleFrontController extends ModuleFrontController {

    public function postProcess() {
        $this->ajax = true;
        $this->display_column_left = false;
        $this->display_column_right = false;
        $hash = Tools::getValue('hash');
        $sql = "SELECT id_cart FROM " . _DB_PREFIX_ . "pagopar_order where hash='$hash'";
        $id_cart = Db::getInstance()->getValue($sql);


        //copiado de pago contra entrega
        if ($this->context->cart->id_customer == 0 || $this->context->cart->id_address_delivery == 0 || $this->context->cart->id_address_invoice == 0 || !$this->module->active) {
            Tools::redirectLink(__PS_BASE_URI__ . 'order.php?step=1');
        }

        // Check that this payment option is still available in case the customer changed his address just before the end of the checkout process
        $authorized = false;
        foreach (Module::getPaymentModules() as $module) {
            if ($module['name'] == 'pagopar') {
                $authorized = true;
                break;
            }
        }


        if (!$authorized) {
            die(Tools::displayError('This payment method is not available.'));
        }

        $customer = new Customer($this->context->cart->id_customer);
        if (!Validate::isLoadedObject($customer)) {
            Tools::redirectLink(__PS_BASE_URI__ . 'order.php?step=1');
        }

        $customer = new Customer((int) $this->context->cart->id_customer);


        $sqlOrdenPagopar = "SELECT id_customer, id_cart FROM " . _DB_PREFIX_ . "pagopar_order where hash='" . pSQL($_GET['hash']) . "'";
        $sqlOrdenPagopar = "SELECT po.id_customer, po.id_cart, o.id_order FROM " . _DB_PREFIX_ . "pagopar_order po
        left join " . _DB_PREFIX_ . "orders o
        on po.id_cart= o.id_cart
        where hash='" . pSQL($_GET['hash']) . "'";


        $datos = Db::getInstance()->executeS($sqlOrdenPagopar);
        $datos = $datos[0];

        Tools::redirectLink(__PS_BASE_URI__ . 'order-confirmation.php?key=' . $customer->secure_key . '&id_cart=' . (int) $datos['id_cart'] . '&id_module=' . (int) $this->module->id . '&id_order=' . (int) $datos['id_order']);
    }

}
