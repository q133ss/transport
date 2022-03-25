<?php

class ETC_CmsDownload_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_download';
    protected $title = 'Download';
    protected $icon = 'eicon-file-download';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/perevozki\/wp-content\/themes\/equita\/elementor\/templates\/widgets\/cms_download\/layout-image\/layout1.jpg"}}}]},{"name":"section_list","label":"Content","tab":"content","controls":[{"name":"el_title","label":"Element Title","type":"textarea","label_block":true},{"name":"download","label":"Download Lists","type":"repeater","default":[],"controls":[{"name":"title","label":"Title","type":"textarea","label_block":true},{"name":"file_type","label":"File Type","type":"text"},{"name":"link","label":"Link","type":"url"},{"name":"background","label":"Text Color","type":"color","default":"#e11d07"}],"title_field":"{{{ title }}}"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}