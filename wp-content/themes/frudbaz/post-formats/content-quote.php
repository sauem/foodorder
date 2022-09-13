<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frudbaz
 */
?>

<article id="post-<?php the_ID();?>" <?php post_class( 'post_item format_quote' );?>>
    <div class="post_content">
        <?php the_content();?>
    </div>
</article>
