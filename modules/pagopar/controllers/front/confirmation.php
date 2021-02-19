<?php

/**
 * @author Grupo M SA <desarrollo@pagopar.com>
 * @copyright Pagopar SA
 * */
ini_set('display_errors', 'off');
error_reporting(0);

require_once (_PS_ROOT_DIR_ . '/modules/pagopar/classes/PagoparOrder.php');
session_start();

class PagoparConfirmationModuleFrontController extends ModuleFrontController {

    public function postProcess() {
        $this->ajax = true;
        $pasarela = empty($_SESSION['pagopar_pasarela']) ? 'null' : $_SESSION['pagopar_pasarela'];
        $numDocu = empty($_SESSION['pagopar_num_documento']) ? 'null' : $_SESSION['pagopar_num_documento'];
        $razonSocial = empty($_SESSION['pagopar_razon_social']) ? 'null' : $_SESSION['pagopar_razon_social'];
        $ruc = empty($_SESSION['pagopar_ruc']) ? 'null' : $_SESSION['pagopar_ruc'];
        $check_factura = empty($_SESSION['check_factura']) ? 'null' : $_SESSION['check_factura'];
        $cart = $this->context->cart;
        $id_cart = $cart->id;

        $_SESSION['pagopar_pasarela'] = null;
        $_SESSION['pagopar_num_documento'] = null;
        $_SESSION['pagopar_razon_social'] = null;
        $_SESSION['pagopar_ruc'] = null;

        unset($_SESSION['pagopar_pasarela']);
        unset($_SESSION['pagopar_num_documento']);
        unset($_SESSION['pagopar_razon_social']);
        unset($_SESSION['pagopar_ruc']);

        if ($numDocu == 'null') {
            $urlerror = $_SERVER['HTTP_REFERER'] . '&x=vacio';
            header('Location: ' . $urlerror);
            exit;
        }

        if ($check_factura == 'true') {
            if ($razonSocial == 'null' || $ruc == 'null') {
                $urlerror = $_SERVER['HTTP_REFERER'] . '&z=vacio';
                header('Location: ' . $urlerror);
                exit;
            }
        }



        $insert = array(
            'pasarela' => $pasarela,
            'id_cart' => $id_cart,
            'num_docu' => $numDocu,
            'ruc' => $ruc,
            'razon_social' => $razonSocial
        );
        Db::getInstance()->insert('pagopar_ajax', $insert);

        if (!empty($numDocu)) {

            $this->procesaDatos($pasarela, $numDocu, $razonSocial, $ruc);
            exit;
        }
    }

    public function guargarDatosAjax() {

    }

