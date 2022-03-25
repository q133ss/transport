<?php
$widget->add_render_attribute( 'inner', [
    'class' => 'cms-testimonial-inner',
    'dir' => $settings['dir'],
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
    'class' => 'cms-slick-carousel'.' '.$settings['content_style'],
    'data-dir' => $settings['dir'],
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
    <div class="cms-testimonial-carousel layout2 cms-slick-slider">
        <div <?php etc_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <div <?php etc_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php foreach ($settings['clients'] as $client): ?>
                    <div class="slick-slide">
                        <div class="cms-client-wrapper">
                            <div class="client-image">
                                <?php
                                if(!empty($client['client_image']['id'])){
                                    echo wp_get_attachment_image($client['client_image']['id']);
                                }
                                else{
                                    ?>
                                    <img src="<?php echo esc_url($client['client_image']['url']); ?>" alt="<?php echo esc_attr($client['client_name']); ?>">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="client-content">
                                <div class="client-heading-star">
                                    <?php if($client['rating'] != 'none') : ?>
                                        <div class="client-rating <?php echo esc_attr($client['rating']); ?>">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php
                                if(!empty($client['client_content'])){
                                    ?>
                                    <p class="said"><?php echo esc_html($client['client_content']); ?></p>
                                    <?php
                                }
                                ?>
                                <div class="client-name">
                                    <?php
                                    if (!empty($client['client_link']['id'])){
                                        $url = !empty($client['client_link']['id'])?$client['client_link']['id']:'#';
                                        $target = !empty($client['client_link']['is_external']);
                                        $rel = !empty($client['client_link']['nofollow']);
                                        ?>
                                        <a class="name-text" href="<?php echo esc_url($url); ?>" <?php etc_print_html($target?'target="_blank"':''); ?> <?php etc_print_html($rel?'rel="nofollow"':''); ?>>
                                            <?php echo esc_html($client['client_name']); ?>
                                        </a>
                                        <?php
                                    }else{
                                        ?> <h5 class="name-text"><?php echo esc_html($client['client_name']);?></h5> <?php
                                    }
                                    ?>
                                </div>
                                <div class="client-job">
                                    <?php
                                    if(!empty($client['client_job'])){
                                        ?>
                                        <p><?php echo esc_html($client['client_job']); ?></p>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
