<?php

/**
 * @author Grupo M SA <desarrollo@pagopar.com>
 * @copyright Pagopar SA
 * */
class PagoparPaymentModuleFrontController extends ModuleFrontController {

    public $ssl = true;

    public function initContent() {
        $this->ajax = true;
        $this->display_column_left = false;
        parent::initContent();

        $cart = $this->context->cart;
        $months = array(
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'May',
            '06' => 'Jun',
            '07' => 'Jly',
            '08' => 'Aug',
            '09' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec'
        );
        $current_year = date('Y');
        $last_year = $current_year + 15;
        $years = array();
        for ($i = $current_year; $i <= $last_year; $i++) {
            $years[$i] = $i;
        }
        $customer = $this->context->customer;
        if (Tools::getValue('res') == 'e') {
            $payment_error = 'Metodos de pago no validos, contacte con el administrador';
        } else {
            $payment_error = '';
        }
        $Currency = new Currency($cart->id_currency);
        $curr_sign = $Currency->getSign();
        $this->context->smarty->assign(array(
            'tpl_dir' => _PS_THEME_DIR_,
            'months' => $months,
            'sign' => $curr_sign,
            'years' => $years,
            'payment_error' => $payment_error,
            'id_lang' => Tools::getValue('id_lang'),
            'firstname' => $customer->firstname,
            'lastname' => $customer->lastname,
            'nbProducts' => $cart->nbProducts(),
            'cust_currency' => $cart->id_currency,
            'currencies' => $this->module->getCurrency((int) $cart->id_currency),
            'total' => $cart->getOrderTotal(true),
            'this_path' => $this->module->getPathUri(),
            'this_path_bw' => $this->module->getPathUri(),
            'this_path_ssl' => Tools::getShopDomainSsl(true, true) . __PS_BASE_URI__ . 'modules/' . $this->module->name . '/'
        ));
        if (Configuration::get('PAGOPAR_MEDIOS_PAGO') == 'N') {
            $this->setTemplate('module:pagopar/views/templates/front/validationN.tpl');
        } else {
            $this->setTemplate('module:pagopar/views/templates/front/validation.tpl');
        }
    }

}
