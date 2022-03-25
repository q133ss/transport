<?php
$default_settings = [
    'newsletter_id' => '',
    'form_style' => 'default',
    'news_alignment' => 'left',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$html_id = etc_get_element_id($settings);
$defined_forms = array( 'form_1', 'form_2', 'form_3', 'form_4', 'form_5', 'form_6', 'form_7', 'form_8', 'form_9', 'form_10' );

if(class_exists('Newsletter') && !empty($newsletter_id)) : ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="cms-newsletter-form font-smooth <?php echo esc_attr($form_style);?>">
        <div class="cms-newsletter-form-inner news-<?php echo esc_attr($news_alignment); ?>">
            <?php
            if ( in_array( $newsletter_id, $defined_forms ) ) {
                $newsletter_id = str_replace( 'form_', '', $newsletter_id );
                echo do_shortcode( '[newsletter_form form="' . esc_attr( $newsletter_id ) . '"]' );
            } else {
                echo NewsletterSubscription::instance()->get_subscription_form_html5();
            }
            ?>
        </div>
    </div>
<?php endif; ?>
