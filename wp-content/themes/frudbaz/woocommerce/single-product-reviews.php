<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-review-forms.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     4.3.1
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product;

if (!comments_open()) {
    return;
}

?>

        <div class="row">
            <div class="col-lg-12">
                <?php if (have_comments()) : ?>
                <div class="client-rv">

                    <?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments', 'style' => 'div',))); ?>

                    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) :
                        echo '<nav class="woocommerce-pagination">';
                        paginate_comments_links(apply_filters('woocommerce_comment_pagination_args', array(
                            'prev_text' => '&larr;',
                            'next_text' => '&rarr;',
                            'type' => 'list',
                        )));
                        echo '</nav>';
                    endif; ?>
                    <?php else : ?>

                    <div class="title"><?php esc_html_e('There are no reviews yet.', 'frudbaz'); ?></div>
                </div>
                <?php endif; ?>
            </div>


            <?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) : ?>

            <div class="col-lg-12 review-form-wrapper">
                <div id="reviews" class="review-form" id="review_form_wrapper">
                    <div class="customer_review_form shop-comment-form from_wrapper comment_form" id="review_form">
                        <?php
                        $commenter = wp_get_current_commenter();

                        $comment_form = array(
                            'title_reply' => '<h4 class="reviews_tab_title">' . esc_html__('Add Your Comments', 'frudbaz') . '</h4>',
                            'title_reply_to' => esc_html__('Leave a Reply to %s', 'frudbaz'),
                            'title_reply_before' => '<div id="reply-title" class="comment-reply-title">',
                            'title_reply_after' => '</div>',
                            'comment_notes_after' => '',
                            'fields' => array(
                                'author' => '
                                <input placeholder="'.esc_html__('Name*', 'frudbaz').'" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" required />',
                                'email' => '' .
                                '<input placeholder="'.esc_html__('Email*', 'frudbaz').'" id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" required />',
                            ),
                            'submit_button' => '<button class="thm_btn thm_btn-black" type="submit">' . esc_html__('Post review', 'frudbaz') . '</button>',
                            'logged_in_as' => '',
                            'comment_field' => '',
                        );

                        if ($account_page_url = wc_get_page_permalink('myaccount')) {
                            $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be <a href="%s">logged in</a> to post a review.', 'frudbaz'), esc_url($account_page_url)) . '</p>';
                        }

                        if (get_option('woocommerce_enable_review_rating') === 'yes') {
                            $comment_form['comment_field'] = '<div class="rating-wrapper rating">
                                    <select class="d-none" name="rating" id="rating" required>
                                        <option value="">' . esc_html__('Rate&hellip;', 'frudbaz') . '</option>
                                        <option value="5">' . esc_html__('Perfect', 'frudbaz') . '</option>
                                        <option value="4">' . esc_html__('Good', 'frudbaz') . '</option>
                                        <option value="3">' . esc_html__('Average', 'frudbaz') . '</option>
                                        <option value="2">' . esc_html__('Not that bad', 'frudbaz') . '</option>
                                        <option value="1">' . esc_html__('Very poor', 'frudbaz') . '</option>
                                    </select>
                                    </div>';
                        }

                        $comment_form['comment_field'] .= '<textarea placeholder="'.esc_html__('Review*', 'frudbaz').'" id="comment" name="comment" cols="30" rows="10" required></textarea>';

                        comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
                        ?>
                    </div>
                </div>

            <?php else : ?>
                <p class="woocommerce-verification-required"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'frudbaz'); ?></p>
            <?php endif; ?>
            </div>
