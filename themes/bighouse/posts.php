<?php
    include 'header.php';
?>
    <main class="wrapper-content">
        <section class="post">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-md-12 no-gutters-col">
                        <?php include 'layouts/breadcrumb.php' ?>
                        <div class="wrapper">
                            <h1 class="section__title section__title-cate">
                                <div class="section__tab text-uppercase">Tin tức</div>
                            </h1>
                            <?php
                                for ($i=0; $i < 6; $i++) { 
                                    echo '
                                    <div class="post__item">
                                        <a href="#" class="post__item-img">
                                            <img src="assets/images/gach-Dong-Tam-loai-2-2-444x444.jpg" alt="">
                                        </a>
                                        <div class="post__item-content">
                                            <a href="#" class="post__item-title">Cách phân biệt gạch Đồng Tâm loại 2 với loại 1 (Gạch Đồng Tâm A và AA)</a>
                                            <p class="post__item-desc">
                                                Trên thị trường hiện nay, thương hiệu Đồng Tâm cung cấp 2 loại gạch là gạch Đồng Tâm loại 2 và loại 1 (loại A và AA) với những điểm khác biệt đáng kể. Tuy nhiên,...
                                            </p>
                                        </div>
                                    </div>
                                    ';
                                }
                            ?>
                            <div class="hazo-pagination">
                                <ul>
                                  <li><a href=""><</a></li>
                                  <li class="active"><a href="">1</a>
                                  </li>
                                  <li><a href="">2</a></li>
                                  <li><a href="">3</a></li>
                                  <li><a href="">></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 d-none d-md-none d-lg-block">
                        <aside class="sidebar">
                            <div class="sidebar__item">
                                <div class="sidebar__title">Danh mục sản phẩm</div>
                                <ul class="sidebar__list">
                                    <li><a href="#">GẠCH ỐP LÁT</a>
                                        <ul class="sidebar__collapsed">
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">THIẾT BỊ VỆ SINH</a>
                                        <ul class="sidebar__collapsed">
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">THIẾT BỊ BẾP</a>
                                        <ul class="sidebar__collapsed">
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                            <li><a href=""><span class="sidebar__divider">»</span> Gạch lát nền</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="sidebar__item">
                                <div class="sidebar__title text-uppercase">Thiết bị vệ sinh</div>
                                <ul class="sidebar__list sidebar__list-type">
                                    <li><a href="#">Bộ phụ kiện 6 món</a>
                                    </li>
                                    <li><a href="#">Bộ phụ kiện 6 món</a>
                                    </li>
                                    <li><a href="#">Bộ phụ kiện 6 món</a>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
    include 'footer.php';
?>
