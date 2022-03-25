<?php

if(!function_exists('etc_generate_class_name')){
    function etc_generate_class_name($name){
        $name = strtolower($name);
        $name = replace_all_special_character($name);
        $class_name = ucfirst($name);
        $class_name = preg_replace_callback('/_([a-z]?)/', function($match) {
            return strtoupper($match[1]);
        }, $class_name);
        $class_name = "ETC_" . $class_name . "_Widget";
        return $class_name;
    }
}

if(!function_exists('etc_generate_file_class_name')){
    function etc_generate_file_class_name($name){
        $name = strtolower($name);
        $name = replace_all_special_character($name, '-');
        return $file_name = 'class-widget-'.$name;
    }
}

if(!function_exists('etc_get_widget_option_name')){
    function etc_get_widget_option_name($name){
        return Elementor_Theme_Core::ETC_WIDGET_PREFIX_OPTION_NAME . $name;
    }
}

if(!function_exists('etc_create_class_widget')){
    function etc_create_class_widget($file_path, $class_name, $name, $title, $icon, $categories, $params, $styles = [], $scripts = []){
        $file_content_template_path = ETC_PATH . 'inc/widgets/class-template/class-widget-template.txt';

        $file_content = file_get_contents($file_content_template_path);
        if($file_content === false){
            return false;
        }
        $file_content = "<?php

" . $file_content;
        $search = array(
            '[[class_name]]',
            '[[name]]',
            '[[title]]',
            '[[icon]]',
            '[[categories]]',
            '[[params]]',
            '[[styles]]',
            '[[scripts]]',
        );
        $str_categories = implode("','", $categories);
        if(!empty($str_categories)){
            $str_categories = "'" . $str_categories . "'";
        }
        $params = json_encode($params);
        $params = str_replace("'", "\'", $params);
        $str_styles = implode("','", $styles);
        if(!empty($str_styles)){
            $str_styles = "'" . $str_styles . "'";
        }
        $str_scripts = implode("','", $scripts);
        if(!empty($str_scripts)){
            $str_scripts = "'" . $str_scripts . "'";
        }
        $replace = array(
            $class_name,
            $name,
            $title,
            $icon,
            $str_categories,
            $params,
            $str_styles,
            $str_scripts,
        );
        $file_content = str_replace(
            $search,
            $replace,
            $file_content
        );
        if (file_put_contents($file_path, $file_content) === false) {
            return false;
        }
        return true;
    }
}

if(!function_exists('etc_add_custom_widget')){
    function etc_add_custom_widget($widget, $dir = ETC_PATH . 'inc/widgets/'){
        $name = isset($widget['name'])?$widget['name']:'';
        $title = isset($widget['title'])?$widget['title']:'';
        $icon = isset($widget['icon'])?$widget['icon']:'';
        $categories = isset($widget['categories'])?$widget['categories']:array();
        $params = isset($widget['params'])?$widget['params']:array();
        $styles = isset($widget['styles'])?$widget['styles']:array();
        $scripts = isset($widget['scripts'])?$widget['scripts']:array();
        $class_name = etc_generate_class_name($widget['name']);
        $file_name = etc_generate_file_class_name($widget['name']);
        $file_path = $dir . $file_name . '.php';
        $result = true;
        if(defined('DEV_MODE') && DEV_MODE){
            $result = etc_create_class_widget($file_path, $class_name, $name, $title, $icon, $categories, $params, $styles, $scripts);
        }
        require_once( $file_path );
        if($result && class_exists($class_name)){
            // update option for widget params
            $option_name = etc_get_widget_option_name($name);
            update_option($option_name, $params);
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class_name() );
        }
    }
}