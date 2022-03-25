<?php
$widget->add_inline_editing_attributes( 'title_text', 'none' );
$img  = etc_get_image_by_size( array(
    'attach_id'  => $settings['image']['id'],
    'thumb_size' => '100x100',
    'class'      => '',
) );
$thumbnail    = $img['thumbnail'];
$phone_result = preg_replace('#[ () ]*#', '', $settings['phone']);
?>
<div class="cms-sales-representative">
    <?php if(!empty($settings['image']['id'])) : ?>
        <div class="item-image">
            <?php echo wp_kses_post($thumbnail); ?>
        </div>
    <?php endif; ?>
    <div class="item-meta">
        <a class="item-phone" href="mailto:<?php echo esc_attr($phone_result); ?>"><?php echo esc_attr($settings['phone']); ?></a>
        <h3 class="item-title">
            <?php echo esc_attr($settings['title_text']); ?>
        </h3>
    </div>
</div>