<?php
$default_settings = [
    'image' => '',
    'description' => '',
    'phone' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
?>
    <div class="cms-banner-contact1">
        <div class="cms-banner-holder">
            <div class="cms-banner-desc"><?php echo wp_kses_post($description); ?></div>
            <div class="cms-banner-phone"><i class="zmdi zmdi-phone"></i><?php echo esc_attr($phone); ?></div>
        </div>
    </div>