<?php

class ETC_CmsImageBoxCarousel_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_image_box_carousel';
    protected $title = 'Image Box Carousel';
    protected $icon = 'eicon-info-box';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 4","image":"http:\/\/perevozki\/wp-content\/themes\/equita\/elementor\/templates\/widgets\/cms_image_box_carousel\/layout-image\/layout1.jpg"}}}]},{"name":"section_boxs","label":"Box Settings","tab":"content","controls":[{"name":"boxs","label":"","type":"repeater","default":[],"controls":[{"name":"box_image","label":"Box Image","type":"media","label_block":true},{"name":"box_text","label":"Box Text","type":"textarea","label_block":true,"default":""}]}]},{"name":"section_carousel_settings","label":"Carousel Settings","tab":"settings","controls":[{"name":"dots","label":"Show Dots","type":"switcher"},{"name":"pause_on_hover","label":"Pause on Hover","type":"switcher"},{"name":"autoplay","label":"Autoplay","type":"switcher"},{"name":"autoplay_speed","label":"Autoplay Speed","type":"number","default":5000,"condition":{"autoplay":"true"}},{"name":"infinite","label":"Infinite Loop","type":"switcher"},{"name":"speed","label":"Animation Speed","type":"number","default":500}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'jquery-slick','cms-clients-list-widget-js' );
}