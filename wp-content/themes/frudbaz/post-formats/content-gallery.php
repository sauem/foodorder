<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frudbaz
 */
$author_bio_avatar_size = 40;
$gallery_images = function_exists( 'acf_photo_gallery' ) ? acf_photo_gallery( 'gallery_images', get_the_id() ) : '';

if ( is_single() ):
frudbaz_set_post_view(get_the_ID());
?>
    <div class="post_content mb-30">
        <?php if ( !empty( $gallery_images ) ): ?>
        <div class="gallery_post_active owl-carousel mb-30">
            <?php foreach ( $gallery_images as $key => $image ): ?>
            <div class="post_thumb">
                <img src="<?php echo esc_url( $image['full_image_url'] ); ?>" alt="<?php print esc_attr__( 'gallery image', 'frudbaz' );?>">
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <ul class="post_meta ul_li">
            <li><i class="fal fa-eye"></i> <?php echo frudbaz_post_view(get_the_ID()); ?></li>
            <li><i class="fal fa-comments"></i> <?php print esc_html__('Comments', 'frudbaz'); ?> (<?php print get_comments_number();?>)</li>
            <li><i class="fal fa-calendar-alt"></i> <?php the_time( get_option( 'date_format' ) );?></li>
        </ul>

        <div class="single-post-main-content">
            <?php the_content( );?>
        </div>
        <div class="post-tag-wrapper">
            <?php print frudbaz_get_tag(); ?>
        </div>
        <div class="post-page-wrapper">
        <?php
            wp_link_pages( [
                'before'      => '<div class="page-links mt-20">' . esc_html__( 'Pages:', 'frudbaz' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ] );
        ?>
        </div>
    </div>
    <?php else: ?>

    <article id="post-<?php the_ID();?>" <?php post_class( 'post_item format_gallery' );?>>

        <?php if ( !empty( $gallery_images ) ): ?>
        <div class="gallery_post_active owl-carousel">
            <?php foreach ( $gallery_images as $key => $image ): ?>
            <div class="post_thumb">
                <img src="<?php echo esc_url( $image['full_image_url'] ); ?>" alt="<?php print esc_attr__( 'gallery image', 'frudbaz' );?>">
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="post_content">
            <ul class="post_meta ul_li">
                <li><i class="fal fa-eye"></i> <?php echo frudbaz_post_view(get_the_ID()); ?></li>
                <li><a href="<?php the_permalink(); ?>">
                    <i class="fal fa-comments"></i> <?php print esc_html__('Comments', 'frudbaz'); ?> (<?php print get_comments_number();?>)</a></li>
                <li><i class="fal fa-calendar-alt"></i> <?php the_time( get_option( 'date_format' ) );?></li>
            </ul>
            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php the_excerpt();?>

            <ul class="post_btn mt-20 ul_li">
                <?php
                    if ( rtl_enable() ) {
                        $frudbaz_blog_btn = get_theme_mod( 'frudbaz_blog_btn_rtl', esc_html__( 'Read More', 'frudbaz' ) );
                    } else {
                        $frudbaz_blog_btn = get_theme_mod( 'frudbaz_blog_btn', esc_html__( 'Read More', 'frudbaz' ) );
                    }

                    $frudbaz_blog_btn_switch = get_theme_mod( 'frudbaz_blog_btn_switch', true );
                    if ( !empty( $frudbaz_blog_btn_switch == true ) ):
                ?>
                <li>
                    <a class="thm_btn" href="<?php the_permalink(); ?>"><?php print esc_html( $frudbaz_blog_btn ); ?></a>
                </li>
                <?php endif; ?>
                <li>
                    <div class="author_wrap">
                        <div class="author">
                        <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>
                        </div>
                        <h5 class="author_name"><?php print ucfirst(get_the_author()); ?></h5>
                    </div>
                </li>
            </ul>
        </div>
    </article>

<?php
endif;?>
