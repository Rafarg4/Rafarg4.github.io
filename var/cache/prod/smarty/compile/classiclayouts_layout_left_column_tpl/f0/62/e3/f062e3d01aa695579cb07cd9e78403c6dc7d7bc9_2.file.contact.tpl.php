<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-19 18:49:33
  from 'C:\xampp\htdocs\marcell\themes\classic\templates\contact.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6030326ddde095_02875771',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f062e3d01aa695579cb07cd9e78403c6dc7d7bc9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\marcell\\themes\\classic\\templates\\contact.tpl',
      1 => 1613750574,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6030326ddde095_02875771 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13064197836030326ddd5a58_02114093', 'page_header_container');
?>


<?php if ($_smarty_tpl->tpl_vars['layout']->value === 'layouts/layout-left-column.tpl') {?>
  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19987553206030326ddda476_08993140', "left_column");
?>

<?php } elseif ($_smarty_tpl->tpl_vars['layout']->value === 'layouts/layout-right-column.tpl') {?>
  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7265959976030326dddcd08_29372809', "right_column");
?>

<?php }?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7418611596030326dddd844_25664324', 'page_content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_header_container'} */
class Block_13064197836030326ddd5a58_02114093 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_header_container' => 
  array (
    0 => 'Block_13064197836030326ddd5a58_02114093',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_header_container'} */
/* {block "left_column"} */
class Block_19987553206030326ddda476_08993140 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'left_column' => 
  array (
    0 => 'Block_19987553206030326ddda476_08993140',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div id="left-column" class="col-xs-12 col-sm-4 col-md-3">
      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['widget'][0], array( array('name'=>"ps_contactinfo",'hook'=>'displayLeftColumn'),$_smarty_tpl ) );?>

    </div>
  <?php
}
}
/* {/block "left_column"} */
/* {block "right_column"} */
class Block_7265959976030326dddcd08_29372809 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'right_column' => 
  array (
    0 => 'Block_7265959976030326dddcd08_29372809',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div id="right-column" class="col-xs-12 col-sm-4 col-md-3">
      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['widget'][0], array( array('name'=>"ps_contactinfo",'hook'=>'displayRightColumn'),$_smarty_tpl ) );?>

    </div>
  <?php
}
}
/* {/block "right_column"} */
/* {block 'page_content'} */
class Block_7418611596030326dddd844_25664324 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_7418611596030326dddd844_25664324',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['widget'][0], array( array('name'=>"contactform"),$_smarty_tpl ) );?>

<?php
}
}
/* {/block 'page_content'} */
}
