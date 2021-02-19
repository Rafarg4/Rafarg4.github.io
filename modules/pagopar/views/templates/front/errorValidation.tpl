{*
*
*}
<!doctype html>
<html lang="{$language.iso_code|escape:'htmlall':'UTF-8'}">

  <head>
    {block name='head'}
      {include file='_partials/head.tpl'}
    {/block}
  </head>

  <body id="{$page.page_name}" class="{$page.body_classes|classnames}">

    {hook h='displayAfterBodyOpeningTag'}

    <main>
      {block name='product_activation'}
        {include file='catalog/_partials/product-activation.tpl'}
      {/block}
      <header id="header">
        {block name='header'}
          {include file='_partials/header.tpl'}
        {/block}
      </header>
      {block name='notifications'}
        {include file='_partials/notifications.tpl'}
      {/block}
      <section id="wrapper">
        <div class="container">
          <div style="clear:both;"></div>
<div class="row">
<div id="center_column" class="center_column col-xs-12 col-sm-12">

{capture name=path}{l s='pagopar' mod='pagopar'}{/capture}
<h1 class="page-heading">
    {l s='Resumen de orden' mod='pagopar'}
</h1>
{assign var='current_step' value='payment'}

{if $payment_error ne ""}
	<p class="alert alert-warning">{l s='Los detalles del pago no son válidos, póngase en contacto con el administrador.' mod='pagopar'}</p>
{/if}
{if $nbProducts <= 0}
	<p class="alert alert-warning">{l s='Su cesta está vacía.' mod='pagopar'}</p>
{else}



<div id="errors"></div>

<form action="{$link->getModuleLink('pagopar', 'confirmation', [], true)|escape:'htmlall':'UTF-8'}" method="post" name="pagopar_form" id="pagopar_form">

<div class="box cheque-box">
	<h3 class="page-subheading">
		{l s='Todos los medios de pagos - Servicio ofrecido por Pagopar' mod='pagopar'}
	</h3>

	<p>
		<img src="{$this_path|escape:'htmlall':'UTF-8'}/views/img/logo.png" alt="{l s='pagopar' mod='pagopar'}" height="49" style="float:left; margin: 0px 10px 5px 0px;" />
		{l s='Has elegido pagar por pagopar.' mod='pagopar'}
		<br/><br />
		<br/>
	</p>
<p>
	<b>{l s='El monto total de su orden es: ' mod='pagopar'}
		<span id="amount" class="price">{$sign|escape:'htmlall':'UTF-8'} {$total|escape:'htmlall':'UTF-8'}</span></b>
</p>

<hr>
<fieldset>
	<div>
	<h3 class="page-subheading">{l s='Ingrese datos de facturación' mod='pagopar'}</h3>
		
		<div style="margin-left: 20px; margin-right: 70px;">
			<p>
		<b>{l s='Ocurrio un error: ' mod='pagopar'}
		<span id="amount" class="price">{$error}</span></b>
</p>
		</div>
	</div>
</fieldset>

	
<p>
	<b>{l s='Confirma tu pedido haciendo clic "Yo confirmo mi orden".' mod='pagopar'}</b>
</p>
 </div>
 <p id="cart_navigation" class="cart_navigation clearfix">
      <a href="{$link->getPageLink('order')|escape:'htmlall':'UTF-8'}" class="btn btn-primary pull-xs-left">
	   <i class="icon-chevron-left"></i>{l s='otros métodos de pago' mod='pagopar'}</a>
				<button type="submit" name="submit" value="{l s='Place my order' mod='pagopar'}" class="btn btn-primary pull-xs-right"/>
					<span>
						{l s='Yo confirmo mi orden' mod='pagopar'}<i class="icon-chevron-right right"></i>
					</span>
				</button>
</p>
  
  
  
  
  
  
</form>

</div>
{/if}
        </div>
      </section>

      <footer id="footer">
        {block name="footer"}
          {include file="_partials/footer.tpl"}
        {/block}
      </footer>

    </main>

    {block name='javascript_bottom'}
      {include file="_partials/javascript.tpl" javascript=$javascript.bottom}
    {/block}

    {hook h='displayBeforeBodyClosingTag'}

  </body>

</html>

