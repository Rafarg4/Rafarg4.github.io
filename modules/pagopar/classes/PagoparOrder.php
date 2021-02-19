<?php 

 class PagoparOrder extends ObjectModel
 {
     public $id_pagopar;
     public $id_customer;
     public $id_cart;
     public $id_pasarela;
     public $hash;
     public $date_add;
     public $total_amount;
     
     public static $definition = array(
         'table' => 'pagopar_order',
         'primary' => 'id_pagopar',
         'multilang' => false,
         'fields' => array(
             'id_pagopar' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
             'id_customer' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
             'id_cart' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
             'id_pasarela' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
             'hash' => array('type' => self::TYPE_STRING,  'required' => true),
             'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate' ,'required' => true),
             'total_amount' => array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat', 'required' => true)
             
         )
     );
 }

?>