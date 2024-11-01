<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://techxplorer.com
 * @since      1.0.0
 *
 * @package    Txp_Anime_List
 * @subpackage Txp_Anime_List/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Txp_Anime_List
 * @subpackage Txp_Anime_List/public
 * @author     techxplorer <corey@techxplorer.com>
 */
class Txp_Anime_List_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_register_style(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'css/txp-anime-list-public.css',
			array(),
			$this->version,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

	}

	/**
	 * Replace the shortcode with the list of puglins.
	 *
	 * @since 1.0.0
	 */
	public function do_shortcode() {

		// Replace the shortocde with the list of anime.
		$anime_list = get_transient( $this->plugin_name . '_cache' );

		// Get the other plugin options.
		$options = get_option( $this->plugin_name );

		// Load the plugin specific public css.
		if ( isset( $options['css'] ) && empty( $options['css'] ) ) {
			wp_enqueue_style( $this->plugin_name );
		}

		if ( false === $anime_list ) {
			require_once plugin_dir_path( __FILE__ ) . '../admin/class-txp-anime-list-admin.php';
			$admin = new Txp_Anime_List_Admin( $this->plugin_name, $this->version );
			$anime_list = $admin->build_anime_list();
		}

		return $anime_list;
	}

	/**
	 * Register the widget
	 */
	public function register_widget() {
		// Unregister the widget cleanly.
		unregister_widget( 'Txp_Anime_List_Widget' );
	}
}
