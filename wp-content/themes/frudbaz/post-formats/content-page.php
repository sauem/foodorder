<div class="post-entry post-entry--top-margin">
<?php
    the_content();
    wp_link_pages( [
        'before'      => '<div class="page-links mt-20"><span class="page-links-title">' . esc_html__( 'Pages:', 'frudbaz' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'frudbaz' ) . ' </span>%',
        'separator'   => '<span class="screen-reader-text"> </span>',
    ] );

    if ( comments_open() || get_comments_number() ):
        comments_template();
    endif;
?>
</div>