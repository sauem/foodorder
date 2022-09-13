<?php
    $author_data = get_the_author_meta( 'description', get_query_var( 'author' ) );
    $facebook_url = get_the_author_meta( 'frudbaz_facebook' );
    $twitter_url = get_the_author_meta( 'frudbaz_twitter' );
    $linkedin_url = get_the_author_meta( 'frudbaz_linkedin' );
    $instagram_url = get_the_author_meta( 'frudbaz_instagram' );
    $frudbaz_url = get_the_author_meta( 'frudbaz_youtube' );
    $frudbaz_write_by = get_the_author_meta( 'frudbaz_write_by' );
    $author_bio_avatar_size = 180;
    if ( $author_data != '' ):
?>
    <div class="post-author mt-40">
        <div class="p-image">
            <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
                <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>
            </a>
        </div>
        <div class="p-info">
            <?php if(!empty($frudbaz_write_by)) : ?>
            <span><?php print esc_html($frudbaz_write_by); ?></span>
                <h3 class="name">
                    <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>"><?php print get_the_author();?></a>
                </h3>
            <?php endif; ?>
            <p><?php the_author_meta( 'description' );?></p>
        </div>
    </div>

<?php endif;?>