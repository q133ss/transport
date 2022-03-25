<?php
$default_settings = [
    'el_title' => '',
    'download' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
?>
<?php if(isset($download) && !empty($download) && count($download)): ?>
    <div class="cms-download e-sidebar-widget">
    	<?php if(!empty($el_title)) : ?>
    		<h3 class="widget-title"><?php echo esc_attr($el_title); ?></h3>
    	<?php endif; ?>
        <?php foreach ($download as $key => $cms_download):
        	$link_key = $widget->get_repeater_setting_key( 'title', 'download', $key );
        	if ( ! empty( $cms_download['link']['url'] ) ) {
			    $widget->add_render_attribute( $link_key, 'href', $cms_download['link']['url'] );

			    if ( $cms_download['link']['is_external'] ) {
			        $widget->add_render_attribute( $link_key, 'target', '_blank' );
			    }

			    if ( $cms_download['link']['nofollow'] ) {
			        $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
			    }
			}
			$link_attributes = $widget->get_render_attribute_string( $link_key );
        	?>
            <div class="item--download">
            	<a <?php echo etc_print_html($link_attributes); ?> style="background-color: <?php echo esc_attr($cms_download['background']);?>">
                    <span class="download-title"><?php echo esc_html($cms_download['title']); ?></span>
	            	<?php if(!empty($cms_download['file_type'])) : ?>
	            		<span class="download-file-type" style="color: <?php echo esc_attr($cms_download['background']);?>">
                            <?php echo esc_attr($cms_download['file_type']); ?>
                        </span>
	            	<?php endif; ?>
	            </a>
           </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
