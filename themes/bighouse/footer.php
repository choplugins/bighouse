    
     
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
                        <?php dynamic_sidebar('bottom-footer-1')?>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <?php dynamic_sidebar('bottom-footer-2')?>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <?php dynamic_sidebar('bottom-footer-3')?>
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