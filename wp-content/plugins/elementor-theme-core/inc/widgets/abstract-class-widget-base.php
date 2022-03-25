<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

abstract class Elementor_Theme_Core_Widget_Base extends \Elementor\Widget_Base {

    protected $name;
    protected $title;
    protected $icon;
    protected $categories;
    protected $params;
    protected $styles;
    protected $scripts;

    public function get_name() {
        return $this->name;
    }

    public function get_title() {
        return $this->title;
    }

    public function get_icon() {
        return $this->icon;
    }

    public function get_categories() {
        return $this->categories;
    }

    public function get_params() {
        return $this->params;
    }

    public function get_style_depends() {
        return $this->styles;
    }

    public function get_script_depends() {
        return $this->scripts;
    }

    protected function _register_controls() {
        $params = [];
        
        if(!is_array($this->params)){
            $params = json_decode($this->params, true);
        }

        $option_name = etc_get_widget_option_name($this->get_name());
        $_params = get_option($option_name, []);
        if(!empty($_params)){
            $params = $_params;
        }
        
        if(isset($params['sections']) && !empty($params['sections'])){
            $sections = $params['sections'];
            foreach($sections as $section){
                if(isset($section['controls']) && !empty($section['controls'])){
                    $controls = isset($section['controls'])?$section['controls']:[];
                    $this->start_controls_section(
                        $section['name'],
                        [
                            'label' => $section['label'],
                            'tab' => $section['tab'],
                            'condition' => isset($section['condition'])?$section['condition']:'',
                        ]
                    );
                    foreach ($controls as $control){
                        $control_type = isset($control['control_type'])?$control['control_type']:'';
                        if($control_type == 'responsive'){
                            $args = $this->convert_args($control);
                            $this->add_responsive_control($control['name'], $args);
                        }
                        elseif($control_type == 'group'){
                            $args = $this->convert_args($control);
                            $args['name'] = $control['name'];
                            $this->add_group_control(
                                $control['type'],
                                $args
                            );
                        }
                        elseif($control_type == 'tab'){
                            if(isset($control['tabs']) && !empty($control['tabs'])){
                                $this->start_controls_tabs( $control['name'] );
                                foreach ($control['tabs'] as $tab){
                                    if(isset($tab['controls']) && !empty($tab['controls'])){
                                        $this->start_controls_tab(
                                            $tab['name'],
                                            [
                                                'label' => $tab['label'],
                                            ]
                                        );
                                        foreach ($tab['controls'] as $tab_control){
                                            $tab_control_type = isset($tab_control['control_type'])?$tab_control['control_type']:'';
                                            if($tab_control_type == 'responsive'){
                                                $args = $this->convert_args($tab_control);
                                                $this->add_responsive_control($tab_control['name'], $args);
                                            }
                                            elseif($tab_control_type == 'group'){
                                                $args = $this->convert_args($tab_control);
                                                $args['name'] = $tab_control['name'];
                                                $this->add_group_control(
                                                    $tab_control['type'],
                                                    $args
                                                );
                                            }
                                            else{
                                                $args = $this->convert_args($tab_control);
                                                $this->add_control($tab_control['name'], $args);
                                            }
                                        }
                                        $this->end_controls_tab();
                                    }
                                }
                                $this->end_controls_tabs();
                            }
                        }
                        else{
                            if($control['type'] == \Elementor\Controls_Manager::REPEATER){
                                $repeater = new \Elementor\Repeater();
                                if(isset($control['controls']) && !empty($control['controls'])){
                                    foreach ($control['controls'] as $rp_control){
                                        $rp_args = $this->convert_args($rp_control);
                                        // $repeater->add_control($rp_control['name'], $rp_args);
                                        $rp_control_type = isset($rp_control['control_type'])?$rp_control['control_type']:'';
                                        if($rp_control_type == 'responsive'){
                                            $repeater->add_responsive_control($rp_control['name'], $rp_args);
                                        }
                                        elseif($rp_control_type == 'group'){
                                            $rp_args['name'] = $rp_control['name'];
                                            $repeater->add_group_control(
                                                $rp_control['type'],
                                                $rp_args
                                            );
                                        }
                                        elseif($rp_control_type == 'tab'){
                                            if(isset($rp_control['tabs']) && !empty($rp_control['tabs'])){
                                                $repeater->start_controls_tabs( $rp_control['name'] );
                                                foreach ($rp_control['tabs'] as $tab){
                                                    if(isset($tab['controls']) && !empty($tab['controls'])){
                                                        $repeater->start_controls_tab(
                                                            $tab['name'],
                                                            [
                                                                'label' => $tab['label'],
                                                            ]
                                                        );
                                                        foreach ($tab['controls'] as $tab_control){
                                                            $tab_control_type = isset($tab_control['control_type'])?$tab_control['control_type']:'';
                                                            if($tab_control_type == 'responsive'){
                                                                $args = $this->convert_args($tab_control);
                                                                $repeater->add_responsive_control($tab_control['name'], $args);
                                                            }
                                                            elseif($tab_control_type == 'group'){
                                                                $args = $this->convert_args($tab_control);
                                                                $args['name'] = $tab_control['name'];
                                                                $repeater->add_group_control(
                                                                    $tab_control['type'],
                                                                    $args
                                                                );
                                                            }
                                                            else{
                                                                $args = $this->convert_args($tab_control);
                                                                $repeater->add_control($tab_control['name'], $args);
                                                            }
                                                        }
                                                        $repeater->end_controls_tab();
                                                    }
                                                }
                                                $repeater->end_controls_tabs();
                                            }
                                        }
                                        else{
                                            $repeater->add_control($rp_control['name'], $rp_args);
                                        }
                                    }
                                }
                                $this->add_control($control['name'], [
                                    'label' => isset($control['label'])?$control['label']:'',
                                    'type' => isset($control['type'])?$control['type']:'',
                                    'fields' => $repeater->get_controls(),
                                    'default' => isset($control['default'])?$control['default']:[],
                                    'description' => isset($control['description'])?$control['description']:'',
                                    'condition' => isset($control['condition'])?$control['condition']:'',
                                    'title_field' => isset($control['title_field'])?$control['title_field']:'',
                                ]);
                            }
                            else{
                                $args = $this->convert_args($control);
                                $this->add_control($control['name'], $args);
                            }
                        }
                    }
                    $this->end_controls_section();
                }
            }
        }
    }

