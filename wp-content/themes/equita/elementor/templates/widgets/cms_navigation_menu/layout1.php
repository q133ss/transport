<?php
$default_settings = [
    'widget_title' => '',
    'menu' => '',
    'style' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
if(!empty($menu)) : ?>
    <div class="cms-navigation-menu1 <?php echo esc_attr($style); ?>">
        <?php if(!empty($widget_title)) : ?>
            <h3 class="widget-title"><?php etc_print_html( nl2br($widget_title) ); ?></h3>
        <?php endif; ?>
        <?php wp_nav_menu(array(
                'fallback_cb' => '',
                'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                'menu'        => $menu
            )
        ); ?>
    </div>
<?php endif; ?>