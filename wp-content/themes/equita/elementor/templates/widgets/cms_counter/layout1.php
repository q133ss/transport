<?php
$widget->add_render_attribute( 'counter', [
    'class' => 'elementor-counter-number',
    'data-duration' => $settings['duration'],
    'data-to-value' => $settings['ending_number'],
] );

if ( ! empty( $settings['thousand_separator'] ) ) {
    $delimiter = empty( $settings['thousand_separator_char'] ) ? ',' : $settings['thousand_separator_char'];
    $widget->add_render_attribute( 'counter', 'data-delimiter', $delimiter );
}
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<div class="cms-counter-layout1">
    <?php if($settings['icon_type'] == 'icon'): ?>
        <div class="cms-counter-icon">
            <?php if(!empty($settings['counter_icon'])): ?>
                <?php
                if($is_new):
                    \Elementor\Icons_Manager::render_icon( $settings['counter_icon'], [ 'aria-hidden' => 'true' ] );
                ?>
                <?php
                else:
                    $widget->add_render_attribute( 'i', 'class', $settings['counter_icon'] );
                    $widget->add_render_attribute( 'i', 'aria-hidden', 'true' );
                ?>
                    <i <?php etc_print_html($widget->get_render_attribute_string( 'i' )); ?>></i>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php elseif($settings['icon_type'] == 'image'): ?>
        <div class="cms-counter-image">
            <?php
                if(!empty($settings['icon_image'])){
                    echo wp_get_attachment_image($settings['icon_image']['id']);
                }
            ?>
        </div>
    <?php endif; ?>
    <div class="cms-counter-number-wrapper">
        <span class="cms-counter-number-prefix"><?php echo esc_html($settings['prefix']); ?></span>
        <span <?php etc_print_html($widget->get_render_attribute_string( 'counter' )); ?>><?php echo esc_html($settings['starting_number']); ?></span>
        <span class="cms-counter-number-suffix"><?php echo esc_html($settings['suffix']); ?></span>
    </div>
    <?php if ( $settings['title'] ) : ?>
        <div class="cms-counter-title"><?php echo etc_print_html($settings['title']); ?></div>
    <?php endif; ?>
</div>