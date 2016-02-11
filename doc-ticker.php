<?php
/**
 * Plugin Name: Doc Ticker
 * Plugin URI:  https://github.com/DioceseOfCharlotte/doc-ticker
 * Description: RSS Feed. Ticker style.
 * Version:     0.1.0
 * Author:      Marty Helmick
 * Author URI:  http://martyhelmick.com
 * License:     GPLv2
 * Text Domain: doc-ticker
 * Domain Path: /languages
 */

/**
 * Main initiation class
 *
 * @since  0.1.0
 * @var  string $version  Plugin version
 * @var  string $basename Plugin basename
 * @var  string $url      Plugin URL
 * @var  string $path     Plugin Path
 */
class Doc_Ticker {

	/**
	 * Current version
	 *
	 * @var  string
	 * @since  0.1.0
	 */
	const VERSION = '0.1.0';

	/**
	 * URL of plugin directory
	 *
	 * @var string
	 * @since  0.1.0
	 */
	protected $url = '';

	/**
	 * Path of plugin directory
	 *
	 * @var string
	 * @since  0.1.0
	 */
	protected $path = '';

	/**
	 * Plugin basename
	 *
	 * @var string
	 * @since  0.1.0
	 */
	protected $basename = '';


	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since  0.1.0
	 * @return Doc_Ticker A single instance of this class.
	 */
	public static function get_instance() {
		$instance = null;
		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->includes();
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Sets up our plugin
	 *
	 * @since  0.1.0
	 */
	protected function __construct() {
		$this->basename = plugin_basename( __FILE__ );
		$this->url      = plugin_dir_url( __FILE__ );
		$this->path     = plugin_dir_path( __FILE__ );
	}

	/**
	 * Loads include and admin files for the plugin.
	 *
	 * @since  0.1.0
	 * @access private
	 * @return void
	 */
	private function includes() {

		/* Load functions for the plugin. */
		require_once( $this->path . '/includes/functions.php' );

		/* Load admin functions. */
		// if ( is_admin() ) {
		// 	require_once( $this->path . 'admin/settings.php' );
		// 	require_once( $this->path . 'admin/admin-notices.php' );
		// }

	}

	/**
	 * Add hooks and filters
	 *
	 * @since  0.1.0
	 * @return void
	 */
	private function setup_actions() {
		register_activation_hook( __FILE__, array( $this, '_activate' ) );
		register_deactivation_hook( __FILE__, array( $this, '_deactivate' ) );

		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Activate the plugin
	 *
	 * @since  0.1.0
	 * @return void
	 */
	function _activate() {
		// Make sure any rewrite functionality has been loaded
		flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin
	 * Uninstall routines should be in uninstall.php
	 *
	 * @since  0.1.0
	 * @return void
	 */
	function _deactivate() {}

	/**
	 * Init hooks
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function init() {
		load_plugin_textdomain( 'doc-ticker', false, dirname( $this->basename ) . '/languages/' );
	}

}

/**
 * Grab the Doc_Ticker object and return it.
 * Wrapper for Doc_Ticker::get_instance()
 *
 * @since  0.1.0
 * @return Doc_Ticker  Singleton instance of plugin class.
 */
function doc_ticker() {
	return Doc_Ticker::get_instance();
}

// Kick it off
doc_ticker();
