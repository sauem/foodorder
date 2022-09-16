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

    <section class="testimonial_area testimonial_bg pt-120 pb-120 mb-5" data-background="<?= ASSET ?>/img/bg/tm_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <div class="tm_content">
                        <div class="sec_title sec_title-white">
                            <span>Customer Feedback</span>
                            <h2>What Our Client Say ?</h2>
                            <p>Rorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ore eu fuulla pariatur. Excepteur sint occaecat cupidatat non proideney.</p>
                        </div>
                        <ul class="tm_counter ul_li">
                            <li>
                                <h3>14k<span>+</span></h3>
                                <span>Happy Customer</span>
                            </li>
                            <li>
                                <h3>16<span>+</span></h3>
                                <span>Award Wining</span>
                            </li>
                            <li>
                                <h3>68<span>+</span></h3>
                                <span>Food Menu</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="testimonial_active owl-carousel">
                        <div class="tm_single white_bg">
                            <div class="tm_top ul_li justify-content-between">
                                <div class="tm_author">
                                    <img src="<?=  ASSET ?>/img/testimonial/author_01.png" alt="">
                                </div>
                                <div class="tm_quote">
                                    <img src="<?=  ASSET ?>/img/icon/quote.png" alt="">
                                </div>
                            </div>
                            <p>Great food! Fresh, quick, friendly, delicious, affordable! Very flexible with orders. Great service! Great portions! If you want great seafood, this place will not disappoint you. Definitelyy.</p>
                            <div class="tm_bottom ul_li justify-content-between">
                                <div class="a_info">
                                    <h4>Wasim Mia</h4>
                                    <span>Founder & co</span>
                                </div>
                                <div class="rating_wrap">
                                    <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fal fa-star"></i></li>
                                    </ul>
                                    <span>4 Rating</span>
                                </div>
                            </div>
                        </div>
                        <div class="tm_single white_bg">
                            <div class="tm_top ul_li justify-content-between">
                                <div class="tm_author">
                                    <img src="<?=  ASSET ?>/img/testimonial/author_02.png" alt="">
                                </div>
                                <div class="tm_quote">
                                    <img src="<?=  ASSET ?>/img/icon/quote.png" alt="">
                                </div>
                            </div>
                            <p>Great food! Fresh, quick, friendly, delicious, affordable! Very flexible with orders. Great service! Great portions! If you want great seafood, this place will not disappoint you. Definitelyy.</p>
                            <div class="tm_bottom ul_li justify-content-between">
                                <div class="a_info">
                                    <h4>Rahim Mia</h4>
                                    <span>Founder & Ceo</span>
                                </div>
                                <div class="rating_wrap">
                                    <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fal fa-star"></i></li>
                                        <li><i class="fal fa-star"></i></li>
                                    </ul>
                                    <span>3 Rating</span>
                                </div>
                            </div>
                        </div>
                        <div class="tm_single white_bg">
                            <div class="tm_top ul_li justify-content-between">
                                <div class="tm_author">
                                    <img src="<?=  ASSET ?>/img/testimonial/author_01.png" alt="">
                                </div>
                                <div class="tm_quote">
                                    <img src="<?=  ASSET ?>/img/icon/quote.png" alt="">
                                </div>
                            </div>
                            <p>Great food! Fresh, quick, friendly, delicious, affordable! Very flexible with orders. Great service! Great portions! If you want great seafood, this place will not disappoint you. Definitelyy.</p>
                            <div class="tm_bottom ul_li justify-content-between">
                                <div class="a_info">
                                    <h4>Rasalina De</h4>
                                    <span>Founder & co</span>
                                </div>
                                <div class="rating_wrap">
                                    <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fal fa-star"></i></li>
                                    </ul>
                                    <span>4 Rating</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
endif;
get_footer();
?>

<script>
    $('.testimonial_active').owlCarousel({
        loop: true,
        margin: 30,
        items: 1,
        center: true,
        autoplay: true,
        smartSpeed: 1000,
        stagePadding: 150,
        responsiveClass: true,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1,
                stagePadding: 0,
            },
            575: {
                items: 1,
                stagePadding: 100,
            },
            768: {
                items: 1,
                stagePadding: 10,
            },
            992: {
                items: 1,
                stagePadding: 50,
            },
            1250: {
                items: 1,
                stagePadding: 150,
            },
        },
    });
    $('.main-slider').slick({
        infinite: true,
        slidesToShow: 1,
        dots: true,
        arrows: false
    });

</script>
