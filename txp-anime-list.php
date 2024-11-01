<?php
/**
 * The plugin bootstrap file
 *
 * @link              https://techxplorer.com
 * @since             1.0.0
 * @package           Txp_Anime_List
 *
 * @wordpress-plugin
 * Plugin Name:       Techxplorer's Anime List
 * Plugin URI:        https://techxplorer.com/
 * Description:       Display a list of anime titles on your site via a shortcode or widget.
 * Version:           1.5.2
 * Author:            techxplorer
 * Author URI:        https://techxplorer.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       txp-anime-list
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-txp-anime-list-activator.php
 */
function activate_txp_anime_list() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-txp-anime-list-activator.php';
	Txp_Anime_List_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-txp-anime-list-deactivator.php
 */
function deactivate_txp_anime_list() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-txp-anime-list-deactivator.php';
	Txp_Anime_List_Deactivator::deactivate();
}

/**
 * The code that runs during plugin install.
 */
function uninstall_txp_anime_list() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-txp-anime-list-uninstaller.php';
	Txp_Plugin_List_Uninstaller::uninstall();
}

register_activation_hook( __FILE__, 'activate_txp_anime_list' );
register_deactivation_hook( __FILE__, 'deactivate_txp_anime_list' );
register_uninstall_hook( __FILE__, 'uninstall_txp_anime_list' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-txp-anime-list.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_txp_anime_list() {

	$plugin = new Txp_Anime_List();
	$plugin->run();

}
run_txp_anime_list();
