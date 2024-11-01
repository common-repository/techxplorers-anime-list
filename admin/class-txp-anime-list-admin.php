<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://techxplorer.com
 * @since      1.0.0
 *
 * @package    Txp_Anime_List
 * @subpackage Txp_Anime_List/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Txp_Anime_List
 * @subpackage Txp_Anime_List/admin
 * @author     techxplorer <corey@techxplorer.com>
 */
class Txp_Anime_List_Admin {

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
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard
	 *
	 * @since 1.0.0
	 */
	public function add_plugin_admin_menu() {
		add_options_page( "Techxplorer's Anime List", 'Anime list', 'manage_options', $this->plugin_name, [ $this, 'display_plugin_setup_page' ] );
	}

	/**
	 * Add a settings action link to the plugins page.
	 *
	 * @param array $links The list of existing links.
	 *
	 * @since 1.0.0
	 */
	public function add_action_links( $links ) {
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=txp-anime-list' ) . '">' . __( 'Settings', 'txp-anime-list' ) . '</a>',
		);
		return array_merge( $settings_link, $links );
	}

	/**
	 * Render the settings page
	 *
	 * @since 1.0.0
	 */
	public function display_plugin_setup_page() {
		include_once( 'partials/txp-anime-list-admin-display.php' );
	}

	/**
	 * Register the setting options
	 *
	 * @since 1.0.0
	 */
	public function options_update() {
		register_setting( $this->plugin_name, $this->plugin_name, array( $this, 'validate' ) );
	}

	/**
	 * Validate the admin settings
	 *
	 * @param array   $input       The list of input from the settings form.
	 * @param boolean $clear_cache Optionally clear the cache on option validation.
	 *
	 * @since 1.0.0
	 */
	public function validate( $input, $clear_cache = true ) {
		// All checkbox options.
		$valid = array();

		// Link formatting.
		$valid['nofollow'] = ( isset( $input['nofollow'] ) && ! empty( $input['nofollow'] ) ) ? 1 : 0;
		$valid['newtab'] = ( isset( $input['newtab'] ) && ! empty( $input['newtab'] ) ) ? 1 : 0;

		// Include plugin icons.
		$valid['covers'] = ( isset( $input['covers'] ) && ! empty( $input['covers'] ) ) ? 1 : 0;

		// Disable plugin CSS.
		$valid['css'] = ( isset( $input['css'] ) && ! empty( $input['css'] ) ) ? 1 : 0;

		// Display alternate titles.
		$valid['alttitles'] = ( isset( $input['alttitles'] ) && ! empty( $input['alttitles'] ) ) ? 1 : 0;

		// Sort title list alphabetically.
		$valid['sort'] = ( isset( $input['sort'] ) && ! empty( $input['sort'] ) ) ? 1 : 0;

		// Kitsu username.
		$valid['username'] = ( isset( $input['username'] ) && ! empty( $input['username'] ) ) ? sanitize_user( $input['username'] ) : '';

		// Try a call to the Kitsu api to see if it works.
		if ( empty( $input['username'] )  && function_exists( 'add_settings_error' ) ) {
			// Add an error about empty username.
			add_settings_error(
				$this->plugin_name . '_username',
				esc_attr( 'settings_updated' ),
				__( 'The username field cannot be empty.', 'txp-anime-list' ),
				'error'
			);
		}

		$userid = $this->get_user_info( $valid['username'] );

		if ( false === $userid && function_exists( 'add_settings_error' ) ) {
			// Add an error about incorrect username.
			add_settings_error(
				$this->plugin_name . '_username',
				esc_attr( 'settings_updated' ),
				__( 'The specified username failed to validate.', 'txp-anime-list' ),
				'error'
			);
		}

		// Kitsu user id.
		$valid['userid'] = $userid;

		// Clear the cache as settings may have changed.
		if ( true === $clear_cache ) {
			$this->clear_cache();
		}

		return $valid;
	}

	/**
	 * Generate a link in a safe way taking into account some options
	 *
	 * @since 1.0.0
	 * @param string  $url      The url to link to.
	 * @param string  $text     The text of the link.
	 * @param boolean $nofollow Add the rel="nofollow" attribute.
	 * @param boolean $newtab   Add the target="_blank" attribute.
	 *
	 * @return The html of the link
	 */
	public function generate_link( $url, $text, $nofollow = false, $newtab = false ) {

		// Build a list of allowed tags and attributes.
		static $allowed = null;

		if ( null === $allowed ) {
			$allowed = array(
				'a' => array(
					'href' => array(),
					'rel' => array(),
					'target' => array(),
				),
			);
		}

		// Check to see if we need to add the attributes.
		if ( true === $nofollow ) {
			$nofollow = ' rel="nofollow" ';
		} else {
			$nofollow = ' ';
		}

		if ( true === $newtab ) {
			$newtab = ' target="_blank" rel="noopener noreferrer" ';
		} else {
			$newtab = ' ';
		}

		if ( ! empty( $nofollow ) && ! empty( $newtab ) ) {
			$nofollow = ' ';
			$newtab = ' target="_blank" rel="noopener noreferrer nofollow" ';
		}

		// Build the link.
		$link = "<a href=\"{$url}\" {$nofollow} {$newtab}>{$text}</a>";

		// Play it safe.
		$link = wp_kses( $link, $allowed );

		return $link;
	}

	/**
	 * Generate the HTML to title cover
	 *
	 * @since 2.1.0
	 * @param string  $src         The url to the image source.
	 * @param string  $url         The url to link to.
	 * @param boolean $nofollow    Add the rel="nofollow" attribute.
	 * @param boolean $newtab      Add the target="_blank" attribute.
	 *
	 * @return string The HTML to display the icon, or an empty string on failure.
	 */
	public function generate_cover_link( $src, $url, $nofollow = false, $newtab = false ) {

		// Build a list of allowed tags and attributes.
		static $allowed = null;

		if ( null === $allowed ) {
			$allowed = array(
				'a' => array(
					'href' => array(),
					'rel' => array(),
					'target' => array(),
				),
				'img' => array(
					'src' => array(),
					'height' => array(),
					'width' => array(),
					'class' => array(),
				),
				'span' => array(
					'class' => array(),
				),
			);
		}

		// Check to see if we need to add the attributes.
		if ( ! empty( $nofollow ) ) {
			$nofollow = ' rel="nofollow" ';
		} else {
			$nofollow = ' ';
		}

		if ( ! empty( $newtab ) ) {
			$newtab = ' target="_blank" rel="noopener noreferrer"';
		} else {
			$newtab = ' ';
		}

		if ( ! empty( $nofollow ) && ! empty( $newtab ) ) {
			$nofollow = ' ';
			$newtab = ' target="_blank" rel="noopener noreferrer nofollow" ';
		}

		// Build the img src tag.
		$img = "<img class=\"txp-anime-list-cover-img\" src=\"{$src}\"/>";

		// Build the link.
		$link = "<a href=\"{$url}\" {$nofollow} {$newtab}>{$img}</a>";

		// Finalise the element.
		$span = "<span class=\"alignleft\">$link</span>";

		// Play it safe.
		$span = wp_kses( $span, $allowed );

		return $span;
	}

	/**
	 * Get information about the user from the Kitsu website
	 *
	 * @param string $username The username at the Kitsu website.
	 *
	 * @return mixed integer|boolean unique user id if user found, or false on failure.
	 */
	private function get_user_info( $username ) {

		// Build the url template.
		$user_url = 'https://kitsu.io/api/edge/users/?filter[name]=%s';

		// Use the url template to check the username.
		$http = new WP_Http();
		$args = array(
			'headers' => array(
				'Accept: application/vnd.api+json',
				'Content-Type: application/vnd.api+json',
			),
		);

		$response = $http->request( sprintf( $user_url, $username ), $args );

		// If the check fails, returns false.
		if ( true === is_wp_error( $response ) ) {
			return false;
		}

		// If we get here, the call succedded.
		$data = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( true === empty( $data['data'][0]['id'] ) ) {
			return false;
		}

		return $data['data'][0]['id'];
	}

	/**
	 * Get the list of anime.
	 *
	 * @param integer $userid The unique userid in the Kitsu service.
	 *
	 * @return array An array of records from Kitsu.
	 */
	public function get_anime_data( $userid ) {

		$records = array();

		// Build the url template.
		$data_url = 'https://kitsu.io/api/edge/users/%d/library-entries?filter[status]=current&filter[media_type]=Anime&include=media';

		// Use the url template to check the username.
		$http = new WP_Http();
		$args = array(
			'headers' => array(
				'Accept: application/vnd.api+json',
				'Content-Type: application/vnd.api+json',
			),
		);

		$response = $http->request( sprintf( $data_url, $userid ), $args );

		// If the check fails, returns false.
		if ( true === is_wp_error( $response ) ) {
			return array();
		}

		// If we get here, the call succeeded.
		$data = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( true === empty( $data['included'] ) ) {
			return array();
		}

		// Loop through each of the records and build our intermediate data.
		$records = array();

		foreach ( $data['included'] as $datum ) {
			$record = new stdClass();
			$record->slug           = $datum['attributes']['slug'];
			$record->canonical_title = $datum['attributes']['canonicalTitle'];
			$record->txp_title      = $record->canonical_title;
			$record->alternate_title = $datum['attributes']['titles']['en'];
			$record->synopsis       = $datum['attributes']['synopsis'];
			$record->cover_image_url  = strtok( $datum['attributes']['posterImage']['small'] , '?' );
			$record->more_info_url    = sprintf( 'https://kitsu.io/anime/%s', $record->slug );
			$records[] = $record;
		}

		return $records;
	}

	/**
	 * Build the list of anime from the data retrieved from Kitsue
	 *
	 * @return string The HTML to display the list of anime titles
	 */
	public function build_anime_list() {

		// Get the plugin options.
		$options = $this->validate( get_option( $this->plugin_name ), false );

		// Don't try and do anything if there is no userid configured.
		if ( true === empty( $options['userid'] ) ) {
			return array();
		}

		if ( isset( $options['nofollow'] ) && ! empty( $options['nofollow'] ) ) {
			$nofollow = true;
		} else {
			$nofollow = false;
		}

		if ( isset( $options['newtab'] ) && ! empty( $options['newtab'] ) ) {
			$newtab = true;
		} else {
			$newtab = false;
		}

		if ( isset( $options['covers'] ) && ! empty( $options['covers'] ) ) {
			$covers = true;
		} else {
			$covers = false;
		}

		if ( isset( $options['alttitles'] ) && ! empty( $options['alttitles'] ) ) {
			$alttitles = true;
		} else {
			$alttitles = false;
		}

		// Get the data from Kitsue.
		$records = $this->get_anime_data( $options['userid'] );

		// Sort the list of titles if required.
		if ( isset( $options['sort'] ) && ! empty( $options['sort'] ) ) {
			require_once __DIR__ . '/class-txp-utils-array.php';

			$records = Txp_Utils_Array::sort_array_by_element( $records, 'txp_title' );
		}

		// Build the HTML.
		$html = "<div class=\"{$this->plugin_name}\"><table>";

		// Add the caption.
		$html .= '<caption>' . esc_html__( 'Currently Watching Anime List.', 'txp-anime-list' ) . '</caption>';

		// Build the profile and home links.
		$profile = '<span class="alignleft">';

		$profile .= $this->build_profile_link( $options['username'], $nofollow, $newtab );

		$profile .= '</span>';

		$home = '<span class="alignright">';

		$home .= $this->build_homepage_link( $nofollow, $newtab );

		$home .= '</span>';

		// Add the table header and footer.
		$html .= "<thead><tr><th colspan=\"2\">{$profile}{$home}</th></tr></thead>";

		$html .= "<tfoot><tr><td colspan=\"2\">{$profile}{$home}</td></tr></tfoot><tbody>";

		$alttitle_link = '';

		foreach ( $records as $record ) {

			// Build the title links.
			$title_link = $this->generate_link( $record->more_info_url, $record->canonical_title, $nofollow, $newtab );

			if ( true === $alttitles ) {
				if ( false === empty( $record->alternate_title ) ) {
					$alttitle_link = $this->generate_link( $record->more_info_url, $record->alternate_title, $nofollow, $newtab );
				} else {
					$alttitle_link = '';
				}
			}

			// Build the more information link.
			$more_info_link = $this->generate_link( $record->more_info_url, esc_html__( 'More info.', 'txp-anime-list' ), $nofollow, $newtab );

			// Build the cover link.
			$cover_link = '';

			if ( true === $covers ) {
				$cover_link = $this->generate_cover_link(
					$record->cover_image_url,
					$record->more_info_url,
					$nofollow,
					$newtab
				);
			}

			// Get the description.
			$description = wpautop( $record->synopsis );

			// Build the table row.
			$row = '<tr>';

			if ( true === $covers ) {
				$row .= '<td class="' . $this->plugin_name . '-cover">' . $cover_link . '</td>';
			}

			$row .= '<td class="' . $this->plugin_name . '-descr">';

			// Use better semantic markup for the titles.
			$row .= "<h2 class=\"txp-anime-list-canonical-title\">{$title_link}</h2>";

			if ( ! empty( $alttitle_link ) ) {
				$row .= '<p class="' . $this->plugin_name . '-alttitle">' . $alttitle_link . '</p>';
			}

			$row .= $description;
			$row .= '<p class="' . $this->plugin_name . '-moreinfo">' . $more_info_link . '</p>';
			$row .= '</td></tr>';

			$html .= $row;
		}// End foreach().

		$html .= '</tbody></table></div>';

		// Set this transient to expire after an hour.
		set_transient( $this->plugin_name . '_cache', $html, HOUR_IN_SECONDS );
		return $html;
	}

	/**
	 * Make the HTML for the link to the profile page.
	 *
	 * @param string $username The Kitsu user name.
	 * @param string $nofollow The rel="nofollow" attribute.
	 * @param string $newtab   The target attribute.
	 *
	 * @return string The HTML of the link.
	 */
	public function build_profile_link( $username, $nofollow, $newtab ) {

		return $this->generate_link(
			sprintf( 'https://kitsu.io/users/%s', $username ),
			esc_html__( 'Kitsu user profile.', 'txp-anime-list' ),
			$nofollow,
			$newtab
		);
	}

	/**
	 * Make the HTML for the link to the Kitsu home page.
	 *
	 * @param string $nofollow The rel="nofollow" attribute.
	 * @param string $newtab   The target attribute.
	 *
	 * @return string The HTML of the link.
	 */
	public function build_homepage_link( $nofollow, $newtab ) {

		return $this->generate_link(
			'https://kitsu.io/',
			'Kitsu homepage.',
			$nofollow,
			$newtab
		);
	}

	/**
	 * Delete the option that is being used as a cache of the HTML for the list.
	 *
	 * @since 1.0.0
	 */
	public function clear_cache() {
		delete_transient( $this->plugin_name . '_cache' );
		delete_transient( $this->plugin_name . '_widget_cache' );
	}
}
