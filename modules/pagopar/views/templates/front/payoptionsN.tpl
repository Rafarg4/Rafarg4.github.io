<fieldset>
	<div>
	<h3 class="page-subheading">{l s='Ingrese datos de facturación' mod='pagopar'}</h3>
		
		<div style="margin-left: 20px; margin-right: 70px;">
			<div class="form-group">
			    <label for="formGroupExampleInput">{l s='Ingrese Cédula o Documento' mod='pagopar'}</label>
			    <input type="text" required name="num_documento" value="" class="form-control" id="num_documento" placeholder="Ej. 4.123.434">
			 </div>
			 
			 <div class="form-group">
			 	<input type="checkbox" name="factura" id="factura" value="1"> Quiero facturar a mi nombre<br>
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