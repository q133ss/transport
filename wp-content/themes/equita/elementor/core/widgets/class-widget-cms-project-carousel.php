<?php

class ETC_CmsProjectCarousel_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_project_carousel';
    protected $title = 'Projects Carousel';
    protected $icon = 'eicon-posts-carousel';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/perevozki\/wp-content\/themes\/equita\/elementor\/templates\/widgets\/cms_project_carousel\/layout-image\/layout1.jpg"},"2":{"label":"Layout 2","image":"http:\/\/perevozki\/wp-content\/themes\/equita\/elementor\/templates\/widgets\/cms_project_carousel\/layout-image\/layout2.jpg"}}}]},{"name":"source_section","label":"Source","tab":"content","controls":[{"name":"thumbnail","type":"image-size","control_type":"group","default":"full"},{"name":"source","label":"Select Categories","type":"select2","multiple":true,"options":{"analystics|project-category":"Analystics","distribution|project-category":"Distribution","logistics|project-category":"Logistics","optimization|project-category":"Optimization","warehousing|project-category":"Warehousing"}},{"name":"orderby","label":"Order By","type":"select","default":"date","options":{"date":"Date","ID":"ID","author":"Author","title":"Title","rand":"Random"}},{"name":"order","label":"Sort Order","type":"select","default":"desc","options":{"desc":"Descending","asc":"Ascending"}},{"name":"limit","label":"Total items","type":"number","default":"6"},{"name":"num_words","label":"Number of Words","type":"number","default":35,"condition":{"layout":"2"}}]},{"name":"section_carousel_settings","label":"Carousel","tab":"content","controls":[{"name":"filter","label":"Filter by categories","type":"select","default":"false","options":{"true":"Enable","false":"Disable"}},{"name":"filter_default_title","label":"Default Title","type":"text","default":"All","condition":{"filter":"true"}},{"name":"filter_alignment","label":"Alignment","type":"select","default":"left","options":{"left":"Left","center":"Center","right":"Right"},"condition":{"filter":"true"}},{"name":"slides_to_show","label":"Slides to Show","type":"select","control_type":"responsive","options":{"":"Default","1":1,"2":2,"3":3}},{"name":"slides_to_scroll","label":"Slides to Scroll","type":"select","control_type":"responsive","options":{"":"Default","1":1,"2":2,"3":3},"condition":{"slides_to_show!":"1"}},{"name":"slides_gutter","label":"Gutter","type":"number","control_type":"responsive","default":15,"condition":{"slides_to_show!":"1"},"selectors":{"{{WRAPPER}} .cms-slick-carousel .slick-list .slick-slide":"padding: 0 {{VALUE}}px;","{{WRAPPER}} .cms-slick-carousel .slick-list":"margin: 0 -{{VALUE}}px;"}},{"name":"dots","label":"Show Dots","type":"switcher","default":"true"},{"name":"infinite","label":"Infinite Loop","type":"switcher","default":"true"},{"name":"speed","label":"Animation Speed","type":"number","default":500}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'jquery-slick','cms-post-carousel-widget-js' );
}