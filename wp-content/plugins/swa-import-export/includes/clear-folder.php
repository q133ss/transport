<?php
/**
 * @Template: clear-folder.php
 * @since: 1.0.0
 * @author: KP
 * @descriptions:
 * @create: 23-Nov-17
 */
function swa_ie_clear_tmp()
{

    $upload_dir = wp_upload_dir();

    swa_ie_delete_directory($upload_dir['basedir'] . '/cms-attachment-tmp');
    swa_ie_delete_directory($upload_dir['basedir'] . '/swa-ie-demo');
}

function swa_ie_delete_directory($dir)
{
    if (!file_exists($dir)) {
        return true;
    }
    if (!is_dir($dir) || is_link($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!swa_ie_delete_directory($dir . "/" . $item, false)) {
            chmod($dir . "/" . $item, 0777);
            if (!swa_ie_delete_directory($dir . "/" . $item, false)) return false;
        };
    }
    return rmdir($dir);
}

function swa_ie_import_finish($demo_id)
{
    update_option('swa_ie_demo_installed', $demo_id);
    global $wp_filesystem, $import_result;
    $file = swa_ie()->plugin_dir . 'assets/log.txt';
    $file_contents = implode(PHP_EOL, $import_result);
    $wp_filesystem->put_contents($file, $file_contents, FS_CHMOD_FILE);
}