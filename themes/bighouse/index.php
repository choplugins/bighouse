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
                                           <h3 class="product-tab__mb-title"><?= $cat_ob->name?></h3>
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
                                   <?php
                                   $brands = hanzo_get_brand_from_product_category($cat_ob->term_id);
                                   if(!empty($brands)):
                                   ?>
                                   <div class="product-brand">
                                       <ul class="product-brand__list">

                                            <?php foreach ($brands as $brand):?>

                                            <li><a href="<?= get_term_link($brand->slug,'pwb-brand')?>"><?= $brand->name?></a></li>

                                           <?php endforeach;?>
                                       </ul>
                                   </div>
                                   <?php endif ?>
                                   <div class="product-brand__img">
                                       <?php $thumbnail_id = get_term_meta($cat_ob->term_id, 'thumbnail_id', true); ?>
                                       <img src="<?= wp_get_attachment_image_src( $thumbnail_id,'large' )[0]?>" alt="" class="img-fluid">
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
                               <div class="col-lg-9 ">
                                   <div class="product__content">
                                       <div class="product__list">
                                           <?php if(!empty($pro_cats)){
                                               foreach ($pro_cats as $item){
                                                   get_template_part('templates/product','grid',['item'=>$item]);
                                               }
                                           }
                                           ?>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </section>
           <?php endif; endforeach; endif;?>

        <?php
            $projects = get_posts(
                    array(
                            'post_type' => 'post',
                            'posts_per_page' => 4,
                            'category_name' => 'du-an'
                    )
            );
            $news = get_posts(
                array(
                    'post_type' => 'post',
                    'posts_per_page' => 4,
                    'category_name' => 'tin-tuc'
                )
            );
        ?>
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
                                <?php if(!empty($projects)): foreach ($projects as $project):?>
                                <?php get_template_part('templates/post','grid',['class'=>'col-lg-6 col-sm-6','post'=>$project])?>
                                <?php endforeach; endif; ?>

                            </div>
                            <a class="new-construction__link-more" href="<?= get_term_link('du-an','category')?>">Xem thêm ▼</a>
                        </div>
                    </div>
                    <div class="new-grid__item">
                        <div class="new-post__data">
                            <div class="new__board">
                                <h3 class="new__title">TIN TỨC & SỰ KIỆN</h3>
                            </div>
                            <ul class="new-post__list">
                                <?php if(!empty($news)): foreach ($news as $item):?>
                                <li>
                                    <?php get_template_part('templates/post','list',['post'=>$item])?>
                                </li>
                                <?php endforeach; endif; ?>

                            </ul>
                            <a class="new-construction__link new-construction__link-more" href="<?= get_term_link('tin-tuc','category')?>">Xem thêm ▼</a>
                        </div>
                    </div>
                </div>
               </div>
            </div>
        </section>

        <?php $clients = get_field('clients','option')?>
        <section class="partner">
            <div class="partner__bg">
                <div class="container">
                    <h4 class="partner__title">Đối tác & khách hàng thân thiết.</h4>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="partner__list" data-flickity='{ "contain": true , "cellAlign": "left", "prevNextButtons":false,"pageDots":false,"autoPlay": 2500 }'>
                        <?php if(!empty($clients)): foreach ($clients as $client):?>
                        <div class="partner__item">
                            <img src="<?= $client['sizes']['large']?>" alt="<?= $client['title']?>">
                        </div>
                        <?php endforeach; endif;?>

                    </div>
                </div>
            </div>
        </section>
        <!-- END Partner -->
    </main>

<?php get_footer()?>