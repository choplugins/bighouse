
    <?php $cats = get_terms(
        array(
            'taxonomy' => 'product_cat',
            'hide_empty' => true
        )
    )?>
    <div class="sidebar__item">
        <div class="sidebar__title text-uppercase">Danh mục sản phẩm</div>
        <?php if(!empty($cats)):?>
        <ul class="sidebar__list">
            <?php foreach ($cats as $cat):?>
            <li><a href="<?= get_term_link($cat,'product_cat')?>" class="text-uppercase"><?= $cat->name ?></a>
                <?php $childs = get_term_children($cat->term_id,'product_cat');if(!empty($childs)):?>
                <ul class="sidebar__collapsed">
                    <?php foreach ($childs as $child):?>
                    <li><a href="<?= get_term_link($child,'product_cat') ?>">
                            <span class="sidebar__divider">»</span> <?= get_term_by('term_id',$child,'product_cat')->name ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
