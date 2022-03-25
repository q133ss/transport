<?php
/**
 * @Template: manual-import-template.php.
 * @since: 1.0.0
 * author: KP
 * @descriptions:
 * @create: 12/19/2018
 */
?>

<div class="swa-manual-import-layout swa-m-hidden" style="display: none">
    <div class="swa-contain">

        <div class="swa-loading" style="display: none">
            <span class="swa-pinner"><span class="fa fa-spinner fa-spin"></span></span>
        </div>
        <span class="dashicons dashicons-dismiss"></span>
        <div class="swa-contain-wrap">
            <div class="swa-tabs-head">
                <div class="tabs-demos swa-mi-active" data-id="select-demo">
                    <span><?php esc_html_e('Select Demo', SWA_TEXT_DOMAIN) ?></span>
                </div>
                <div class="tabs-demos"
                     data-id="attachments">
                    <span><?php esc_html_e('Download Attachment', SWA_TEXT_DOMAIN) ?></span>
                </div>
            </div>
            <div class="swa-tabs-content">
                <div class="tabs-contents swa-mi-demo-list" id="select-demo">
                    <?php
                    if (!empty($demo_list)):
                        foreach ($demo_list as $demo):
                            $file_demo_info = $path . $demo . '/demo-info.json';
                            $demo_installed = $current_demo_installed === $demo ? true : false;
                            if (file_exists($file_demo_info)):
                                $info_demo = json_decode(file_get_contents($file_demo_info), true);
                                $link = "#";
                                if (file_exists($path . $demo . '/options.json')) {
                                    $options = json_decode(file_get_contents($path . $demo . '/options.json'), true);
                                    $link = $options['attachment'];
                                }
                                ?>
                                <div class="swa-mi-demo-item">
                                    <div class="swa-mi-item-inner">
                                        <div class="swa-mi-image">
                                            <img src="<?php echo $url . $demo . '/screenshot.png' ?>" alt="">
                                            <div class="swa-mi-preview">
                                                <h4 class="swa-mi-demo-title"><?php echo esc_attr($info_demo['name']) ?></h4>
                                                <a class="swa-mi-select" href="#"
                                                   data-attachment="<?php echo esc_url($link) ?>"
                                                   data-demo="<?php echo esc_attr($demo) ?>">
                                                    <span><?php esc_html_e('Select', SWA_TEXT_DOMAIN) ?></span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            <?php
                            endif;
                        endforeach;
                    else:
                        ?>
                        <div class="swa-ie-demo-empty">
                            <span class="dashicons dashicons-warning"></span>
                            <h4 class="swa-ie-notice-empty"><?php echo esc_html__('Demos data is empty') ?></h4>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="tabs-contents" id="attachments">
                    <div class="swa-mi-demo-item-selected">
                        <div class="swa-mi-item-inner">
                            <div class="swa-mi-image swa-mi-image-selected">
                                <img src="<?php echo swa_ie()->assets_url . '/swa-ie.jpg' ?>" alt="">
                                <div class="swa-mi-preview">
                                    <h4 class="swa-mi-demo-title-selected"></h4>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="swa-mi-download-att">
                        <div class="swa-mi-dl-step step-1">
                            <h4><?php echo esc_html__('Step 1:', SWA_TEXT_DOMAIN) ?></h4>
                            <button id="swa-download-attachment-btn"
                                    data-attachment="#"><?php echo esc_html__('Download Attachments File', SWA_TEXT_DOMAIN) ?></button>
                        </div>
                        <div class="swa-mi-dl-step step-2">
                            <h4><?php echo esc_html__('Step 2:', SWA_TEXT_DOMAIN) ?></h4>
                            <p>Please <b>"<?php esc_html_e("Upload", SWA_TEXT_DOMAIN) ?>
                                    "</b> <?php esc_html_e("and", SWA_TEXT_DOMAIN) ?>
                                <b>"<?php esc_html_e("Unzip", SWA_TEXT_DOMAIN) ?>"</b> file
                                to <b><?php echo wp_upload_dir()['basedir'] ?>/</b></p>
                        </div>
                        <div class="swa-mi-dl-step step-3">
                            <input type="checkbox" id="swa-accept-unzip-done" value="swa-accept">
                            <label for="swa-accept-unzip-done"><?php esc_html_e("I uploaded and unzipped file", SWA_TEXT_DOMAIN) ?></label>
                        </div>
                        <div class="swa-mi-dl-step step-4">
                            <button><?php esc_html_e("Import Demo Data", SWA_TEXT_DOMAIN) ?></button>
                            <form method="post" style="display: none">
                                <input type="hidden" name="swa-ie-id" value="<?php echo esc_attr($demo) ?>">
                                <input type="hidden" name="action" value="swa-import">
                                <input type="hidden" name="manual_importing" value="true">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>