<?php

class ETC_CmsNavigationMenu_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_navigation_menu';
    protected $title = 'Navigation Menu';
    protected $icon = 'eicon-menu-bar';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"source_section","label":"Source Settings","tab":"content","controls":[{"name":"widget_title","label":"Widget Title","type":"textarea","label_block":true},{"name":"menu","label":"Select Menu","type":"select","options":{"main-menu":"Main Menu","menu-company":"Menu Company","menu-footer-bottom":"Menu Footer Bottom","menu-industries":"Menu Industries","menu-services":"Menu Services"}},{"name":"style","label":"Style","type":"select","options":{"default":"Default","e-sidebar-widget":"Sidebar Menu"},"default":"default"},{"name":"menu_align","label":"Alignment","type":"choose","control_type":"responsive","options":{"left":{"title":"Left","icon":"fa fa-align-left"},"center":{"title":"Center","icon":"fa fa-align-center"},"right":{"title":"Right","icon":"fa fa-align-right"}},"selectors":{"{{WRAPPER}} .cms-navigation-menu1.inline-white":"text-align: {{VALUE}};"},"condition":{"style":"inline-white"}},{"name":"link_color","label":"Link Color","type":"color","selectors":{"{{WRAPPER}} .cms-navigation-menu1 ul.menu li a":"color: {{VALUE}} !important;"}},{"name":"link_color_hover","label":"Link Color Hover &amp; Active","type":"color","selectors":{"{{WRAPPER}} .cms-navigation-menu1 ul.menu li a:hover, {{WRAPPER}} .cms-navigation-menu1 ul.menu li.current_page_item > a":"color: {{VALUE}} !important;"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}