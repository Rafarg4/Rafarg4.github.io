
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