<?php get_header() ?>
<main class="wrapper-content">
    <!--slider-->
    <section class="silder">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-none d-lg-block">

                        <?php wp_nav_menu(array(
                            'menu' => 'categories-menu',
                            'container' => 'ul',
                            'menu_class' => 'introNav',
                            'walker' => new HanzoCatMenuWalker()
                        ))?>

                    
                </div>
                <div class="col-lg-6">
                    <div class="slider__data">
                        <div class="slider__list " data-flickity='{"wrapAround": true , "prevNextButtons": false, "pageDots": false }'>
                            <?php $home_slider = get_field('home_slider','option');
                                if(!empty($home_slider)):foreach ($home_slider as $slider):
                            ?>
                            <div class="slider__item">
                                <a href="<?= $slider['caption']?>">
                                    <img style="width: 100%; height: 100%;" src="<?= $slider['sizes']['large']?>" alt="<?= $slider['title']?>">
                                </a>
                            </div>
                                <?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="slider-img__list">
                    <?php $home_right_banner = get_field('home_right_banner','option');
                    if(!empty($home_right_banner)):foreach ($home_right_banner as $slider):
                        ?>
                        <a href="<?= $slider['caption']?>"><img class="img-fluid" src="<?= $slider['sizes']['large']?>" alt="<?= $slider['title']?>"></a>
                    <?php endforeach; endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end slider-->
    <!--slider mb-->
    <section class="silder-mb  d-lg-none d-md-block">
        <div class="slider__data">
            <div class="slider__list " data-flickity='{"wrapAround": true , "prevNextButtons": false, "pageDots": false }'>
                <div class="slider__item">
                    <a href="#">
                        <img style="width: 100%; height: 100%;" src="assets/images/BocThamMienPhi_1025x511.jpg" alt="">
                    </a>
                </div>
                <div class="slider__item">
                    <a href="#">
                        <img style="width: 100%; height: 100%;" src="assets/images/BocThamMienPhi_1025x511.jpg" alt="">
                    </a>
                </div>
            </div>
        </div> 
    </section>
    <!--end slider mb-->
    <section class="intro-nav d-lg-none d-md-block">
        <div class="container">
            <ul class="intro-nav__list">
                <li><a href="#">Gạch lát nền</a></li>
                <li><a href="#">Gạch ốp tường</a></li>
                <li><a href="#">Bồn cầu</a></li>
                <li><a href="#">Chậu lavabo</a></li>
                <li><a href="#">Sen vòi</a></li>
                <li><a href="#">Hút mùi</a></li>
                <li><a href="#">Bếp từ</a></li>
            </ul>
        </div>
    </section>
        <!--Product type 3 -->
        <section class="product product-type3 mb-2">
            <div class="container bg-white">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="product-title__sale d-lg-none">
                            <?php echo hanzo_svg('gift','18')?>Sản phẩm khuyến mãi
                        </h3>
                        <h3 class="product-type3__title d-none d-lg-block">SẢN PHẨM KHUYỄN MÃI</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div style="width: 100%" data-flickity='{ "draggable": false, "contain": true , "pageDots": false } '>
                            <?php
                                for($i = 0; $i <=8 ; $i++){
                                    echo '
                                    <div class="product__item product__item-slider">
                                        <a class="product__link" href="#">
                                            <div class="product__img">
                                                <img src="assets/images/combo-viglacera-4-1.jpg" alt="" class="img-fluid">
                                            </div>
                                            <div class="product__discount">-40%</div>
                                            <div class="product__name">Chậu lavabo dương bàn Viglacera V25</div>
                                            <span class="product__price">
                                                <del>
                                                    <span>Giá NY: 13.750.000 vnđ</span>
                                                </del>
                                                <ins>
                                                    <span>Giá 680.000 vnđ </span>
                                                </ins>
                                            </span>
                                        </a>
                                    </div>
                                    ';
                                } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End product type 3-->
        <!-- Product type 1-->
        <section class="product product-type1 mb-2">
            <div class="container bg-white">
                <div class="row">
                    <div class="col-lg-12 no-gutters-col">
                        <div class="product-tab__box d-none d-lg-block">
                            <ul class="product-tab">
                                <h2 class="product-tab__title">
                                    <a href="#">
                                        <?php echo hanzo_svg('menu-button-of-three-horizontal-lines','18')?>Thiết bị nhà bếp
                                    </a>
                                </h2>
                                <a class="product-tab__link btn" href="#">Vòi rửa bát</a>
                                <a class="product-tab__link btn" href="#">Vòi rửa bát</a>
                                <a class="product-tab__link btn" href="#">Vòi rửa bát</a>
                                <a class="product-tab__link btn" href="#">Vòi rửa bát</a>   
                                <a class="product-tab__link btn" href="#">Vòi rửa bát</a>
                            </ul>
                            <a href="#" class="product__link-more">Xem thêm ▼</a>
                        </div>
                        <div class="product-tab__mb d-lg-none">
                            <div class="product-tab__mb-box">
                                <h3 class="product-tab__mb-title">THIẾT BỊ NHÀ BẾP</h3>
                                <a href="#">Xem nhanh</a>
                            </div>
                            <ul class="product-tab__mb-list">
                                <li><a href="#">Sen tắm</a></li>
                                <li><a href="#">Sen tắm</a></li>
                                <li><a href="#">Sen tắm</a></li>
                                <li><a href="#">Sen tắm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 no-gutters-col product__grid d-none d-lg-block">
                        <div class="product-brand">
                            <ul class="product-brand__list">
                                <?php
                                    for($i = 0; $i<= 8; $i++){
                                        echo '
                                            <li><a href="#">Taka</a></li>
                                        ';
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="product-brand__img">
                            <img src="assets/images/phoi-canh-category-gach-lat-nen.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-9 ">
                        <div class="product__content">
                            <div class="product__list">
                                <?php
                                    for($i = 1; $i <=8; $i++){
                                        echo '
                                            <div class="product__item">
                                                <a class="product__link" href="#">
                                                    <div class="product__img">
                                                        <img src="assets/images/voi-rua-bat-cata-cma.jpg" alt="" class="img-fluid">
                                                    </div>
                                                    <div class="product__discount">-40%</div>
                                                    <div class="product__name">Chậu lavabo dương bàn Viglacera V25</div>
                                                    <span class="product__price">
                                                        <ins>
                                                            <span>Giá 680.000 vnđ </span>
                                                        </ins>
                                                    </span>
                                                </a>
                                            </div>
                                        ';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product type 1-->
        <!-- Product type 2 -->
        <section class="product product-type2 mb-2">
            <div class="container bg-white">
                <div class="row">
                    <div class="col-lg-12 no-gutters-col">
                        <div class="product-tab__box d-none d-lg-block">
                            <ul class="product-tab">
                                <h2 class="product-tab__title">
                                    <a href="#">
                                        <?php echo hanzo_svg('menu-button-of-three-horizontal-lines','18')?>Tủ chậu
                                    </a>
                                </h2>
                            </ul>
                            <a href="#" class="product__link-more">Xem thêm ▼</a>
                        </div>
                        <div class="product-tab__mb d-lg-none">
                            <div class="product-tab__mb-box">
                                <h3 class="product-tab__mb-title">TỦ CHẬU</h3>
                                <a href="#">Xem nhanh</a>
                            </div>
                            <ul class="product-tab__mb-list">
                                <li><a href="#">Sen tắm</a></li>
                                <li><a href="#">Sen tắm</a></li>
                                <li><a href="#">Sen tắm</a></li>
                                <li><a href="#">Sen tắm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-type2__list" data-flickity='{"draggable": true ,"freeScroll": true, "wrapAround": true }'>
                            <?php
                                for($i = 0; $i <=8 ; $i++){
                                    echo '
                                    <div class="product__item product__item-slider">
                                        <a class="product__link" href="#">
                                            <div class="product__img">
                                                <img src="assets/images/combo-viglacera-4-1.jpg" alt="" class="img-fluid">
                                            </div>
                                            <div class="product__discount">-40%</div>
                                            <div class="product__name">Chậu lavabo dương bàn Viglacera V25</div>
                                            <span class="product__price">
                                                <del>
                                                    <span>Giá NY: 13.750.000 vnđ</span>
                                                </del>
                                                <ins>
                                                    <span>Giá 680.000 vnđ </span>
                                                </ins>
                                            </span>
                                        </a>
                                    </div>
                                    ';
                                } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End product type 2 -->
        <!-- Product type 1-->
        <section class="product product-type1 mb-2">
            <div class="container bg-white">
                <div class="row">
                    <div class="col-lg-12 no-gutters-col">

                        <div class="product-tab__box d-none d-lg-block">
                            <ul class="product-tab">
                                <h2 class="product-tab__title">
                                    <a href="#">
                                        <?php echo hanzo_svg('menu-button-of-three-horizontal-lines','18')?>Thiết bị nhà bếp
                                    </a>
                                </h2>
                                <a class="product-tab__link btn" href="#">Vòi rửa bát</a>
                                <a class="product-tab__link btn" href="#">Vòi rửa bát</a>
                                <a class="product-tab__link btn" href="#">Vòi rửa bát</a>
                                <a class="product-tab__link btn" href="#">Vòi rửa bát</a>
                                <a class="product-tab__link btn" href="#">Vòi rửa bát</a>
                            </ul>
                            <a href="#" class="product__link-more">Xem thêm ▼</a>
                        </div>
                        
                        <div class="product-tab__mb d-lg-none">
                            <div class="product-tab__mb-box">
                                <h3 class="product-tab__mb-title">THIẾT BỊ VỆ SINH</h3>
                                <a href="#">Xem nhanh</a>
                            </div>
                            <ul class="product-tab__mb-list">
                                <li><a href="#">Sen tắm</a></li>
                                <li><a href="#">Sen tắm</a></li>
                                <li><a href="#">Sen tắm</a></li>
                                <li><a href="#">Sen tắm</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 no-gutters-col product__grid d-none d-lg-block">
                        <div class="product-brand">
                            <ul class="product-brand__list">
                                <?php
                                    for($i = 0; $i<= 8; $i++){
                                        echo '
                                            <li><a href="#">Taka</a></li>
                                        ';
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="product-brand__img">
                            <img src="assets/images/phoi-canh-category-gach-lat-nen.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-9 ">
                        <div class="product__content">
                            <div class="product__list">
                                <?php
                                    for($i = 1; $i <=8; $i++){
                                        echo '
                           
                                            <div class="product__item">
                                                <a class="product__link" href="#">
                                                    <div class="product__img">
                                                        <img src="assets/images/voi-rua-bat-cata-cma.jpg" alt="" class="img-fluid">
                                                    </div>
                                                    <div class="product__discount">-40%</div>
                                                    <div class="product__name">Chậu lavabo dương bàn Viglacera V25</div>
                                                    <span class="product__price">
                                                    <del>
                                                        <span>Giá NY: 13.750.000 vnđ</span>
                                                    </del>
                                                    <ins>
                                                        <span>Giá 680.000 vnđ </span>
                                                    </ins>
                                                </span>
                                                </a>
                                            </div>
                                        ';
                                    };
                                ?>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Product type 1-->
        <!-- New -->
        <section class="new mb-2">
            <div class="container bg-white">
               <div class="row">
               <div class="new-grid">
                    <div class="new-grid__item">
                        <div class="new-construction__data">
                            <div class="new__board">
                                <h3 class="new__title">DỰ ÁN ĐÃ LÀM</h3>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="new-construction__box">
                                        <a href="">
                                            <div class="new-construction__img">
                                                <img src="assets/images/du-an-tech-444x273.jpg" alt="">
                                            </div>
                                            <div class="new-construction__text">
                                                <h4 class="new-construction__title">Dự án Stech, KCN Bỉm Sơn, Thị xã Bỉm Sơn, Thanh Hóa</h4>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="new-construction__box">
                                        <a href="">
                                            <div class="new-construction__img">
                                                <img src="assets/images/du-an-tech-444x273.jpg" alt="">
                                            </div>
                                            <div class="new-construction__text">
                                                <h4 class="new-construction__title">Dự án Stech, KCN Bỉm Sơn, Thị xã Bỉm Sơn, Thanh Hóa</h4>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="new-construction__box">
                                        <a href="">
                                            <div class="new-construction__img">
                                                <img src="assets/images/du-an-tech-444x273.jpg" alt="">
                                            </div>
                                            <div class="new-construction__text">
                                                <h4 class="new-construction__title">Dự án Stech, KCN Bỉm Sơn, Thị xã Bỉm Sơn, Thanh Hóa</h4>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="new-construction__box">
                                        <a href="">
                                            <div class="new-construction__img">
                                                <img src="assets/images/du-an-tech-444x273.jpg" alt="">
                                            </div>
                                            <div class="new-construction__text">
                                                <h4 class="new-construction__title">Dự án Stech, KCN Bỉm Sơn, Thị xã Bỉm Sơn, Thanh Hóa</h4>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <a class="new-construction__link-more" href="#">Xem thêm ▼</a>
                        </div>
                    </div>
                    <div class="new-grid__item">
                        <div class="new-post__data">
                            <div class="new__board">
                                <h3 class="new__title">DỰ ÁN ĐÃ LÀM</h3>
                            </div>

                            <ul class="new-post__list">
                                <li>
                                    <div class="new-post__item">
                                        <div class="new-post__img">
                                            <img src="assets/images/gach-Dong-Tam-loai-2-2-444x444.jpg" alt="">
                                        </div>
                                        <div class="new-post__info">
                                            <div class="new-post__title"><a href="#">Cách phân biệt gạch Đồng Tâm loại 2 với loại 1 (Gạch Đồng Tâm A và AA)</a></div>
                                            <div class="new-post__date">12-4-2021</div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new-post__item">
                                        <div class="new-post__img">
                                            <img src="assets/images/gach-Dong-Tam-loai-2-2-444x444.jpg" alt="">
                                        </div>
                                        <div class="new-post__info">
                                            <div class="new-post__title"><a href="#">Cách phân biệt gạch Đồng Tâm loại 2 với loại 1 (Gạch Đồng Tâm A và AA)</a></div>
                                            <div class="new-post__date">12-4-2021</div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new-post__item">
                                        <div class="new-post__img">
                                            <img src="assets/images/gach-Dong-Tam-loai-2-2-444x444.jpg" alt="">
                                        </div>
                                        <div class="new-post__info">
                                            <div class="new-post__title"><a href="#">Cách phân biệt gạch Đồng Tâm loại 2 với loại 1 (Gạch Đồng Tâm A và AA)</a></div>
                                            <div class="new-post__date">12-4-2021</div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="new-post__item">
                                        <div class="new-post__img">
                                            <img src="assets/images/gach-Dong-Tam-loai-2-2-444x444.jpg" alt="">
                                        </div>
                                        <div class="new-post__info">
                                            <div class="new-post__title"><a href="#">Cách phân biệt gạch Đồng Tâm loại 2 với loại 1</a></div>
                                            <div class="new-post__date">12-4-2021</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <a class="new-construction__link new-construction__link-more" href="#">Xem thêm ▼</a>
                        </div>
                    </div>
                </div>
               </div>
            </div>
        </section>
        <!-- End New -->
        
        <!-- Partner -->
        <section class="partner">
            <div class="partner__bg">
                <div class="container">
                    <h4 class="partner__title">Đối tác & khách hàng thân thiết.</h4>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="partner__list" data-flickity='{ "contain": true , "cellAlign": "left", "prevNextButtons":false,"pageDots":false,"autoPlay": 2500 }'>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>
                        <div class="partner__item">
                            <img src="assets/images/doi-tac-3.jpg" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- END Partner -->
    </main>

<?php get_footer()?>