<?php
/**
 * Plugin Name: SWA Import Export Special
 * Plugin URI: http://cmssuperheroes.com/
 * Description: SWA Import Export helping to create demo data package and setup demo data for clients site.
 * Version: 1.2.4
 * Author: KP
 * Author URI: http://cmssuperheroes.com/
 * License: GPLv2
 * Text Domain: swa-import-export
 */
if (!defined('ABSPATH')) {
    exit();
}
define('SWA_TEXT_DOMAIN', 'swa-import-export');
define('SWA_IE_FILE', __FILE__);

if (!class_exists('SWA_Import_Export')) {

    /**
     * Main Class SWA_Import_Export
     *
     * @since 1.0.0
     *
     * @description: Public SWA_Import_Export:: or GLOBAL swa_ie()
     *
     * @author: KP
     *
     * @create: 15 November, 2017
     */
    class SWA_Import_Export
    {
        public $file;
        public $basename;
        public $plugin_dir;
        public $plugin_url;
        public $assets_dir;
        public $assets_url;
        public $theme_dir;
        public $theme_url;

        public static $instance;

        /**
         * @return SWA_Import_Export
         */
        public static function instance()
        {
            if (is_null(self::$instance)) {
                self::$instance = new SWA_Import_Export();
                self::$instance->setup_globals();
                self::$instance->includes();
                self::$instance->setup_actions();

                remove_filter('wp_import_post_meta', ['Elementor\Compatibility', 'on_wp_import_post_meta']);
            }

            return self::$instance;
        }

        private function setup_globals()
        {
            $this->file = __FILE__;

            /* base name. */
            $this->basename = plugin_basename($this->file);

            /* base plugin. */
            $this->plugin_dir = plugin_dir_path($this->file);
            $this->plugin_url = plugin_dir_url($this->file);

            /* base assets. */
            $this->assets_dir = trailingslashit($this->plugin_dir . 'assets');
            $this->assets_url = trailingslashit($this->plugin_url . 'assets');

            $this->theme_dir = trailingslashit(get_template_directory() . '/inc/demo-data');
            $this->theme_url = trailingslashit(get_template_directory_uri() . '/inc/demo-data');

        }

        function swa_ie_menu_handle()
        {
            $current_theme = wp_get_theme();
            if (is_child_theme()) {
                $current_theme = $current_theme->parent();
            }
            $this->theme_name = $current_theme->get('Name');
            $this->theme_text_domain = $current_theme->get('TextDomain');
            if (class_exists('CmssuperheroesCore') || class_exists('Elementor_Theme_Core') || class_exists('CMS_PORTAL')) {
                add_submenu_page($this->theme_text_domain, esc_html__('Import Demo', SWA_TEXT_DOMAIN), esc_html__('Import Demo', SWA_TEXT_DOMAIN), 'manage_options', 'swa-import', array($this, 'swa_import_demo_page'));
            } else {
                add_submenu_page('tools.php', esc_html__('Import Demo', SWA_TEXT_DOMAIN), esc_html__('Import Demo', SWA_TEXT_DOMAIN), 'manage_options', 'swa-import', array($this, 'swa_import_demo_page'));
            }
        }

        public function swa_import_demo_page()
        {
            $export_mode = $this->swa_ie_enable_export_mode();
            include_once swa_ie()->plugin_dir . 'templates/import-page.php';
        }


        function swa_ie_enable_export_mode()
        {
            return apply_filters('swa_ie_export_mode', false);
        }

        private function includes()
        {
            global $wp_filesystem;

            add_action('admin_menu', array($this, 'swa_ie_menu_handle'), 100);
            add_action('admin_enqueue_scripts', array($this, 'swa_ie_enqueue_scripts'));

            add_action('wp_ajax_swa_before_reset', [$this, 'before_reset']);

            /**
             * Add WP_Filesystem Class
             *
             */
            if (!class_exists('WP_Filesystem')) {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                WP_Filesystem();
            }


            // Load Importer API
            require_once ABSPATH . 'wp-admin/includes/import.php';

            if (!class_exists('WP_Importer'))
                require_once ABSPATH . 'wp-admin/includes/class-wp-importer.php';


            require_once ABSPATH . 'wp-admin/includes/post.php';

            require_once ABSPATH . 'wp-admin/includes/comment.php';

            require_once ABSPATH . 'wp-admin/includes/media.php';

            require_once ABSPATH . 'wp-admin/includes/image.php';

            require_once ABSPATH . 'wp-admin/includes/taxonomy.php';

            // include WXR file parsers
            require swa_ie()->plugin_dir . 'includes/api/parsers.php';

            /* class WP_Import not exists */
            if (!class_exists('SWA_Import'))
                require_once swa_ie()->plugin_dir . 'includes/api/wordpress-importer.php';

            /**
             * Require extra functions file
             */
            require_once $this->plugin_dir . 'includes/extra-functions.php';
            /**
             * Require export contents handle
             */
            require_once $this->plugin_dir . 'includes/export.php';

            /**
             * Require import contents handle
             */
            require_once $this->plugin_dir . 'includes/import-contents.php';

            /**
             * Require media handle
             */
            require_once $this->plugin_dir . 'includes/attachments.php';

            /**
             * Require zip file and download handle
             */
            require_once $this->plugin_dir . 'includes/zip-file-and-download.php';

            /**
             * Require widget handle
             */
            require_once $this->plugin_dir . 'includes/widgets.php';

            /**
             * Require theme options handle
             */
            require_once $this->plugin_dir . 'includes/settings.php';


            /**
             * Require wp options handle
             */
            require_once $this->plugin_dir . 'includes/options.php';


            /**
             * Require wp options handle
             */
            require_once $this->plugin_dir . 'includes/revslider.php';


            /**
             * Require clear tmp folder
             */
            require_once $this->plugin_dir . 'includes/clear-folder.php';


            /**
             * Require term handlers
             */
            require_once $this->plugin_dir . 'includes/term-handlers.php';

            /**
             * Require woocommerce attributes handles
             */
            require_once $this->plugin_dir . 'includes/woo_attributes_handles.php';

            /**
             * Require git sync
             */
            require_once $this->plugin_dir . 'includes/git.php';


            /**
             * Require reset demo data
             */
            require_once $this->plugin_dir . 'includes/wp-reset.php';


            /**
             * Add SWA_Import_Export_redirect_handle Class
             *
             */
            if (!class_exists('SWA_Import_Export_handle')) {
                require_once($this->plugin_dir . 'includes/import-export-handle.php');
                new SWA_Import_Export_handle();
            }

        }

        private function setup_actions()
        {
        }

        function pp_load_textdomain()
        {
            $language_folder = basename(dirname(__FILE__)) . '/languages';
            load_plugin_textdomain(SWA_TEXT_DOMAIN, false, $language_folder);
        }


        function get_all_demo_folder()
        {

            if (!is_dir($this->theme_dir))
                return false;

            $files = scandir($this->theme_dir, 1);

            return array_diff($files, array('..', '.', 'attachment'));
        }

        function swa_ie_enqueue_scripts()
        {
            if (isset($_REQUEST['page']) && $_REQUEST['page'] === 'swa-import') {
                wp_enqueue_style('swa-ie.css', $this->plugin_url . 'assets/swa-ie.css');
                wp_enqueue_script('swa-ie.js', $this->plugin_url . 'assets/swa-ie.js', array(), 'all', true);
                wp_localize_script('swa-ie.js', 'swa_ie', [
                    'ajax_url' => admin_url('admin-ajax.php'),
                ]);
            }
        }

        function before_reset()
        {
            // Deactivate all plugins exclude swa import export
            if (!function_exists('get_plugins')) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }
            if (!function_exists('request_filesystem_credentials')) {
                require_once ABSPATH . 'wp-admin/includes/file.php';
            }

            $swa_ie_basename = plugin_basename(SWA_IE_FILE);

            $active_plugins = (array)get_option('active_plugins', array());
            if (($key = array_search($swa_ie_basename, $active_plugins)) !== false) {
                unset($active_plugins[$key]);
            }

            if (!empty($active_plugins)) {
                deactivate_plugins($active_plugins, true, false);
            }

            wp_send_json_success();
            exit;
        }
    }

    function swa_ie()
    {
        return SWA_Import_Export::instance();
    }

    $GLOBALS['swa_ie'] = swa_ie();
}