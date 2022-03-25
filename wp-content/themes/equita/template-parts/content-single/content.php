<?php
/**
 * Template part for displaying posts in loop
 *
 * @package Equita
 */
$post_tags_on = equita_get_opt( 'post_tags_on', true );
$post_navigation_on = equita_get_opt( 'post_navigation_on', false );
$post_author_info_on = equita_get_opt( 'post_author_info_on', false );
$post_social_share_on = equita_get_opt( 'post_social_share_on', false );
$post_feature_image_on = equita_get_opt( 'post_feature_image_on', true );
$post_title_on = equita_get_opt('post_title_on', false);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-hentry'); ?>>
    <?php if (has_post_format('gallery')) : ?>
        <div class="entry-featured">
            <?php
            $light_box = equita_get_post_format_value('post-gallery-lightbox', '0');
            $gallery_list = explode(',', equita_get_post_format_value('post-gallery-images', ''));
            wp_enqueue_script( 'owl-carousel' );
            wp_enqueue_script( 'equita-carousel' );
            ?>
            <div class="cms-carousel owl-carousel featured-active <?php if($light_box) {echo 'images-light-box';} ?>" data-item-xs="1" data-item-sm="1" data-item-md="1" data-item-lg="1" data-item-xl="1" data-item-xxl="1" data-margin="30" data-loop="true" data-autoplay="false" data-autoplaytimeout="5000" data-smartspeed="250" data-center="false" data-arrows="true" data-bullets="false" data-stagepadding="0" data-stagepaddingsm="0" data-rtl="false">
                <?php
                foreach ($gallery_list as $img_id):
                    ?>
                    <div class="cms-carousel-item">
                        <a class="light-box" href="<?php echo esc_url(wp_get_attachment_image_url($img_id, 'full'));?>"><img src="<?php echo esc_url(wp_get_attachment_image_url($img_id, 'large'));?>" alt="<?php echo esc_attr(get_post_meta( $img_id, '_wp_attachment_image_alt', true )) ?>"></a>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
            <h2 class="entry-title">
                <a href="<?php echo esc_url( get_permalink()); ?>">
                    <?php if(is_sticky()) { ?>
                        <i class="fa fa-thumb-tack"></i>
                    <?php } ?>
                    <?php the_title(); ?>
                </a>
            </h2>
        </div>
    <?php elseif (has_post_format('quote')) : ?>
        <div class="entry-featured">
            <?php
                $quote_text = equita_get_post_format_value('post-quote-cite', '');
                echo esc_attr($quote_text);
            ?>
        </div>
    <?php elseif (has_post_format('link')) : ?>
        <div class="entry-featured">
            <?php
                $link_pf = equita_get_post_format_value('post-link-url', '#');
                echo esc_url($link_pf);
            ?>
        </div>
    <?php elseif (has_post_format('video')) : ?>
        <div class="entry-featured">
            <div class="entry-video featured-active">
                <?php
                $video_url = equita_get_post_format_value('post-video-url', '#');
                $video_file = equita_get_post_format_value('post-video-file', '');
                $video_html = equita_get_post_format_value('post-video-html', '');
                $video = '';
                if (!empty($video_url)) {
                    global $wp_embed;
                    echo esc_html($wp_embed->run_shortcode('[embed]' . $video_url . '[/embed]'));
                } elseif (!empty($video_file)) {
                    if (strpos('[embed', $video_file)) {
                        global $wp_embed;
                        echo esc_html($wp_embed->run_shortcode($video_file));
                    } else {
                        echo do_shortcode($video_file);
                    }
                } else {
                    if ('' != $video_html) {
                        echo esc_html($video_html);
                    }
                }
                ?>
            </div>
        </div>
    <?php elseif (has_post_format('audio')) : ?>
        <div class="entry-featured">
            <?php
                $audio_url = equita_get_post_format_value('post-audio-url', '#');
                echo esc_url($audio_url);
            ?>
        </div>
    <?php endif; ?>
    <div class="entry-body">
        <?php equita_post_meta(); ?>
        <?php if($post_title_on){ ?>
            <div class="data">
                <h2 class="entry-title">
                    <?php the_title(); ?>
                </h2>
            </div>
        <?php } ?>
        <div class="entry-content clearfix">
            <?php
                the_content();
                wp_link_pages( array(
                    'before'      => '<div class="page-links">',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <?php if($post_social_share_on) {
            equita_socials_share_default();
        } ?>
        <?php if($post_tags_on) :
            equita_entry_tagged_in();
        endif; ?>
        <?php if($post_navigation_on) : ?>
            <div class="entry-navigation">
                <?php equita_post_nav_default(); ?>
            </div>
        <?php endif; ?>
        <?php if($post_author_info_on) : ?>
            <div class="entry-author-info">
                <div class="author-post">
                    <div class="author-avatar">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 'full' ); ?>
                        </div>
                    <div class="author-description">
                        <div class="author-name">
                            <?php the_author_posts_link(); ?>
                        </div>
                        <p>
                            <?php the_author_meta( 'description' ); ?>
                        </p>
                        <?php equita_get_user_social(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</article><!-- #post -->