<?php
$html_id = etc_get_element_id($settings);
$tax = array();
$source = $widget->get_setting('source', '');
$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', 6);
$num_words = $widget->get_setting('num_words', 16);
$post_ids = $widget->get_setting('post_ids', '');
extract(etc_get_posts_of_grid('project', [
    'source' => $source,
    'orderby' => $orderby,
    'order' => $order,
    'limit' => $limit,
    'post_ids' => $post_ids,
]));
$widget->add_render_attribute( 'inner', [
    'class' => 'cms-project-carousel-inner',
] );

$filter_default_title = $widget->get_setting('filter_default_title', 'All');
$filter = $widget->get_setting('filter', 'false');
$filter_alignment = $widget->get_setting('filter_alignment', 'center');
$slides_to_show = $widget->get_setting('slides_to_show', '');
$slides_to_show_tablet = $widget->get_setting('slides_to_show_tablet', '');
$slides_to_show_mobile = $widget->get_setting('slides_to_show_mobile', '');
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');
$slides_to_scroll_tablet = $widget->get_setting('slides_to_scroll_tablet', '');
$slides_to_scroll_mobile = $widget->get_setting('slides_to_scroll_mobile', '');

$slidesToShow = !empty($slides_to_show)?$slides_to_show:3;
$isSingleSlide = 1 === $slidesToShow;
$defaultLGDevicesSlidesCount = $isSingleSlide ? 1 : 3;
$slidesToShowTablet = !empty($slides_to_show_tablet)?$slides_to_show_tablet:$defaultLGDevicesSlidesCount;
$slidesToShowMobile = !empty($slides_to_show_mobile)?$slides_to_show_mobile:1;
if($isSingleSlide){
    $slidesToScroll = 1;
}
else{
    $slidesToScroll = !empty($slides_to_scroll)?$slides_to_scroll:$defaultLGDevicesSlidesCount;
}
$slidesToScrollTablet = !empty($slides_to_scroll_tablet)?$slides_to_scroll_tablet:$defaultLGDevicesSlidesCount;
$slidesToScrollMobile = !empty($slides_to_scroll_mobile)?$slides_to_scroll_mobile:1;

$arrows = $widget->get_setting('arrows');
$dots = $widget->get_setting('dots');
$pause_on_hover = $widget->get_setting('pause_on_hover');
$autoplay = $widget->get_setting('autoplay');
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite');
$speed = $widget->get_setting('speed', '500');
$widget->add_render_attribute( 'carousel', [
    'class' => 'cms-slick-carousel',
    'data-arrows' => $arrows,
    'data-dots' => $dots,
    'data-pauseOnHover' => $pause_on_hover,
    'data-autoplay' => $autoplay,
    'data-autoplaySpeed' => $autoplay_speed,
    'data-infinite' => $infinite,
    'data-speed' => $speed,
    'data-slidesToShow' => $slidesToShow,
    'data-slidesToShowTablet' => $slidesToShowTablet,
    'data-slidesToShowMobile' => $slidesToShowMobile,
    'data-slidesToScroll' => $slidesToScroll,
    'data-slidesToScrollTablet' => $slidesToScrollTablet,
    'data-slidesToScrollMobile' => $slidesToScrollMobile,
] );

$title_tag = $widget->get_setting('title_tag', 'h3');

$thumbnail_size = $widget->get_setting('thumbnail_size', 'full');
$thumbnail_custom_dimension = $widget->get_setting('thumbnail_custom_dimension', '');
if($thumbnail_size != 'custom'){
    $img_size = $thumbnail_size;
}
elseif(!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])){
    $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
}
else{
    $img_size = 'full';
}
?>
<?php if (is_array($posts)): ?>
    <div id="<?php echo esc_attr($html_id) ?>" class="cms-project-carousel2 cms-slick-slider">
        <div <?php etc_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <?php if ($filter == "true"): ?>
                <div class="grid-filter-wrap align-<?php echo esc_attr($filter_alignment); ?>">
                    <span class="filter-item active" data-filter="*"><?php echo esc_html($filter_default_title); ?></span>
                    <?php foreach ($categories as $category): ?>
                        <?php $category_arr = explode('|', $category); ?>
                        <?php
                        if ($category_arr[1] != "post_tag"){
                            $tax[] = $category_arr[1];
                            $term = get_term_by('slug',$category_arr[0], $category_arr[1]);
                            ?>
                            <span class="filter-item" data-filter="<?php echo esc_attr('.' . $term->slug); ?>">
                                <?php echo esc_html($term->name); ?>
                            </span>
                            <?php
                        }
                        ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div <?php etc_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php
                foreach ($posts as $post):
                $img_id       = get_post_thumbnail_id( $post->ID );
                $img          = etc_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class'      => '',
                ) );
                $thumbnail    = $img['thumbnail'];
                $author = get_user_by('id', $post->post_author);
                $filter_class = etc_get_term_of_post_to_class($post->ID, array_unique($tax));
                ?>
                <div class="carousel-item slick-slide <?php echo esc_attr($filter_class); ?>">
                    <div class="grid-item-inner">
                        <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)): ?>
                            <div class="entry-featured">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="entry-body">
                            <div class="item-category">
                                <?php the_terms( $post->ID, 'project-category', '', ', ' ); ?>
                            </div>
                            <h3 class="entry-title">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                            </h3>
                            <div class="entry-content">
                                <?php
                                if (!empty($post->post_excerpt)) {
                                    echo wp_trim_words($post->post_excerpt, $num_words, $more = null);
                                } else {
                                    $content = strip_shortcodes($post->post_content);
                                    $content = apply_filters('the_content', $content);
                                    $content = str_replace(']]>', ']]&gt;', $content);
                                    $content = wp_trim_words($content, $num_words, '&hellip;');
                                    echo wp_kses_post($content);
                                }
                                ?>
                            </div>
                            <div class="entry-readmore">
                                <a class="btn-more" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_html__('Explore More', 'equita'); ?><i class="fac fac-arrow-right space-left"></i></a>
                            </div>
                    </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>