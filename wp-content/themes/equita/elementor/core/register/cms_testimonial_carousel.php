<?php
$slides_to_show = range( 1, 5 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

// Register Contact Form 7 Widget
etc_add_custom_widget(
    array(
        'name' => 'cms_testimonial_carousel',
        'title' => esc_html__('Testimonial Carousel', 'equita'),
        'icon' => 'eicon-testimonial-carousel',
        'categories' => array(Elementor_Theme_Core::ETC_CATEGORY_NAME),
        'scripts' => array(
            'jquery-slick',
            'cms-item-carousel-js',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__( 'Layout', 'equita' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__( 'Templates', 'equita' ),
                            'type' => Elementor_Theme_Core::LAYOUT_CONTROL,
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'equita' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_testimonial_carousel/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'equita' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_testimonial_carousel/layout-image/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'equita' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/cms_testimonial_carousel/layout-image/layout3.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_clients',
                    'label' => esc_html__('Clients', 'equita'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'clients',
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [
                                [
                                    'client_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'equita' ),
                                    'client_image' => esc_html__( 'Client Image', 'equita' ),
                                    'client_name' => esc_html__( 'John Doe', 'equita' ),
                                    'client_job' => esc_html__( 'Designer', 'equita' ),
                                    'client_link' => esc_html__( 'http://client-link.com', 'equita' ),
                                ],
                            ],
                            'controls' => array(
                                array(
                                    'name' => 'client_image',
                                    'label' => esc_html__('Client Logo/Image', 'equita'),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'rating',
                                    'label' => esc_html__('Rating', 'equita' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => 'star5',
                                    'options' => [
                                        'star1' => esc_html__('1 Star', 'equita' ),
                                        'star2' => esc_html__('2 Star', 'equita' ),
                                        'star3' => esc_html__('3 Star', 'equita' ),
                                        'star4' => esc_html__('4 Star', 'equita' ),
                                        'star5' => esc_html__('5 Star', 'equita' ),
                                    ],
                                ),
                                array(
                                    'name' => 'client_content',
                                    'label' => __( 'Content', 'equita' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => '10',
                                    'default' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                                ),
                                array(
                                    'name' => 'client_name',
                                    'label' => esc_html__('Client Name', 'equita'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                    'default' => esc_html__( 'John Doe', 'equita' )
                                ),
                                array(
                                    'name'  =>  'client_job',
                                    'label' => __( 'Job', 'equita' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => 'Designer',
                                ),
                                array(
                                    'name' => 'client_link',
                                    'label' => esc_html__('Client URL', 'equita'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                    'placeholder' => esc_html__('http://client-link.com', 'equita'),
                                ),
                            ),
                            'title_field' => '{{{ client_name }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_styling',
                    'label' => esc_html__('Settings', 'equita'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'heading_client_content',
                            'label' => esc_html__('Content', 'equita'),
                            'type' => \Elementor\Controls_Manager::HEADING,
                        ),
                        array(
                            'name' => 'client_content_color',
                            'label' => esc_html__('Text Color', 'equita'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-testimonial-carousel .client-content p' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .cms-testimonial-carousel-syncing .client-content-item p' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'client_content_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cms-testimonial-carousel .client-content p, {{WRAPPER}} .cms-testimonial-carousel-syncing .client-content-item p',
                        ),
                        array(
                            'name' => 'content_style',
                            'label' => esc_html__('Style', 'equita' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'default',
                            'options' => [
                                'default' => esc_html__('Default', 'equita' ),
                                'indent-right' => esc_html__('Indent Right ', 'equita' ),
                                'indent-right large-space' => esc_html__('Indent Right Large', 'equita' ),
                            ],
                            'condition' => [
                                'layout' => array('2','3'),
                            ],
                        ),
                        array(
                            'name' => 'heading_client_image',
                            'label' => esc_html__('Client Images', 'equita'),
                            'type' => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name'  =>  'client_image_size',
                            'type'  =>  \Elementor\Controls_Manager::SLIDER,
                            'label' => esc_html__('Image Width', 'equita'),
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 20,
                                    'max' => 200,
                                ],
                            ],
                            'default'   => [
                                'unit' => 'px',
                                'size' => 60,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-testimonial-carousel .client-image img' => 'width: {{SIZE}}{{UNIT}};height: auto;',
                            ],

                        ),
                        array(
                            'name'  =>  'client_image_border',
                            'type'  => \Elementor\Group_Control_Border::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cms-testimonial-carousel .client-image img',
                        ),
                        array(
                            'name'  => 'client_image_border_radius',
                            'label' => __( 'Border Radius', 'equita' ),
                            'type' =>\Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-testimonial-carousel .client-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_client_name',
                            'label' => esc_html__('Name', 'equita'),
                            'type' => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'client_name_color',
                            'label' => esc_html__('Text Color', 'equita'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-testimonial-carousel .client-name .name-text' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .cms-testimonial-carousel-syncing .client-name .name-text' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'client_name_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cms-testimonial-carousel .client-name .name-text, {{WRAPPER}} .cms-testimonial-carousel-syncing .client-name .name-text',
                        ),
                        array(
                            'name' => 'heading_client_Job',
                            'label' => esc_html__('Job', 'equita'),
                            'type' => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                        ),
                        array(
                            'name' => 'client_job_color',
                            'label' => esc_html__('Text Color', 'equita'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cms-testimonial-carousel .client-job' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .cms-testimonial-carousel-syncing .client-job' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'client_job_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .cms-testimonial-carousel .client-job, {{WRAPPER}} .cms-testimonial-carousel-syncing .client-job',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_carousel_settings',
                    'label' => esc_html__('Carousel Settings', 'equita'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        array(
                            'name' => 'slides_to_show',
                            'label' => esc_html__('Slides to Show', 'equita'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'control_type' => 'responsive',
                            'options' => [
                                    '' => esc_html__( 'Default', 'equita' ),
                                ] + $slides_to_show,
                        ),
                        array(
                            'name' => 'slides_to_scroll',
                            'label' => esc_html__('Slides to Scroll', 'equita'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'control_type' => 'responsive',
                            'options' => [
                                    '' => esc_html__( 'Default', 'equita' ),
                                ] + $slides_to_show,
                            'condition' => [
                                'slides_to_show!' => '1',
                            ],
                        ),
                        array(
                            'name' => 'slides_gutter',
                            'label' => esc_html__('Gutter', 'equita'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'control_type' => 'responsive',
                            'default' => 10,
                            'condition' => [
                                'slides_to_show!' => '1',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cms-slick-carousel .slick-list .slick-slide' => 'padding: {{VALUE}}px;',
                                '{{WRAPPER}} .cms-slick-carousel .slick-list' => 'margin: 0 -{{VALUE}}px;',
                            ],
                        ),
                        array(
                            'name' => 'arrows',
                            'label' => esc_html__('Show Arrows', 'equita'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'dots',
                            'label' => esc_html__('Show Dots', 'equita'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'pause_on_hover',
                            'label' => esc_html__('Pause on Hover', 'equita'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'autoplay',
                            'label' => esc_html__('Autoplay', 'equita'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'autoplay_speed',
                            'label' => esc_html__('Autoplay Speed', 'equita'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 5000,
                            'condition' => [
                                'autoplay' => 'true'
                            ]
                        ),
                        array(
                            'name' => 'infinite',
                            'label' => esc_html__('Infinite Loop', 'equita'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'speed',
                            'label' => esc_html__('Animation Speed', 'equita'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 500,
                        ),
                        array(
                            'name' => 'dir',
                            'label' => esc_html__('Direction', 'equita'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'ltr' => esc_html__('Left', 'equita'),
                                'rtl' => esc_html__('Right', 'equita'),
                            ],
                            'default' => 'ltr',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);