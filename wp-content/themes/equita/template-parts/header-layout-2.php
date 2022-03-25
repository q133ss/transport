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
//Top Bar Note
$note_text = equita_get_opt( 'note_text' );
// Language
$lang_slides = equita_get_opt('lang_slides');
$result = 1;
if (!empty($lang_slides)) {
    $result = count($lang_slides);
}
$show_lang = true;
if ($result == 1 && empty($lang_slides[0]['title'])) {
    $show_lang = false;
}
?>
<header id="masthead" class="site-header">
    <div id="site-header-wrap" class="header-layout2 header-trans <?php if($sticky_on == 1) { echo 'is-sticky'; } ?>">
        <div id="site-header" class="site-header-main">
            <div class="container">
                <div class="row">
                    <div class="site-branding">
                        <?php get_template_part( 'template-parts/header-branding' ); ?>
                    </div>
                    <div class="site-navigation">
                        <nav class="main-navigation">
                            <?php get_template_part( 'template-parts/header-menu' ); ?>
                        </nav>
                        <?php
                        if ($search_on || ($h_btn_on == 'show') || $show_lang){
                            ?>
                            <div class="site-tool">
                                <?php if($search_on) : ?>
                                    <div class="site-header-item site-header-search">
                                        <span class="h-btn-search"><i class="fa fa-search"></i></span>
                                    </div>
                                <?php endif; ?>
                                <?php if($h_btn_on == 'show') : ?>
                                    <div class="site-header-item site-header-button">
                                        <a class="btn" href="<?php echo esc_url($h_btn_url); ?>" target="<?php echo esc_attr($h_btn_target); ?>"><?php echo esc_attr($h_btn_text); ?></a>
                                    </div>
                                <?php endif; ?>
                                <?php
                                if (class_exists('SitePress')) {
                                    ?>
                                    <div class="language-dropdow">
                                        <?php do_action('wpml_add_language_selector'); ?>
                                    </div>
                                    <?php
                                } elseif ($show_lang) {
                                    ?>
                                    <div class="language-dropdow">
                                        <ul>
                                            <li class="lang-item">
                                                <a class="lang-sel"
                                                   href="<?php echo esc_attr($lang_slides[0]['url']) ?>">
                                                    <span><?php echo esc_html($lang_slides[0]['title']) ?></span>
                                                </a>
                                                <?php
                                                if ($result > 1) {
                                                    ?>
                                                    <ul class="lang-submenu"><?php
                                                        for ($i = 1; $i < $result; $i++) {
                                                            ?>
                                                            <li class="lang-item">
                                                                <a href="<?php echo esc_attr($lang_slides[$i]['url']) ?>"><?php echo esc_html($lang_slides[$i]['title']) ?></a>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?></ul> <?php
                                                }
                                                ?>

                                            </li>
                                        </ul>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
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