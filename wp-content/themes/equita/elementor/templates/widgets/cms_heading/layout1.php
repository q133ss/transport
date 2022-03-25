<?php
$widget->add_render_attribute( 'icon', 'class', [ 'elementor-icon', 'elementor-animation'] );

$icon_tag = 'span';
$has_heading = ! empty( $settings['heading_text'] );

if ( ! empty( $settings['link']['url'] ) ) {
    $widget->add_render_attribute( 'link', 'href', $settings['link']['url'] );
    $icon_tag = 'a';

    if ( $settings['link']['is_external'] ) {
        $widget->add_render_attribute( 'link', 'target', '_blank' );
    }

    if ( $settings['link']['nofollow'] ) {
        $widget->add_render_attribute( 'link', 'rel', 'nofollow' );
    }
}

$icon_attributes = $widget->get_render_attribute_string( 'icon' );
$link_attributes = $widget->get_render_attribute_string( 'link' );

$widget->add_render_attribute( 'subheading_text', 'class', ['custom-subheading'] );
$widget->add_render_attribute( 'description_text', 'class', 'custom-heading-description' );

$widget->add_inline_editing_attributes( 'heading_text', 'none' );
$widget->add_inline_editing_attributes( 'subheading_text' );
$widget->add_inline_editing_attributes( 'description_text' );
?>
<div class="cms-heading-wrapper cms-heading-layout1">
    <?php if(!empty($settings['subheading_text'])) : ?>
        <div <?php etc_print_html($widget->get_render_attribute_string( 'subheading_text' )); ?>><?php echo esc_html($settings['subheading_text']); ?></div>
    <?php endif; ?>

    <?php if ( $has_heading ) : ?>
        <<?php etc_print_html($settings['heading_size']); ?> class="custom-heading">
            <<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?><?php etc_print_html($widget->get_render_attribute_string( 'heading_text' )); ?>><?php echo wp_kses_post($settings['heading_text']); ?></<?php etc_print_html($icon_tag); ?>>
        </<?php etc_print_html($settings['heading_size']); ?>>
    <?php endif; ?>
    
    <?php if(!empty($settings['description_text'])) : ?>
        <div <?php etc_print_html($widget->get_render_attribute_string( 'description_text' )); ?>><?php echo wp_kses_post($settings['description_text']); ?></div>
    <?php endif; ?>
</div>