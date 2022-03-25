<?php
$tab_style = $widget->get_setting('tab_style', 'style1');
$active_tab = $widget->get_setting('active_tab', 1);
$tabs = $widget->get_setting('tabs', '');
$tabs_icon = [];
$tabs_title = [];
$tabs_content = [];
foreach ($tabs as $key => $tab){
    $title_key = $widget->get_repeater_setting_key( 'tab_title', 'tabs', $key );
    $icon_key = $title_key.'-icon';
    $content_key = $widget->get_repeater_setting_key( 'tab_content', 'tabs', $key );

    $tabs_title[$title_key] = $tab['tab_title'];
    $tabs_icon[$title_key] = $tab['title_icon'];
    $tabs_content[$content_key] = '';
    if($tab['content_type'] == 'template'){
        if(!empty($tab['tab_content_template'])){
            $content = \Elementor\Plugin::$instance->frontend->get_builder_content( $tab['tab_content_template'] );
            $tabs_content[$content_key] = $content;
        }
    }
    elseif($tab['content_type'] == 'text_editor'){
        $tabs_content[$content_key] = $tab['tab_content'];
    }

    $widget->add_render_attribute( $title_key, [
        'class' => [ 'cms-tab-title' ],
        'data-target' => '#' . $tab['_id'],
    ] );

    $widget->add_render_attribute( $icon_key, [
        'class' => $tab['title_icon'],
        'aria-hidden' => 'true',
    ] );

    $widget->add_inline_editing_attributes( $title_key, 'basic' );
    $widget->add_render_attribute( $content_key, [
        'class' => [ 'cms-tab-content' ],
        'id' => $tab['_id'],
    ] );
    if($tab['content_type'] == 'text_editor'){
        $widget->add_inline_editing_attributes( $content_key, 'advanced' );
    }

    if($active_tab == $key + 1){
        $widget->add_render_attribute( $content_key, 'style', 'display:block;');
        $widget->add_render_attribute( $title_key, 'class', 'active');
    }
}
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<div class="cms-tabs cms-tabs--layout1">
    <div class="cms-tabs-title">
        <?php foreach ($tabs_title as $title_key => $tab_title): ?>
            <div <?php etc_print_html($widget->get_render_attribute_string( $title_key )); ?>>
                <?php
                if($is_new):
                    \Elementor\Icons_Manager::render_icon( $tabs_icon[$title_key], [ 'aria-hidden' => 'true' ] );
                    ?>
                <?php else: ?>
                    <i <?php etc_print_html($widget->get_render_attribute_string( $title_key.'icon' )); ?>></i>
                <?php endif; ?>
                <?php echo etc_print_html($tab_title); ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="cms-tabs-content">
        <?php foreach ($tabs_content as $content_key => $tab_content): ?>
            <div <?php etc_print_html($widget->get_render_attribute_string( $content_key )); ?>><?php etc_print_html($tab_content); ?></div>
        <?php endforeach; ?>
    </div>
</div>