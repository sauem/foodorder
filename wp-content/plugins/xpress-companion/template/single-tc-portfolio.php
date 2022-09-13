<?php
/**
 * The main template file
 *
 * @package  WordPress
 * @subpackage  duxin
 */
get_header();

if ( is_active_sidebar( 'portfolio-sidebar' ) ) {
    $port_col = 'col-xxl-8 col-xl-8 col-lg-7';
} else {
    $port_col = 'col';
}
?>
        <?php
        if( have_posts() ):
            while( have_posts() ): the_post();
            $portfolio_show = function_exists( 'get_field' ) ? get_field( 'portfolio_show' ) : '';
            $portfolio_section = function_exists( 'get_field' ) ? get_field( 'portfolio_section' ) : '';
            $portfolio_details_thumb = function_exists('get_field') ? get_field('portfolio_details') : '';

            if( $portfolio_show  ) :
        ?>
        <section class="case-details-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="case-details-top mb-130">
                            <div class="cd-thumb">
                                <img src="<?php echo esc_url($portfolio_details_thumb); ?>" alt="img">
                            </div>
                            <div class="cd-top-text">
                                <ul class="cd-list">
                                    <li>
                                        <?php if (!empty($portfolio_section['label'])) : ?>
                                        <span><?php echo wp_kses_post( $portfolio_section['label'] ); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($portfolio_section['clients'])) : ?>
                                        <p><?php echo wp_kses_post( $portfolio_section['clients'] ); ?></p>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <?php if (!empty($portfolio_section['label_2'])) : ?>
                                        <span><?php echo wp_kses_post( $portfolio_section['label_2'] ); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($portfolio_section['services'])) : ?>
                                        <p><?php echo wp_kses_post( $portfolio_section['services'] ); ?></p>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <?php if (!empty($portfolio_section['label_3'])) : ?>
                                        <span><?php echo wp_kses_post( $portfolio_section['label_3'] ); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($portfolio_section['durations'])) : ?>
                                        <p><?php echo wp_kses_post( $portfolio_section['durations'] ); ?></p>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <?php if (!empty($portfolio_section['label_4'])) : ?>
                                        <span><?php echo wp_kses_post( $portfolio_section['label_4'] ); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($portfolio_section['tools'])) : ?>
                                        <p><?php echo wp_kses_post( $portfolio_section['tools'] ); ?></p>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                                <div class="cd-btn">
                                    <?php if (!empty($portfolio_section['button_text'])) : ?>
                                    <a class="thm-btn" href="<?php echo esc_url( $portfolio_section['button_url'] ); ?>"><?php echo wp_kses_post( $portfolio_section['button_text'] ); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php 
            endwhile; wp_reset_query();
        endif; 
        ?>
        

<?php get_footer();?>