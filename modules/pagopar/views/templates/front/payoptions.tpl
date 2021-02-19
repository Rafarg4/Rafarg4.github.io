<fieldset>
	<div>
		<input type="hidden" id="url_recibir_ajax" value="{$url_recibir_ajax}">
		<input type="hidden" id="url_agregar_tarjeta" value="{$url_agregar_tarjeta}">
	<h3 class="page-subheading">{l s='Ingrese datos de facturación' mod='pagopar'}</h3>
		
		<div style="margin-left: 20px; margin-right: 70px;">
			<div class="form-group">
			    <label for="formGroupExampleInput">{l s='Ingrese Cédula o Documento' mod='pagopar'}</label>
			    <input type="text" required name="num_documento" value="" class="form-control" id="num_documento" placeholder="Ej. 4.123.434">
			 </div>
			 
			 <div class="form-group">
			 	<input type="checkbox" name="factura" id="factura" value="false"> Quiero facturar a mi nombre<br>
			 </div>
			 <div id="facturasDatos" >
				 <div class="form-group">
				    <label for="formGroupExampleInput">{l s='Ingrese Razón Social' mod='pagopar'}</label>
				    <input type="text" required name="razon_social" value="" class="form-control" id="razon_social" placeholder="Ej. Empresa SA">
				 </div>
				 
				 <div class="form-group">
				    <label for="formGroupExampleInput">{l s='Ingrese Ruc' mod='pagopar'}</label>
				    <input type="text" required name="ruc" value="" class="form-control" id="ruc" placeholder="Ej. 8009674592-2">
				 </div>
			 </div>
		</div>
	</div>
</fieldset>
<hr>
<div>

<fieldset>


      <h3 class="page-subheading">{l s='Seleccione Pasarela' mod='pagopar'}</h3>
		{if $contrato == true}
			<button clas="btn btn-primary center-block" data-toggle="modal" data-target="#myModal" type="button" name="" id="pagoparAddCard">Agregar tarjeta</button>
		{/if}
      <table>
		  {foreach $tarjetas as $t}
			  {assign var="imagen" value="{$t->url_logo}"}
			  {assign var="width" value="30"}
			  <tr>
				  <td>
					  <input id="opcrecurrente-{$t->alias_token}" type="radio" value="catastro-{$t->alias_token}" name="pasarela" /> <img alt="Yes" src="{$imagen}" width="{$width}" title="Yes" /> <strong>{$t->tarjeta_numero}</strong> - Pagos Recurrentes
				  </td>
			  </tr>
		  {/foreach}
      	{foreach $resultado as $r} 
			{if $compra > $r->monto_minimo or $compra == $r->monto_minimo}
				{assign var="imagen" value="https://cdn.pagopar.com/assets/images/plugins/woocommerce/tarjetas-credito.png"}
				<!-- If para mostrar valor de imagen -->
				{if $r->forma_pago eq 1 }
					{assign var="imagen" value="https://cdn.pagopar.com/assets/images/plugins/woocommerce/tarjetas-credito.png"}
					{assign var="width" value="47"}
				{else if $r->forma_pago eq 2}
					{assign var="imagen" value="https://cdn.pagopar.com/assets/images/pago-aquipago.png"}
					{assign var="width" value="47"}
				{else if $r->forma_pago eq 3}
					{assign var="imagen" value="https://cdn.pagopar.com/assets/images/pago-pagoexpress.png"}
					{assign var="width" value="47"}
				{else if $r->forma_pago eq 4}
					{assign var="imagen" value="https://cdn.pagopar.com/assets/images/pago-practipago.png"}
					{assign var="width" value="47"}
				{else if $r->forma_pago eq 9}
					{assign var="imagen" value="https://cdn.pagopar.com/assets/images/plugins/woocommerce/tarjetas-credito.png"}
					{assign var="width" value="47"}
				{else if $r->forma_pago eq 10}
					{assign var="imagen" value="https://cdn.pagopar.com/assets/images/pago-tigo-money.png"}
					{assign var="width" value="75"}
				{else if $r->forma_pago eq 12}
					{assign var="imagen" value="https://www.pagopar.com/assets/images/pago-billetera-personal.png"}
					{assign var="width" value="75"}
				{else if $r->forma_pago eq 13}
					{assign var="imagen" value="https://www.pagopar.com/assets/images/pago-infonet-pago-movil.png"}
					{assign var="width" value="75"}
				{else if $r->forma_pago eq 18}
					{assign var="imagen" value="https://cdn.pagopar.com/assets/images/metodos-pago/zimple.png"}
					{assign var="width" value="47"}
				{/if}
			  <tr>
	      		<td>
	      			<input type="radio" value="{$r->forma_pago}" id="pasarela" name="pasarela" /> <img alt="Yes" src="{$imagen}" width="{$width}" title="Yes" /> <strong>{$r->titulo}</strong> - {$r->descripcion}
	      		</td>
	      	 </tr>
      	 {/if}
		{/foreach}

      </table>
      
    </div>
<div class="modal" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content" style="    width: 605px;">
			<div class="modal-header">
				<span class="button" data-dismiss="modal" aria-label="Close">cancel</span>
				<h2 class="modal-heading">iFrame vPos</h2>
			</div>

			<div class="modal-body" style="height: 370px;">
				<div class="loader-1 center"><span></span></div>
				<div style="height: 130px; width: 100%; margin: auto" id="iframe-container"/>
			</div>
		</div>
	</div>
</div>
  </fieldset><br>

