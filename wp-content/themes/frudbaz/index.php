<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
					<?php
						if ( have_posts() ):
    					if ( is_home() && !is_front_page() ):
    				?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title();?></h1>
					</header>
					<?php
						endif;?>
					<?php
						/* Start the Loop */
						while ( have_posts() ): the_post(); ?>
						<?php
							get_template_part( 'post-formats/content', get_post_format() );?>
						<?php
							endwhile;
						?>
						<div class="pagination_wrap pt-10 list-none">
							<?php frudbaz_pagination( '<i class="ti-angle-double-left"></i>', '<i class="ti-angle-double-right"></i>', '', ['class' => ''] );?>
						</div>
						<?php
						else:
							get_template_part( 'post-formats/content', 'none' );
						endif;
					?>

				</div>
			</div>

			<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
		        <div class="col-lg-4">
		        	<div class="widget_wrap mb-50">
						<?php get_sidebar();?>
	            	</div>
	            </div>
			<?php endif;?>
        </div>
    </div>
</section>

<?php
get_footer();
