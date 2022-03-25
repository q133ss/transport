<?php

class ETC_CmsSalesRepresentative_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_sales_representative';
    protected $title = 'Sales Representative';
    protected $icon = 'eicon-info-box';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"icon_section","label":"Sales Representative","tab":"content","controls":[{"name":"image","label":"Choose Image","type":"media"},{"name":"phone","label":"Phone","type":"text","default":"","placeholder":"Enter your phone","label_block":true},{"name":"title_text","label":"Title","type":"text","default":"","placeholder":"Enter your title","label_block":true}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}