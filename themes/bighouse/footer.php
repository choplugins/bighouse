    
     
        <!-- form báo giá -->
        <div class="pop-form">
            <div class="pop-form__box">
                <div class="pop-form__message">
                    <img src="assets/images/head-logo.png" alt="">
                    <div class="pop-form__title">
                    <p>đăng ký <b>tư vấn miễn phí</b></p>  
                    </div>
                </div>
                <div class="pop-form__form">
                    <form action="#">
                            <input id="iname" name="iname" type="textbox" placeholder="Họ tên*:">
                            <input id="imob" name="imob" type="textbox" placeholder="Điện thoại*:">
                            <input id="iemail" name="iemail" type="textbox" placeholder="Email:">
                            <textarea id="itext" type="hidden" name="itext" placeholder="Nhu cầu tư vấn"></textarea>
                            <button type="submit">Hoàn thành</button>
                        </div>
                    </form>
                    <div class="pop-form__sol"><p><a href="tel:0869559495"> Tổng đài tư vấn: 0869.559.495</a></p></div>
                    <div class="pop-form__close">X</div>
                </div>
            </div>
        </div>
     <!-- Footer -->
     <footer class="footer" id="footer">
        <!-- footer top -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <?php dynamic_sidebar('top-footer')?>
                </div>
            </div>
        </div>
        <!-- footer bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <div class="footer-bottom__box">
                            <div class="footer-bottom__logo">
                                <img src="assets/images/head-logo.png" alt="">
                            </div>
                            <ul class="footer-bottom__certification">
                                <li><img src="assets/images/ft2-1.png" alt=""></li>
                                <li><img src="assets/images/ft2-2.png" alt=""></li>
                                <li><img src="assets/images/dmca_protected_sml_120m.png" alt=""></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="footer-bottom__box">
                            <h3 class="footer-bottom__title">BIG HOUSE HÀ NỘI</h3>
                            <ul class="footer-bottom__list">
                                <li>Công ty TNHH xây dựng và hạ tầng Ngôi Nhà Lớn</li>
                                <li>Showroom 1: 97 Hoàng Quốc Việt, Quận Cầu Giấy, Hà Nội</li>
                                <li>Showroom 2: 99 Hoàng Quốc Việt, Quận Cầu Giấy, Hà Nội</li>
                                <li>Showroom 3: 95 Hoàng Quốc Việt, Quận Cầu Giấy, Hà Nội</li>
                                <li>Showroom 4: C3.23 Lê Trọng Tấn, Hà Đông, Hà Nội (Coming soon)</li>
                                <li>ĐT: 0869.559.495 - 1900.3323</li>
                                <li>Email : ngoinhalonhanoi@gmail.com</li>
                                <li>MST: 0101678313</li>
                                <li>STK: 19128340076017 - NH Techcombank - CN Hoàng Quốc Việt</li>
                                <li>Website: https://bighousevietnam.com</li>
                            </ul>
                            <a class="footer-bottom__link" href="#">Xem bản đồ</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="footer-bottom__box">
                            <h3 class="footer-bottom__title">BIG HOUSE TP HCM</h3>
                            <ul class="footer-bottom__list">
                                <li>Công ty TNHH Xây dựng và Hạ tầng Ngôi Nhà Lớn</li>
                                <li>Đ/C: 30/14 Nguyễn Văn Công, Phường 3, Quận Gò Vấp, TP HCM</li>
                                <li>Email : ngoinhalonhanoi@gmail.com</li>
                                <li>MST: 0101678313</li>
                                <li>STK: 19128340076017 - NH Techcombank - CN Hoàng Quốc Việt</li>
                                <li>ĐT: 0869.559.495 - 1900.3323</li>
                                <li><strong><a style="color: #ff9900;" href="#" target="_blank" rel="noopener">FACEBOOK</a>&nbsp;
                                    |                                &nbsp;
                                    <a style="color: #ff9900;" href="#" target="_blank" rel="noopener">YOUTUBE</a></strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-mb__contact">
            <a id="btn-form" href="#"><?php echo hanzo_svg('edit','12')?> TV/Báo giá</a>
            <a href="tel:0869559495"><?php echo hanzo_svg('call','12')?>0869.559.495</a>
        </div>
    </footer>

    <!-- back to top -->
    <div class="backToTop show__backToTop">
        <?php echo hanzo_svg('down-arrow','18')?>
    </div>
    <?php wp_footer()?>

</body>
</html>