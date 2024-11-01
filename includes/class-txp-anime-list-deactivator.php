<?php
/**
 * Fired during plugin deactivation
 *
 * @link       https://techxplorer.com
 * @since      1.0.0
 *
 * @package    Txp_Anime_List
 * @subpackage Txp_Anime_List/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Txp_Anime_List
 * @subpackage Txp_Anime_List/includes
 * @author     techxplorer <corey@techxplorer.com>
 */
class Txp_Anime_List_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// Play nice and delete the transiets.
		delete_transient( 'txp-anime-list_cache' );
	}
}
