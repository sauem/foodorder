<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
					?>
					<div class="result-bar page-header d-none">
						<h1 class="page-title"><?php esc_html_e( 'Search Results For:', 'frudbaz' );?> <?php print get_search_query();?></h1>
					</div>
					<?php
						while ( have_posts() ): the_post();
							get_template_part( 'post-formats/content', 'search' );
						endwhile;
					?>
					<div class="pagination_wrap pt-10 list-none">
						<?php frudbaz_pagination( '<i class="fas fa-angle-double-left"></i>', '<i class="fas fa-angle-double-right"></i>', '', [ 'class' => '' ] );?>
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
