{**
* 2007-2016 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
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
* @copyright 2007-2016 PrestaShop SA
* @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
* International Registered Trademark & Property of PrestaShop SA
*}

{if !$configuration.is_catalog}
    <form action="{$urls.pages.cart}" class="cart-form-url" method="post">
        <input type="hidden" name="token" class="cart-form-token" value="{$static_token}">
        <input type="hidden" value="{$product.id_product}" name="id_product">
        <input type="hidden" class="input-group form-control" value="1" name="qty" />
        <button data-button-action="add-to-cart" class="btn btn-primary" {if !$product.quantity > 0}disabled title="{l s=' Out of stock ' d='Shop.Theme.Actions'}"{/if}>
            <span>
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </span>
        </button>
    </form>
{/if}