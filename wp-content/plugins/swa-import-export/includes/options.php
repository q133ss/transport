<?php
/**
 * @Template: options.php
 * @since: 1.0.0
 * @author: KP
 * @descriptions:
 * @create: 16-Nov-17
 */

if (!defined('ABSPATH')) {
    die();
}

/**
 * theme_core_ie_options_export
 * @descriptions: Export options data of WP Settings
 *
 * @param: $file
 */
function swa_ie_options_export($file)
{
    global $wp_filesystem;

    $upload_dir = wp_upload_dir();

    $options = array();

    /* default. */
    $options['home'] = swa_ie_options_get_home_page();
    $options['blog'] = swa_ie_options_get_blog_page();
    $options['shop'] = swa_ie_options_get_shop_page();
    $options['cart'] = swa_ie_options_get_cart_page();
    $options['checkout'] = swa_ie_options_get_checkout_page();
    $options['my_account'] = swa_ie_options_get_my_account_page();
    $options['menus'] = swa_ie_options_get_menus();
    $options['opt-name'] = swa_ie_setting_get_opt_name($file);
    $options['export'] = !empty($_POST['swa-ie-data-type']) ? $_POST['swa-ie-data-type'] : array();

    /* wp options */
    $options['wp-options'] = swa_ie_options_get_wp_options(apply_filters('swa_ie_options_wp_options', array(
        'permalink_structure'
    )));

    /* attachment */
    if (file_exists($upload_dir['basedir'] . '/cms-attachment-tmp.zip')) {
        $options['attachment'] = $upload_dir['baseurl'] . '/cms-attachment-tmp.zip';
    }

    $wp_filesystem->put_contents($file, json_encode($options), FS_CHMOD_FILE);
}

function swa_ie_options_get_home_page()
{
    $_page_id = get_option('page_on_front');

    if ($_page_id) {
        $_page = get_post($_page_id);

        if ($_page && $_page->ID) {
            return $_page->post_name;
        }
    }

    return null;
}

function swa_ie_options_get_blog_page()
{
    $_page_id = get_option('page_for_posts');

    if ($_page_id) {
        $_page = get_post($_page_id);

        if ($_page && $_page->ID) {
            return $_page->post_name;
        }
    }

    return null;
}

function swa_ie_options_get_shop_page()
{

    $page_id = get_option('woocommerce_shop_page_id');

    if (!$page_id) {
        return null;
    }

    $page = new WP_Query(array('post_type' => 'page', 'posts_per_page' => 1, 'page_id' => $page_id));

    if (!$page->post) {
        return null;
    }

    return $page->post->post_name;
}

function swa_ie_options_get_cart_page()
{

    $page_id = get_option('woocommerce_cart_page_id');

    if (!$page_id) {
        return null;
    }

    $page = new WP_Query(array('post_type' => 'page', 'posts_per_page' => 1, 'page_id' => $page_id));

    if (!$page->post) {
        return null;
    }

    return $page->post->post_name;
}

function swa_ie_options_get_checkout_page()
{

    $page_id = get_option('woocommerce_checkout_page_id');

    if (!$page_id) {
        return null;
    }

    $page = new WP_Query(array('post_type' => 'page', 'posts_per_page' => 1, 'page_id' => $page_id));

    if (!$page->post) {
        return null;
    }

    return $page->post->post_name;
}

function swa_ie_options_get_my_account_page()
{

    $page_id = get_option('woocommerce_myaccount_page_id');

    if (!$page_id) {
        return null;
    }

    $page = new WP_Query(array('post_type' => 'page', 'posts_per_page' => 1, 'page_id' => $page_id));

    if (!$page->post) {
        return null;
    }

    return $page->post->post_name;
}

function swa_ie_options_get_menus()
{

    $theme_locations = get_nav_menu_locations();

    if (empty($theme_locations)) {
        return null;
    }

    foreach ($theme_locations as $key => $id) {
        $menu_object = wp_get_nav_menu_object($id);
        $theme_locations[$key] = $menu_object->slug;
    }

    return $theme_locations;
}

function swa_ie_options_get_wp_options($options = array())
{
    if (empty($options)) {
        return $options;
    }

    $_options = array();

    foreach ($options as $key) {
        $_options[$key] = get_option($key);
    }

    return $_options;
}


