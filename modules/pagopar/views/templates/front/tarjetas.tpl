{extends file='customer/page.tpl'}

{block name='page_title'}
    {l s='Mis tarjetas' d='Shop.Theme.Customeraccount'}
{/block}

{block name='page_content'}
    <input type="hidden" id="url_agregar_tarjeta" value="{$url_agregar_tarjeta}">
    {foreach $cards as $card}
        <div class="col-lg-4 col-md-6 col-sm-6" id="{$card->alias_token}">
            {block name='address_block_item'}
                <article id="addres" class="address">
                    <div class="address-body">
                        <h4>{$card->tarjeta_numero}</h4>
                        <img src="{$card->url_logo}" alt="" width="100px">
                    </div>

                    {block name='address_block_item_actions'}
                        <div class="address-footer">
                            <a href="javascript:void(0);" name="{$card->alias_token}" class="pagoparDeleteCard" data-link-action="delete-address">
                                <i class="material-icons">&#xE872;</i>
                                <span id="{$card->alias_token}">{l s='Delete' d='Shop.Theme.Actions'}</span>
                            </a>
                        </div>
                    {/block}
                </article>
            {/block}

        </div>
    {/foreach}
    <div class="clearfix"></div>
    <div class="addresses-footer" style="padding-top: 50px;">
        <a href="" data-link-action="add-address" data-toggle="modal" data-target="#myModal" type="button" name="" id="pagoparAddCard">
            <i class="material-icons">&#xE145;</i>
            <span>{l s='Agregar nueva tarjeta' d='Shop.Theme.Actions'}</span>
        </a>
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
{/block}


