{block name='address_block_item'}
    <article id="address-{$card.id}" class="address" data-id-address="{$card.id}">
        <div class="address-body">
            <h4>{$card.tarjeta_numero}</h4>
            <img src="{$card.url_logo}" alt="">
        </div>

        {block name='address_block_item_actions'}
            <div class="address-footer">
                <a href="{url entity=address id=$address.id params=['delete' => 1, 'token' => $token]}" data-link-action="delete-address">
                    <i class="material-icons">&#xE872;</i>
                    <span>{l s='Delete' d='Shop.Theme.Actions'}</span>
                </a>
            </div>
        {/block}
    </article>
{/block}