    public function convert_args( $control = [] ){
        $args = [];
        $args_index = [
            'label',
            'type',
            'input_type',
            'options',
            'default',
            'description',
            'placeholder',
            'multiple',
            'rows',
            'min',
            'max',
            'step',
            'label_on',
            'label_off',
            'return_value',
//            'scheme',
            'show_external',
            'size_units',
            'range',
            'toggle',
            'raw',
            'content_classes',
            'language',
            'label_block',
            'show_label',
            'selectors',
            'selector',
            'separator',
            'condition',
            'prefix_class',
            'types',
            'allowed_dimensions',
            'fa4compatibility',
            'recommended',
            'controls',
            'devices',
            'desktop_default',
            'tablet_default',
            'mobile_default',
        ];
        foreach ($args_index as $index){
            if(isset($control[$index]) && !empty($control[$index])){
                $args[$index] = $control[$index];
            }
        }
        switch ($control['type']){
            case \Elementor\Controls_Manager::MEDIA :
                if(!isset($control['default']) ){
                    $args['default'] = [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ];
                }
                break;
            case \Elementor\Controls_Manager::SWITCHER :
                $args['return_value'] = isset($control['return_value'])?$control['return_value']:'true';
                $args['default'] = isset($control['default'])?$control['default']:'';
                break;
        }

        return $args;
    }

    public function add_inline_editing_attributes( $key, $toolbar = 'basic' ) {
        parent::add_inline_editing_attributes( $key, $toolbar );
    }

    public function get_repeater_setting_key( $setting_key, $repeater_key, $repeater_item_index ) {
        return parent::get_repeater_setting_key( $setting_key, $repeater_key, $repeater_item_index );
    }

    public function parse_text_editor( $content ) {
        return parent::parse_text_editor($content);
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $settings['element_id'] = $this->get_id();
        $settings['element_name'] = $this->get_name();
        etc_get_template($this);
    }

    public function get_setting($setting, $default = ''){
        $setting_value = parent::get_settings($setting);
        $setting_value = !empty($setting_value)?$setting_value:$default;
        return $setting_value;
    }
}