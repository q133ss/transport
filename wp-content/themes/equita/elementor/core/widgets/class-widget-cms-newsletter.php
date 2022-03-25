<?php

class ETC_CmsNewsletter_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_newsletter';
    protected $title = 'Newsletter Forms';
    protected $icon = 'eicon-form-horizontal';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"source_section","label":"Content Settings","tab":"content","controls":[{"name":"newsletter_id","label":"Select Form","type":"select","options":{"default":"Default Form"},"default":"default"},{"name":"form_style","label":"Form Style","type":"select","options":{"default":"Default"},"default":"default"},{"name":"news_alignment","label":"Alignment","type":"select","default":"left","options":{"center":"Center","left":"Left","right":"Right"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'cms-newsletter-widget-js' );
}