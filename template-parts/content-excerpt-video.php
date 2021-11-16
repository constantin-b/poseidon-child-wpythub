<?php
/**
 * The template for displaying video posts in the loop without post excerpts
 *
 * @package Poseidon
 */

?>

<article class="wpythub video-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">

        <?php if( has_post_thumbnail() ):?>

        <div class="featured-image">
            <a href="<?php the_permalink();?>" title="<?php echo esc_attr( get_the_title() );?>" rel="bookmark">
                <?php the_post_thumbnail( [300, 200] ); ?>
            </a>
        </div>

        <?php endif;?>

        <?php the_title( sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', get_the_permalink() ), '</a></h2>' ); ?>
    </div>
</article>
