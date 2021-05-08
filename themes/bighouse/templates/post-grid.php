
<div class="<?= $args['class']?>">
    <div class="new-construction__box">
        <a href="<?= get_permalink($args['post'])?>" title="<?= get_the_title($args['post'])?>">
            <div class="new-construction__img">
                <img src="<?= get_the_post_thumbnail_url($args['post'],'medium')?>" alt="<?= get_the_title($args['post'])?>">
            </div>
            <div class="new-construction__text">
                <h4 class="new-construction__title"><?= get_the_title($args['post'])?></h4>
            </div>
        </a>
    </div>
</div>