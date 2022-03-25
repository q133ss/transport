<?php
/**
 * Template part for displaying default header layout
 */
$sticky_on = equita_get_opt( 'sticky_on', false );
$search_on = equita_get_opt( 'search_on', false );
$h_btn_on = equita_get_opt( 'h_btn_on', 'hide' );
$h_btn_text = equita_get_opt( 'h_btn_text' );
$h_btn_link_type = equita_get_opt( 'h_btn_link_type', 'page' );
$h_btn_link = equita_get_opt( 'h_btn_link' );
$h_btn_link_custom = equita_get_opt( 'h_btn_link_custom' );
$h_btn_target = equita_get_opt( 'h_btn_target', '_self' );
if($h_btn_link_type == 'page') {
    $h_btn_url = get_permalink($h_btn_link);
} else {
    $h_btn_url = $h_btn_link_custom;
}
$phone_label = equita_get_opt( 'phone_label' );
$phone_number = equita_get_opt( 'phone_number' );
$phone_result = preg_replace('#[ () ]*#', '', $phone_number);
$email_label = equita_get_opt( 'email_label' );
$email_address = equita_get_opt( 'email_address' );
$time_label = equita_get_opt( 'time_label' );
$time = equita_get_opt( 'time' );

?>
<header id="masthead" class="site-header">
    <div id="site-header-wrap" class="header-layout3 <?php if($sticky_on == 1) { echo 'is-sticky'; } ?>">
        <div class="site-header-top">
            <div class="container">
                <div class="row">
                    <div class="header-top-left">
                        <div class="site-branding">
                            <?php get_template_part( 'template-parts/header-branding' ); ?>
                        </div>
                    </div>

                    <div class="header-top-right">
                        <?php if(!empty($phone_number)) : ?>
                            <div class="header-top-item">
                                <i class="fas fac-phone"></i>
                                <div class="header-top-item-inner">
                                    <p><?php echo esc_html($phone_label); ?></p>
                                    <a href="tel:<?php echo esc_attr($phone_result); ?>"><?php echo esc_html($phone_number); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($email_address)) : ?>
                            <div class="header-top-item">
                                <i class="fas fac-envelope"></i>
                                <div class="header-top-item-inner">
                                    <p><?php echo esc_html($email_label); ?></p>
                                    <a href="mailto:<?php echo esc_attr($email_address); ?>"><?php echo esc_html($email_address); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($time)) : ?>
                            <div class="header-top-item">
                                <i class="fas fac-clock"></i>
                                <div class="header-top-item-inner">
                                    <p><?php echo esc_attr($time_label); ?></p>
                                    <span><?php echo esc_attr($time); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($h_btn_on == 'show') : ?>
                            <div class="site-header-button">
                                <a class="btn" href="<?php echo esc_url($h_btn_url); ?>" target="<?php echo esc_attr($h_btn_target); ?>"><?php echo esc_attr($h_btn_text); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="site-header" class="site-header-main">
            <div class="mobile-branding site-branding">
                <?php get_template_part( 'template-parts/header-branding' ); ?>
            </div>
            <div class="container">
                <div class="row">
                    <div class="site-navigation">
                        <nav class="main-navigation">
                            <?php get_template_part( 'template-parts/header-menu' ); ?>
                        </nav>
                    </div>
                    <div class="site-header-right">
                        <div class="site-header-social">
                            <?php equita_social_header(); ?>
                        </div>
                        <?php if($search_on) : ?>
                            <form role="search" method="get" class="search-form-popup" action="<?php echo esc_url(home_url( '/' )); ?>">
                                <div class="searchform-wrap">
                                    <input type="text" placeholder="<?php echo esc_attr__('Search...', 'equita'); ?>" id="h-search" name="s" class="search-field" />
                                    <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div id="main-menu-mobile">
                <span class="btn-nav-mobile open-menu">
                    <span></span>
                </span>
            </div>
        </div>
    </div>
</header>