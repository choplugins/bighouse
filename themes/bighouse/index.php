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
                <?php if(!empty($home_slider)):foreach ($home_slider as $slider):
                ?>
                <div class="slider__item">
                    <a href="<?= $slider['caption']?>">
                        <img style="width: 100%; height: 100%;" src="<?= $slider['sizes']['large']?>" alt="<?= $slider['title']?>">
                    </a>
                </div>
                <?php endforeach; endif; ?>
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

        <?php $promotions = get_posts(array(
                'post_type' => 'product',
                'posts_per_page' => 7,
                'meta_query' => array(
                    array(
                        'key' => '_sale_price',
                        'value' => 0,
                        'compare' => '>=',
                    )
                )
        )) ?>
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
                            <?php if(!empty($promotions)){
                                foreach ($promotions as $item){
                                    get_template_part('templates/product','item',['item'=>$item]);
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
           $home_cats = get_field('home_categories','option');
           if(!empty($home_cats)): foreach ($home_cats as $k => $cat):
               $cat_ob = get_term($cat,'product_cat');
               if($k==1):
                   ?>
                   <section class="product product-type2 mb-2">
                   <div class="container bg-white">
                       <div class="row">
                           <div class="col-lg-12 no-gutters-col">
                               <div class="product-tab__box d-none d-lg-block">
                                   <ul class="product-tab">
                                       <h2 class="product-tab__title">
                                           <a href="<?= get_term_link($cat_ob,'product_cat')?>">
                                               <?php echo hanzo_svg('menu-button-of-three-horizontal-lines','18')?><?= $cat_ob->name ?>
                                           </a>
                                       </h2>
                                   </ul>
                                   <a href="<?= get_term_link($cat_ob,'product_cat')?>" class="product__link-more">Xem thêm ▼</a>
                               </div>
                               <div class="product-tab__mb d-lg-none">
                                   <div class="product-tab__mb-box">
                                       <h3 class="product-tab__mb-title text-uppercase"><?= $cat_ob->name ?></h3>
                                       <a href="<?= get_term_link($cat_ob,'product_cat')?>">Xem nhanh</a>
                                   </div>
                                   <?php $childs = get_term_children($cat_ob->term_id,'product_cat');if(!empty($childs)):?>
                                   <ul class="product-tab__mb-list">
                                        <?php foreach ($childs as $child):?>
                                       <li><a href="<?= get_term_link($child,'product_cat')?>"><?= get_term_by('term_id',$child,'product_cat')->name?></a></li>
                                        <?php endforeach;?>
                                   </ul>
                                    <?php endif;?>
                               </div>
                           </div>
                       </div>
                       <?php $pro_cats = get_posts(array(
                               'post_type' => 'product',
                                'posts_per_page' => 10,
                                'tax_query' => array(
                                        array(
                                                'taxonomy' => 'product_cat',
                                                'field' => 'term_id',
                                                'terms' => $cat
                                        )
                                )
                       ));?>
                       <div class="row">
                           <div class="col-12">
                               <div class="product-type2__list" data-flickity='{"draggable": true ,"freeScroll": true, "wrapAround": true }'>
                                   <?php if(!empty($pro_cats)){
                                       foreach ($pro_cats as $item){
                                           get_template_part('templates/product','item',['item'=>$item]);
                                       }
                                   }
                                   ?>
                               </div>
                           </div>
                       </div>
                   </div>
                   </section>
           <?php else:?>
                   <section class="product product-type1 mb-2">
                       <div class="container bg-white">
                           <div class="row">
                               <div class="col-lg-12 no-gutters-col">
                                   <div class="product-tab__box d-none d-lg-block">
                                       <ul class="product-tab">
                                           <h2 class="product-tab__title">
                                               <a href="<?= get_term_link($cat_ob,'product_cat')?>">
                                                   <?php echo hanzo_svg('menu-button-of-three-horizontal-lines','18')?><?= $cat_ob->name?>
                                               </a>
                                           </h2>
                                           <?php $childs = get_term_children($cat_ob->term_id,'product_cat');?>
                                           <?php foreach ($childs as $child):?>
                                               <a class="product-tab__link btn" href="<?= get_term_link($child,'product_cat')?>"><?= get_term_by('term_id',$child,'product_cat')->name?></a>
                                           <?php endforeach;?>
                                       </ul>
                                       <a href="<?= get_term_link($cat_ob,'product_cat')?>" class="product__link-more">Xem thêm ▼</a>
                                   </div>
                                   <div class="product-tab__mb d-lg-none">
                                       <div class="product-tab__mb-box">
                                           <h3 class="product-tab__mb-title">THIẾT BỊ NHÀ BẾP</h3>
                                           <a href="<?= get_term_link($cat_ob,'product_cat')?>">Xem nhanh</a>
                                       </div>
                                       <?php if(!empty($childs)):?>
                                           <ul class="product-tab__mb-list">
                                               <?php foreach ($childs as $child):?>
                                                   <li><a href="<?= get_term_link($child,'product_cat')?>"><?= get_term_by('term_id',$child,'product_cat')->name?></a></li>
                                               <?php endforeach;?>
                                           </ul>
                                       <?php endif;?>
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
           <?php endif; endforeach; endif;?>

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