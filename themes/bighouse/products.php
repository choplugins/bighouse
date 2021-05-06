<?php 
    include 'header.php';
?>
<main class="wrapper-content">
    <section class="product">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-md-12 no-gutters-col">
                    <?php  include 'layouts/breadcrumb.php'?>
                    <div class="wrapper">
                        <h1 class="post-detail__title post-detail__title-type"> Vertu là một phụ kiện vô cùng chất với đàn ông thành đạt</h1>
                        <div class="category__box">
                            <p><strong><a href="#">Chậu rửa mặt</a></strong> hay còn có tên gọi khác là <strong>chậu lavabo</strong> là sản phẩm không thể thiếu trong kiến trúc nhà tắm, nhà vệ sinh. Hiện nay, nhờ công nghệ phát triển mà các thương hiệu cho ra đời những sản phẩm với nhiều mẫu mã khác nhau. Hơn nữa, các sản phẩm có chất lượng cao và hiện đại đang là xu hướng hiện nay. Vì số lượng mẫu mã ngày càng tăng nên <strong>giá chậu lavabo</strong> có mức cạnh tranh cao. Để giúp bạn tìm được sản phẩm chính hãng phù hợp với gia đình mình. Big House mời các bạn tham khảo những <a href="#">mẫu thiết bị vệ sinh</a> chậu rửa mới với giá thành tốt nhất ngay dưới đây.</p>
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

<?php 
    include 'footer.php';
?>