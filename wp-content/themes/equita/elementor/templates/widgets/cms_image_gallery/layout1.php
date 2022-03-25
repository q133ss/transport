<?php
$html_id = etc_get_element_id($settings);
$col_xl = 12 / intval($widget->get_setting('col_xl', 3));
$col_lg = 12 / intval($widget->get_setting('col_lg', 3));
$col_md = 12 / intval($widget->get_setting('col_md', 2));
$col_sm = 12 / intval($widget->get_setting('col_sm', 1));
$col_xs = 12 / intval($widget->get_setting('col_xs', 1));
$grid_sizer = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
$gap_item = intval($widget->get_setting('gap', 15));
$grid_class = 'cms-grid-inner cms-grid-masonry row';
$thumbnail_size = $widget->get_setting('thumbnail_size', '');
$thumbnail_custom_dimension = $widget->get_setting('thumbnail_custom_dimension', '');
if ( ! $settings['wp_gallery'] ) {
    return;
}
$randGallery = $settings['wp_gallery'];
if ($settings['gallery_rand'] == 'rand'){
    shuffle($randGallery);
}
?>

<div id="<?php echo esc_attr($html_id) ?>" class="cms-grid cms-image-gallery images-light-box clearfix" data-layout="masonry">

    <div class="<?php echo esc_attr($grid_class); ?>" data-gutter="<?php echo esc_attr($gap_item); ?>">
        <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
        <?php
        if ($thumbnail_size != 'custom') {
            $img_size = $thumbnail_size;
        } elseif (!empty($thumbnail_custom_dimension['width']) && !empty($thumbnail_custom_dimension['height'])) {
            $img_size = $thumbnail_custom_dimension['width'] . 'x' . $thumbnail_custom_dimension['height'];
        } else {
            $img_size = 'full';
        }
        foreach ( $randGallery as $key => $value):
            $image = isset($value['id']) ? $value['id'] : '';
            $image_title = get_the_title($image);
            $img = etc_get_image_by_size( array(
                'attach_id'  => $image,
                'thumb_size' => $img_size,
                'class'      => '',
            ));
            $thumbnail = $img['thumbnail'];
            $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            ?>
            <div class="<?php echo esc_attr($item_class); ?>">
                <div class="grid-item-inner">
                    <span class="hover-effect cms-over">
                        <?php if(!empty($image)) : ?>
                            <?php echo wp_kses_post($thumbnail); ?>
                        <?php endif; ?>
                    </span>
                    <div class="grid-item-content">
                        <div class="up-icon">
                            <a class="light-box" data-elementor-open-lightbox="no" href="<?php echo esc_url(wp_get_attachment_image_url($image, 'full')); ?>" title="<?php echo esc_attr($image_title)?>">
                                <i class="zmdi zmdi-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="image-caption">
                    <?php echo wp_get_attachment_caption($image);?>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>