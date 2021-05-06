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
                        <h1 class="product-detail__title"> Vertu là một phụ kiện vô cùng chất với đàn ông thành đạt</h1>

                        <div class="product-detail">
                            <div class="row">
                                <div class="col-xl-5">
                                    <div class="product-detail__img">
                                        <div class="product__img">
                                            <img src="assets/images/voi-rua-bat-cata-cma.jpg" alt="" >
                                        </div>
                                        <div class="product__discount">-40%</div>
                                    </div>
                                </div>
                                <div class="col-xl-7">
                                    <div class="product-detail__content">
                                        <span class="product__price">
                                            <del>
                                                <span>Giá NY: 13.750.000 vnđ</span>
                                            </del>
                                            <ins>
                                                <span>Giá 680.000 vnđ </span>
                                            </ins>
                                        </span>

                                        <div class="product-detail__short-desc ws-sgct">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Mã Sản Phẩm</strong></td>
                                                        <td>SC 6032</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Thương hiệu</strong></td>
                                                        <td>Bancoot</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Xuất xứ</strong></td>
                                                        <td>Chính hãng</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Chất liệu</strong></td>
                                                        <td>Đồng mạ NiKen 5 lớp và Crom</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Bảo hành</strong></td>
                                                        <td>3 năm</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Đơn Vị Tính</strong></td>
                                                        <td>Bộ</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="product-detail__action">
                                            <div class="product-detail__action-buy">
                                                <button type="submit" name="add-to-cart" class="btn btn-detail btn-detail__buy">
                                                    <?php echo hanzo_svg('shopping-cart','32')?>
                                                    Mua Hàng
                                                </button>
                                            </div>
                                            <div class="product-detail__action-call">
                                                <a class="btn btn-detail btn-detail__call" href="tel:0869559495">0869.559.495</a>
                                            </div>
                                            <div class="product-detail__action-notify">
                                                <button class="btn btn-detail btn-detail__notify"><?php echo hanzo_svg('download','30')?>Nhận báo giá</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-detail__info">
                            <ul class="nav nav-pills" id="product-detail-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="product-detail-info-tab" data-toggle="pill" href="#product-detail-info" role="tab" aria-controls="product-detail-info" aria-selected="true">Thông tin bổ sung ▼	</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="product-comment-tab" data-toggle="pill" href="#product-comment" role="tab" aria-controls="product-comment" aria-selected="false">Đánh giá sản phẩm ▼</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-product-detail-content">
                                <div class="tab-pane fade active show" id="product-detail-info" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="info__detail ws-sgct">
                                        <p>Xuất xứ : Nokia Chính Hãng</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="product-comment" role="tabpanel" aria-labelledby="product-comment-tab">
                                    <div class="info__detail ws-sgct">
                                        <p>Xuất xứ : Nokia Chính Hãng</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="post-other">
                            <div class="post-other__title">
                                <div class="post-other__tab text-uppercase">Sản phẩm cùng loại</div>
                            </div>
                            <div class="product__list">
                                <?php 
                                for($i=1 ; $i <=8; $i++){
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
                                        </div>';
                                    }

                                ?>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-load__more">Xem thêm ▼</button>
                            </div>
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