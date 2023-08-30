<?php
/**
 * Class for public methods.
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
if ( ! class_exists( 'Plugin_Slug_Public' ) ) {

	/**
	 * Calls for public methods.
	 */
	class Plugin_Slug_Public {

		/**
		 * Constructor for class.
		 */
		public function __construct() {
			// Enque custom scripts.
			add_action( 'admin_enqueue_scripts', array( $this, 'plugin_prefix_enqueue_scripts' ) );
		}

		/**
		 * Enqueue custom frontend scripts.
		 */
		public function plugin_prefix_enqueue_scripts() {
			$plugin_asset = 'plugin-slug-public';

			if ( ! defined( 'SCRIPT_DEBUG' ) || ! SCRIPT_DEBUG ) {
				// If Script debug disabled then include minified files.
				$plugin_asset .= '.min';
			}

			// Plugin Related Style and Scripts.
			wp_enqueue_script(
				'plugin-slug-public',
				trailingslashit( PLUGIN_PREFIX_URL ) . 'app/public/assets/js/' . $plugin_asset . '.js',
				array( 'jquery' ),
				PLUGIN_PREFIX_VERSION,
				true
			);

			wp_enqueue_style(
				'plugin-slug-public',
				trailingslashit( PLUGIN_PREFIX_URL ) . 'app/public/assets/css/' . $plugin_asset . '.css',
				array(),
				PLUGIN_PREFIX_VERSION
			);
		}
	}
	new Plugin_Slug_Public();
}
