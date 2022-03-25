<?php
$widget->add_render_attribute( 'inner', [
    'class' => 'cms-clients-list-inner',
] );
$slidesToShow = !empty($settings['slides_to_show'])?$settings['slides_to_show']:3;
$isSingleSlide = 1 === $slidesToShow;
$defaultLGDevicesSlidesCount = $isSingleSlide ? 1 : 2;
$slidesToShowTablet = !empty($settings['slides_to_show_tablet'])?$settings['slides_to_show_tablet']:$defaultLGDevicesSlidesCount;
$slidesToShowMobile = !empty($settings['slides_to_show_mobile'])?$settings['slides_to_show_mobile']:1;
if($isSingleSlide){
    $slidesToScroll = 1;
}
else{
    $slidesToScroll = !empty($settings['slides_to_scroll'])?$settings['slides_to_scroll']:$defaultLGDevicesSlidesCount;
}
$slidesToScrollTablet = !empty($settings['slides_to_scroll_tablet'])?$settings['slides_to_scroll_tablet']:$defaultLGDevicesSlidesCount;
$slidesToScrollMobile = !empty($settings['slides_to_scroll_mobile'])?$settings['slides_to_scroll_mobile']:1;
$widget->add_render_attribute( 'carousel', [
    'class' => 'cms-slick-carousel',
    'data-arrows' => $settings['arrows'],
    'data-dots' => $settings['dots'],
    'data-pauseOnHover' => $settings['pause_on_hover'],
    'data-autoplay' => $settings['autoplay'],
    'data-autoplaySpeed' => $settings['autoplay_speed'],
    'data-infinite' => $settings['infinite'],
    'data-speed' => $settings['speed'],
    'data-slidesToShow' => $slidesToShow,
    'data-slidesToShowTablet' => $slidesToShowTablet,
    'data-slidesToShowMobile' => $slidesToShowMobile,
    'data-slidesToScroll' => $slidesToScroll,
    'data-slidesToScrollTablet' => $slidesToScrollTablet,
    'data-slidesToScrollMobile' => $slidesToScrollMobile,
] );
?>
<?php if(isset($settings['clients']) && !empty($settings['clients']) && count($settings['clients'])): ?>
    <div class="cms-client1 cms-slick-slider">
        <div <?php etc_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <div <?php etc_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php foreach ($settings['clients'] as $client): 
                    $img          = etc_get_image_by_size( array(
                        'attach_id'  => $client['client_image']['id'],
                        'thumb_size' => 'full',
                        'class'      => '',
                    ) );
                    $thumbnail    = $img['thumbnail'];
                    $url = !empty($client['client_link']['id'])?$client['client_link']['id']:'#';
                    $target = !empty($client['client_link']['is_external']);
                    $rel = !empty($client['client_link']['nofollow']);
                    if(!empty($client['client_image']['id'])){ ?>
                        <div class="slick-slide">
                            <div class="client-image">
                                <a href="<?php echo esc_url($url); ?>" <?php etc_print_html($target?'target="_blank"':''); ?> <?php etc_print_html($rel?'rel="nofollow"':''); ?>><?php echo wp_kses_post($thumbnail); ?></a>
                            </div>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
