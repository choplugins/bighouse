<?php 
    include 'header.php'
?>
    <main class="wrapper-content">
        <section class="post">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-md-12 no-gutters-col">
                        <nav aria-label="breadcrumbs" class="rank-math-breadcrumb">
                            <p>
                              <a href="index.php">Trang chủ</a>
                              <span class="separator">»</span>
                              <span class="last">Tin tức - Sự kiện</span>
                            </p>
                        </nav>
                        <div class="wrapper">
                            <h1 class="post-detail__title post-detail__title-type"> Vertu là một phụ kiện vô cùng chất với đàn ông thành đạt</h1>
                            <div class="news-detail-inner ws-sgct">
                                demo code
                            </div>
                           


                 
                            <!-- post-other -->
                            
                            <div class="post-other">
                                <div class="post-other__title">
                                    <div class="post-other__tab text-uppercase">Bài viết mới nhất</div>
                                </div>

                                <div class="post-other__list" data-flickity='{ "freeScroll": true, "contain": true, "pageDots": false }'>
                                    <?php
                                        for($i = 0; $i < 5 ; $i++){
                                            echo '
                                                <a href="#" class="post-other__item">
                                                    <div class="post-other__img">
                                                        <img src="assets/images/dai-ly-gach-dong-tam-tai-hai-phong-444x444.jpg" alt="">
                                                    </div>
                                                    <div class="post-other__name">
                                                        Đại lý gạch Đồng Tâm tại Hải Phòng uy tín – giá tốt nhất 2021
                                                    </div>
                                                </a>
                                            ';
                                        }
                                    ?>
                                </div>
                            </div>
                            <!-- end post-other -->
                            
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

                            <div class="sidebar__item">
                                <div class="sidebar__title">Bài viết liên quan</div>
                                <ul class="sidebar__list sidebar__list-post">
                                    <li>
                                        <div class="sidebar__list-post__item">
                                            <a href="#" class="sidebar__list-post__img">
                                                <img src="assets/images/ban-da-lavabo.jpg" alt="">
                                            </a>
                                            <div class="sidebar__list-post__title">
                                                <a href="#">20+ Mẫu bàn đá lavabo – chậu rửa mặt bàn đá không bao giờ lỗi Mốt</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar__list-post__item">
                                            <a href="#" class="sidebar__list-post__img">
                                                <img src="assets/images/ban-da-lavabo.jpg" alt="">
                                            </a>
                                            <div class="sidebar__list-post__title">
                                                <a href="#">20+ Mẫu bàn đá lavabo – chậu rửa mặt bàn đá không bao giờ lỗi Mốt</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar__list-post__item">
                                            <a href="#" class="sidebar__list-post__img">
                                                <img src="assets/images/ban-da-lavabo.jpg" alt="">
                                            </a>
                                            <div class="sidebar__list-post__title">
                                                <a href="#">20+ Mẫu bàn đá lavabo – chậu rửa mặt bàn đá không bao giờ lỗi Mốt</a>
                                            </div>
                                        </div>
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
    include 'footer.php'
?>