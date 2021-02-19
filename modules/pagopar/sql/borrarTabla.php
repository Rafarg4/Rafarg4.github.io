<?php 

$sql = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'pagopar_order`';

return Db::getInstance()->execute($sql);

?>