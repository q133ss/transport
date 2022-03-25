<?php

class ETC_CmsPricing_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_pricing';
    protected $title = 'Pricing';
    protected $icon = 'eicon-editor-list-ul';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/perevozki\/wp-content\/themes\/equita\/elementor\/templates\/widgets\/cms_pricing\/layout-image\/layout1.jpg"}}},{"name":"style","label":"Style","type":"select","options":{"style1":"Default","style2":"Primary","style3":"Secondary"},"default":"style1"}]},{"name":"section_list","label":"Content","tab":"content","controls":[{"name":"title","label":"Title","type":"text","placeholder":"Enter your title","label_block":true},{"name":"description","label":"Description","type":"textarea","placeholder":"Enter your description","rows":10,"show_label":false},{"name":"content_list","label":"Feature","type":"repeater","default":[],"controls":[{"name":"content","label":"Content","type":"text","label_block":true}],"title_field":"{{{ content }}}"},{"name":"price","label":"Price","type":"text"},{"name":"time","label":"Time","type":"text"},{"name":"button_text","label":"Button Text","type":"text","default":""},{"name":"button_link","label":"Link","type":"url"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}