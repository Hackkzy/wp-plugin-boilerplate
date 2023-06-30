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
			add_action( 'admin_enqueue_scripts', array( $this, 'plugin_slug_enqueue_scripts' ) );
		}

		/**
		 * Enqueue custom frontend scripts.
		 */
		public function plugin_slug_enqueue_scripts() {
			$plugin_slug_js  = 'plugin-slug-public.min.js';
			$plugin_slug_css = 'plugin-slug-public.min.css';

			if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
				// If Script Debug enabled then include non minified files.
				$plugin_slug_js = 'plugin-slug-public.js';
				$plugin_slug_js = 'plugin-slug-public.css';
			}

			// Plugin Related Style and Scripts.
			wp_enqueue_script(
				'plugin-slug-admin',
				trailingslashit( PLUGIN_PREFIX_URL ) . 'app/public/assets/js/' . $plugin_slug_js,
				array( 'jquery' ),
				PLUGIN_PREFIX_VERSION,
				true
			);

			wp_enqueue_style(
				'plugin-slug-admin',
				trailingslashit( PLUGIN_PREFIX_URL ) . 'app/public/assets/css/' . $plugin_slug_css,
				array(),
				PLUGIN_PREFIX_VERSION
			);
		}
	}
	new Plugin_Slug_Public();
}
