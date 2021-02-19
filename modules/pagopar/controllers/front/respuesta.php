<?php
/**
 * @author Grupo M SA <desarrollo@pagopar.com>
 * @copyright Pagopar SA
 * */

ini_set('display_errors', 'on');
error_reporting(E_ALL);

ob_start();
require_once (_PS_ROOT_DIR_ . '/config/config.inc.php');
require_once (_PS_ROOT_DIR_ . '/init.php');
require_once (_PS_ROOT_DIR_ . '/modules/pagopar/pagopar.php');

class PagoparRespuestaModuleFrontController extends ModuleFrontController {
    public function initContent() {
        $this->ajax = true;
        $pagopar = new Pagopar();

        $json = Tools::file_get_contents('php://input');
        $data = Tools::jsonDecode($json);

//---mostrar respuesta automaticamente, sin necesidad de procesarla nuevamente.
        $arrayRespuesta = $data->resultado;
        $variable = array($arrayRespuesta[0]);
        $jsonrespuesta = json_encode($variable);


        if ($data) {
            $pagado = (pSQL($data->resultado[0]->pagado)) ? 1 : 0;
            $forma_pago = pSQL($data->resultado[0]->forma_pago);
            $fecha_pago = pSQL($data->resultado[0]->fecha_pago);
            $fecha_maxima_pago = pSQL($data->resultado[0]->fecha_maxima_pago);
            $hash_pedido = pSQL($data->resultado[0]->hash_pedido);
            $monto = pSQL($data->resultado[0]->monto);
            $numero_pedido = pSQL($data->resultado[0]->numero_pedido);
            $cancelado = (pSQL($data->resultado[0]->cancelado)) ? 1 : 0;
            $forma_pago_identificador = pSQL($data->resultado[0]->forma_pago_identificador);
            $token = pSQL($data->resultado[0]->token);

            # Si coinciden los token, esta validación es extrictamente obligatoria para evitar el uso malisioso de este endpoint
            if (sha1(Configuration::get('PAGOPAR_CLAVE_PRIVADA') . $hash_pedido) === $token) {
                $sql = "UPDATE " . _DB_PREFIX_ . "pagopar_order
            SET
            pagado = $pagado,
            forma_pago = '$forma_pago',
            fecha_pago = '$fecha_pago',
            fecha_maxima_pago = '$fecha_maxima_pago',
            numero_pedido = '$numero_pedido',
            cancelado = $cancelado,
            forma_pago_identificador = '$forma_pago_identificador',
            token = '$token'
            WHERE hash = '$hash_pedido';";

                Db::getInstance()->execute($sql);


                $sql_id = "SELECT po.id_cart, po.total_amount, o.id_order FROM " . _DB_PREFIX_ . "pagopar_order po join " . _DB_PREFIX_ . "orders o on po.id_cart = o.id_cart where po.hash='$hash_pedido'";
                $row = Db::getInstance()->getRow($sql_id);

                //para actualizar la orden
                $objOrder = new Order($row['id_order']); //order with id=1
                $history = new OrderHistory();
                $json = '';

                if ($pagado == 1) {
                    #$pagopar_complete = Configuration::get('PAGOPAR_PAYMENT_COMPLETE');
                    #$history->changeIdOrderState($pagopar_complete, (int) ($objOrder->id));
                    #$nuevoEstado = Configuration::get('PAGOPAR_PAYMENT_COMPLETE');
                    $nuevoEstado = 2;
                    $history->id_order = (int) ($objOrder->id);
                    #$history->id_order_state = (int) ($nuevoEstado);
                    $history->changeIdOrderState((int) ($nuevoEstado), $objOrder);
                    $history->add(true);
                } elseif ($cancelado == 1) {
                    #$history->changeIdOrderState('6', (int) ($objOrder->id));
                    $nuevoEstado = 6;
                    $history->id_order = (int) ($objOrder->id);
                    #$history->id_order_state = (int) ($nuevoEstado);
                    $history->changeIdOrderState((int) ($nuevoEstado), $objOrder);
                    $history->add(true);
                } elseif ($pagado == 0) {
                    #$pagopar_waiting = Configuration::get('PAGOPAR_PAYMENT_WAITING');
                    #$history->changeIdOrderState($pagopar_waiting, (int) ($objOrder->id));
                    $nuevoEstado = Configuration::get('PAGOPAR_PAYMENT_WAITING');
                    $history->id_order = (int) ($objOrder->id);
                    #$history->id_order_state = (int) ($nuevoEstado);
                    $history->changeIdOrderState((int) ($nuevoEstado), $objOrder);
                    $history->add(true);
                }



                echo $jsonrespuesta;
            } else {
                echo 'Token no coincide';
            }
        } else {
            echo 'No se han enviado datos';
        }
    }
}