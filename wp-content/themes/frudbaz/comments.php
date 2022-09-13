<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frudbaz
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<?php if ( get_comments_number() >= 1 ): ?>
<div class="post_comment">
    <div class="comment-title-wrapper">
        <?php
            $comment_no = number_format_i18n( get_comments_number() );
            $comment_text = ( !empty( $comment_no ) AND ( $comment_no > 1 ) ) ? esc_html__( ' Comments', 'frudbaz' ) : esc_html__( ' Comment ', 'frudbaz' );
            $comment_no = ( !empty( $comment_no ) AND ( $comment_no > 0 ) ) ? '<h3 class="comment_title">' . esc_html( $comment_no . $comment_text ) . '</h3>' : ' ';
            print sprintf( "%s", $comment_no );
        ?>
    </div>
    <div class="comment-list-wrap">
        <ul class="comment_list mb-40">
            <?php
                wp_list_comments( [
                    'style'       => 'ul',
                    'callback'    => 'frudbaz_comment',
                    'avatar_size' => 50,
                    'short_ping'  => true,
                ] );
            ?>
        </ul>
    </div>
    <div class="divider"></div>
</div>
<?php endif;?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
    <div class="comment-pagination mb-50">
        <nav id="comment-nav-below" class="comment-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'frudbaz' );?></h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="nav-previous "><?php previous_comments_link( esc_html__( '&larr; Older ', 'frudbaz' ) );?></div>
                </div>
                <div class="col-md-6">
                    <div class="nav-next "><?php next_comments_link( esc_html__( 'Newer &rarr;', 'frudbaz' ) );?></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </nav><!-- #comment-nav-below -->
    </div>
<?php endif; // check for comment navigation ?>


<div class="from_wrapper mt-30">
    <?php comment_form();?>
</div>
