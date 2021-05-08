
<div class="post__item">
    <a href="<?= get_permalink($args['post'])?>" class="post__item-img" title="<?= get_the_title($args['post'])?>">
        <img src="<?= get_the_post_thumbnail_url($args['post'],'medium')?>" alt="<?= get_the_title($args['post'])?>">
    </a>
    <div class="post__item-content">
        <a href="<?= get_permalink($args['post'])?>" class="post__item-title"><?= get_the_title($args['post'])?></a>
        <p class="post__item-desc">
            <?= wp_trim_words(get_the_content($args['post']),50)?>
        </p>
    </div>
</div>