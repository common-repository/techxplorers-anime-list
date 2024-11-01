<?php
/**
 * Fired during plugin plugin uninstallation
 *
 * @link       https://techxplorer.com
 * @since      1.0.0
 *
 * @package    Txp_Anime_List
 * @subpackage Txp_Anime_List/includes
 */

/**
 * Fired during plugin uninstallation.
 *
 * This class defines all code necessary to run during the plugin's uinstallation.
 *
 * @since      1.0.0
 * @package    Txp_Anime_List
 * @subpackage Txp_Anime_List/includes
 * @author     techxplorer <corey@techxplorer.com>
 */
class Txp_Anime_List_Uninstaller {

	/**
	 * Uninstall the plugin.
	 *
	 * Clean up during uninstall by removing settings, options, etc.
	 *
	 * @since    2.0.0
	 */
	public static function uninstall() {
		delete_option( 'txp-anime-list' );
		delete_transient( 'txp-anime-list_cache' );
	}
}
