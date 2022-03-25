<?php
$titles = equita_get_page_titles();
$pagetitle = equita_get_opt( 'pagetitle', 'show' );
$custom_pagetitle = equita_get_page_opt( 'custom_pagetitle', 'themeoption');
if($custom_pagetitle != 'themeoption' && $custom_pagetitle != '' && !is_archive() && !is_search() ) {
    $pagetitle = $custom_pagetitle;
}
ob_start();
if ( $titles['title'] )
{
    printf( '<h1 class="page-title">%s</h1>', esc_attr($titles['title']) );
}
$titles_html = ob_get_clean();
$breadcrumb_on = equita_get_opt( 'breadcrumb_on', false );
$ptitle_content_align = equita_get_opt( 'ptitle_content_align', 'center' );
// gradient on
$gradient = 'gradient-off';
$p_title_bg = equita_get_opt('ptitle_bg');
if (!empty($p_title_bg['background-image'])){
    $gradient = 'gradient-on';
}
if(is_404()) {
    return true;
}
if($pagetitle == 'show') : ?>
    <div id="pagetitle" class="pagetitle <?php echo esc_attr($gradient);?>">
        <div class="container">
            <div class="page-title-inner ptt-align-<?php echo esc_attr($ptitle_content_align);?>">
                <?php if($breadcrumb_on) : ?>
                    <?php equita_breadcrumb(); ?>
                <?php endif; ?>
                <?php printf( '%s', wp_kses_post($titles_html)); ?>
            </div>
        </div>
    </div>
<?php endif; ?>