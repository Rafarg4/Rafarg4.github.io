<?php

/**
 * @author Grupo M SA <desarrollo@pagopar.com>
 * @copyright Pagopar SA
 * */

use PrestaShop\PrestaShop\Core\Payment\PaymentOption;
if (!defined('_PS_VERSION_')) {
    exit;
}
ini_set('display_errors', 'off');
error_reporting(0);

class Pagopar extends PaymentModule {

    public function __construct() {

        $this->name = 'pagopar';
        $this->tab = 'payments_gateways';
        $this->version = '1.0.0';
        $this->author = 'Pagopar - Grupo M SA';
        $this->bootstrap = true;
        $this->controllers = array('payment', 'confirmation', 'pedido', 'process', 'catastro', 'respuesta');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        parent::__construct();
        $this->displayName = $this->l('Pagopar');
        $this->description = $this->l('Ofrecé a tus clientes pagar con todos los medios de pago disponibles en el mercado de Paraguay a través de Pagopar. Podrán pagar con tarjeta de crédito (Procesadoras: Bancard, Procard), bocas de cobranzas (Aquipago, Practipago, Pagoexpress), billeteras electronicas (Tigo Money y BIlletera Personal) y muchos medios de pagos mas.');
    }

    public function install() {

        if (!parent::install() ||
            !Configuration::updateValue('PAGOPAR_CLAVE_PUBLICA', '') ||
            !Configuration::updateValue('PAGOPAR_CLAVE_PRIVADA', '') ||
            !Configuration::updateValue('PAGOPAR_DIAS_PAGO', '') ||
            !Configuration::updateValue('PAGOPAR_HORAS_PAGO', '') ||
            !Configuration::updateValue('PAGOPAR_URL_COMPRA', '') ||
            !Configuration::updateValue('PAGOPAR_URL_COMPRA_FINALIZADA', '') ||
            !Configuration::updateValue('PAGOPAR_PAGO_MINIMO', '') ||
            !Configuration::updateValue('PAGOPAR_MEDIOS_PAGO', '') ||
            !Configuration::updateValue('PAGOPAR_FOOTER_TEMA_BASE', 'dark') ||
            !Configuration::updateValue('PAGOPAR_COLOR_FONDO', '#333333') ||
            !Configuration::updateValue('PAGOPAR_COLOR_BORDE_SUPERIOR', '#333333') ||
            !$this->installDb() || !$this->installDbAjax() ||
            !$this->registerHook('paymentOptions') ||
            !$this->registerHook('displayAdminAfterHeader') ||
            !$this->registerHook('displayCustomerAccount') ||
            !$this->registerHook('footer') ||
            !$this->registerHook('paymentReturn') ||
            !$this->registerHook('header') ||
            !$this->registerHook('displayAdminOrder') ||
            !$this->registerHook('displayOrderDetail') ||
            !$this->registerHook('updateOrderStatus')
        )
            return false;

        $this->setStatus();

        return true;
    }

    public function hookDisplayCustomerAccount()
    {
        $datos_comercio = $this->traerDatosComercio();
        $output = "";
        if($datos_comercio->respuesta == true) {
            if ($datos_comercio->contrato_firmado === true) {
                $output = '<a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="addresses-link" href="'.Context::getContext()->link->getModuleLink(
                        'pagopar',
                        'tarjetas',
                        array()
                            ).'">
                      <span class="link-item">
                        <i class="material-icons">credit_card</i>
                        Mis tarjetas
                      </span>
                    </a>';
            }
        }
        echo $output;
    }

    public function hookDisplayAdminAfterHeader()
    {
        $datos_comercio = $this->traerDatosComercio();
        $deudas = [];
        $isStaging = false;
        if($datos_comercio->respuesta == true) {
            $isStaging = $datos_comercio->resultado->entorno === "Staging";
            $deudas = $datos_comercio->resultado->pedidos_pendientes;
        }
        $this->smarty->assign('isStaging', $isStaging);
        $this->smarty->assign('deudas_pagopar', $deudas);
        return $this->display(__FILE__, '/views/templates/admin/adminHeader.tpl');
    }

    public function traerDatosComercio() {

        $token = sha1(Configuration::get('PAGOPAR_CLAVE_PRIVADA') . "DATOS-COMERCIO");
        $publica = Configuration::get('PAGOPAR_CLAVE_PUBLICA');


        $array['token'] = $token;
        $array['public_key'] = $publica;

        $datosJson = json_encode($array);

        $url = "https://api.pagopar.com/api/comercios/2.0/datos-comercio/";
        try {
            $ch = curl_init();
            if (FALSE === $ch)
                throw new Exception('failed to initialize');

            // abrimos la sesión cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $datosJson);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($datosJson),
                    'X-Origin: Prestashop')
            );

