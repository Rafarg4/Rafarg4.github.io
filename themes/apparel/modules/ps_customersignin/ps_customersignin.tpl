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
<div id="_desktop_user_info">
    <div class="user-info">
        <span id="header-menu-btn" class="tog-icon-block hidden-sm-down">
            <span class="hidden-sm-down">{l s='My Account' d='Shop.Theme.Actions'}</span>
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </span>
        <span class="hidden-md-up user-info-icon">
            {if $logged}
                <li class="user-link">
                    <a
                        class="account"
                        href="{$my_account_url}"
                        title="{l s='View my customer account' d='Shop.Theme.Customeraccount'}"
                        rel="nofollow"
                        >
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="hidden-sm-down">{$customerName}</span>
                    </a>
                </li>
            {else}
                <li class="user-link">
                    <a
                        href="{$my_account_url}"
                        title="{l s='Log in to your customer account' d='Shop.Theme.Customeraccount'}"
                        rel="nofollow"
                        >
                        <i class="fa fa-sign-in" aria-hidden="true"></i>
                        <span class="hidden-sm-down">{l s='Sign In' d='Shop.Theme.Actions'}</span>
                    </a>
                </li>
            {/if}
        </span>
        <ul style="display: none;" id="header-menu-content" class="header-menu-links">
            {if $logged}
                <li class="user-link">
                    <a
                        class="logout hidden-sm-down"
                        href="{$logout_url}"
                        rel="nofollow"
                        >
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        <span class="hidden-sm-down">{l s='Sign out' d='Shop.Theme.Actions'}</span>
                    </a>
                </li>
                <li class="user-link">
                    <a
                        class="account"
                        href="{$my_account_url}"
                        title="{l s='View my customer account' d='Shop.Theme.Customeraccount'}"
                        rel="nofollow"
                        >
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="hidden-sm-down">{$customerName}</span>
                    </a>
                </li>
            {else}
                <li class="user-link">
                    <a
                        class="register"
                        href="{$urls.pages.register}"
                        title="{l s='New account registration' d='Shop.Theme.Customeraccount'}"
                        rel="nofollow"
                        >
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        <span class="hidden-sm-down">{l s='Create an Account' d='Shop.Theme.Actions'}</span>
                    </a>
                </li>
                <li class="user-link">
                    <a
                        href="{$my_account_url}"
                        title="{l s='Log in to your customer account' d='Shop.Theme.Customeraccount'}"
                        rel="nofollow"
                        >
                        <i class="fa fa-sign-in" aria-hidden="true"></i>
                        <span class="hidden-sm-down">{l s='Sign In' d='Shop.Theme.Actions'}</span>
                    </a>
                </li>
            {/if}
        </ul>
    </div>
</div>