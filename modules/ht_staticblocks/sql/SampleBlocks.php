<?php

/**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
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
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
class SampleBlocks {

    public function initData($base_url) {

        $content_block1 = '
                   <div class="ht-static-block offer-block">
<div class="inner-wrapper">
<div class="container">
<div class="row">
<div class="img-block left-block"><a href="#"> <img src="img/cms/adv-img-1.jpg" alt="img" /> </a></div>
<div class="img-block right-block"><a href="#"> <img src="img/cms/adv-img-2.jpg" alt="img" /> </a></div>
</div>
</div>
</div>
</div>
';
        $content_block2 = '
                  <div class="ht-static-block testimonial-block">
<div class="container">
<div class="section-title">
<h2><span> What client say </span></h2>
</div>
<div class="content-block">
<div class="testimonial-slider-block slider-block">
<div class="item">
<div class="item-inner">
<div class="text-block">
<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque. Laudantium totam rem aperiam, eaque ipsa quae unde error accusantium unde error accusantium unde.</p>
<div class="img-block"><img src="img/cms/testimonial-img-1.jpg" alt="" /></div>
<span class="name">Keonel Lee</span> <span class="designation">Fashion Designer</span></div>
</div>
</div>
<div class="item">
<div class="item-inner">
<div class="text-block">
<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque. Laudantium totam rem aperiam, eaque ipsa quae unde error accusantium unde error accusantium unde.</p>
<div class="img-block"><img src="img/cms/testimonial-img-2.jpg" alt="" /></div>
<span class="name">Keonel Lee</span> <span class="designation">Fashion Designer</span></div>
</div>
</div>
</div>
</div>
</div>
</div>
';

        $content_block3 = '
    <div id="blog-section" class="ht-home-blogs slider-block">
    <div class="container">
        <div class="section-title">
            <h2>
                <span>
                    Latest Blog
                </span>
            </h2>
        </div>
        <div class="content-block">
            <div class="content-row  blog-slider">
                <div class="item">
                    <div class="item-inner">
                        <div class="img-block">
                            <a href="#">
                                <div class="post_thumbnail">
                                    <img src="img/cms/blog-img-1.jpg" alt="blog-img">
                                </div>
                            </a>
                        </div>
                        <div class="text-block">
                            <div class="post-content">
                                <a href="" class="blog-title">
                                    <span>
                                        This is First Post For Lorem Ipsum
                                    </span>
                                </a>
                                <div class="blog-desc">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been ipsum
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="item-inner">
                        <div class="img-block">
                            <a href="#">
                                <div class="post_thumbnail">
                                    <img src="img/cms/blog-img-2.jpg" alt="blog-img">
                                </div>
                            </a>
                        </div>
                        <div class="text-block">
                            <div class="post-content">
                                <a href="" class="blog-title">
                                    <span>
                                        This is Secound Post For Lorem Ipsum
                                    </span>
                                </a>
                                <div class="blog-desc">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been ipsum
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="item-inner">
                        <div class="img-block">
                            <a href="#">
                                <div class="post_thumbnail">
                                    <img src="img/cms/blog-img-3.jpg" alt="blog-img">
                                </div>
                            </a>
                        </div>
                        <div class="text-block">
                            <div class="post-content">
                                <a href="" class="blog-title">
                                    <span>
                                        This is Third Post For Lorem Ipsum
                                    </span>
                                </a>
                                <div class="blog-desc">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been ipsum
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="item-inner">
                        <div class="img-block">
                            <a href="#">
                                <div class="post_thumbnail">
                                    <img src="img/cms/blog-img-4.jpg" alt="blog-img">
                                </div>
                            </a>
                        </div>
                        <div class="text-block">
                            <div class="post-content">
                                <a href="" class="blog-title">
                                    <span>
                                        This is Fourth Post For Lorem Ipsum
                                    </span>
                                </a>
                                <div class="blog-desc">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been ipsum
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';

        $content_block4 = '<div id="block_contact_hours" class="col-md-3 links wrapper">
	<div class="column-title hidden-sm-down">
		<a href="#"><img src="img/cms/footer-logo.png" /></a>
	</div>
	<div class="title clearfix hidden-md-up" data-target="#footer_contact_hours" data-toggle="collapse">
		<span>Quick Contact</span>
		<span class="float-xs-right icon">
			<span class="navbar-toggler collapse-icons">
				<i class="fa fa-angle-down add" aria-hidden="true"></i>
				<i class="fa fa-angle-up remove" aria-hidden="true"></i> 
			</span>
		</span>
	</div>
	<div class="footer-column-content column-content collapse" id="footer_contact_hours">
		<div class="contact-info">
			<div class="item">
				<span class="text-span"> 135 Barnard, St. Brooklyn, NY 10036, United States</span>
			</div>
			<div class="item">
				<span class="text-span">Phone: +1 234-456-7890 </span>
			</div>
			<div class="item">
				<span class="text-span">Email: info@domain.com </span>
			</div>
		</div>
	</div>
</div>
';

        $content_block5 = '
    <div class="header-msg-block">
<div class="message"><span>Mega march sale Flate <strong>25% Off</strong></span></div>
</div>
';



        $displayHome = Hook::getIdByName('displayHome');
        $displayFooter = Hook::getIdByName('displayFooter');
        $displayTop = Hook::getIdByName('displayTop');
        $displayNav1 = Hook::getIdByName('displayNav1');
        $displayFooterBefore = Hook::getIdByName('displayFooterBefore');
        $displayHomeTop1 = Hook::getIdByName('displayHomeTop1');
        $displayHomeTop2 = Hook::getIdByName('displayHomeTop2');
        $displayHomeTop3 = Hook::getIdByName('displayHomeTop3');
        $displayHomeBottom1 = Hook::getIdByName('displayHomeBottom1');
        $displayHomeBottom2 = Hook::getIdByName('displayHomeBottom2');
        $displayHomeBottom3 = Hook::getIdByName('displayHomeBottom3');
        $id_shop = Configuration::get('PS_SHOP_DEFAULT');

        /* install static Block */
        $result = true;
        $result &= Db::getInstance()->Execute('INSERT INTO `' . _DB_PREFIX_ . 'ht_staticblocks` (`id_ht_staticblocks`, `hook`, `active`) 
			VALUES
                        (1, "displayHomeTop2", 1),
                        (2, "displayHomeTop3", 1),
                        (3, "displayHomeBottom1", 1),
                        (4, "displayFooter", 1),
                        (5, "displayNav1", 1)
			;');

        $result &= Db::getInstance()->Execute('INSERT INTO `' . _DB_PREFIX_ . 'ht_staticblocks_shop` (`id_ht_staticblocks`, `id_shop`,`active`) 
			VALUES 
			(1,' . $id_shop . ', 1),
			(2,' . $id_shop . ', 1),
			(3,' . $id_shop . ', 1),
			(4,' . $id_shop . ', 1),
			(5,' . $id_shop . ', 1)
			;');

        foreach (Language::getLanguages(false) as $lang) {
            $result &= Db::getInstance()->Execute('INSERT INTO `' . _DB_PREFIX_ . 'ht_staticblocks_lang` (`id_ht_staticblocks`, `id_shop`, `id_lang`, `title`, `content`) 
			VALUES 
			("1", "' . $id_shop . '","' . $lang['id_lang'] . '","Offer Banner Block", \'' . $content_block1 . '\'),
			("2", "' . $id_shop . '","' . $lang['id_lang'] . '","Testimonial Block", \'' . $content_block2 . '\'),
			("3", "' . $id_shop . '","' . $lang['id_lang'] . '","Blog Block", \'' . $content_block3 . '\'),
			("4", "' . $id_shop . '","' . $lang['id_lang'] . '","Footer Contact Block", \'' . $content_block4 . '\'),
			("5", "' . $id_shop . '","' . $lang['id_lang'] . '","Header Message Block", \'' . $content_block5 . '\')
                ;');
        }
        return $result;
    }

}
