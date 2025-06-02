<?php
$rating = get_field('movies-rejting');
?>

<div class="afisha__item">
    <div class="afisha__item-poster">
        <?php the_post_thumbnail(); ?>
        <div class="afisha__item-rating">
            <div class="afisha__item-rating-inner">
                <span><?php echo $rating; ?></span>
                <span>⭐</span>
            </div>
        </div>
    </div>
    <div class="afisha__item-content">
        <h3 class="afisha__item-title">
            <?php the_title(); ?>
        </h3>
        <a href="<?php the_permalink(); ?>" class="afisha__item-more btn3">Read more</a>
    </div>
</div>