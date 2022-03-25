<?php
/**
 * @Template: settings.php
 * @since: 1.0.0
 * @author: KP
 * @descriptions:
 * @create: 20-Nov-17
 */

use Elementor\Core\Settings\Page\Manager as PageManager;
use Elementor\Plugin;
use Elementor\Core\Kits\Manager;

if ( ! defined( 'ABSPATH' ) ) {
	die();
}
/**
 * Export theme options
 *
 * @param $file
 */
function swa_ie_setting_export( $file ) {
	global $wp_filesystem;

	$option_name = swa_ie_setting_get_opt_name( $file );

	$file_contents = get_option( $option_name );

	if ( ! $file_contents ) {
		return;
	}

	$file_contents = json_encode( $file_contents );

	$wp_filesystem->put_contents( $file, $file_contents, FS_CHMOD_FILE ); // Save it
}

function swa_ie_setting_import( $file ) {
	// File exists?
	if ( file_exists( $file ) ) {
		// Get file contents and decode
		$data = file_get_contents( $file );

		$data = json_decode( $data, true );

		$data = swa_ie_replace_theme_options( $data );

		$option_name = swa_ie_setting_get_opt_name( $file );

		update_option( $option_name, $data );

		global $import_result;
		$import_result[] = 'Import theme options "' . $option_name . '" successfully!';
	}
}

function swa_ie_setting_get_opt_name( $file ) {

	global $wp_filesystem;

	/**
	 * Add WP_Filesystem Class
	 *
	 */
	if ( ! class_exists( 'WP_Filesystem' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		WP_Filesystem();
	}

	$opt_name = apply_filters( 'swa_ie_options_name', 'cms_theme_options' );

	if ( ! file_exists( $file ) ) {
		return $opt_name;
	}

	$options = file_get_contents( $file );

	$options = json_decode( $options, true );

	return ! empty( $options['opt-name'] ) ? $options['opt-name'] : $opt_name;
}

function swa_ie_replace_theme_options( $options ) {
	$_replaces = apply_filters( 'swa_ie_replace_theme_options', array() );

	foreach ( $_replaces as $pattern => $_replace ) {
		if ( isset( $options[ $pattern ] ) ) {
			$options[ $pattern ] = $_replace;
		}
	}

	return $options;
}

function swa_ie_site_settings_import( $file ) {
	if ( file_exists( $file ) ) {
		$kit = Plugin::$instance->kits_manager->get_active_kit();

		if ( ! $kit->get_id() ) {
			$kit = Plugin::$instance->kits_manager->create_default();
		}

		update_option( Manager::OPTION_ACTIVE, $kit );

		$kit = Plugin::$instance->kits_manager->get_active_kit();

		$new_settings = json_decode( file_get_contents( $file ), true );

		$new_settings = $new_settings['settings'];

		$result = $kit->save( [ 'settings' => $new_settings ] );

		global $import_result;
		$import_result[] = 'Import Elementor Site Settings successfully!';
	}
}