    //procesa datos para envio.
    public function procesaDatos($pasarela = null, $numDocu = null, $razonSocial = null, $ruc = null) {


        $cart = $this->context->cart;


        $order_status = (int) Configuration::get('PAGOPAR_PAYMENT_WAITING');
        $order_total = $cart->getOrderTotal(true, Cart::BOTH);

        # Creamos la orden a partir del carrito
        $this->module->validateOrder($cart->id, $order_status, $order_total, "Pagopar", null, array(), null, false, $cart->secure_key);

        $url_curl = 'https://api.pagopar.com/api/comercios/1.1/iniciar-transaccion';
        #$cart = $this->context->cart;
        $customer = $this->context->customer;
        $clave_publica = Configuration::get('PAGOPAR_CLAVE_PUBLICA');
        $clave_privada = Configuration::get('PAGOPAR_CLAVE_PRIVADA');
        $dias_maximo_pago = Configuration::get('PAGOPAR_DIAS_PAGO');
        $fecha = date_create('Y-m-d');
        $dias = "+ $dias_maximo_pago days";
        $mod_date = strtotime($dias);
        $fecha_max = date('Y-m-d H:m:s', $mod_date);
        $idPedido = "c-" . $cart->id;
        $precio = $cart->getOrderTotal(true);
        $token = sha1($clave_privada . $idPedido . $precio);
        $documento_comprador = $customer->id;
        $nombre = $customer->firstname . " " . $customer->lastname;
        $email = $customer->email;
        //$email = "";
        # Obtenemos nombre mas amigable con los items del carrito
        $products = Context::getContext()->cart->getProducts();
        $product_ids = array();
        $cantidadProductosCarrito = count($products);
        foreach ($products as $product) {
            $nombreCompra = trim($product['name']);
        }
        if ($cantidadProductosCarrito > 1) {
            if (($cantidadProductosCarrito - 1) === 1) {
                $itemPluralSingular = 'producto';
            } else {
                $itemPluralSingular = 'productos';
            }
            $nombreCompra = $nombreCompra . ' y ' . ($cantidadProductosCarrito - 1) . ' ' . $itemPluralSingular . ' más.';
        }

        $datosjson = '

            {
              "token": "' . $token . '",
              "comprador": {
                "ruc": "' . $ruc . '",
                "email": "' . $email . '",
                "ciudad": null,
                "nombre": "' . $nombre . '",
                "telefono": "",
                "direccion": "",
                "documento": "' . $numDocu . '",
                "coordenadas": "",
                "razon_social": "' . $razonSocial . '",
                "tipo_documento": "CI",
                "direccion_referencia": null
              },
              "public_key": "' . $clave_publica . '",
              "monto_total": ' . $precio . ',
              "tipo_pedido": "VENTA-COMERCIO",
              "compras_items": [
                {
                  "ciudad": "1",
                  "nombre": "' . $nombreCompra . '",
                  "cantidad": 1,
                  "categoria": "909",
                  "public_key": "' . $clave_publica . '",
                  "url_imagen": "",
                  "descripcion": "' . $nombreCompra . '",
                  "id_producto": "",
                  "precio_total": ' . $precio . ',
                  "vendedor_telefono": "",
                  "vendedor_direccion": "",
                  "vendedor_direccion_referencia": "",
                  "vendedor_direccion_coordenadas": ""
                }
              ],
              "fecha_maxima_pago": "' . $fecha_max . '",
              "id_pedido_comercio": "' . $idPedido . '",
              "descripcion_resumen": ""
            }

            ';
        //echo $datosjson;
        $resultado = $this->curl__($datosjson, $url_curl);

        if ($resultado->respuesta == true) {
            $insert = array(
                'id_customer' => $this->context->customer->id,
                'id_cart' => $this->context->cart->id,
                'id_pasarela' => $pasarela,
                'hash' => $resultado->resultado[0]->data,
                'date_add' => date('Y-m-d H:m:s'),
                'total_amount' => $this->context->cart->getOrderTotal(true)
            );
            Db::getInstance()->insert('pagopar_order', $insert);

            if (!empty($pasarela)) {
                if ($pasarela === 16) {
                    $hash_tarjeta = $_SESSION['hash_tarjeta'];
                    $pp_result = $this->pagoConcurrente($this->context->customer->id, $hash_tarjeta, $resultado->resultado[0]->data);
                    $_SESSION['hash_tarjeta'] = null;
                    header('Location: '.$this->context->link->getModuleLink("pagopar", 'pedido', array(), true).'?hash='.$resultado->resultado[0]->data);
                } else {
                    header('Location: https://www.pagopar.com/pagos/' . $resultado->resultado[0]->data . '?forma_pago=' . $pasarela);
                }
            } else {
                header('Location: https://www.pagopar.com/pagos/' . $resultado->resultado[0]->data);
            }

            exit();
        } else {
            $error = $resultado->resultado;
            //echo  Tools::displayError('Oops, algo paso mal: '.$error)."<br>";
            echo "<p><b>Oops, algo paso mal: " . $error . "</b></p>";
            //$this->display(__FILE__,'validation.tpl');
            echo "<a href='javascript:history.go(-2);'><input style='padding:10px;' type='button' value='Intentar mas tarde'></a>";
        }
    }

    function pagoConcurrente($id, $card, $hash) {
        $clave_publica = Configuration::get('PAGOPAR_CLAVE_PUBLICA');
        $clave_privada = Configuration::get('PAGOPAR_CLAVE_PRIVADA');
        $token = sha1($clave_privada."PAGO-RECURRENTE");
        $args = [
            'identificador' => $id,
            'token' => $token,
            'token_publico' => $clave_publica,
            'tarjeta' => $card,
            'hash_pedido' => $hash
        ];
        $response = $this->curl__(json_encode($args), "https://api.pagopar.com/api/pago-recurrente/2.0/pagar/");

        return $response;
    }

    //funcion curl para pedir datos.
    public function curl__($datos, $url) {

        try {
            $ch = curl_init();
            if (FALSE === $ch)
                throw new Exception('failed to initialize');

            $datosJson = $datos;

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

}
