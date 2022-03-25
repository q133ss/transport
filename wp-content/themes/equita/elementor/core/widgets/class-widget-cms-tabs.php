<?php

class ETC_CmsTabs_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_tabs';
    protected $title = 'Tabs';
    protected $icon = 'eicon-tabs';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"section_tabs","label":"Tabs","tab":"content","controls":[{"name":"active_tab","label":"Active Tab","type":"number","default":1,"separator":"after"},{"name":"tabs","label":"Tabs Items","type":"repeater","controls":[{"name":"tab_title","label":"Title","type":"text","default":"Tab Title","placeholder":"Tab Title","label_block":true},{"name":"title_icon","label":"Title Icon","type":"icons","fa4compatibility":"icon","default":{"value":"fas fa-star","library":"fa-solid"}},{"name":"content_type","label":"Content Type","type":"select","default":"text_editor","options":{"text_editor":"Text Editor","template":"Template"}},{"name":"tab_content","label":"Content","type":"wysiwyg","default":"Tab Content","placeholder":"Tab Content","show_label":false,"condition":{"content_type":"text_editor"}},{"name":"tab_content_template","label":"Template","type":"select","default":"","options":{"":"Select Template","5438":"Default Kit","5395":"omg","5189":"Form_Tab_2_no_banner (using)","5186":"Form_Tab_1_no_banner (using)","5139":"Google Map Location","5135":"Google Map","4999":"Default Kit","4625":"Map Location Box (Using)","4123":"Form_Tab_2 (using)","4081":"Form_Tab_1 (using)"},"condition":{"content_type":"template"}}],"title_field":"{{{ tab_title }}}"}]},{"name":"section_style_tab","label":"Style","tab":"style","controls":[{"name":"tab_background","label":"Tab Background","type":"color","selectors":{"{{WRAPPER}} .cms-tabs .cms-tab-title":"background-color: {{VALUE}};"}},{"name":"tab_color","label":"Tab Color","type":"color","selectors":{"{{WRAPPER}} .cms-tabs .cms-tab-title":"color: {{VALUE}};","{{WRAPPER}} .cms-tabs .cms-tab-title svg":"fill: {{VALUE}};"}},{"name":"tab_active_background","label":"Tab Active Background","type":"color","selectors":{"{{WRAPPER}} .cms-tabs .cms-tab-title.active":"background-color: {{VALUE}};"}},{"name":"tab_active_color","label":"Tab Active Color","type":"color","selectors":{"{{WRAPPER}} .cms-tabs .cms-tab-title.active":"color: {{VALUE}};","{{WRAPPER}} .cms-tabs .cms-tab-title.active svg":"fill: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'cms-tabs-widget-js' );
}