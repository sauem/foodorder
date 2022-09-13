<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frudbaz
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

?>

<section class="blog_area pt-120 pb-70">
	<div class="container">
        <div class="row">
			<div class="col-lg-<?php print esc_attr( $blog_column );?> blog-post-items blog-padding">
				<div class="blog_wrap mb-50">
					<?php if ( have_posts() ): ?>
						<header class="page-header d-none">
							<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><!-- .page-header -->
						<?php
							/* Start the Loop */
							while ( have_posts() ):
								the_post();

								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
								get_template_part( 'post-formats/content', get_post_type() );
							endwhile;?>
						<div class="author-navigation">
						<?php
							the_posts_pagination( array(
								'screen_reader_text' => ' ',
								'prev_text'  => 'New Posts',
								'next_text' => 'Old Posts'
							) );
						?>
						</div>
						<?php
							else:
								get_template_part( 'post-formats/content', 'none' );
							endif;
						?>
				</div>
			</div>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
		        <div class="col-lg-4">
					<div class="widget_wrap mb-50">
						<?php get_sidebar();?>
					</div>
	            </div>
			<?php
				}
			?>
        </div>
    </div>
</div>
<?php
get_footer();
