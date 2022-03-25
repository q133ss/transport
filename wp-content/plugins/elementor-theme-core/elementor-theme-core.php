<?php
/**
 * Plugin Name: Elementor Theme Core
 * Description: Elementor Page Builder Extension.
 * Plugin URI:  https://cmssuperheroes.com/
 * Version:     1.3.2
 * Author:      CMSSuperHeroes
 * Author URI:  https://cmssuperheroes.com/
 * Text Domain: elementor-theme-core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define('ETC_TEXT_DOMAIN', 'elementor-theme-core');
define('ETC_PATH', plugin_dir_path(__FILE__));
define('ETC_URL', plugin_dir_url(__FILE__));

if(file_exists(WP_PLUGIN_DIR . '/redux-framework/redux-framework.php')){
    $default_headers = array(
        'Name'        => 'Plugin Name',
        'PluginURI'   => 'Plugin URI',
        'Version'     => 'Version',
        'Description' => 'Description',
        'Author'      => 'Author',
        'AuthorURI'   => 'Author URI',
        'TextDomain'  => 'Text Domain',
        'DomainPath'  => 'Domain Path',
        'Network'     => 'Network',
        'RequiresWP'  => 'Requires at least',
        'RequiresPHP' => 'Requires PHP',
        // Site Wide Only is deprecated in favor of Network.
        '_sitewide'   => 'Site Wide Only',
    );
    $reduxFrameworkData = get_file_data( WP_PLUGIN_DIR . '/redux-framework/redux-framework.php', $default_headers, 'plugin' );
    if(!class_exists('ReduxFrameworkInstances') && version_compare( $reduxFrameworkData['Version'], '4.0.0', '>=' )){
        require_once ETC_PATH . 'inc/redux/class-ReduxFrameworkInstances.php';
    }
}

final class Elementor_Theme_Core {

    const VERSION = '1.3.0';

    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    const MINIMUM_PHP_VERSION = '7.0';

    const ETC_WIDGET_PREFIX_OPTION_NAME = 'etc_';

    const ETC_CATEGORY_NAME = 'elementor-theme-core';

    const ETC_CATEGORY_TITLE = 'Elementor Theme Core';

    const EMOJI_CONTROL = 'emojionearea';

    const LAYOUT_CONTROL = 'layoutcontrol';

    const ICONS_CONTROL = 'cms_icons';

    const REPEATER_CONTROL = 'cms_repeater';

    const SELECT_CONTROL = 'cms_select';

    const ETC_TAB_NAME = 'elementor_theme_core';

    const ETC_TAB_TITLE = 'Elementor Theme Core';

    public $post_metabox = null;

    private static $_instance = null;

    public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    public function __construct() {
        add_action( 'init', [ $this, 'load_scss_lib' ], 2 );
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init' ] );
        // lack to elementor deprecate jquery-slick
        add_action('deprecated_file_included', [$this, 'deprecated_file_included'], 2);

        add_action('wp_enqueue_scripts', array($this, 'enqueue'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue'));

        if (!class_exists('EFramework_CPT_Register')) {
            require_once ETC_PATH . 'inc/class-cpt-register.php';
            EFramework_CPT_Register::get_instance();
        }

        if (!class_exists('EFramework_CTax_Register')) {
            require_once ETC_PATH . 'inc/class-ctax-register.php';
            EFramework_CTax_Register::get_instance();
        }

        if (!class_exists('EFramework_MegaMenu_Register')) {
            require_once ETC_PATH . 'inc/mega-menu/class-megamenu.php';
            EFramework_MegaMenu_Register::get_instance();
        }

        if (!class_exists('EFramework_menu_handle')) {
            require_once ETC_PATH . 'inc/class-menu-hanlde.php';
        }

        if(!class_exists('CMS_Ajax_Handle')){
            require_once ETC_PATH . 'inc/class-ajax-handle.php';
        }
    }

    public function i18n() {
        load_plugin_textdomain( ETC_TEXT_DOMAIN );

        if (!class_exists('ReduxFramework')) {
//            add_action('admin_notices', array($this, 'redux_framework_notice'));
        } else {
            if (!class_exists('CMS_Post_Metabox')) {
                require_once ETC_PATH . 'inc/class-post-metabox.php';

                if (empty($this->post_metabox)) {
                    $this->post_metabox = new CMS_Post_Metabox();
                }
            }
            if (!class_exists('CMS_Taxonomy_Meta')) {
                require_once ETC_PATH . 'inc/class-taxonomy-meta.php';

                if (empty($this->taxonomy_meta)) {
                    $this->taxonomy_meta = new CMS_Taxonomy_Meta();
                }
            }
        }
    }

    public function init() {

        // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        // Check for required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        if (class_exists('ReduxFramework') && !class_exists('CMS_Redux_Extensions')) {
            require_once ETC_PATH . 'inc/class-redux-extensions.php';
        }

        add_action( 'elementor/editor/before_enqueue_scripts', function() {
            wp_enqueue_style( 'etc-editor-css', ETC_URL . '/assets/css/elementor-editor.css', array(), '1.0.0' );
        } );

        // Include Helper
        require_once( __DIR__ . '/inc/helpers/resize-image.php' );
        require_once( __DIR__ . '/inc/helpers/common.php' );
        require_once( __DIR__ . '/inc/helpers/widget.php' );

        // Widget Categories
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

        // Add Plugin actions
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
        add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );

        add_action( 'elementor/elements/elements_registered', [ $this, 'elements_registered' ] );
    }

    function deprecated_file_included($file){
        if($file == 'jquery-slick'){
            add_filter( 'deprecated_file_trigger_error', function () {
                return false;
            }, 2 );
        }
    }

    public function load_scss_lib(){
        $scssc_lib = apply_filters('cms_scssc_lib', 'old');
        $cms_scssc_on = apply_filters('cms_scssc_on', false);
        if ($cms_scssc_on && $scssc_lib === 'old' && !class_exists('scssc')) {
            // scss compiler library v0.0.12
            require_once __DIR__ . '/lib/scss.inc.php';
        }
        if ($cms_scssc_on && $scssc_lib === 'new' && !class_exists('\Leafo\ScssPhp\Compiler')) {
            // scss compiler library v0.7.5
            require_once __DIR__ . '/lib/scss/scss.inc.php';
        }
    }

    public function enqueue(){
        /* Styles */
        wp_enqueue_style('etc-main-css', ETC_URL . 'assets/css/main.css', [], '1.0.0');
        wp_enqueue_style('progressbar-lib-css', ETC_URL . 'assets/css/lib/progressbar.min.css', [], '0.7.1');
        wp_enqueue_style('oc-css', ETC_URL . 'assets/css/lib/owl.carousel.min.css', [], '2.2.1');

        /* Scripts */
        wp_register_script('waypoints-lib-js', ETC_URL . 'assets/js/lib/waypoints.min.js', [ 'jquery' ], '2.0.5');
        wp_register_script('imagesloaded', ETC_URL . 'assets/js/lib/imagesloaded.pkgd.min.js', [ 'jquery' ], '3.1.8');
        wp_register_script('isotope', ETC_URL . 'assets/js/lib/isotope.pkgd.min.js', [ 'jquery' ], '3.0.5');
        wp_register_script('counter-lib-js', ETC_URL . 'assets/js/lib/counter.min.js', [ 'jquery' ], '');
        wp_register_script('oc-js', ETC_URL . 'assets/js/lib/owl.carousel.min.js', [ 'jquery' ], '2.2.1');
        wp_register_script('progressbar-lib-js', ETC_URL . 'assets/js/lib/progressbar.min.js', ['jquery'], '0.7.1');
        wp_register_script('easy-pie-chart-lib-js', ETC_URL . 'assets/js/lib/easy-pie-chart.js', ['jquery'], '2.1.7');
        if(!wp_script_is('jquery-slick')){
            wp_enqueue_style('slick-css', ETC_URL . 'assets/css/lib/slick.css', [], '1.8.0');
            wp_register_script('jquery-slick', ETC_URL . 'assets/js/lib/slick.js', ['jquery'], '1.8.0');
        }
        wp_enqueue_script('jquery-serializejson-lib-js', ETC_URL . 'assets/js/lib/jquery.serializejson.js', [ 'jquery' ], '3.2.1');

        wp_enqueue_script('etc-main-js', ETC_URL . 'assets/js/main.js', [ 'jquery' ], '1.0.0');
    }

    public function admin_enqueue(){
        wp_enqueue_style('etc-admin-css', ETC_URL . 'assets/css/admin.css', [], '1.0.0');

        wp_enqueue_script('jquery-serializejson-lib-js', ETC_URL . 'assets/js/lib/jquery.serializejson.js', [ 'jquery' ], '3.2.1');
        wp_enqueue_script('etc-admin-js', ETC_URL . 'assets/js/admin.js', [ 'jquery' ], '1.0.0');
    }

    public function admin_notice_missing_main_plugin() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', ETC_TEXT_DOMAIN ),
            '<strong>' . esc_html__( 'Elementor Theme Core', ETC_TEXT_DOMAIN ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor Plugin', ETC_TEXT_DOMAIN ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    public function admin_notice_minimum_elementor_version() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', ETC_TEXT_DOMAIN ),
            '<strong>' . esc_html__( 'Elementor Theme Core', ETC_TEXT_DOMAIN ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor Plugin', ETC_TEXT_DOMAIN ) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    public function admin_notice_minimum_php_version() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', ETC_TEXT_DOMAIN ),
            '<strong>' . esc_html__( 'Elementor Theme Core', ETC_TEXT_DOMAIN ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', ETC_TEXT_DOMAIN ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    /**
     * Redux Framework notices
     *
     * @since 1.0
     * @access public
     */
    function redux_framework_notice()
    {
        $plugin_name = '<strong>' . esc_html__("Elementor Theme Core", ETC_TEXT_DOMAIN) . '</strong>';
        $redux_name = '<strong>' . esc_html__("Redux Framework", ETC_TEXT_DOMAIN) . '</strong>';

        echo '<div class="notice notice-warning is-dismissible">';
        echo '<p>';
        printf(
            esc_html__('%1$s require %2$s installed and activated. Please active %3$s plugin', ETC_TEXT_DOMAIN),
            $plugin_name,
            $redux_name,
            $redux_name
        );
        echo '</p>';
        printf('<button type="button" class="notice-dismiss"><span class="screen-reader-text">%s</span></button>', esc_html__('Dismiss this notice.', ETC_TEXT_DOMAIN));
        echo '</div>';
    }

    public function elements_registered(){
        require_once( __DIR__ . '/inc/elementor/section.php' );
        require_once( __DIR__ . '/inc/elementor/column.php' );

        $elements_manager = \Elementor\Plugin::$instance->elements_manager;
        $elements_manager->unregister_element_type('section');
        $elements_manager->unregister_element_type('column');
        $elements_manager->register_element_type(new \Elementor\ETC_Element_Section());
        $elements_manager->register_element_type(new \Elementor\ETC_Element_Column());
    }

    public function init_widgets() {

        // Include Widget files
        require_once( __DIR__ . '/inc/widgets/abstract-class-widget-base.php' );

        if(is_file(get_template_directory() . '/elementor/core/elementor.php')){
            require_once get_template_directory() . '/elementor/core/elementor.php';
        }
    }

    public function init_controls() {

        // Include Control files
        require_once( __DIR__ . '/inc/controls/class-control-emoji.php' );
        require_once( __DIR__ . '/inc/controls/class-control-layout.php' );
        require_once( __DIR__ . '/inc/controls/class-control-icons.php' );
        require_once( __DIR__ . '/inc/controls/class-control-repeater.php' );

        $controls_manager = \Elementor\Plugin::$instance->controls_manager;

        // Register control
        $controls_manager->register_control( self::EMOJI_CONTROL, new Elementor_Theme_Core_EmojiOneArea_Control() );
        $controls_manager->register_control( self::LAYOUT_CONTROL, new Elementor_Theme_Core_Layout_Control() );
        $controls_manager->register_control( self::ICONS_CONTROL, new Elementor_Theme_Core_Icons_Control() );
        $controls_manager->register_control( self::REPEATER_CONTROL, new Elementor_Theme_Core_Repeater_Control() );

        // Add Tab
        $controls_manager->add_tab( self::ETC_TAB_NAME, esc_html__(self::ETC_TAB_TITLE, ETC_TEXT_DOMAIN) );
    }

    function add_elementor_widget_categories( $elements_manager ) {

        $categories = apply_filters('etc_add_custom_categories', array(
            array(
                'name' => self::ETC_CATEGORY_NAME,
                'title' => __( self::ETC_CATEGORY_TITLE, ETC_TEXT_DOMAIN ),
                'icon' => 'fa fa-plug',
            ),
        ));

        foreach ($categories as $cat){
            $elements_manager->add_category(
                $cat['name'],
                array(
                    'title' => $cat['title'],
                    'icon' => $cat['icon'],
                )
            );
        }
    }
}

Elementor_Theme_Core::instance();

function request_uri(){
    return $_SERVER['REQUEST_URI'];
}