            $content = curl_exec($ch);
            $resultadoArray = json_decode($content);

            if (FALSE === $content)
                throw new Exception(curl_error($ch), curl_errno($ch));

            // ...process $content now
        } catch (Exception $e) {

            trigger_error(sprintf(
                'Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
        }

        return $resultadoArray;
    }

    public function hookFooter($params) {

        $tema = 'dark';
        #$tema = 'light';


        $colorFondoDefectoTema = '#333333';
        $colorBordeDefectoTema = '#333333';

        $tema = Configuration::get('PAGOPAR_FOOTER_TEMA_BASE');
        $colorFondoDefectoTema = Configuration::get('PAGOPAR_COLOR_FONDO');
        $colorBordeDefectoTema = Configuration::get('PAGOPAR_COLOR_BORDE_SUPERIOR');
        #$pagopar_formas_pago = get_option('pagopar_formas_pago');


        # Seteamos valores por defecto
        if ($tema == '')
        {
            $tema = 'dark';
        }

        if ($colorFondoDefectoTema == '')
        {
            $colorFondoDefectoTema = '#333333';
        }

        if ($colorBordeDefectoTema == '')
        {
            $colorBordeDefectoTema = '#333333';
        }
        $urlBasePlugin = _PS_BASE_URL_.__PS_BASE_URI__. 'modules/pagopar/views/img/footer/' . $tema . '';
        $this->smarty->assign('tema', $tema);
        $this->smarty->assign('color_fondo', $colorFondoDefectoTema);
        $this->smarty->assign('color_borde', $colorBordeDefectoTema);
        $this->smarty->assign('urlBasePlugin', $urlBasePlugin);

        return $this->display(__file__, 'footer.tpl');
    }

    public function uninstall() {
        return true;
        /*
          include(dirname(__FILE__) . '/sql/borrarTabla.php');
          include(dirname(__FILE__) . '/sql/borrarTablaAjax.php');
          if (!parent::uninstall()
          //|| !Configuration::deleteByName('PAGOPAR_CLAVE_PUBLICA')
          //|| !Configuration::deleteByName('PAGOPAR_CLAVE_PRIVADA')
          || !Configuration::deleteByName('PAGOPAR_DIAS_PAGO') || !Configuration::deleteByName('PAGOPAR_HORAS_PAGO')
          //|| !Configuration::deleteByName('PAGOPAR_URL_COMPRA')
          //|| !Configuration::deleteByName('PAGOPAR_URL_COMPRA_FINALIZADA')
          || !Configuration::deleteByName('PAGOPAR_PAGO_MINIMO') || !Configuration::deleteByName('PAGOPAR_MEDIOS_PAGO'))
          return false;

          return true;
         */
    }

    public function setStatus() {
        $status = array();
        $status['send_email'] = false;
        $status['invoice'] = false;
        $status['unremovable'] = true;
        $status['paid'] = false;
        $status['template'] = '';
        if (!Configuration::get('PAGOPAR_PAYMENT_WAITING')) {
            $add_state = $this->addState($this->l('Pagopar pendiente de pago'), '#0404B4', $status);
            Configuration::updateValue('PAGOPAR_PAYMENT_WAITING', $add_state);
        }
        if (!Configuration::get('PAGOPAR_PAYMENT_COMPLETE')) {
            $status['send_email'] = true;
            $status['invoice'] = true;
            $status['unremovable'] = true;
            $status['paid'] = true;
            $status['template'] = 'payment';
            $add_sta_val = $this->addState($this->l('Pagopar pago completado'), '#088A29', $status);
            Configuration::updateValue('PAGOPAR_PAYMENT_COMPLETE', $add_sta_val);
        }
        if (!Configuration::get('PAGOPAR_ORDER_STATUS')) {
            Configuration::updateValue('PAGOPAR_ORDER_STATUS', 0);
        }
    }

    public function installDb() {


        return (Db::getInstance()->execute("
				CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "pagopar_order` (
				  `id_pagopar` int(11) NOT NULL AUTO_INCREMENT,
				  `id_customer` int(11) NOT NULL DEFAULT '0',
                  `id_cart` int(11) NOT NULL DEFAULT '0',
                  `id_pasarela` int(11) NOT NULL DEFAULT '0',
				  `hash` text NOT NULL,
				  `date_add` DATETIME NOT NULL,
                  `total_amount` decimal(20,6) NOT NULL DEFAULT '0',
                  `pagado` boolean not null default 0,
                  `forma_pago` varchar(30) not null default 'null',
                  `fecha_pago` DATETIME NOT NULL,
                  `fecha_maxima_pago` DATETIME NOT NULL,
                  `numero_pedido` varchar(30) not null default 'null',
                  `cancelado` boolean not null default 0,
                  `forma_pago_identificador` varchar(30) not null default 'null',
                  `token` varchar(100) not null default 'null',
				  PRIMARY KEY (`id_pagopar`)
				) ENGINE=" . _MYSQL_ENGINE_ . "  DEFAULT CHARSET= utf8;"));
    }

    public function installDbAjax() {
        return (Db::getInstance()->execute("
				CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "pagopar_ajax` (
				  `id_ajax` int(11) NOT NULL AUTO_INCREMENT,
				  `pasarela` int(11) NOT NULL DEFAULT '0',
                  `id_cart` int(11) NOT NULL DEFAULT '0',
                  `num_docu` varchar(30) not null default 'null',
                  `ruc` varchar(30) not null default 'null',
                  `razon_social` varchar(70) not null default 'null',
				  PRIMARY KEY (`id_ajax`)
				) ENGINE=" . _MYSQL_ENGINE_ . "  DEFAULT CHARSET= utf8;"));
    }

    public function getContent() {
        $url_agradecimiento = Configuration::get('PAGOPAR_URL_COMPRA');
        $url_respuesta = Configuration::get('PAGOPAR_URL_COMPRA_FINALIZADA');

        if (empty($url_agradecimiento) && empty($url_respuesta)) {
            $url_agradecimiento = Context::getContext()->link->getModuleLink(
                    'pagopar',
                    'pedido',
                    array()
                ) . '?hash=($hash)';
            $url_respuesta = Context::getContext()->link->getModuleLink(
                'pagopar',
                'respuesta',
                array()
            );
        }

        $this->smarty->assign('save', false);

        if (Tools::isSubmit('botonGuardar')) {

            $clavePublica = Tools::getValue('clave_publica');
            Configuration::updateValue('PAGOPAR_CLAVE_PUBLICA', $clavePublica);

            $clavePrivada = Tools::getValue('clave_privada');
            Configuration::updateValue('PAGOPAR_CLAVE_PRIVADA', $clavePrivada);

            $clavePrivada = Tools::getValue('dias_pago');
            Configuration::updateValue('PAGOPAR_DIAS_PAGO', $clavePrivada);

            $clavePrivada = Tools::getValue('horas_pago');
            Configuration::updateValue('PAGOPAR_HORAS_PAGO', $clavePrivada);

            $clavePrivada = Tools::getValue('url_agradecimiento');
            Configuration::updateValue('PAGOPAR_URL_COMPRA', $clavePrivada);

            $clavePrivada = Tools::getValue('url_finalizada');
            Configuration::updateValue('PAGOPAR_URL_COMPRA_FINALIZADA', $clavePrivada);

            $clavePrivada = Tools::getValue('pago_minimo');
            Configuration::updateValue('PAGOPAR_PAGO_MINIMO', $clavePrivada);

            $clavePrivada = Tools::getValue('medios_pago');
            Configuration::updateValue('PAGOPAR_MEDIOS_PAGO', $clavePrivada);

            $tema = Tools::getValue('tema');
            Configuration::updateValue('PAGOPAR_FOOTER_TEMA_BASE', $tema);

            $color_fondo = Tools::getValue('color_fondo');
            Configuration::updateValue('PAGOPAR_COLOR_FONDO', $color_fondo);

            $color_borde = Tools::getValue('color_borde');
            Configuration::updateValue('PAGOPAR_COLOR_BORDE_SUPERIOR', $color_borde);

            $this->smarty->assign('save', true);
        }

        $varCPublica = Configuration::get('PAGOPAR_CLAVE_PUBLICA');
        $this->smarty->assign('clavepublica', $varCPublica);

        $varCPrivada = Configuration::get('PAGOPAR_CLAVE_PRIVADA');
        $this->smarty->assign('claveprivada', $varCPrivada);

        $varCPrivada = Configuration::get('PAGOPAR_DIAS_PAGO');
        $this->smarty->assign('dias_pago', $varCPrivada);

        $varCPrivada = Configuration::get('PAGOPAR_HORAS_PAGO');
        $this->smarty->assign('horas_pago', $varCPrivada);

        $varCPrivada = $url_agradecimiento;
        $this->smarty->assign('url_agradecimiento', $varCPrivada);

        $varCPrivada = $url_respuesta;
        $this->smarty->assign('url_finalizada', $varCPrivada);

        $varCPrivada = Configuration::get('PAGOPAR_PAGO_MINIMO');
        $this->smarty->assign('pago_minimo', $varCPrivada);

        $varAmbiente = Configuration::get('PAGOPAR_MEDIOS_PAGO');
        $this->smarty->assign('medios_pago', $varAmbiente);

        $tema = Configuration::get('PAGOPAR_FOOTER_TEMA_BASE');
        $this->smarty->assign('tema', $tema);

        $color_fondo = Configuration::get('PAGOPAR_COLOR_FONDO');
        $this->smarty->assign('color_fondo', $color_fondo);

        $color_borde = Configuration::get('PAGOPAR_COLOR_BORDE_SUPERIOR');
        $this->smarty->assign('color_borde', $color_borde);


        $this->curlNotificarInstalacionComercio();

        $datos_comercio = $this->traerDatosComercio();
        $deudas = [];
        $isStaging = false;
        if($datos_comercio->respuesta == true) {
            $isStaging = $datos_comercio->resultado->entorno === "Staging";
            $deudas = $datos_comercio->resultado->pedidos_pendientes;
        }
        $this->smarty->assign('isStaging', $isStaging);
        $this->smarty->assign('deudas_pagopar', $deudas);

        return $this->display(__FILE__, 'configure.tpl');
        //return $this->displayConfigForm();
    }

    public function displayConfigForm() {
        $url_agradecimiento = Configuration::get('PAGOPAR_URL_COMPRA');
        $url_respuesta = Configuration::get('PAGOPAR_URL_COMPRA_FINALIZADA');


        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Configuración Básica'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Token público'),
                        'name' => 'clave_publica',
                        'size' => 50,
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Token privado'),
                        'name' => 'clave_privada',
                        'size' => 50,
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Periodo de dias de pago'),
                        'size' => 50,
                        'desc' => $this->l('Ej: 1 ó 2...3'),
                        'name' => 'dias_pago'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Periodo de horas de pago'),
                        'size' => 50,
                        'desc' => $this->l('Ej: 1 ó 2...3'),
                        'name' => 'horas_pago'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Url de agradecimiento de compra'),
                        'size' => 50,
                        'name' => 'url_agradecimiento',
                        'desc' => $url_agradecimiento,
                        'enable' => false
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Url de respuesta de pagopar compra finalizada'),
                        'size' => 50,
                        'name' => 'url_finalizada',
                        'desc' => $this->l($url_respuesta),
                        'enable' => false
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Mostrar todos los medios de pagos sin importar los montos minimos'),
                        'name' => 'pago_minimo',
                        'desc' => $this->l('El comercio asume los montos minimos de los medios de pagos previa autorizacion en el sistema de pagopar. Para mas explicacion contactar a: desarrollo@pagopar.com'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Si')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Mostrar todos los medios de pagos en esta tienda previa explicacion'),
                        'name' => 'medios_pago',
                        'desc' => $this->l('Se muestran todos los medios de pagos en el checkout de la tienda y se habilita el redireccionamiento automatico a los medios de pagos finales. Para solicitar esta opcion comuniquese con: desarrollo@pagopar.com'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Si')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                    'class' => 'btn btn-default pull-right'
                )
        ));

        if (empty($url_agradecimiento) && empty($url_respuesta)) {
            //$url_agradecimiento = _PS_BASE_URL_.'/modules/pagopar/pedido.php?hash=($hash)';
            //$url_respuesta = _PS_BASE_URL_.'/modules/pagopar/respuesta.php';

            $url_agradecimiento = Context::getContext()->link->getModuleLink(
                    'pagopar',
                    'pedido',
                    array()
                ) . '?hash=($hash)';
            $url_respuesta = Context::getContext()->link->getModuleLink(
                'pagopar',
                'respuesta',
                array()
            );

            $valor['url_agradecimiento'] = $url_agradecimiento;
            $valor['url_finalizada'] = $url_respuesta;
        } else {
            $valor['url_agradecimiento'] = Configuration::get('PAGOPAR_URL_COMPRA');
            $valor['url_finalizada'] = Configuration::get('PAGOPAR_URL_COMPRA_FINALIZADA');
        }

        //Horas de pago de las variables del form de configuracion
        $valor['clave_publica'] = Configuration::get('PAGOPAR_CLAVE_PUBLICA');
        $valor['clave_privada'] = Configuration::get('PAGOPAR_CLAVE_PRIVADA');
        $valor['dias_pago'] = Configuration::get('PAGOPAR_DIAS_PAGO');
        $valor['horas_pago'] = Configuration::get('PAGOPAR_HORAS_PAGO');
        $valor['pago_minimo'] = Configuration::get('PAGOPAR_PAGO_MINIMO');
        $valor['medios_pago'] = Configuration::get('PAGOPAR_MEDIOS_PAGO');

        $helper = new HelperForm();
        $helper->submit_action = 'botonGuardar';
        $helper->fields_value = $valor;

        return $helper->generateForm(array($fields_form));
    }

    public function hookHeader() {
        $this->context->controller->addJS($this->_path . 'views/js/pagopar.js');
        $this->context->controller->addJS($this->_path . 'views/js/catastro.js');
        $this->context->controller->addJS($this->_path . 'views/js/bancard-checkout-2.1.0.js');
        //$this->context->controller->addCSS($this->_path.'views/css/megadigitalmodulo.css');
    }

    public function hookPaymentOptions($params) {
        if (!$this->active) {
            return [];
        }

        if (!$this->checkCurrency($params['cart'])) {
            return [];
        }

        //traer medios de pagos
        $pagos = $this->curlFormaPago();
        $resultado = $pagos->resultado;
        $cart = $this->context->cart;
        $precio = $cart->getOrderTotal(true);
        $tarjetas = [];
        $url = Context::getContext()->link->getModuleLink(
            'pagopar',
            'process',
            array()
        );
        $url_catastro = Context::getContext()->link->getModuleLink(
            'pagopar',
            'catastro',
            array()
        );
        $datos_comercio = $this->traerDatosComercio();
        $contrato = false;
        if($datos_comercio->respuesta) {
            $contrato = $datos_comercio->contrato_firmado;
            if ($datos_comercio->contrato_firmado == true) {
                $tarjetas = $this->curlListarTarjetas();
            }
        }

        $this->smarty->assign('compra', $precio);
        $this->smarty->assign('tarjetas', $tarjetas->resultado);
        $this->smarty->assign('resultado', $resultado);
        $this->smarty->assign('contrato', $contrato);
        $this->smarty->assign('url_recibir_ajax', $url);
        $this->smarty->assign('url_agregar_tarjeta', $url_catastro);

        $pago_template = $this->display(__FILE__, 'payoptions.tpl');

        if (Configuration::get('PAGOPAR_MEDIOS_PAGO') == 'N') {

            $pago_template = $this->display(__FILE__, 'payoptionsN.tpl');
        }


        $info = $pago_template;
        //$info = $this->getTranslator()->trans("<p>Pago con tarjeta de cr&eacute;dito y d&eacute;bito</p>", array(), 'Modules.Pagopar');

        $newOption = new PaymentOption();

        $newOption->setModuleName($this->name)
                ->setCallToActionText($this->getTranslator()->trans('Pago online - Todos los medios de pagos - Servicio ofrecido por Pagopar', array(), 'Modules.Pagopar'))
                ->setAction($this->context->link->getModuleLink($this->name, 'confirmation', array(), true))
                ->setAdditionalInformation($pago_template);

        $payment_options = array();



        $payment_options = [
            $newOption,
        ];


        return $payment_options;
    }

    public function checkCurrency($cart)
    {
        $currency_order = new Currency($cart->id_currency);
        $currencies_module = $this->getCurrency($cart->id_currency);

        if (is_array($currencies_module)) {
            foreach ($currencies_module as $currency_module) {
                if ($currency_order->id == $currency_module['id_currency']) {
                    return true;
                }
            }
        }
        return false;
    }
    /* public function hookDisplayOrderConfirmation($param) {
      echo 'goetz';
      return "goetz";
      } */

    public function formatoFechaLatina($fecha) {
        ini_set('display_errors', 'off');
        error_reporting(0);

        $fechaPartes = explode(' ', $fecha);

        #Fecha
        $diaMesAnho = explode('-', $fechaPartes[0]);
        $diaMesAnho = $diaMesAnho[2] . '/' . $diaMesAnho[1] . '/' . $diaMesAnho[0];

        # Hora
        $horaMinuto = explode(':', $fechaPartes[1]);
        $horaMinuto = $horaMinuto[0] . ':' . $horaMinuto[1];

        $resultado['fecha'] = $diaMesAnho;
        $resultado['hora'] = $horaMinuto;
        return $resultado;
    }

    public function formatoEnteroString($monto) {
        return number_format($monto, 0, ',', '.');
    }

    public function hookPaymentReturn($params) {


        $explicacion = "Agradecemos su preferencia";

        $id_cart = pSQL($_GET['id_cart']);
        # Obtenemos el numero de CI
        $sql = "SELECT num_docu FROM " . _DB_PREFIX_ . "pagopar_ajax where id_cart=" . $id_cart;
        $documentoDefecto = (string) Db::getInstance()->getValue($sql);


        # Obtenemos el hash (Pagopar) del pedido
        $sqlOrdenPagopar = "SELECT hash FROM " . _DB_PREFIX_ . "pagopar_order where id_cart=" . $id_cart;
        $hashPedidoPagopar = (string) Db::getInstance()->getValue($sqlOrdenPagopar);


        $resultado = $this->curlDatosPedido($hashPedidoPagopar);
        $respuesta = json_encode($resultado);
        $respuesta = json_decode($respuesta, true);


        $output = '';
        if ($id_cart) {

            if (isset($hashPedidoPagopar)) {
                if ($respuesta['respuesta']) {
                    $datos = $respuesta['resultado'][0];

                    #$datos['forma_pago_identificador'] = 2; #simulamos pago con X medio
                    #$datos['pagado'] = false; #simulamos pago con X medio


                    $pagado = ($datos['pagado']) ? "Pedido pagado" : "Pendiente de pago";
                    $fechaMaximaPago = $this->formatoFechaLatina($datos['fecha_maxima_pago']);
                    $fechaPago = $this->formatoFechaLatina($datos['fecha_pago']);

                    if ($datos['pagado'] === true) {
                        $output .= "<h2>¡Gracias por su compra!</h2>";
                        $output .= "<p>Hemos recibido su pago y enviado un resumen de su pedido a su e-mail.</p>";
                    } else {
                        if (in_array($datos['forma_pago_identificador'], array(1, 9, 10, 12))) {
                            $output .= "<h2>¡Hubo un error al intentar pagar el pedido!</h2>";
                            if (in_array($datos['forma_pago_identificador'], array(1, 9))) {
                                $output .= "<ul><strong>¿Porqué no se realizó el pago? Algunos de los errores más comunes son:</strong>:";
                                $output .= "<li>La tarjeta no tiene fondos suficientes</li>";
                                $output .= "<li>La tarjeta no está habilitada para compras en Internet</li>";
                                $output .= "<li>Se ingresó incorrectamente el código CVV</li>";
                                $output .= "</ul>";
                                $output .= "<p><em class='consultarBanco'>Para saber más detalle sobre porqué no pudo realizarse el pago puede comunicarse con la entidad financiera emisora de su tarjeta</em><p>";
                            } elseif (in_array($datos['forma_pago_identificador'], array(10, 12))) {
                                $output .= "<ul><strong>¿Porqué no se realizó el pago? Algunos de los errores más comunes son:</strong>:";
                                $output .= "<li>No tiene fondos suficientes en su billetera</li>";
                                $output .= "<li>Se ingresó incorrectamente el PIN de transacción de su billetera</li>";
                                $output .= "</ul>";
                                $output .= "<p><em class='consultarBanco'>Para saber más detalle sobre porqué no pudo realizarse el pago puede comunicarse con su empresa de telefonía proveedora de su billetera.</em><p>";
                            }
                        } else {
                            $output .= "<h2>Hemos recibido su pedido de pago</h2>";
                        }

                        if ($datos['forma_pago_identificador'] == 7) {
                            $output .= "<p>Debe ingresar a su Homebanking, y buscar en el apartado 'Pago de Servicios' el comercio <strong>PAGOPAR</strong>, ingresando su cédula <strong>" . $this->formatoEnteroString($documentoDefecto) . "</strong> o número de pedido <strong>" . $this->formatoEnteroString($datos['numero_pedido']) . "</strong>.</p>";

                            $output .= "<ul><strong>Las entidades financieras habilitadas para el pago desde el Homebanking son:</strong>";
                            $output .= "<li><a target='_blank' href='https://www.visionbanco.com/' class='btn-link'>Visión Banco</a></li>";
                            $output .= "<li><a target='_blank' href='https://www.bancoatlas.com.py' class='btn-link'>Banco Atlas</a></li>";
                            $output .= "<li><a target='_blank' href='https://www.bancognb.com.py/' class='btn-link'>Banco GNB</a></li>";
                            $output .= "<li><a target='_blank' href='https://www.interfisa.com.py/' class='btn-link'>Banco Interfisa</a></li>";
                            $output .= "<li><a target='_blank' href='https://www.bancoitapua.com.py/' class='btn-link'>Banco Itapúa</a></li>";
                            $output .= "<li><a target='_blank' href='https://www.regional.com.py/' class='btn-link'>Banco Regional</a></li>";
                            $output .= "<li><a target='_blank' href='http://www.bancop.com.py/' class='btn-link'>Banco Bancop</a></li>";
                            $output .= "<li><a target='_blank' href='https://www.bancobasa.com.py/' class='btn-link'>Banco BASA</a></li>";
                            $output .= "<li><a target='_blank' href='http://www.cu.coop.py/' class='btn-link'>Cooperativa Universitaria</a></li>";
                            $output .= "</ul>";
                        } elseif (in_array($datos['forma_pago_identificador'], array(2, 3, 4))) {
                            $output .= '<ul>';
                            $output .='<li>  Eligió pagar con ' . $datos['forma_pago'] . ', recuerde que tiene hasta las ' . $fechaMaximaPago['hora'] . ' del ' . $fechaMaximaPago['fecha'] . ' para pagar.</li>';
                            $output .='<li>  Debe ir a boca de cobranza de ' . $datos['forma_pago'] . ', decir que quiere pagar el comercio <strong style="font-size:16px;color:#0f68a8">Pagopar</strong>, mencionando su cédula <strong>' . $this->formatoEnteroString($documentoDefecto) . '</strong> o número de pedido <strong>' . $this->formatoEnteroString($datos['numero_pedido']) . '</strong>.</li>';
                            $output .= '</ul>';

                            if ($datos['forma_pago_identificador'] == 2) {
                                $output .= '<div style="float:right;">';
                                $output .= '<a target="_blank" href="http://www.pronet.com.py/quepago/" class="btn-link">Ver bocas de cobranzas de ' . $datos['forma_pago'] . '</a>';
                                $output .= '</div>';
                                $output .= '<div style="clear:both;"></div>';
                            } elseif ($datos['forma_pago_identificador'] == 3) {
                                $output .= '<div style="float:right;">';
                                $output .= '<a target="_blank" href="http://www.pagoexpress.com.py:81/v4/bocas.php" class="btn-link">Ver bocas de cobranzas de ' . $datos['forma_pago'] . '</a>';
                                $output .= '</div>';
                                $output .= '<div style="clear:both;"></div>';
                            } elseif ($datos['forma_pago_identificador'] == 4) {
                                $output .= '<div style="float:right;">';
                                $output .= '<a target="_blank" href="https://www.documenta.com.py/bocas.php" class="btn-link">Ver bocas de cobranzas de ' . $datos['forma_pago'] . '</a>';
                                $output .= '</div>';
                                $output .= '<div style="clear:both;"></div>';
                            }
                        }
                    }




                    $output .= "<div class='cuadroResumen'>";
                    $output .= "<h4>Datos del pedido:</h4>";

                    $output .= "<p><strong>Número de pedido de pago:</strong> " . $this->formatoEnteroString($datos['numero_pedido']) . " " . "</p>";
                    $output .= "<p><strong>Forma de pago:</strong> " . $datos['forma_pago'] . "</p>";
                    $output .= "<p><strong>Estado del pago:</strong> " . $pagado . "</p>";
                    #$fecha = ($datos['fecha_pago']) ? $datos['fecha_pago'] : '';
                    if ($datos['pagado'] === true) {
                        $output .= "<p><strong>Fecha de pago:</strong> " . $fechaPago['fecha'] . ' ' . $fechaPago['hora'] . "</p>";
                    }
                    #$symbol = get_woocommerce_currency_symbol();
                    $output .= "<p><strong>Monto:</strong> " . $this->formatoEnteroString($datos['monto']) . " " . "</p>";
                    #$output .= "<p><strong>Fecha máxima de pago:</strong> " . $datos['fecha_maxima_pago'] . "</p>";
                    $output .= "</div>";
                }
                /* if ($respuesta['resultado']['cancelado'] === true) {
                  $output .= "<h3>Existe un problema con el pedido.<h3>";
                  $output .= "<p>Fallo del pedido, motivo: " . $respuesta['resultado'][0] . "</p>";

                  global $woocommerce;
                  $customer_order = new WC_Order((int) $order_id);
                  $customer_order->add_order_note('Fallo del pedido, Motivo: ' . $respuesta['resultado'][0] . '.');

                  $customer_order->update_status('cancelled');
                  } */
            } else {
                $output .= '<h3>Existe un error con el hash</h3>';
            }
        } else {
            $output .= '<h3>Existe un error con el hash</h3>';
        }

        $output .= '
<style>
.cuadroResumen {background: #fcfcfc;
    border: solid 1px #eee;
    padding: 15px;
    line-height: 14px;
    font-size: 15px;margin-top:15px;}

.consultarBanco {font-size:14px;}

</style>
<script>

function mostrarRespuesta(){

$("#content-hook_order_confirmation").after($("#content-hook_payment_return"));

}

setTimeout(mostrarRespuesta, 1000);

$(document).ready(function(){
});

</script>
        ';

        return $output;
    }

    public function hookDisplayAdminOrder() {
        return "Muestra en el administrador de orden";
    }

    public function hookDisplayOrderDetail() {
        return "Muestra en el detalle de ordenes";
    }

    public function hookUpdateOrderStatus($params) {
        return "Actualizar orden de estado";
    }

    private function addState($en, $color, $status) {
        $order_state = new OrderState();
        $order_state->name = array();
        foreach (Language::getLanguages() as $language) {
            $order_state->name[$language['id_lang']] = $en;
        }
        $order_state->name[$this->context->language->id] = $en;
        $order_state->send_email = $status['send_email'];
        $order_state->color = $color;
        $order_state->hidden = false;
        $order_state->unremovable = $status['unremovable'];
        $order_state->delivery = false;
        $order_state->logable = false;
        $order_state->invoice = $status['invoice'];
        $order_state->paid = $status['paid'];
        $order_state->template = $status['template'];
        if ($order_state->add()) {
            if (file_exists(dirname(__FILE__) . '/logo.gif')) {
                $dir_name = dirname(__FILE__) . '/../../img/os/';
                Tools::copy(dirname(__FILE__) . '/logo.gif', $dir_name . (int) $order_state->id . '.gif');
            }
        }
        return $order_state->id;
    }

    private function curlFormaPago() {

        $token = sha1(Configuration::get('PAGOPAR_CLAVE_PRIVADA') . "FORMA-PAGO");
        $publica = Configuration::get('PAGOPAR_CLAVE_PUBLICA');

        $datosJson = '
            {
                "token": "' . $token . '",
                "token_publico": "' . $publica . '"
            }';

        $url = "https://api.pagopar.com/api/forma-pago/1.1/traer/";
        try {
            $ch = curl_init();
            if (FALSE === $ch)
                throw new Exception('failed to initialize');

            // abrimos la sesión cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $datosJson);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($datosJson),
                'X-Origin: Prestashop')
            );

            $content = curl_exec($ch);
            $resultadoArray = json_decode($content);

            if (FALSE === $content)
                throw new Exception(curl_error($ch), curl_errno($ch));

            // ...process $content now
        } catch (Exception $e) {

            trigger_error(sprintf(
                            'Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
        }

        return $resultadoArray;
    }

    private function curlListarTarjetas() {
        $customer = $this->context->customer;
        $token = sha1(Configuration::get('PAGOPAR_CLAVE_PRIVADA') . "PAGO-RECURRENTE");
        $publica = Configuration::get('PAGOPAR_CLAVE_PUBLICA');

        $datos['token_publico'] = $publica;
        $datos['token'] = $token;
        $datos['identificador'] = $customer->id;
        $url = "https://api.pagopar.com/api/pago-recurrente/2.0/listar-tarjeta/";
        try {
            $ch = curl_init();
            if (FALSE === $ch)
                throw new Exception('failed to initialize');

            // abrimos la sesión cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "Cache-Control: no-cache",
                    "Content-Type: application/json"
                )
            );

            $content = curl_exec($ch);
            $resultadoArray = json_decode($content);

            if (FALSE === $content)
                throw new Exception(curl_error($ch), curl_errno($ch));

            // ...process $content now
        } catch (Exception $e) {

            trigger_error(sprintf(
                'Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
        }

        return $resultadoArray;
    }

    private function curlDatosPedido($hashPedido) {

        $token = sha1(Configuration::get('PAGOPAR_CLAVE_PRIVADA') . "CONSULTA");
        $publica = Configuration::get('PAGOPAR_CLAVE_PUBLICA');


        $array['token'] = $token;
        $array['token_publico'] = $publica;
        $array['hash_pedido'] = $hashPedido;

        $datosJson = json_encode($array);

        $url = "https://api.pagopar.com/api/pedidos/1.1/traer";
        try {
            $ch = curl_init();
            if (FALSE === $ch)
                throw new Exception('failed to initialize');

            // abrimos la sesión cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $datosJson);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($datosJson),
                'X-Origin: Prestashop')
            );

            $content = curl_exec($ch);
            $resultadoArray = json_decode($content);

            if (FALSE === $content)
                throw new Exception(curl_error($ch), curl_errno($ch));

            // ...process $content now
        } catch (Exception $e) {

            trigger_error(sprintf(
                            'Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
        }

        return $resultadoArray;
    }

    private function curlNotificarInstalacionComercio() {

        $array['plugin'] = 'PRESTASHOP';
        $array['version'] = $this->version;
        $array['path_instalacion'] = _PS_BASE_URL_ . __PS_BASE_URI__;
        $array['php_server_name'] = $_SERVER['SERVER_NAME'];

        $datosJson = json_encode($array);

        $url = "https://api.pagopar.com/api/instalacion-plugin/1.1/notificar";
        try {
            $ch = curl_init();
            if (FALSE === $ch)
                throw new Exception('failed to initialize');

            // abrimos la sesión cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $datosJson);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($datosJson),
                'X-Origin: Prestashop')
            );

            $content = curl_exec($ch);
            $resultadoArray = json_decode($content);

            if (FALSE === $content)
                throw new Exception(curl_error($ch), curl_errno($ch));

            // ...process $content now
        } catch (Exception $e) {

            trigger_error(sprintf(
                            'Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()), E_USER_ERROR);
        }

        return $resultadoArray;
    }

    /*
       */
}
