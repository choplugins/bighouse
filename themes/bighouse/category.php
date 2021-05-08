<?php get_header()?>
<main class="wrapper-content">
    <section class="post">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-md-12 no-gutters-col">
                    <nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
                       <?php if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                        }?>
                    </nav>
                    <div class="wrapper">
                        <h1 class="section__title section__title-cate">
                            <div class="section__tab text-uppercase"><?= single_cat_title()?></div>
                        </h1>
                        <?php
                        if(have_posts()):  while (have_posts()):
                                the_post();
                                get_template_part('templates/category-post','item',['post'=>$post]); ?>

                          <?php endwhile; endif; ?>
                        <div class="hazo-pagination">
                            <?php wp_pagenavi(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 d-none d-md-none d-lg-block">
                    <aside class="sidebar">
                   <?php get_template_part('templates/post','sidebar')?>
                    </aside>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer()?>