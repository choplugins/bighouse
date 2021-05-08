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
                        <h1 class="post-detail__title post-detail__title-type"> <?php single_post_title()?></h1>
                        <div class="news-detail-inner ws-sgct">
                            <?php the_content() ?>
                        </div>
                        <div class="post-other">
                            <div class="post-other__title">
                                <div class="post-other__tab text-uppercase">Bài viết mới nhất</div>
                            </div>
                            <?php $recents = get_posts(array('post_type'=>'post','posts_per_page'=>6));?>
                            <div class="post-other__list" data-flickity='{ "freeScroll": true, "contain": true, "pageDots": false }'>
                                <?php foreach ($recents as $recent):?>
                                        <a href="<?= get_permalink($recent)?>" class="post-other__item">
                                            <div class="post-other__img">
                                                <img src="<?= get_the_post_thumbnail_url($recent,'medium')?>" alt="<?= get_the_title()?>">
                                            </div>
                                            <div class="post-other__name"><?= get_the_title()?></div>
                                        </a>
                               <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- end post-other -->

                    </div>

                </div>
                <div class="col-xl-3 d-none d-md-none d-lg-block">
                    <aside class="sidebar">

                        <?php get_template_part('templates/post','sidebar'); $cat = wp_get_post_categories($post->ID);?>
                        <?php $related = get_posts(array('post_type'=>'post','posts_per_page'=>6,'exclude' => $post->ID,'category'=>$cat[0]));?>
                        <div class="sidebar__item">
                            <div class="sidebar__title">Bài viết liên quan</div>
                            <ul class="sidebar__list sidebar__list-post">
                                <?php if(!empty($related)): foreach ($related as $item):?>
                                <li>
                                    <div class="sidebar__list-post__item">
                                        <a href="<?= get_permalink($item)?>" class="sidebar__list-post__img">
                                            <img src="<?= get_the_post_thumbnail_url($item,'medium')?>" alt="<?= get_the_title($item)?>">
                                        </a>
                                        <div class="sidebar__list-post__title">
                                            <a href="<?= get_permalink($item)?>"><?= get_the_title($item)?></a>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach;endif;?>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer()?>