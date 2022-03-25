<?php
/**
 * Template part for displaying site branding
 */

$logo = equita_get_opt( 'logo', array( 'url' => '', 'id' => '' ) );
$logo_url = $logo['url'];

$logo_dark = equita_get_page_opt( 'logo_dark', array( 'url' => '', 'id' => '' ) );

$custom_header = equita_get_page_opt( 'custom_header', '0' );

if ( $custom_header == '1' && !empty($logo_dark['url']) ) {
    $logo_url = $logo_dark['url'];
}

$logo_light = equita_get_opt( 'logo_light', array( 'url' => '', 'id' => '' ) );
$logo_light_url = $logo_light['url'];

$logo_mobile = equita_get_opt( 'logo_mobile', array( 'url' => '', 'id' => '' ) );
$logo_mobile_url = $logo_mobile['url'];

if (empty($logo_light_url)){
    $logo_light_url = get_template_directory_uri().'/assets/images/logo-light.png';
}
if (empty($logo_url)){
    $logo_url = get_template_directory_uri().'/assets/images/logo-dark.png';
}
if (empty($logo_mobile_url)){
    $logo_mobile_url = get_template_directory_uri().'/assets/images/logo-dark.png';
}

if ($logo_url || $logo_light_url || $logo_mobile_url)
{
    printf(
        '<a class="logo-light" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $logo_light_url )
    );
    printf(
        '<a class="logo-dark" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $logo_url )
    );
    printf(
        '<a class="logo-mobile" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $logo_mobile_url )
    );
}