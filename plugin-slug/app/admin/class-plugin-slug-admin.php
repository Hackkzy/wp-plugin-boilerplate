<?php
/**
 * Class for admin methods.
 *
 * @package PLUGIN_PACKAGE_NAME
 */

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class is exist, then don't execute this.
if ( ! class_exists( 'Plugin_Slug_Admin' ) ) {

	/**
	 * Calls for admin methods.
	 */
	class Plugin_Slug_Admin {

		/**
		 * Constructor for class.
		 */
		public function __construct() {
			// Enque custom scripts.
			add_action( 'admin_enqueue_scripts', array( $this, 'plugin_slug_enqueue_scripts' ) );
		}

		/**
		 * Enqueue custom admin scripts.
		 */
		public function plugin_slug_enqueue_scripts() {
			$plugin_asset  = 'plugin-slug-admin';

			if ( ! defined( 'SCRIPT_DEBUG' ) || ! SCRIPT_DEBUG ) {
				// If Script debug disabled then include minified files.
				$plugin_asset .= '.min';
			}

			// Plugin Related Style and Scripts.
			wp_enqueue_script(
				'plugin-slug-admin',
				trailingslashit( PLUGIN_PREFIX_URL ) . 'app/admin/assets/js/' . $plugin_asset . '.js',
				array( 'jquery' ),
				PLUGIN_PREFIX_VERSION,
				true
			);

			wp_enqueue_style(
				'plugin-slug-admin',
				trailingslashit( PLUGIN_PREFIX_URL ) . 'app/admin/assets/css/' . $plugin_asset . '.css',
				array(),
				PLUGIN_PREFIX_VERSION
			);
		}
	}
	new Plugin_Slug_Admin();
}
