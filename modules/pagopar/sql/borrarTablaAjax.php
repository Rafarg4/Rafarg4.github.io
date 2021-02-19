<?php 
$sql2 = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'pagopar_ajax`';

return Db::getInstance()->execute($sql2);
?>