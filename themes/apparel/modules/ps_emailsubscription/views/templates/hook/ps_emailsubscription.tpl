{**
* 2007-2018 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License 3.0 (AFL-3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* https://opensource.org/licenses/AFL-3.0
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
* @author    PrestaShop SA <contact@prestashop.com>
* @copyright 2007-2018 PrestaShop SA
* @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
* International Registered Trademark & Property of PrestaShop SA
*}

<div id="newsletter" class="col-md-9 newsletter-block">
    <div class="newsletter-title col-md-3">
        <span>
            {l s='Newsletter' d='Shop.Theme.Customeraccount'}
        </span>
    </div>
    <div class="block newsletter col-md-9">
        <div class="content">
            <form action="{$urls.pages.index}#footer" method="post" class="form subscribe">
                <div class="field newsletter">
                    <div class="control">
                        <input
                            name="email"
                            type="email"
                            value="{$value}"
                            placeholder="{l s='Enter your email' d='Shop.Forms.Labels'}"
                            aria-labelledby="block-newsletter-label"
                            >
                    </div>
                </div>
                <input type="hidden" name="action" value="0">
                <div class="actions">
                    <input
                        class="hidden-xs-down"
                        name="submitNewsletter"
                        type="submit"
                        value="{l s='Subscribe' d='Shop.Theme.Actions'}"
                        >
                    <input
                        class="hidden-sm-up"
                        name="submitNewsletter"
                        type="submit"
                        value="{l s='Ok' d='Shop.Theme.Actions'}"
                        >
                </div>
                <div class="clearfix"></div>
                {if $conditions}
                    <p class="condition">{$conditions}</p>
                {/if}
                {if $msg}
                    <p class="alert {if $nw_error}alert-danger{else}alert-success{/if}">
                        {$msg}
                    </p>
                {/if}
                {if isset($id_module)}
                    {hook h='displayGDPRConsent' id_module=$id_module}
                {/if}
            </form>
        </div>
    </div>
</div>

