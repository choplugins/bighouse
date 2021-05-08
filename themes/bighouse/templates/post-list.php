<div class="new-post__item">
    <div class="new-post__img">
        <a href="<?= get_permalink($args['post'])?>" title="<?= get_the_title($args['post'])?>">
        <img src="<?= get_the_post_thumbnail_url($args['post'],'medium')?>" alt="<?= get_the_title($args['post'])?>"></a>
    </div>
    <div class="new-post__info">
        <div class="new-post__title"><a href="<?= get_permalink($args['post'])?>" title="<?= get_the_title($args['post'])?>"><?= get_the_title($args['post'])?></a></div>
        <div class="new-post__date"><?= get_the_date('d-m-Y',$args['post'])?></div>
    </div>
</div>