/**
 * Import wp options functions
 *
 * @param $options
 */
function swa_ie_options_import($options)
{
    global $import_result;
    foreach ($options as $key => $option) {
        switch ($key) {
            case 'home':
                swa_ie_options_set_home_page($option);
                $import_result[] = esc_html__('Set home page successfully!', 'swa-ie');
                break;
            case 'blog':
                swa_ie_options_set_blog_page($option);
                $import_result[] = esc_html__('Set blog page successfully!', 'swa-ie');
                break;
            case 'shop':
                swa_ie_options_set_shop_page($option);
                $import_result[] = esc_html__('Set shop page successfully!', 'swa-ie');
                break;
            case 'cart':
                swa_ie_options_set_cart_page($option);
                $import_result[] = esc_html__('Set cart page successfully!', 'swa-ie');
                break;
            case 'checkout':
                swa_ie_options_set_checkout_page($option);
                $import_result[] = esc_html__('Set checkout page successfully!', 'swa-ie');
                break;
            case 'my_account':
                swa_ie_options_set_my_account_page($option);
                $import_result[] = esc_html__('Set my account page successfully!', 'swa-ie');
                break;
            case 'menus':
                swa_ie_options_set_menus($option);
                $import_result[] = esc_html__('Import menus successfully!', SWA_TEXT_DOMAIN);
                break;
            case 'wp-options':
                swa_ie_options_set_wp_options($option);
                $import_result[] = esc_html__('Import wp options successfully!', SWA_TEXT_DOMAIN);
                break;
        }
    }
}

function swa_ie_options_set_home_page($slug)
{

    $page = new WP_Query(array('post_type' => 'page', 'posts_per_page' => 1, 'name' => $slug));

    if (!$page->post) {
        return null;
    }

    update_option('show_on_front', 'page');
    update_option('page_on_front', $page->post->ID);
}

function swa_ie_options_set_blog_page($slug)
{

    $page = new WP_Query(array('post_type' => 'page', 'posts_per_page' => 1, 'name' => $slug));

    if (!$page->post) {
        return null;
    }

    update_option('show_on_front', 'page');
    update_option('page_for_posts', $page->post->ID);
}

function swa_ie_options_set_shop_page($slug)
{

    $page = new WP_Query(array('post_type' => 'page', 'posts_per_page' => 1, 'name' => $slug));

    if (!$page->post) {
        return null;
    }

    update_option('woocommerce_shop_page_id', $page->post->ID);
}

function swa_ie_options_set_cart_page($slug)
{

    $page = new WP_Query(array('post_type' => 'page', 'posts_per_page' => 1, 'name' => $slug));

    if (!$page->post) {
        return null;
    }

    update_option('woocommerce_cart_page_id', $page->post->ID);
}

function swa_ie_options_set_checkout_page($slug)
{

    $page = new WP_Query(array('post_type' => 'page', 'posts_per_page' => 1, 'name' => $slug));

    if (!$page->post) {
        return null;
    }

    update_option('woocommerce_checkout_page_id', $page->post->ID);
}

function swa_ie_options_set_my_account_page($slug)
{

    $page = new WP_Query(array('post_type' => 'page', 'posts_per_page' => 1, 'name' => $slug));

    if (!$page->post) {
        return null;
    }

    update_option('woocommerce_myaccount_page_id', $page->post->ID);
}

function swa_ie_options_set_menus($menus)
{
    if (!empty($menus)) {
        $new_setting = array();
        foreach ($menus as $key => $menu) {

            $_menu = get_term_by('slug', $menu, 'nav_menu');
            if ($_menu !== false) {
                $new_setting[$key] = $_menu->term_id;
            }
        }

        set_theme_mod('nav_menu_locations', $new_setting);

    }
}

function swa_ie_options_set_wp_options($options = array())
{
    if (empty($options)) {
        return;
    }

    global $wp_rewrite;

    foreach ($options as $key => $value) {
        if ($key == 'permalink_structure') {
            $permalink_structure = sanitize_option('permalink_structure', $value);
            $wp_rewrite->set_permalink_structure($permalink_structure);
            continue;
        }
        update_option($key, $value);
    }
}
