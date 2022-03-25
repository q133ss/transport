<?php

class ETC_CmsCareerCarousel_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_career_carousel';
    protected $title = 'Career Carousel';
    protected $icon = 'eicon-parallax';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/perevozki\/wp-content\/themes\/equita\/elementor\/templates\/widgets\/cms_career_carousel\/layout-image\/layout1.jpg"}}}]},{"name":"content_list","label":"Content","tab":"content","controls":[{"name":"career","label":"Add Item","type":"repeater","controls":[{"name":"title","label":"Title","type":"text","label_block":true},{"name":"description","label":"Description","type":"textarea","label_block":true},{"name":"time","label":"Time","type":"text","label_block":true},{"name":"address","label":"Address","type":"text","label_block":true},{"name":"button_text","label":"Button Text","type":"text","separator":"after"},{"name":"button_link","label":"Button Link","type":"url"}],"title_field":"{{{ title }}}"}]},{"name":"section_carousel_settings","label":"Carousel Settings","tab":"settings","controls":[{"name":"slides_to_show","label":"Slides to Show","type":"select","control_type":"responsive","options":{"":"Default","1":1,"2":2,"3":3,"4":4,"5":5,"6":6,"7":7,"8":8,"9":9,"10":10}},{"name":"slides_to_scroll","label":"Slides to Scroll","type":"select","control_type":"responsive","options":{"":"Default","1":1,"2":2,"3":3,"4":4,"5":5,"6":6,"7":7,"8":8,"9":9,"10":10},"condition":{"slides_to_show!":"1"}},{"name":"slides_gutter","label":"Gutter","type":"number","control_type":"responsive","default":15,"condition":{"slides_to_show!":"1"},"selectors":{"{{WRAPPER}} .cms-slick-carousel .slick-list .slick-slide":"padding-left: {{VALUE}}px;padding-right: {{VALUE}}px;","{{WRAPPER}} .cms-slick-slider .cms-carousel-inner":"margin-left: -{{VALUE}}px; margin-right: -{{VALUE}}px;"}},{"name":"arrows","label":"Show Arrows","type":"switcher","default":"false"},{"name":"dots","label":"Show Dots","type":"switcher","default":"false"},{"name":"pause_on_hover","label":"Pause on Hover","type":"switcher","default":"false"},{"name":"autoplay","label":"Autoplay","type":"switcher","default":"false"},{"name":"autoplay_speed","label":"Autoplay Speed","type":"number","default":5000,"condition":{"autoplay":"true"}},{"name":"infinite","label":"Infinite Loop","type":"switcher","default":"false"},{"name":"speed","label":"Animation Speed","type":"number","default":500}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'jquery-slick','cms-post-carousel-widget-js' );
}