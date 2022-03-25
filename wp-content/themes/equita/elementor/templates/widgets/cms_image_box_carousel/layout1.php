<?php
$widget->add_render_attribute( 'inner', [
    'class' => 'cms-box-inner',
] );
$widget->add_render_attribute( 'carousel', [
    'class' => 'cms-slick-carousel',
    'data-dots' => $settings['dots'],
    'data-pauseOnHover' => $settings['pause_on_hover'],
    'data-autoplay' => $settings['autoplay'],
    'data-autoplaySpeed' => $settings['autoplay_speed'],
    'data-infinite' => $settings['infinite'],
    'data-speed' => $settings['speed'],
    'data-slidesToShow' => 1,
    'data-slidesToShowTablet' => 1,
    'data-slidesToShowMobile' => 1,
    'data-slidesToScroll' => 1,
    'data-slidesToScrollTablet' => 1,
    'data-slidesToScrollMobile' => 1,
] );
?>
<?php if(isset($settings['boxs']) && !empty($settings['boxs']) && count($settings['boxs'])): ?>
    <div class="cms-image-box-carousel cms-slick-slider">
        <div <?php etc_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php foreach ($settings['boxs'] as $box):
                    $img          = etc_get_image_by_size( array(
                        'attach_id'  => $box['box_image']['id'],
                        'thumb_size' => 'full',
                        'class'      => '',
                    ) );
                    $thumbnail    = $img['thumbnail'];
                    $url = !empty($box['client_link']['id'])?$box['client_link']['id']:'#';
                    $target = !empty($box['client_link']['is_external']);
                    $rel = !empty($box['client_link']['nofollow']);
                    if(!empty($box['box_image']['id']) || !empty($box['box_text'])){ ?>
                        <div class="slick-slide">
                            <div <?php etc_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
                                <div class="box-image">
                                    <a href="<?php echo esc_url($url); ?>" <?php etc_print_html($target?'target="_blank"':''); ?> <?php etc_print_html($rel?'rel="nofollow"':''); ?>><?php echo wp_kses_post($thumbnail); ?></a>
                                </div>
                                <div class="box-text">
                                    <?php
                                    if (!empty($box['box_text'])){
                                        ?><h4><?php echo esc_html($box['box_text']);?></h4><?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            </div>
    </div>
<?php endif; ?>
