<?php
ini_set('display_errors', 'off');
error_reporting(0);

require_once (_PS_ROOT_DIR_ . '/modules/pagopar/classes/PagoparOrder.php');

class  PagoparCatastroModuleFrontController extends ModuleFrontController {


    public function initContent() {
        $this->ajax = true;
        $action = Tools::getValue('action');
        $this->pagopar_agregar_cliente();
        switch($action) {
            case 1:
                $this->pagopar_agregar_tarjeta();
                break;
            case 2:
                $this->pagopar_borrar_tarjeta();
                break;
            case 3:
                $this->pagopar_confirmar_tarjeta();
            default:
                echo "ok";
                break;
        }
    }

    function pagopar_agregar_cliente()
    {
        $apiUrl = "https://api.pagopar.com/api/pago-recurrente/1.1/agregar-cliente/";
        $response = $this->pagoparCurl(null, null, $apiUrl, true);
        return $response;
    }

    function pagopar_borrar_tarjeta()
    {
        $hash = Tools::getValue('hash_tarjeta');
        $returnUrl = "/mi-cuenta/cards/";
        $apiUrl = "https://api.pagopar.com/api/pago-recurrente/2.0/eliminar-tarjeta/";
        $response = $this->pagoparCurl($returnUrl, $hash, $apiUrl, false);
        echo $response;
    }


    function pagopar_agregar_tarjeta()
    {
        $returnUrl = "/mi-cuenta/cards/";
        $apiUrl = "https://api.pagopar.com/api/pago-recurrente/1.1/agregar-tarjeta/";
        $response = $this->pagoparCurl($returnUrl, null, $apiUrl, false);
        echo $response;
    }

    function pagopar_confirmar_tarjeta()
    {
        $returnUrl = "/mi-cuenta/cards/";
        $apiUrl = "https://api.pagopar.com/api/pago-recurrente/1.1/confirmar-tarjeta/";
        $response = $this->pagoparCurl($returnUrl, null, $apiUrl, false);
        echo $response;
    }

    function pagopar_reversar_pago()
    {
        $returnUrl ="/mi-cuenta/cards/";
        $apiUrl = "https://api.pagopar.com/api/pedidos/1.1/reversar";
        $response = $this->pagoparCurl($returnUrl, null, $apiUrl, false, 'PEDIDO-REVERSAR', $_POST["hash_pedido"]);

        echo $response;
    }

    function pagoparCurl($returnUrl, $hash, $apiUrl, $isAddClient, $tokenString = 'PAGO-RECURRENTE', $hash_pedido = null, $traerDatos = false) {
        $customer = $this->context->customer;
        $clave_publica = Configuration::get('PAGOPAR_CLAVE_PUBLICA');
        $clave_privada = Configuration::get('PAGOPAR_CLAVE_PRIVADA');
        $datos['token_publico'] = $clave_publica;
        $datos['token'] = sha1($clave_privada . $tokenString);
        $datos['identificador'] = $customer->id;

        if($traerDatos)
            $datos['public_key'] = $clave_publica;

        if($hash_pedido != null)
            $datos['hash_pedido'] = $hash_pedido;

        if($returnUrl != null)
            $datos['url'] = $returnUrl;

        if($hash != null)
            $datos['tarjeta'] = $hash;

        if($isAddClient) {
            $datos['nombre_apellido'] = $customer->firstname. " ".$customer->lastname;
            $datos['email'] = $customer->email;
            $datos['celular'] = "0900000000";
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($datos) ,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Content-Type: application/json"
            ) ,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }
}