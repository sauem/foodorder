<?php

namespace ElementHelper\Widget;

use Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;

defined('ABSPATH') || die();

class Member_Details extends Element_El_Widget
{

    /**
     * Get widget name.
     *
     * Retrieve Element Helper widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'member-details';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Member Details', 'elementhelper');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'elh-widget-icon eicon-lock-user';
    }

    public function get_keywords()
    {
        return ['slider', 'memeber', 'map', 'details'];
    }

    protected function register_content_controls() {
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Information', 'elementhelper'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Title',
                'placeholder' => __('Type title here', 'elementhelper'),
                'separator' => 'before',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __('Description', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here, content here’, making it look like readable English.',
                'placeholder' => __('Type content here', 'elementhelper'),
                'separator' => 'before',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title2',
            [
                'label' => __('Title', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Title',
                'placeholder' => __('Type title here', 'elementhelper'),
                'separator' => 'before',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'content2',
            [
                'label' => __('Description', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here, content here’, making it look like readable English.',
                'placeholder' => __('Type content here', 'elementhelper'),
                'separator' => 'before',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title3',
            [
                'label' => __('Title', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Title',
                'placeholder' => __('Type title here', 'elementhelper'),
                'separator' => 'before',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'content3',
            [
                'label' => __('Description', 'elementhelper'),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here, content here’, making it look like readable English.',
                'placeholder' => __('Type content here', 'elementhelper'),
                'separator' => 'before',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_feature_lists',
            [
                'label' => __( 'Feature List', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'f_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Feature item', 'elementhelper' ),
                'default' => __( 'Experienced Attorneys Professional.', 'elementhelper' ),
                'placeholder' => __( 'Type text here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'feature_lists',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(f_title || "Carousel Item"); #>',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_skills',
            [
                'label' => __( 'Skill List', 'elementhelper' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            's_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'elementhelper' ),
                'placeholder' => __( 'Type title here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            's_number',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Skill Number', 'elementhelper' ),
                'default' => __( '70', 'elementhelper' ),
                'placeholder' => __( 'Type number here', 'elementhelper' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'skills',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(s_title || "Carousel Item"); #>',
            ]
        );

        $this->end_controls_section();

    }

    protected function register_style_controls()
    {

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <section class="el-team-details-content">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="el-team-content">
                            <?php if(!empty($settings['title'])) : ?>
                            <h2 class="el-title"><?php echo esc_html($settings['title']); ?></h2>
                            <?php endif; ?>
                            <?php if(!empty($settings['content'])) : ?>
                            <p><?php echo esc_html($settings['content']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="el-team-content">
                            <?php if(!empty($settings['title2'])) : ?>
                            <h2 class="el-title"><?php echo esc_html($settings['title2']); ?></h2>
                            <?php endif; ?>
                            <?php if(!empty($settings['content2'])) : ?>
                            <p><?php echo esc_html($settings['content2']); ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="team-service-skill">
                            <div class="row">
                                <div class="col-xl-6">
                                    <?php if(!empty($settings['feature_lists'])) : ?>
                                    <div class="activity-list-progress ">
                                        <div class="pr-team-details-activity">
                                            <ul class="activity-list">
                                                <?php foreach ( $settings['feature_lists'] as $feature_list ) :?>
                                                <li><?php echo esc_html($feature_list['f_title']); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-xl-6">
                                    <?php if(!empty($settings['skills'])) : ?>
                                    <div class="skill-progress-bar">
                                        <?php foreach ( $settings['skills'] as $skill ) :?>
                                        <div class="skill-set-percent ta-home-6 headline">
                                            <h4><?php echo esc_html($skill['s_title']); ?></h4>
                                            <div class="progress">
                                                <div class="progress-bar" data-percent="<?php echo esc_attr($skill['s_number']); ?>"></div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="el-team-content el-team-content__2">
                            <?php if(!empty($settings['title3'])) : ?>
                            <h2 class="el-title"><?php echo esc_html($settings['title3']); ?></h2>
                            <?php endif; ?>
                            <?php if(!empty($settings['content3'])) : ?>
                            <p><?php echo esc_html($settings['content3']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
