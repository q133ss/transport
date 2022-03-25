<?php
if ( ! empty( $settings['link']['url'] ) ) {
    $widget->add_render_attribute( 'link', 'href', $settings['link']['url'] );

    if ( $settings['link']['is_external'] ) {
        $widget->add_render_attribute( 'link', 'target', '_blank' );
    }

    if ( $settings['link']['nofollow'] ) {
        $widget->add_render_attribute( 'link', 'rel', 'nofollow' );
    }
}

$link_attributes = $widget->get_render_attribute_string( 'link' );

$widget->add_render_attribute( 'description_text', 'class', 'item--description' );

$widget->add_inline_editing_attributes( 'title_text', 'none' );
$widget->add_inline_editing_attributes( 'description_text' );

$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<div class="cms-fancy-box-layout4">
    <div class="item-content">
        <h3 class="item--title">
            <?php echo etc_print_html($settings['title_text']); ?>
        </h3>
        <div <?php etc_print_html($widget->get_render_attribute_string( 'description_text' )); ?>><?php echo esc_html($settings['description_text']); ?></div>
        <div class="item--button">
            <a class="btn-more" <?php echo implode( ' ', [ $link_attributes ] ); ?>><i class="fac fac-arrow-right"></i></a>
        </div>
    </div>
</div>