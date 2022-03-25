<?php

class ETC_CmsVideoPlayer_Widget extends Elementor_Theme_Core_Widget_Base{
    protected $name = 'cms_video_player';
    protected $title = 'Video Player';
    protected $icon = 'eicon-play';
    protected $categories = array( 'elementor-theme-core' );
    protected $params = '{"sections":[{"name":"layout_section","label":"Layout","tab":"layout","controls":[{"name":"layout","label":"Templates","type":"layoutcontrol","default":"1","options":{"1":{"label":"Layout 1","image":"http:\/\/perevozki\/wp-content\/themes\/equita\/elementor\/templates\/widgets\/cms_video_player\/layout-image\/layout1.jpg"}}}]},{"name":"icon_section","label":"Video Player","tab":"content","controls":[{"name":"video_style","label":"Style","type":"select","options":{"style-image":"Image","style-background":"Background"},"default":"style-image"},{"name":"text_align","label":"Video Alignment","type":"choose","control_type":"responsive","options":{"left":{"title":"Left","icon":"fa fa-align-left"},"center":{"title":"Center","icon":"fa fa-align-center"},"right":{"title":"Right","icon":"fa fa-align-right"}},"condition":{"video_style":"style-background"},"selectors":{"{{WRAPPER}} .cms-video-player":"text-align: {{VALUE}};"}},{"name":"image","label":"Choose Image","type":"media","condition":{"video_style":"style-image"}},{"name":"video_link","label":"Link","type":"text"},{"name":"description","label":"Description","type":"textarea","label_block":true}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}