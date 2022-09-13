<?php

/**
 * Template Name: Page Sidebar
 * @package frudbaz
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

?>

<div class="page-area pt-120 pb-120">
    <div class="container">
		<div class="row">
			<div class="col-lg-<?php print esc_attr( $blog_column );?>">
				<div class="frudbaz-page-content">
					<?php
						if ( have_posts() ):
							while ( have_posts() ): the_post();
								get_template_part( 'post-formats/content', 'page' );
							endwhile;
						else:
						get_template_part( 'post-formats/content', 'none' );
						endif;
					?>
				</div>
			</div>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
		        <div class="col-lg-4">
					<div class="blog__sidebar news-sidebar">
						<?php get_sidebar();?>
					</div>
	            </div>
			<?php endif;?>
		</div>
    </div>
</div>

<?php
get_footer();
