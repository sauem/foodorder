<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package frudbaz
 */
?>

<!doctype html>
<html <?php language_attributes(); ?> <?php print frudbaz_enable_rtl(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php if (is_singular() && pings_open(get_queried_object())): ?>
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?= get_template_directory_uri() . '/assets/css/home.css?v=' . time() ?>"/>
</head>

<body <?php body_class(); ?>>
<div class="body_wrap">
    <?php $frudbaz_preloader = get_theme_mod('frudbaz_preloader', true); ?>
    <?php $frudbaz_backtotop = get_theme_mod('frudbaz_backtotop', true); ?>

    <?php if (!empty($frudbaz_backtotop)): ?>
        <!-- backtotop - start -->
        <div id="thetop"></div>
        <div id="backtotop">
            <a href="#" id="scroll">
                <i class="fal fa-arrow-up"></i>
                <i class="fal fa-arrow-up"></i>
            </a>
        </div>
        <!-- backtotop - end -->
    <?php endif; ?>

    <?php if (!empty($frudbaz_preloader)): ?>
        <!-- start Preloader  -->
        <div class="preloder_part">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
        <!-- End Preloader  -->
    <?php endif; ?>
    <div class="body-overlay"></div>
    <?php wp_body_open(); ?>

    <!-- header start -->
    <?php do_action('frudbaz_header_style'); ?>
    <!-- header end -->

    <!-- wrapper-box start -->
    <?php do_action('frudbaz_before_main_content'); ?>
