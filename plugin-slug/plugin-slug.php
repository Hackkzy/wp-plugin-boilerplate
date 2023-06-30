<?php
/**
 * Plugin Name:       PLUGIN_NAME
 * Plugin URI:        PLUGIN_URI
 * Description:       PLUGIN_DESCRIPTION
 * Version:           PLUGIN_VERSION
 * Author:            PLUGIN_AUTHOR
 * Author URI:        PLUGIN_AUTHOR_URI
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       TEXT_DOMAIN
 * Domain Path:       /languages
 *
 * @package           PLUGIN_PACKAGE_NAME
 */

/**
 * Defining Constants.
 *
 * @package    PLUGIN_PACKAGE_NAME
 */
if ( ! defined( 'PLUGIN_PREFIX_VERSION' ) ) {
	/**
	 * The version of the plugin.
	 */
	define( 'PLUGIN_PREFIX_VERSION', '1.1.0' );
}

if ( ! defined( 'PLUGIN_PREFIX_PATH' ) ) {
	/**
	 *  The server file system path to the plugin directory.
	 */
	define( 'PLUGIN_PREFIX_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'PLUGIN_PREFIX_URL' ) ) {
	/**
	 * The url to the plugin directory.
	 */
	define( 'PLUGIN_PREFIX_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'PLUGIN_PREFIX_BASE_NAME' ) ) {
	/**
	 * The url to the plugin directory.
	 */
	define( 'PLUGIN_PREFIX_BASE_NAME', plugin_basename( __FILE__ ) );
}
/**
 * Apply transaltion file as per WP language.
 */
function plugin_prefix_text_domain_loader() {

	// Get mo file as per current locale.
	$mofile = PLUGIN_PREFIX_PATH . 'languages/' . get_locale() . '.mo';

	// If file does not exists, then apply default mo.
	if ( ! file_exists( $mofile ) ) {
		$mofile = PLUGIN_PREFIX_PATH . 'languages/default.mo';
	}

	load_textdomain( 'TEXT_DOMAIN', $mofile );
}

add_action( 'plugins_loaded', 'plugin_prefix_text_domain_loader' );

/**
 * Setting link for plugin.
 *
 * @param  array $links Array of plugin setting link.
 * @return array
 */
function plugin_prefix_setting_page_link( $links ) {

	$settings_link = sprintf(
		'<a href="%1$s">%2$s</a>',
		esc_url( admin_url( 'admin.php?page=settings-page-slug' ) ),
		esc_html__( 'Settings', 'blp-persona-verification' )
	);

	array_unshift( $links, $settings_link );
	return $links;
}
add_filter( 'plugin_action_links_' . PLUGIN_PREFIX_BASE_NAME, 'plugin_prefix_setting_page_link' );

// Include plugin related files here.
require PLUGIN_PREFIX_PATH . '/app/includes/common-functions.php';
require PLUGIN_PREFIX_PATH . '/app/admin/class-plugin-slug-admin.php';
require PLUGIN_PREFIX_PATH . '/app/public/class-plugin-slug-public.php';
