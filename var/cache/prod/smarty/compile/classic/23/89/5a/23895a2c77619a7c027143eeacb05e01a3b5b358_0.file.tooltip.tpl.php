<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-19 18:37:51
  from 'C:\xampp\htdocs\marcell\modules\welcome\views\templates\tooltip.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60302fafc2a433_03168947',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '23895a2c77619a7c027143eeacb05e01a3b5b358' => 
    array (
      0 => 'C:\\xampp\\htdocs\\marcell\\modules\\welcome\\views\\templates\\tooltip.tpl',
      1 => 1613750880,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60302fafc2a433_03168947 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="onboarding-tooltip">
  <div class="content"></div>
  <div class="onboarding-tooltipsteps">
    <div class="total"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Step','d'=>'Modules.Welcome.Admin'),$_smarty_tpl ) );?>
 <span class="count">1/5</span></div>
    <div class="bulls">
    </div>
  </div>
  <button class="btn btn-primary btn-xs onboarding-button-next"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Next','d'=>'Modules.Welcome.Admin'),$_smarty_tpl ) );?>
</button>
</div>
<?php }
}
