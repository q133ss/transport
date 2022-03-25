<?php

if (!defined('ABSPATH')) {
    die();
}
if (!class_exists('CMS_Ajax_Handle')) {
    class CMS_Ajax_Handle {
        public function __construct() {
            add_action('wp_ajax_cms_auto_generate', array($this, 'cms_auto_generate'));
        }

        function cms_auto_generate(){
            try {
                $result = [
                    'stt' => true,
                    'msg' => __('Generate Successfully!', CMS_TEXT_DOMAIN),
                    'data' => strtoupper(substr(md5(uniqid(mt_rand(), true) . ':' . microtime(true)), 5, 11)),
                ];
                wp_send_json($result);
            } catch (Exception $e) {
                $result = [
                    'stt' => false,
                    'msg' => $e->getMessage(),
                    'data' => '',
                ];
                wp_send_json($result);
            }
            die();
        }
    }
    new CMS_Ajax_Handle();
}