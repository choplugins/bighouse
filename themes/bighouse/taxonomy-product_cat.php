<?php get_header()?>

<main class="wrapper-content">
    <section class="product">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-md-12 no-gutters-col">
                    <?php if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                    }?>
                    <div class="wrapper">
                        <h1 class="post-detail__title post-detail__title-type"> <?php
                            $term = get_term_by( 'term_id', get_queried_object_id(), get_query_var( 'taxonomy' ) ); echo $term->name;?>
                        </h1>
                        <div class="category__box">
                            <div class="desc"><?= term_description(get_queried_object_id()) ?></div>
                            <?php $childs = get_term_children(get_queried_object_id(),'product_cat'); if(!empty($childs)):?>
                            <div class="category__list">
                                <div class="category__item">
                                    <?php foreach ($childs as $child):?>
                                    <a href="<?= get_term_link($child,'product_cat')?>"><?= get_term_by('term_id',$child,'product_cat')->name?></a>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <?php endif;?>
                        </div>

                        <div class="product__list mt-5">
                            <?php while(have_posts()){
                                the_post();
                                get_template_part('templates/product','grid',['item'=>$post]);
                            }?>
                        </div>
                        <div class="text-center">
                            <div class="hazo-pagination">
                                <?php wp_pagenavi(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 d-none d-md-none d-lg-block">
                    <aside class="sidebar">
                        <?php get_template_part('templates/post','sidebar')?>
                        <?php dynamic_sidebar('product-category')?>

                    </aside>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer()?>
