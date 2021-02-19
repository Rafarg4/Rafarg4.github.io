<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-19 18:37:41
  from 'C:\xampp\htdocs\marcell\admin835e9aaqw\themes\new-theme\template\components\layout\confirmation_messages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60302fa5e805b2_44859476',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fecaba4962707604eff16dae95f1df2ec8910db3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\marcell\\admin835e9aaqw\\themes\\new-theme\\template\\components\\layout\\confirmation_messages.tpl',
      1 => 1613750800,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60302fa5e805b2_44859476 (Smarty_Internal_Template $_smarty_tpl) {
if (isset($_smarty_tpl->tpl_vars['confirmations']->value) && count($_smarty_tpl->tpl_vars['confirmations']->value) && $_smarty_tpl->tpl_vars['confirmations']->value) {?>
  <div class="bootstrap">
    <div class="alert alert-success" style="display:block;">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['confirmations']->value, 'conf');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['conf']->value) {
?>
        <?php echo $_smarty_tpl->tpl_vars['conf']->value;?>

      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
  </div>
<?php }
}
}
