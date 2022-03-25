<?php
/**
 * Custom post types register.
 * @since   1.0
 * @author  KP
 *
 */

class EFramework_CPT_Register
{
    /**
     * Core singleton class
     *
     * @var self - pattern realization
     * @access private
     */
    private static $_instance;

    /**
     * Store supported post types in an array
     * @var array
     * @access private
     */
    private $post_types = array();

    private $post_type = '';

    /**
     * Constructor
     *
     * @access private
     */
    private function __construct()
    {
        add_action('init', array($this, 'init'), 0);
        add_action('init', array($this, 'cms_featured_handlers'));
        add_action('admin_menu', array($this, 'cms_remove_post_custom_fields'),99);
    }

    function init()
    {
        $this->post_types = apply_filters('cms_extra_post_types', array(
            'portfolio' => array()
        ));
        $this->post_types['portfolio'] = array_merge(
            array(
                'status' => true,
                'post_featured' => false,
                'item_name' => __('Portfolio', ETC_TEXT_DOMAIN),
                'items_name' => __('Portfolios', ETC_TEXT_DOMAIN),
                'args' => array(),
                'labels' => array(
                    'singular_name' => __('Portfolio', ETC_TEXT_DOMAIN),
                    'add_new' => _x('Add New', 'add new on admin panel', ETC_TEXT_DOMAIN),
                )
            ), $this->post_types['portfolio']
        );
        foreach ($this->post_types as $key => $cms_post_type) {
            if ($cms_post_type['status'] === true):
                $cms_post_type_args = !empty($cms_post_type['args']) ? $cms_post_type['args'] : array();
                $cms_post_type_labels = !empty($cms_post_type['labels']) ? $cms_post_type['labels'] : array();
                $args = array_merge(array(
                    'labels' => array_merge(array(
                        'name' => $cms_post_type['item_name'],
                        'singular_name' => $cms_post_type['item_name'],
                        'add_new' => _x('Add New', 'add new on admin panel', ETC_TEXT_DOMAIN),
                        'add_new_item' => __('Add New', ETC_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'],
                        'edit_item' => __('Edit', ETC_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'],
                        'new_item' => __('New', ETC_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'],
                        'view_item' => __('View', ETC_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'],
                        'view_items' => __('View', ETC_TEXT_DOMAIN) . ' ' . $cms_post_type['items_name'],
                        'search_items' => __('Search', ETC_TEXT_DOMAIN) . ' ' . $cms_post_type['items_name'],
                        'not_found' => __('No', ETC_TEXT_DOMAIN) . ' ' . $cms_post_type['items_name'] . ' ' . __('Found', ETC_TEXT_DOMAIN),
                        'not_found_in_trash' => __('No', ETC_TEXT_DOMAIN) . ' ' . $cms_post_type['items_name'] . ' ' . __('Found in Trash', ETC_TEXT_DOMAIN),
                        'parent_item_colon' => __('Parent', ETC_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'] . ':',
                        'all_items' => __('All', ETC_TEXT_DOMAIN) . ' ' . $cms_post_type['items_name'],
                        'archives' => $cms_post_type['item_name'] . ' ' . __('Archives', ETC_TEXT_DOMAIN),
                        'attributes' => $cms_post_type['item_name'] . ' ' . __('Entry Attributes', ETC_TEXT_DOMAIN),
                        'uploaded_to_this_item' => __('Uploaded to this', ETC_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'],
                        'menu_name' => $cms_post_type['item_name'],
                        'filter_items_list' => __('Filter', ETC_TEXT_DOMAIN) . ' ' . $cms_post_type['item_name'] . ' ' . __('list', ETC_TEXT_DOMAIN),
                        'items_list_navigation' => $cms_post_type['item_name'] . ' ' . __('list navigation', ETC_TEXT_DOMAIN),
                        'items_list' => $cms_post_type['item_name'] . ' ' . __('list', ETC_TEXT_DOMAIN),
                        'name_admin_bar' => $cms_post_type['item_name']
                    ), $cms_post_type_labels),
                    'hierarchical' => false,
                    'description' => '',
                    'public' => true,
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'menu_position' => null,
                    'menu_icon' => 'dashicons-portfolio',
                    'show_in_nav_menus' => true,
                    'publicly_queryable' => true,
                    'exclude_from_search' => false,
                    'has_archive' => true,
                    'query_var' => true,
                    'can_export' => true,
                    'capability_type' => 'post',
                    'supports' => array(
                        'title',
                        'editor',
                        'thumbnail',
                        'excerpt',
                        'revisions',
                        'author'
                    )
                ), $cms_post_type_args);
                register_post_type($key, $args);
                flush_rewrite_rules();
                $this->post_type = $key;
                if (isset($cms_post_type['post_featured']) && $cms_post_type['post_featured'] === true) {
                    add_filter('manage_' . $key . '_posts_columns', array($this, 'cms_add_column_featured'));
                    add_filter('manage_' . $key . '_posts_custom_column', array($this, 'cms_add_content_featured_column'), 10, 2);
                }

            endif;
        }
    }


    function cms_remove_post_custom_fields()
    {
        remove_meta_box('postcustom', 'page', 'normal');
        remove_meta_box('postcustom', 'page', 'side');
        remove_meta_box('postcustom', 'page', 'advanced');
    }

    /**
     * Registers portfolio post type, this function should be called in an init hook function.
     * @uses $wp_post_types Inserts new post type object into the list
     *
     * @access protected
     */
    protected function type_portfolio_register()
    {

//        $portfolio_slug = function_exists('abtheme_get_opt') ? abtheme_get_opt('portfolio_slug', 'portfolio') : 'portfolio';
//        $args = apply_filters('cmssuperheroes_portfolio_post_type_args', array(
//            'labels'              => array(
//                'name'                  => __('Portfolio', ETC_TEXT_DOMAIN),
//                'singular_name'         => __('Portfolio Entry', ETC_TEXT_DOMAIN),
//                'add_new'               => _x('Add New', 'add new on admin panel', ETC_TEXT_DOMAIN),
//                'add_new_item'          => __('Add New Portfolio Entry', ETC_TEXT_DOMAIN),
//                'edit_item'             => __('Edit Portfolio Entry', ETC_TEXT_DOMAIN),
//                'new_item'              => __('New Portfolio Entry', ETC_TEXT_DOMAIN),
//                'view_item'             => __('View Portfolio Entry', ETC_TEXT_DOMAIN),
//                'view_items'            => __('View Portfolio Entries', ETC_TEXT_DOMAIN),
//                'search_items'          => __('Search Portfolio Entries', ETC_TEXT_DOMAIN),
//                'not_found'             => __('No Portfolio Entries Found', ETC_TEXT_DOMAIN),
//                'not_found_in_trash'    => __('No Portfolio Entries Found in Trash', ETC_TEXT_DOMAIN),
//                'parent_item_colon'     => __('Parent Portfolio Entry:', ETC_TEXT_DOMAIN),
//                'all_items'             => __('All Entries', ETC_TEXT_DOMAIN),
//                'archives'              => __('Portfolio Archives', ETC_TEXT_DOMAIN),
//                'attributes'            => __('Portfolio Entry Attributes', ETC_TEXT_DOMAIN),
//                'insert_into_item'      => __('Insert into Portfolio Entry', ETC_TEXT_DOMAIN),
//                'uploaded_to_this_item' => __('Uploaded to this Portfolio Entry', ETC_TEXT_DOMAIN),
//                'menu_name'             => __('Portfolio', ETC_TEXT_DOMAIN),
//                'filter_items_list'     => __('Filter portfolio list', ETC_TEXT_DOMAIN),
//                'items_list_navigation' => __('Portfolio list navigation', ETC_TEXT_DOMAIN),
//                'items_list'            => __('Portfolio list', ETC_TEXT_DOMAIN),
//                'name_admin_bar'        => _x('Portfolio', 'add new on admin bar', ETC_TEXT_DOMAIN)
//            ),
//            'hierarchical'        => false,
//            'description'         => '',
//            'taxonomies'          => array('portfolio_category'),
//            'public'              => true,
//            'show_ui'             => true,
//            'show_in_menu'        => true,
//            'show_in_admin_bar'   => true,
//            'menu_position'       => null,
//            'menu_icon'           => 'dashicons-portfolio',
//            'show_in_nav_menus'   => true,
//            'publicly_queryable'  => true,
//            'exclude_from_search' => false,
//            'has_archive'         => true,
//            'query_var'           => true,
//            'can_export'          => true,
//            'rewrite'             => array(
//                'slug'       => $portfolio_slug,
//                'with_front' => false,
//                'pages'      => true
//            ),
//            'capability_type'     => 'post',
//            'supports'            => array(
//                'title',
//                'editor',
//                'thumbnail',
//                'excerpt',
//                'revisions'
//            )
//        ));
    }

    /**
     * Get instance of the class
     *
     * @access public
     * @return object this
     */
    public static function get_instance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function cms_add_column_featured($defaults)
    {
        $defaults['post_featured'] = esc_html__('Featured', ETC_TEXT_DOMAIN);
        return $defaults;
    }

    public function cms_add_content_featured_column($colum_name, $post_id)
    {
        if ($colum_name === "post_featured") {
            $pt = get_post_type($post_id);
            if ($pt !== false) {
                $href = admin_url("edit.php?post_type=" . $pt);
                $meta_featured = get_post_meta($post_id, 'cms_post_featured', true);
                if ($meta_featured === "featured") {
                    echo '<a href="' . $href . '&cms_post_id=' . $post_id . '"><span class="fs-show-featured dashicons dashicons-star-filled"></span></a>';
                } else {
                    echo '<a href="' . $href . '&cms_post_id=' . $post_id . '"><span class="fs-show-featured dashicons dashicons-star-empty"></span></a>';
                }
            }
        }
    }

    public function cms_featured_handlers()
    {
        if (!empty($_REQUEST['cms_post_id']) && get_post(intval($_REQUEST['cms_post_id'])) !== null) {
            $pid = intval($_REQUEST['cms_post_id']);
            $featured_meta = get_post_meta($pid, 'cms_post_featured', true);
            if ($featured_meta === "featured") {
                update_post_meta($pid, 'cms_post_featured', '');
            } else {
                update_post_meta($pid, 'cms_post_featured', 'featured');
            }
            $pt = get_post_type($pid);
            if ($pt !== false) {
                wp_redirect(admin_url("edit.php?post_type=" . $pt));
            }
        }
    }
}