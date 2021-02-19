<?php
ini_set('display_errors', 'off');
error_reporting(0);
session_start();
class PagoparTarjetasModuleFrontController extends ModuleFrontController {

    public $ssl = true;
    public function initContent()
    {
        $tarjetas = [];
        $resultado = $this->curlListarTarjetas();
        if ($resultado->respuesta) {
            $tarjetas = $resultado->resultado;
        }
        $link = __FILE__;
        $url_catastro = Context::getContext()->link->getModuleLink(
            'pagopar',
            'catastro',
            array()
        );
        $this->context->smarty->assign('cards', $tarjetas);
        $this->context->smarty->assign('link', $link);
        $this->context->smarty->assign('url_agregar_tarjeta', $url_catastro);
        parent::initContent();
        $this->setTemplate('module:pagopar/views/templates/front/tarjetas.tpl');
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
}