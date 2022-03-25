<?php

class ETC_CmsBannerContact_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_banner_contact';
    protected $title = 'Banner Contact';
    protected $icon = 'eicon-info-box';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/perevozki\/wp-content\/themes\/equita\/elementor\/templates\/widgets\/cms_banner_contact\/layout-image\/layout1.jpg"}}}]},{"name":"content_section","label":"Content","tab":"content","controls":[{"name":"description","label":"Description","type":"textarea","rows":10,"show_label":false},{"name":"phone","label":"Phone","type":"text"},{"name":"content_color","label":"Content Color","type":"color","selectors":{"{{WRAPPER}} .cms-banner-contact1 .cms-banner-holder":"color: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}