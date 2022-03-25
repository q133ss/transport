<?php

class ETC_CmsCtf7_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_ctf7';
    protected $title = 'Contact Form 7';
    protected $icon = 'eicon-form-horizontal';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"source_section","label":"Source Settings","tab":"content","controls":[{"name":"style","label":"Style","type":"select","options":{"style1":"Style 1"},"default":"style1"},{"name":"ctf7_title","label":"Title","type":"text","label_block":true,"condition":{"style":"style2"}},{"name":"ctf7_description","label":"Description","type":"textarea","rows":10,"show_label":false,"condition":{"style":"style2"}},{"name":"ctf7_id","label":"Select Form","type":"select","options":{"4427":"Request A Quote","4086":"Track and Trace Tab","4085":"Request Quote Tab","2692":"Contact Form Contact"}}]},{"name":"textarea_size","label":"Texarea Size","tab":"style","controls":[{"name":"message_height","type":"slider","label":"Message Height","size_units":["px"],"range":{"px":{"min":120,"max":350}},"default":{"unit":"px","size":""},"selectors":{"{{WRAPPER}} .wpcf7-form textarea.wpcf7-textarea":"height: {{SIZE}}{{UNIT}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}