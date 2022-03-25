<?php

class ETC_CmsTeamGrid_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_team_grid';
    protected $title = 'Team Grid';
    protected $icon = 'eicon-user-circle-o';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/perevozki\/wp-content\/themes\/equita\/elementor\/templates\/widgets\/cms_team_grid\/layout-image\/layout1.jpg"}}}]},{"name":"section_list","label":"Content","tab":"content","controls":[{"name":"content_list","label":"Team List","type":"repeater","default":[],"controls":[{"name":"image","label":"Image","type":"media"},{"name":"title","label":"Title","type":"text","label_block":true},{"name":"position","label":"Position","type":"text"},{"name":"link","label":"Link","type":"url"},{"name":"social","label":"Social","type":"cms_icons"}],"title_field":"{{{ title }}}"}]},{"name":"grid_section","label":"Grid","tab":"content","controls":[{"name":"thumbnail","type":"image-size","control_type":"group","default":"full"},{"name":"col_xs","label":"Columns XS Devices","type":"select","default":"1","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_sm","label":"Columns SM Devices","type":"select","default":"2","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_md","label":"Columns MD Devices","type":"select","default":"3","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_lg","label":"Columns LG Devices","type":"select","default":"4","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}},{"name":"col_xl","label":"Columns XL Devices","type":"select","default":"4","options":{"1":"1","2":"2","3":"3","4":"4","6":"6"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'imagesloaded','isotope','cms-post-grid-widget-js' );
}