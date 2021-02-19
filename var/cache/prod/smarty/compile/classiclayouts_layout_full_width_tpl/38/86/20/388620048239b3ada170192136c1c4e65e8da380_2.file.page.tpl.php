<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-19 18:38:03
  from 'C:\xampp\htdocs\marcell\themes\classic\templates\page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60302fbbe1c7d5_33458222',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '388620048239b3ada170192136c1c4e65e8da380' => 
    array (
      0 => 'C:\\xampp\\htdocs\\marcell\\themes\\classic\\templates\\page.tpl',
      1 => 1613750573,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60302fbbe1c7d5_33458222 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13536848560302fbbe17a62_42555325', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'page_title'} */
class Block_74201779960302fbbe18283_03882449 extends Smarty_Internal_Block
{
public $callsChild = 'true';
public $hide = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <header class="page-header">
          <h1><?php 
$_smarty_tpl->inheritance->callChild($_smarty_tpl, $this);
?>
</h1>
        </header>
      <?php
}
}
/* {/block 'page_title'} */
/* {block 'page_header_container'} */
class Block_158758632060302fbbe17e25_57349302 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_74201779960302fbbe18283_03882449', 'page_title', $this->tplIndex);
?>

    <?php
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content_top'} */
class Block_151708945460302fbbe1af54_52564336 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_177633417060302fbbe1b4c3_38154517 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Page content -->
        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_175968822260302fbbe1abd4_74741440 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-content card card-block">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_151708945460302fbbe1af54_52564336', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_177633417060302fbbe1b4c3_38154517', 'page_content', $this->tplIndex);
?>

      </section>
    <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_footer'} */
class Block_43959632660302fbbe1bf28_77603892 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <!-- Footer content -->
        <?php
}
}
/* {/block 'page_footer'} */
/* {block 'page_footer_container'} */
class Block_134910866060302fbbe1bc12_48178848 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <footer class="page-footer">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_43959632660302fbbe1bf28_77603892', 'page_footer', $this->tplIndex);
?>

      </footer>
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_13536848560302fbbe17a62_42555325 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_13536848560302fbbe17a62_42555325',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_158758632060302fbbe17e25_57349302',
  ),
  'page_title' => 
  array (
    0 => 'Block_74201779960302fbbe18283_03882449',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_175968822260302fbbe1abd4_74741440',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_151708945460302fbbe1af54_52564336',
  ),
  'page_content' => 
  array (
    0 => 'Block_177633417060302fbbe1b4c3_38154517',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_134910866060302fbbe1bc12_48178848',
  ),
  'page_footer' => 
  array (
    0 => 'Block_43959632660302fbbe1bf28_77603892',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main">

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_158758632060302fbbe17e25_57349302', 'page_header_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_175968822260302fbbe1abd4_74741440', 'page_content_container', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_134910866060302fbbe1bc12_48178848', 'page_footer_container', $this->tplIndex);
?>


  </section>

<?php
}
}
/* {/block 'content'} */
}
