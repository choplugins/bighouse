<?php $pro = wc_get_product($args['item'])?>
<div class="product__item product__item-slider">
    <a class="product__link" href="<?= get_permalink($args['item'])?>">
        <div class="product__img">
            <img src="<?= get_the_post_thumbnail_url($args['item'],'medium')?>" alt="<?= get_the_title($args['item'])?>" class="img-fluid">
        </div>
        <?php if($pro->is_on_sale()):?>
        <?php $percentage = round( ( ( $pro->regular_price - $pro->sale_price ) / $pro->regular_price ) * 100 );?>
        <div class="product__discount">-<?= $percentage?>%</div>
        <?php endif;?>
        <div class="product__name"><?= get_the_title($args['item'])?></div>
        <span class="product__price">
            <?php if($pro->is_on_sale()):?>
            <del>
                <span>Giá NY: <?= wc_price($pro->get_sale_price())?></span>
            </del>
            <?php endif; ?>
            <ins>
                <span><?= wc_price($pro->get_price())?></span>
            </ins>
        </span>
    </a>
</div>