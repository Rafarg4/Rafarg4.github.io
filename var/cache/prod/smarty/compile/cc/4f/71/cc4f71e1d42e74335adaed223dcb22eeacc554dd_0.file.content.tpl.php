<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-19 18:37:50
  from 'C:\xampp\htdocs\marcell\admin835e9aaqw\themes\default\template\content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60302fae2d3001_28353459',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc4f71e1d42e74335adaed223dcb22eeacc554dd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\marcell\\admin835e9aaqw\\themes\\default\\template\\content.tpl',
      1 => 1613750794,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60302fae2d3001_28353459 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="ajax_confirmation" class="alert alert-success hide"></div>
<div id="ajaxBox" style="display:none"></div>

<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div>
<?php }
}
