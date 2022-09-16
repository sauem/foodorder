<?php
/**
 * Template Name: Menu page
 */
get_header();
?>
<?php if (have_posts()): ?>
    <section class="slider bg-dark">
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="main-slider">
                        <?php
                        query_posts([
                            'post_type' => 'slider2',
                            'posts' => 99
                        ]);
                        while (have_posts()): the_post();
                            ?>
                            <div class="slide-item">
                                <a target="_blank" href="<?= get_post_meta(get_the_ID(), 'link_to', true) ?>">
                                <img src="<?= get_the_post_thumbnail_url() ?>" class="img-fluid"
                                     alt="<?= get_post_meta(get_the_ID(), 'alt', true) ?>">
                                </a>
                            </div>
                        <?php endwhile;
                        wp_reset_query(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php the_content() ?>
<?php
endif;
get_footer();
?>

<script>

    $('.main-slider').slick({
        infinite: true,
        slidesToShow: 1,
        dots: true,
        arrows: false
    });

</script>
