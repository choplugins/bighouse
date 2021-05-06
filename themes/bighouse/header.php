<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open();
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
?>
    <!-- header PC -->
    <header class="header d-none d-lg-block" id="header">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header-top__left header-top__address">
                            <?php dynamic_sidebar( 'top-header' ); ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header-top__right">
                            <?php wp_nav_menu(array(
                                    'menu' => 'top-menu',
                                    'container'=>'ul',
                                    'menu_class' => 'header-top__list',
                                    'walker' => new HanzoTopMenuWalker()
                            ))?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" header-center">
            <div class="container">
                <div class="header-center__list">
                    <div class="header-center__logo">
                        <img src="<?= esc_url($logo[0])?>" alt="<?= get_bloginfo( 'name' )?>">
                    </div>
                    <div class="header-center__commit-list">
                        <?php $header_banners = get_field('header_banner','option');
                            if(!empty($header_banners)): foreach ($header_banners as $key => $banner):
                        ?>
                                <div class="header-center__commit-item header-center__commit-item-<?= ++$key?>"><?= nl2br($banner['content'])?></div>
                        <?php endforeach; endif;?>
                    </div>
        
                    <div class="header-center__shortcut">
                        <a href="#" class="header-center__shortcut-item btn" title="Tài khoản">
                            <svg width="16px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 460.8 460.8" style="enable-background:new 0 0 460.8 460.8;" xml:space="preserve"><path d="M230.432,0c-65.829,0-119.641,53.812-119.641,119.641s53.812,119.641,119.641,119.641s119.641-53.812,119.641-119.641
                                        S296.261,0,230.432,0z"/>
                                    <path d="M435.755,334.89c-3.135-7.837-7.314-15.151-12.016-21.943c-24.033-35.527-61.126-59.037-102.922-64.784
                                        c-5.224-0.522-10.971,0.522-15.151,3.657c-21.943,16.196-48.065,24.555-75.233,24.555s-53.29-8.359-75.233-24.555
                                        c-4.18-3.135-9.927-4.702-15.151-3.657c-41.796,5.747-79.412,29.257-102.922,64.784c-4.702,6.792-8.882,14.629-12.016,21.943
                                        c-1.567,3.135-1.045,6.792,0.522,9.927c4.18,7.314,9.404,14.629,14.106,20.898c7.314,9.927,15.151,18.808,24.033,27.167
                                        c7.314,7.314,15.673,14.106,24.033,20.898c41.273,30.825,90.906,47.02,142.106,47.02s100.833-16.196,142.106-47.02
                                        c8.359-6.269,16.718-13.584,24.033-20.898c8.359-8.359,16.718-17.241,24.033-27.167c5.224-6.792,9.927-13.584,14.106-20.898
                                        C436.8,341.682,437.322,338.024,435.755,334.89z"/>
                                </svg>
                            Tài khoản
                        </a>
                        <a href="#" class="header-center__shortcut-item btn " title="Giỏ hàng">
                            <svg width="14px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 511.997 511.997" style="enable-background:new 0 0 511.997 511.997;" xml:space="preserve"><path d="M405.387,362.612c-35.202,0-63.84,28.639-63.84,63.84s28.639,63.84,63.84,63.84s63.84-28.639,63.84-63.84
                                            S440.588,362.612,405.387,362.612z M405.387,451.988c-14.083,0-25.536-11.453-25.536-25.536s11.453-25.536,25.536-25.536
                                            c14.083,0,25.536,11.453,25.536,25.536S419.47,451.988,405.387,451.988z"/><path d="M507.927,115.875c-3.626-4.641-9.187-7.348-15.079-7.348H118.22l-17.237-72.12c-2.062-8.618-9.768-14.702-18.629-14.702
                                            H19.152C8.574,21.704,0,30.278,0,40.856s8.574,19.152,19.152,19.152h48.085l62.244,260.443
                                            c2.062,8.625,9.768,14.702,18.629,14.702h298.135c8.804,0,16.477-6.001,18.59-14.543l46.604-188.329
                                            C512.849,126.562,511.553,120.516,507.927,115.875z M431.261,296.85H163.227l-35.853-150.019h341.003L431.261,296.85z"/><path d="M173.646,362.612c-35.202,0-63.84,28.639-63.84,63.84s28.639,63.84,63.84,63.84s63.84-28.639,63.84-63.84
                                            S208.847,362.612,173.646,362.612z M173.646,451.988c-14.083,0-25.536-11.453-25.536-25.536s11.453-25.536,25.536-25.536
                                            s25.536,11.453,25.536,25.536S187.729,451.988,173.646,451.988z"/>
                                </svg>
                            Giỏ hàng (0)</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container d-flex position-relative no-gutters-col">
                <div class="header-bottom__nav">
                    <a href="#">
                        <?php echo hanzo_svg('menu-button-of-three-horizontal-lines','18')?>
                        DANH MỤC SẢN PHẨM
                    </a>
                    <div class="toolBar">
                        <?php wp_nav_menu(array(
                                'menu' => 'categories-menu',
                                'container' => 'ul',
                                'menu_class' => 'introNav',
                                'walker' => new HanzoCatMenuWalker()
                        ))?>
                    </div>
                </div>
                <div class="header-bottom__search">
                    <form name="frm_Search"  method="get" >
                        <input type="text" value="Tìm kiếm" name="s">
                        <input type="hidden" name="post_type" value="product">
                        <button>
                            <?php echo hanzo_svg('loupe','18')?>
                        </button>
                    </form>
                </div>
                <?php $socials = get_field('socials','option')?>
                <div class="header-bottom__contact">
                    <div class="header-bottom__social">
                        <a target="_blank" href="<?= $socials['youtube']?>">
                            <svg width="22px" viewBox="-21 -117 682.66672 682"  xmlns="http://www.w3.org/2000/svg"><path d="m626.8125 64.035156c-7.375-27.417968-28.992188-49.03125-56.40625-56.414062-50.082031-13.703125-250.414062-13.703125-250.414062-13.703125s-200.324219 0-250.40625 13.183593c-26.886719 7.375-49.03125 29.519532-56.40625 56.933594-13.179688 50.078125-13.179688 153.933594-13.179688 153.933594s0 104.378906 13.179688 153.933594c7.382812 27.414062 28.992187 49.027344 56.410156 56.410156 50.605468 13.707031 250.410156 13.707031 250.410156 13.707031s200.324219 0 250.40625-13.183593c27.417969-7.378907 49.03125-28.992188 56.414062-56.40625 13.175782-50.082032 13.175782-153.933594 13.175782-153.933594s.527344-104.382813-13.183594-154.460938zm-370.601562 249.878906v-191.890624l166.585937 95.945312zm0 0"/></svg>
                        </a>
                        <a target="_blank" href="<?= $socials['facebook']?>">
                            <svg width="22px" id="Bold" enable-background="new 0 0 24 24" viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"><path d="m15.997 3.985h2.191v-3.816c-.378-.052-1.678-.169-3.192-.169-3.159 0-5.323 1.987-5.323 5.639v3.361h-3.486v4.266h3.486v10.734h4.274v-10.733h3.345l.531-4.266h-3.877v-2.939c.001-1.233.333-2.077 2.051-2.077z"/></svg>
                        </a>
                    </div>
                    <a class="header-bottom__call" href="<?= get_field('hotline','option')?>">
                        <span>YÊU CẦU BIGHOUSE GỌI LẠI</span>
                        <b>trong 2 phút</b>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- end header pc -->

    <!-- header mobile -->
    <header class="header-mb d-lg-none d-md-block">
        <div class="container">
            <div class="nav-mb">
                <div class="nav-mb__logo">
                    <img src="<?= get_field('mobile_logo','option')?>" alt="<?= get_bloginfo( 'name' )?>">
                </div>
                <div class="nav-mb__search">
                    <form action="#">
                    <input type="text" name="s" autocomplete="off" placeholder="Tìm kiếm">
                    <input type="hidden" name="post_type" value="product">
                    <button type="submit" >
                        <?php echo hanzo_svg('loupe','12')?>
                    </button>
                    </form>
                </div>
                <div class="nav-mb__toggle">
                    <?php echo hanzo_svg('menu-button-of-three-horizontal-lines','24')?>
                    Menu
                </div>
            </div>
        </div>
        <div class="menu-mobile">
            <?php wp_nav_menu(array(
                    'menu' => 'categories-menu',
                    'container' => '',
                    'menu_class' => 'menu-mobile__list menu-mobile__main',
                    'walker' => new HanzoCatMobileMenuWalker()
            ))?>
        </div>
    </header>
        <!--overlay-->
        <div class="overlay"></div>
    <!--end overlay-->
    <!-- end header mobile -->



