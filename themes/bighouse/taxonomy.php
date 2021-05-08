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
                            <?= term_description(get_queried_object_id()) ?>
                            <div class="category__list">
                                <?php
                                for($i=0 ; $i <=8; $i++ ){
                                    echo '
                                    <div class="category__item">
                                        <a href="#">Bồn Cầu 1 Khối</a>
                                    </div>
                                    ';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="product__list mt-5">
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
                        <div class="text-center">
                            <button class="btn btn-load__more">Xem thêm ▼</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 d-none d-md-none d-lg-block">
                    <?php include 'layouts/sidebar-product.php' ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer()?>
