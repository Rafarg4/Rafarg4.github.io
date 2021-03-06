<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-19 18:37:55
  from 'C:\xampp\htdocs\marcell\modules\pagopar\views\templates\hook\footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60302fb3692b96_33001074',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bad2f2a5de625c70d7247907465e5bea1a75c034' => 
    array (
      0 => 'C:\\xampp\\htdocs\\marcell\\modules\\pagopar\\views\\templates\\hook\\footer.tpl',
      1 => 1613769803,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60302fb3692b96_33001074 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"><?php echo '</script'; ?>
>

<style>


    .footerPagopar {
        position: relative;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['color_fondo']->value, ENT_QUOTES, 'UTF-8');?>
;
        text-align: center;
        color: #FFF;border-top: 1px solid <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['color_borde']->value, ENT_QUOTES, 'UTF-8');?>
;
    }

    .footerPagopar .container {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .light .footerPagopar { background-color: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['color_fondo']->value, ENT_QUOTES, 'UTF-8');?>
; border-top: 1px solid <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['color_borde']->value, ENT_QUOTES, 'UTF-8');?>
; }

    .pagopar-methods {
        width: 100%;
        text-align: center;
    }

    .dark {
        padding-top: 240px;
    }

    .light {
        padding-top: 240px;
    }

    .pagopar-methods ul.list {
        display: block;
        list-style: none;
        margin: 0;
        padding: 0;
        vertical-align: top;
    }

    .pagopar-methods ul.list li {
        display: inline-block;
        list-style: none;
        margin: 0;
        padding: 0;
        vertical-align: top;
        margin-bottom: 5px;
    }

    .pagopar-methods ul.list li.method {
        -webkit-transition: all 200ms ease;
        -moz-transition: all 200ms ease;
        -o-transition: all 200ms ease;
        -ms-transition: all 200ms ease;
        transition: all 200ms ease;
        max-width: 46px;
        height: 28px;
        line-height: 28px;
        opacity: 1;
    }

    .pagopar-methods ul.list li.extra-method.hidden {
        display: none;
        opacity: 0;
    }

    .pagopar-methods ul.list li.more {
        width: 46px;
        height: 28px;
        background-color: #0f68a8;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
        line-height: 28px;
        text-align: center;
        font-size: 14px;
        cursor: pointer;
    }

    .pagopar-methods ul.list li.more::before { content: "+7"; }
    .pagopar-methods ul.list li.more.active { background-color: #0a4f81; }
    .pagopar-methods ul.list li.more.active::before { content: "-7"; }

    .pagopar-methods ul.list li.method img, .pagopar-methods ul.list li.logo-pagopar img {
        display: block;
        max-width: 100%;
        height: auto;
    }

    .pagopar-methods ul.list li.logo-pagopar {
        margin-left: 10px;
        max-width: 133px;
    }d

    @media (max-width: 767px) {
        .pagopar-methods ul.list li.logo-pagopar {
            display: block;
            margin-top: 8px;
            text-align: center;
            max-width: 100%;
        }
        .pagopar-methods ul.list li.logo-pagopar img { display: inline-block; width: 115px; }
    }

</style>

<div class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tema']->value, ENT_QUOTES, 'UTF-8');?>
" style="padding-top: 240px;">
    <div class="footerPagopar">
        <div class="container">
            <div class="pagopar-methods">
                <ul class="list">

                    <li class="method"><img title="Pagá con VISA a través de Pagopar" alt="Cobrar con Tarjeta de Crédito Visa en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/visa.png" ></li>

                    <li class="method"><img title="Pagá con Mastercard a través de Pagopar" alt="Cobrar con Tarjeta de Crédito Mastercard en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/mastercard.png" ></li>

                    <li class="method"><img title="Pagá con American Express a través de Pagopar" alt="Cobrar con Tarjeta de Crédito American Express en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/aex.png" ></li>

                    <li class="method extra-method hidden"><img title="Pagá con Diners a través de Pagopar" alt="Cobrar con Tarjeta de Crédito Diners en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/diners.png" ></li>

                    <li class="method extra-method hidden"><img title="Pagá con Credifielco a través de Pagopar" alt="Cobrar con Tarjeta de Crédito Credifielco en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/credifielco.png" ></li>

                    <li class="method extra-method hidden"><img title="Pagá con Única a través de Pagopar" alt="Cobrar con Tarjeta de Crédito Única en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/unica.png" ></li>

                    <li class="method extra-method hidden"><img title="Pagá con Credicard a través de Pagopar" alt="Cobrar con Tarjeta de Crédito Credicard en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/credicard.png" ></li>

                    <li class="method extra-method hidden"><img title="Pagá con Cabal a través de Pagopar" alt="Cobrar con Tarjeta de Crédito Cabal en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/cabal.png" ></li>

                    <li class="method extra-method hidden"><img title="Pagá con Panal a través de Pagopar" alt="Cobrar con Tarjeta de Crédito Panal en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/panal.png" ></li>

                    <li class="method extra-method hidden"><img title="Pagá con Pagopar Card a través de Pagopar" alt="Cobrar con Tarjeta de Crédito Pagopar Card en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/pagopar.png" ></li>

                    <li class="method"><img title="Pagá con Pagoexpress a través de Pagopar" alt="Cobrar con Pagoepxress en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/pagoexpress.png" ></li>

                    <li class="method"><img title="Pagá con Aquí Pago a través de Pagopar" alt="Cobrar con Aqui Pago en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/aquipago.png" ></li>

                    <li class="method"><img title="Pagá con Practipago a través de Pagopar" alt="Cobrar con Practipago en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/practipago.png" ></li>

                    <li class="method"><img title="Pagá con Tigo Money a través de Pagopar" alt="Cobrar con Tigo Money en Paraguay - Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/tigo-money.png" ></li>

                    <li class="method"><img title="Pagá con Billetera Personal a través de Pagopar" alt="Cobrar con Billetera Personal en Paraguay - Pagopar"  src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/billetera-personal.png" ></li>

                    <li class="method more"></li>

                    <li class="logo-pagopar">
                        <a target="_blank" href="https://www.pagopar.com/">
                            <img title="Vender y cobrar online fácil con Pagopar"  "Vender y cobrar online fácil con Pagopar" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urlBasePlugin']->value, ENT_QUOTES, 'UTF-8');?>
/procesado-por-pagopar.png" alt="Procesado por Pagopar">
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>    
    
    
    
    <?php }
}
