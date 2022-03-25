<?php
$default_settings = [
    'ctf7_id' => '',
    'style' => '',
    'ctf7_title' => '',
    'ctf7_description' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = etc_get_element_id($settings);

if(class_exists('WPCF7') && !empty($ctf7_id)) : ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="cms-contact-form <?php echo esc_attr($style); ?>">
        <div class="cms-contact-form-inner">
        	<?php if(!empty($ctf7_title) || !empty($ctf7_description)) : ?>
	        	<div class="cms-contact-form-meta">
	        		<h3><?php echo esc_attr($ctf7_title); ?></h3>
	        		<p><?php echo esc_attr($ctf7_description); ?></p>
	        	</div>
	        <?php endif; ?>
            <?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $ctf7_id ).'"]'); ?>
        </div>
    </div>
<?php endif; ?>
