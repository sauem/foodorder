<?php
/**
 * Template Name: Home page
 */
get_header();
?>
<?php if (have_posts()): ?>
    <section class="slider">
        <div class="main-slider">
            <?php
            query_posts([
                'post_type' => 'slider',
                'posts' => 6
            ]);
            while (have_posts()): the_post();
                ?>
                <div class="slide-item">
                    <img src="<?= get_the_post_thumbnail_url() ?>" class="img-fluid"
                         alt="<?= get_post_meta(get_the_ID(), 'alt', true) ?>">
                </div>
            <?php endwhile;
            wp_reset_query(); ?>
        </div>
        <a class="btn-slider" href="/menu">SEE MENU</a>

    </section>

    <section class="container py-5">
        <div class="col-md-8 offset-md-2">
            <?php the_content(); ?>
        </div>
    </section>
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
