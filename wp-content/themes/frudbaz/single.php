<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package frudbaz
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;
?>

<section class="blog_details_area blog_area pt-120 pb-70">
    <div class="container">
        <div class="row">
			<div class="col-lg-<?php print esc_attr( $blog_column );?>">
				<div class="blog_dtls_wrap mb-50">
					<?php
						while ( have_posts() ):
						the_post();
							get_template_part( 'post-formats/content', get_post_format() );
    					?>

						<?php

						if(!empty(get_previous_post() || get_next_post()) ) :

						?>
							<div class="related_posts d-none mt-30">
								<div class="row mt-none-30">
								<?php
									$borne_prev_post = get_previous_post();
									if($borne_prev_post) :
								?>
								<pre><?php var_dump($prevThumbnail); ?></pre>
									<div class="col-lg-6 col-md-6">
										<div class="rp_single mt-30">
											<div class="rp_thumb">
												<a href="<?php print get_the_permalink($borne_prev_post); ?>">
													<?php print get_the_post_thumbnail($borne_prev_post); ?>
												</a>
											</div>
											<div class="rp_content">
												<h4>
													<a href="<?php print get_the_permalink($borne_prev_post); ?>">
														<?php print get_the_title($borne_prev_post); ?>
													</a>
												<p><?php print wp_trim_words(get_the_excerpt($borne_prev_post), 18, ''); ?></p>
											</div>
										</div>
									</div>
									<?php
										endif;
										$borne_next_post = get_next_post();
										if ( $borne_next_post ) :
									?>
									<div class="col-lg-6 col-md-6">
										<div class="rp_single mt-30">
											<div class="rp_thumb">
												<a href="<?php print get_the_permalink($borne_next_post); ?>">
													<?php print get_the_post_thumbnail($borne_next_post); ?>
												</a>
											</div>
											<div class="rp_content">
												<h4>
													<a href="<?php print get_the_permalink($borne_next_post); ?>">
													<?php print get_the_title($borne_next_post); ?></a></h4>
												<p><?php print wp_trim_words(get_the_excerpt($borne_next_post), 18, ''); ?></p>
											</div>
										</div>
									</div>
									<?php endif; ?>
								</div>
							</div>

						<?php
							endif;

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ):
								comments_template();
							endif;

							endwhile; // End of the loop.
						?>
				</div>
			</div>
			<?php
				if ( is_active_sidebar( 'blog-sidebar' ) ) {?>
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
</section>

<?php
get_footer();
