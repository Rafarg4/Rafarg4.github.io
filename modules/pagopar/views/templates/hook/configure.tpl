{if $save}
  <div class="bootstrap">
    <div class="module_confirmation conf confirmation alert alert-success">
      <button type="button" class="close" data-dismiss="alert">x</button>
      {l s='Datos guardados correctamente' mod='pagopar'}
    </div>
  </div>
{/if}

{if $isStaging == true}
  <div class="module_confirmation conf confirmation alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">x</button>
    Pagopar - Tu entorno de desarrollo es Staging. Para solicitar el pase a producción debes de completar todo el circuito con un pedido.
  </div>
{/if}

{foreach $deudas_pagopar as $dp}
  <div class="module_confirmation conf confirmation alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">x</button>
    Pagopar - Tiene una deuda pendiente de Gs. {$dp->monto} <a href="{$dp->url}">Ver pedido</a>
  </div>
{/foreach}
<div class="alert alert-info">
    <img src="https://cdn.pagopar.com/assets/images/logo-pagopar.png" style="float:left; margin-right:15px;" height="33">
    <p><strong>Gracias por instalar <a href="https://www.pagopar.com/" target="_blank">Pagopar</a>.</strong></p>
    <p>¿Necesita ayuda para configurar el modulo de Pagopar? Podés comunicarte al (021)326-3966 o a soporte@pagopar.com y lo configuramos por vos.</p>
</div>

<form action="" method="post" style="padding:30px; padding-top:10px;">
  <div class="form-group">
    <label for="formGroupExampleInput">{l s='Token público' mod='pagopar'}</label>
    <input type="text" required name="clave_publica" value="{$clavepublica}" class="form-control" id="formGroupExampleInput" placeholder="Ingrese token Pública">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">{l s='Token privado' mod='pagopar'}</label>
    <input type="text" required name="clave_privada" value="{$claveprivada}" class="form-control" id="formGroupExampleInput" placeholder="Ingrese token Privada">
  </div>
  
  <div class="form-group">
    <label for="formGroupExampleInput">{l s='Período de días de pago' mod='pagopar'}</label>
    <input type="text" name="dias_pago" value="{$dias_pago}" class="form-control" id="formGroupExampleInput" placeholder="Ej: 1 ó 2...3">
  </div>
  
  <div class="form-group">
    <label for="formGroupExampleInput">{l s='Período de horas de pago' mod='pagopar'}</label>
    <input type="text" name="horas_pago" value="{$horas_pago}" class="form-control" id="formGroupExampleInput" placeholder="Ej: 1 ó 2...3">
  </div>
  
  <div class="form-group">
    <label for="formGroupExampleInput">{l s='Url de agradecimiento de compra' mod='pagopar'}</label>
    <input type="text" name="url_agradecimiento" value="{$url_agradecimiento}" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  
  <div class="form-group">
    <label for="formGroupExampleInput">{l s='Url de respuesta de pagopar compra finalizada' mod='pagopar'}</label>
    <input type="text" name="url_finalizada" value="{$url_finalizada}" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  
  
  <div class="form-check">
    <label class="form-check-label" for="exampleCheck1">{l s='Mostrar todos los medios de pagos sin importar los montos mínimos' mod='pagopar'}</label>
    <select class="form-control" name="pago_minimo" id="exampleFormControlSelect1">
      <option value="S" {if $pago_minimo eq "S"} selected="selected" {/if} >Si</option>
      <option value="N" {if $pago_minimo eq "N"} selected="selected" {/if} >No</option>
    </select>
    <label class="form-check-label" for="exampleCheck1">{l s='El comercio asume los montos mínimos de los medios de pagos previa autorización en el sistema de pagopar. Para mas explicación contactar a: desarrollo@pagopar.com' mod='pagopar'}</label>
  </div><p></p>
  
  <div class="form-check">
    <label class="form-check-label" for="exampleCheck1">{l s='Mostrar todos los medios de pagos en esta tienda. Utilizar esta opcion bajo previa explicación y habilitacion de dicho permiso por el equipo de Pagopar' mod='pagopar'}</label>
    <select class="form-control" name="medios_pago" id="exampleFormControlSelect1">
      <option value="S" {if $medios_pago eq "S"} selected="selected" {/if} >Si</option>
      <option value="N" {if $medios_pago eq "N"} selected="selected" {/if} >No</option>
    </select>
    <label class="form-check-label" for="exampleCheck1">{l s='Se muestran todos los medios de pagos en el checkout de la tienda y se habilita el redireccionamiento automático a los medios de pagos finales. Para solicitar esta opcion comuníquese con: desarrollo@pagopar.com' mod='pagopar'}</label>
  </div>
  <br>
  <br>
  <div class="form-group">
    <label for="formGroupExampleInput">Footer</label>
  </div>
  <div class="form-check">
    <label class="form-check-label" for="exampleCheck1">Tema</label>
    <select class="form-control" name="tema" id="exampleFormControlSelect1">
      <option value="dark" {if $tema eq "dark"} selected="selected" {/if} >Dark</option>
      <option value="light" {if $tema eq "light"} selected="selected" {/if} >Light</option>
    </select>
  </div>
  <div class="form-check">
    <label class="form-check-label" for="exampleCheck1">Color de fondo</label>
    <input type="color" name="color_fondo" value="{$color_fondo}" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-check">
    <label class="form-check-label" for="exampleCheck1">Color de borde superior</label>
    <input type="color" name="color_borde" value="{$color_borde}" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <p></p>
  <button type="submit" name="botonGuardar" class="btn btn-primary">{l s='Save' mod='pagopar'}</button>
</form>