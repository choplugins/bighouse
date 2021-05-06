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
                        <div class="header-center__commit-item header-center__commit-item-1">Cam kết hàng <br> chính hãng</div>
                        <div class="header-center__commit-item header-center__commit-item-2">Giao hàng <br> toàn quốc</div>
                        <div class="header-center__commit-item header-center__commit-item-3">Thanh toán <br> tại nhà</div>
                        <div class="header-center__commit-item header-center__commit-item-4">Luôn có <br> khuyến mại</div>
                        <div class="header-center__commit-item header-center__commit-item-5">Giá luôn rẻ</div>
                    </div>
        
                    <div class="header-center__shortcut">
                        <a href="#" class="header-center__shortcut-item btn" title="Tài khoản">
                            <svg width="16px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 460.8 460.8" style="enable-background:new 0 0 460.8 460.8;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M230.432,0c-65.829,0-119.641,53.812-119.641,119.641s53.812,119.641,119.641,119.641s119.641-53.812,119.641-119.641
                                        S296.261,0,230.432,0z"/>
                                </g>
                            </g>
                            <g>
                                <g>
                                    <path d="M435.755,334.89c-3.135-7.837-7.314-15.151-12.016-21.943c-24.033-35.527-61.126-59.037-102.922-64.784
                                        c-5.224-0.522-10.971,0.522-15.151,3.657c-21.943,16.196-48.065,24.555-75.233,24.555s-53.29-8.359-75.233-24.555
                                        c-4.18-3.135-9.927-4.702-15.151-3.657c-41.796,5.747-79.412,29.257-102.922,64.784c-4.702,6.792-8.882,14.629-12.016,21.943
                                        c-1.567,3.135-1.045,6.792,0.522,9.927c4.18,7.314,9.404,14.629,14.106,20.898c7.314,9.927,15.151,18.808,24.033,27.167
                                        c7.314,7.314,15.673,14.106,24.033,20.898c41.273,30.825,90.906,47.02,142.106,47.02s100.833-16.196,142.106-47.02
                                        c8.359-6.269,16.718-13.584,24.033-20.898c8.359-8.359,16.718-17.241,24.033-27.167c5.224-6.792,9.927-13.584,14.106-20.898
                                        C436.8,341.682,437.322,338.024,435.755,334.89z"/>
                                </g>
                            </g>
                                </svg>
                            Tài khoản
                        </a>
                        <a href="#" class="header-center__shortcut-item btn " title="Giỏ hàng">
                            <svg width="14px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 511.997 511.997" style="enable-background:new 0 0 511.997 511.997;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M405.387,362.612c-35.202,0-63.84,28.639-63.84,63.84s28.639,63.84,63.84,63.84s63.84-28.639,63.84-63.84
                                            S440.588,362.612,405.387,362.612z M405.387,451.988c-14.083,0-25.536-11.453-25.536-25.536s11.453-25.536,25.536-25.536
                                            c14.083,0,25.536,11.453,25.536,25.536S419.47,451.988,405.387,451.988z"/>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M507.927,115.875c-3.626-4.641-9.187-7.348-15.079-7.348H118.22l-17.237-72.12c-2.062-8.618-9.768-14.702-18.629-14.702
                                            H19.152C8.574,21.704,0,30.278,0,40.856s8.574,19.152,19.152,19.152h48.085l62.244,260.443
                                            c2.062,8.625,9.768,14.702,18.629,14.702h298.135c8.804,0,16.477-6.001,18.59-14.543l46.604-188.329
                                            C512.849,126.562,511.553,120.516,507.927,115.875z M431.261,296.85H163.227l-35.853-150.019h341.003L431.261,296.85z"/>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M173.646,362.612c-35.202,0-63.84,28.639-63.84,63.84s28.639,63.84,63.84,63.84s63.84-28.639,63.84-63.84
                                            S208.847,362.612,173.646,362.612z M173.646,451.988c-14.083,0-25.536-11.453-25.536-25.536s11.453-25.536,25.536-25.536
                                            s25.536,11.453,25.536,25.536S187.729,451.988,173.646,451.988z"/>
                                    </g>
                                </g>
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
                        <ul class="introNav">
                            <li>
                                <a title="GẠCH ỐP LÁT" target="_self" href="#">GẠCH ỐP LÁT</a>
                                <div class="introNavBox">
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">GẠCH ỐP LÁT</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch Prime</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch Bạch Mã</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch Taicera</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch Viglacera</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch Tasa</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch Hoàn Mỹ</a>
                                        </li>

                                        <li>
                                            <a href="">Gạch CMC</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">THƯƠNG HIỆU GẠCH</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch Tây Ban Nha</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch Á Mỹ</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch Thạch Bàn</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch Kis</a>
                                        </li>

                                        <li>
                                            <a href="#">Gạch Vitto</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">GẠCH LÁT NỀN</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch lát nền 15x60</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch lát nền 15×80</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch lát nền 15×90</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch lát nền 25x25</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch lát nền 30x30</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch lát nền 40x40</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch lát nền 50x50</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch lát nền 60x60</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch lát nền 80x80</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">GẠCH ỐP TƯỜNG</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch ốp tường 12x40</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch ốp tường 12x50</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch ốp tường 25x40</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch ốp tường 30x45</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch ốp tường 30x60</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch viền trang trí</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">LOẠI GẠCH</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch Bông</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch lát nền phòng khách</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch ốp mặt tiền</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch ốp nhà vệ sinh</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch ốp phòng bếp</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch ốp phòng ngủ</a>
                                        </li>
                                        <li>
                                            <a href="#">Gạch ốp trang trí</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a title="THIẾT BỊ VỆ SINH" target="_self" href="#">THIẾT BỊ VỆ SINH</a>
                                <div class="introNavBox">
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">THIẾT BỊ VỆ SINH</a>
                                        </li>
                                        <li>
                                            <a href="#">Chậu rửa mặt</a>
                                        </li>
                                        <li>
                                            <a href="#">Bồn cầu</a>
                                        </li>
                                        <li>
                                            <a href="#">Vòi chậu</a>
                                        </li>
                                        <li>
                                            <a href="#">Thoát sàn</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen tắm</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen cây</a>
                                        </li>
                                        <li>
                                            <a href="#">Bình nóng lạnh</a>
                                        </li>
                                        <li>
                                            <a href="#">Tủ chậu</a>
                                        </li>
                                        <li>
                                            <a href="#">Bồn tắm</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">THƯƠNG HIỆU</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị vệ sinh Sobisung</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">BỒN CẦU</a>
                                        </li>
                                        <li>
                                            <a href="#">Bồn cầu 1 khối</a>
                                        </li>
                                        <li>
                                            <a href="#">Bồn cầu 2 khối</a>
                                        </li>
                                        <li>
                                            <a href="#">Bồn cầu thông minh</a>
                                        </li>
                                        <li>
                                            <a href="#">Bồn cầu âm tường</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">VÒI CHẬU RỬA MẶT</a>
                                        </li>
                                        <li>
                                            <a href="#">Chậu rửa mặt âm bàn</a>
                                        </li>
                                        <li>
                                            <a href="#">Chậu rửa mặt bán âm bàn</a>
                                        </li>
                                        <li>
                                            <a href="#">Chậu rửa mặt dương bàn</a>
                                        </li>
                                        <li>
                                            <a href="#">Chậu rửa mặt treo tường</a>
                                        </li>
                                        <li>
                                            <a href="#">Vòi chậu cảm ứng</a>
                                        </li>
                                        <li>
                                            <a href="#">Vòi chậu nước lạnh</a>
                                        </li>
                                        <li>
                                            <a href="#">Vòi chậu nóng lạnh</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">SEN VÒI</a>
                                        </li>
                                        <li>
                                            <a href="#">Sem tắm âm tường</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen tắm lạnh</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen tắm nóng lạnh</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen cây</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a title="THIẾT BỊ BẾP" target="_self" href="#">THIẾT BỊ BẾP</a>
                                <div class="introNavBox">
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">THIẾT BỊ NHÀ BẾP</a>
                                        </li>
                                        <li>
                                            <a arr_id="12132" href="#">Vòi rửa bát</a>
                                        </li>
                                        <li>
                                            <a arr_id="597" href="#">Chậu rửa bát</a>
                                        </li>
                                        <li>
                                            <a href="#">Bếp hồng ngoại</a>
                                        </li>
                                        <li>
                                            <a href="#">Bếp từ</a>
                                        </li>
                                        <li>
                                            <a href="#">Hút mùi</a>
                                        </li>
                                        <li>
                                            <a href="#">Nồi chảo</a>
                                        </li>
                                        <li>
                                            <a href="#">Bếp gas</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">THƯƠNG HIỆU</a>
                                        </li>
                                        <li>
                                            <a arr_id="1924" href="https://bighousevietnam.com/blueger/">Thiết bị bếp Blueger</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị bếp Kapani</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị bếp Inax</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị bếp Bancoot</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị bếp Bosch</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị bếp Caesar</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị bếp Cata</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị bếp Picenza</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị bếp Samwon</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">THƯƠNG HIỆU</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị bếp Sobitex</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị bếp Taka</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị bếp Teka</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị bếp American Standard</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị nhà bếp AMTS</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị nhà bếp EU</a>
                                        </li>
                                        <li>
                                            <a href="#">Thiết bị nhà bếp Sobisung</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a title="BỒN CẦU" target="_self" href="#">BỒN CẦU</a>
                                <div class="introNavBox">
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">THƯƠNG HIỆU</a>
                                        </li>
                                        <li>
                                            <a href="#">Bồn cầu Inax</a>
                                        </li>
                                        <li>
                                            <a href="#">Bồn cầu Toto</a>
                                        </li>
                                        <li>
                                            <a href="#">Bồn cầu Viglacera</a>
                                        </li>
                                        <li>
                                            <a href="#">Bồn cầu Jomoo</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a title="SEN CÂY" target="_self" href="#">SEN CÂY</a>
                                <div class="introNavBox">
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">THƯƠNG HIỆU</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen cây Inax</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen cây Toto</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen cây Viglacera</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen cây Daehan</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen cây Daeshin</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen cây AMTS</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen cây Bancoot</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen cây Caesar</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen cây Jomoo</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a title="CHẬU LAVABO" target="_self" href="#">CHẬU LAVABO</a>
                                <div class="introNavBox">
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">THƯƠNG HIỆU</a>
                                        </li>
                                        <li>
                                            <a href="#">Chậu lavabo Toto</a>
                                        </li>
                                        <li>
                                            <a href="#">Chậu rửa mặt Inax</a>
                                        </li>
                                        <li>
                                            <a href="#">Chậu lavabo Viglacera</a>
                                        </li>
                                        <li>
                                            <a href="#">Chậu rửa mặt Jomoo</a>
                                        </li>
                                        <li>
                                            <a href="#" >Chậu rửa mặt American</a>
                                        </li>
                                        <li>
                                            <a href="#">Chậu rửa mặt Caesar</a>
                                        </li>
                                        <li>
                                            <a href="#">Chậu lavabo AMTS</a>
                                        </li>
                                        <li>
                                            <a href="#">Chậu lavabo Thiên Thanh</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a title="VÒI CHẬU" target="_self" href="#">VÒI CHẬU</a>
                                <div class="introNavBox">
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">THƯƠNG HIỆU</a>
                                        </li>
                                        <li>
                                            <a href="#">Vòi chậu Inax</a>
                                        </li>
                                        <li>
                                            <a href="#">Vòi chậu Toto</a>
                                        </li>
                                        <li>
                                            <a href="#/">Vòi chậu Viglacera</a>
                                        </li>
                                        <li>
                                            <a href="#">Vòi chậu Jomoo</a>
                                        </li>
                                        <li>
                                            <a href="#">Vòi chậu Kosco</a>
                                        </li>
                                        <li>
                                            <a href="#">Vòi chậu American</a>
                                        </li>
                                        <li>
                                            <a href="#">Vòi chậu AMTS</a>
                                        </li>
                                        <li>
                                            <a href="#">Vòi chậu Sanji</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">THƯƠNG HIỆU</a>
                                        </li>
                                        <li>
                                            <a  href="#">Vòi chậu Sobisung</a>
                                        </li>
                                        <li>
                                            <a  href="#">Vòi chậu Sobitex</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a title="SEN TẮM" target="_self" href="#">SEN TẮM</a>
                                <div class="introNavBox">
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">THƯƠNG HIỆU</a>
                                        </li>
                                        <li>
                                            <a  href="#">Sen tắm Toto</a>
                                        </li>
                                        <li>
                                            <a  href="#">Sen tắm Inax</a>
                                        </li>
                                        <li>
                                            <a  href="#">Sen tắm Viglacera</a>
                                        </li>
                                        <li>
                                            <a  href="#">Sen tắm Daehan</a>
                                        </li>
                                        <li>
                                            <a  href="#">Sen tắm Daeshin</a>
                                        </li>
                                        <li>
                                            <a  href="#">Sen tắm American</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen tắm Mirolin</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen tắm Caesar</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen tắm Samwon</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen tắm Sanji</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen tắm Sobisung</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen tắm Bancoot</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen tắm AMTS</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen tắm Kosco</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen tắm Sobitex</a>
                                        </li>
                                        <li>
                                            <a href="#">Sen tắm Daebak</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a title="BẾP TỪ" target="_self" href="#">BẾP TỪ</a>
                                <div class="introNavBox">
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">THƯƠNG HIỆU</a>
                                        </li>
                                        <li>
                                            <a href="#">Bếp từ Bosch</a>
                                        </li>
                                        <li>
                                            <a href="#">Bếp từ Blueger</a>
                                        </li>
                                        <li>
                                            <a href="#">Bếp từ Faster</a>
                                        </li>
                                        <li>
                                            <a href="#">Bếp từ Kapani</a>
                                        </li>
                                        <li>
                                            <a href="#">Bếp từ Cata</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a title="KHUYẾN MÃI BIG HOUSE" target="_self" href="#">KHUYẾN MÃI BIG HOUSE</a>
                                <div class="introNavBox">
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">SẢN PHẨM KHUYẾN MÃI</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="introNavBoxTitle">
                                            <a href="#">Khuyến Mãi Big House</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
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
                <div class="header-bottom__contact">
                    <div class="header-bottom__social">
                        <a target="_blank" href="#">
                            <svg width="22px" viewBox="-21 -117 682.66672 682" width="682pt" xmlns="http://www.w3.org/2000/svg"><path d="m626.8125 64.035156c-7.375-27.417968-28.992188-49.03125-56.40625-56.414062-50.082031-13.703125-250.414062-13.703125-250.414062-13.703125s-200.324219 0-250.40625 13.183593c-26.886719 7.375-49.03125 29.519532-56.40625 56.933594-13.179688 50.078125-13.179688 153.933594-13.179688 153.933594s0 104.378906 13.179688 153.933594c7.382812 27.414062 28.992187 49.027344 56.410156 56.410156 50.605468 13.707031 250.410156 13.707031 250.410156 13.707031s200.324219 0 250.40625-13.183593c27.417969-7.378907 49.03125-28.992188 56.414062-56.40625 13.175782-50.082032 13.175782-153.933594 13.175782-153.933594s.527344-104.382813-13.183594-154.460938zm-370.601562 249.878906v-191.890624l166.585937 95.945312zm0 0"/></svg>
                        </a>
                        <a target="_blank" href="#">
                            <svg width="22px" id="Bold" enable-background="new 0 0 24 24" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m15.997 3.985h2.191v-3.816c-.378-.052-1.678-.169-3.192-.169-3.159 0-5.323 1.987-5.323 5.639v3.361h-3.486v4.266h3.486v10.734h4.274v-10.733h3.345l.531-4.266h-3.877v-2.939c.001-1.233.333-2.077 2.051-2.077z"/></svg>
                        </a>
                    </div>
                    <a class="header-bottom__call" href="#">
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
                    <img src="<?= esc_url($logo[0])?>" alt="<?= get_bloginfo( 'name' )?>" class="img-fluid" >
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
            <ul class="menu-mobile__list menu-mobile__main">
                <li class="current-menu-item">
                    <a href="#"><?php echo hanzo_svg('menu-button-of-three-horizontal-lines','24')?>Gạch úp lát</a>
                    <ul class="menu-mobile__sub">
                        <li>
                            <a href="#">GẠCH ỐP LÁT1</a>
                            <ul class="menu-mobile__mega">
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">GẠCH ỐP LÁT</a>
                            <ul class="menu-mobile__mega">
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">GẠCH ỐP LÁT</a>
                            <ul class="menu-mobile__mega">
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">GẠCH ỐP LÁT</a>
                            <ul class="menu-mobile__mega">
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">GẠCH ỐP LÁT</a>
                            <ul class="menu-mobile__mega">
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">GẠCH ỐP LÁT</a>
                            <ul class="menu-mobile__mega">
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><?php echo hanzo_svg('menu-button-of-three-horizontal-lines','24')?>Gạch úp lát</a>
                    <ul class="menu-mobile__sub">
                        <li>
                            <a href="#">GẠCH ỐP LÁT</a>
                            <ul class="menu-mobile__mega">
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><?php echo hanzo_svg('menu-button-of-three-horizontal-lines','24')?>Gạch úp lát</a>
                    <ul class="menu-mobile__sub">
                        <li>
                            <a href="#">GẠCH ỐP LÁT2</a>
                            <ul class="menu-mobile__mega">
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">GẠCH ỐP LÁT</a>
                            <ul class="menu-mobile__mega">
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">GẠCH ỐP LÁT</a>
                            <ul class="menu-mobile__mega">
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">GẠCH ỐP LÁT</a>
                            <ul class="menu-mobile__mega">
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">GẠCH ỐP LÁT</a>
                            <ul class="menu-mobile__mega">
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">GẠCH ỐP LÁT</a>
                            <ul class="menu-mobile__mega">
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                                <li><a href="#">Gạch Prime</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
        <!--overlay-->
        <div class="overlay"></div>
    <!--end overlay-->
    <!-- end header mobile -->



