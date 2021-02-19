<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-19 18:37:52
  from 'C:\xampp\htdocs\marcell\modules\pagopar\views\templates\admin\adminHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60302fb0baa0b0_61872423',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b94f9fd106e3c11e4123d1519b4ed8755d6d82e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\marcell\\modules\\pagopar\\views\\templates\\admin\\adminHeader.tpl',
      1 => 1613769803,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60302fb0baa0b0_61872423 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['isStaging']->value == true) {?>
    <div class="module_confirmation conf confirmation alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        Pagopar - Tu entorno de desarrollo es Staging. Para solicitar el pase a producción debes de completar todo el circuito con un pedido.
    </div>
<?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['deudas_pagopar']->value, 'dp');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['dp']->value) {
?>
<div class="module_confirmation conf confirmation alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">x</button>
    Pagopar - Tiene una deuda pendiente de Gs. <?php echo $_smarty_tpl->tpl_vars['dp']->value->monto;?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['dp']->value->url;?>
">Ver pedido</a>
</div>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
