<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://techxplorer.com
 * @since      1.0.0
 *
 * @package    Txp_Anime_List
 * @subpackage Txp_Anime_List/admin/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<!-- Main Content -->
			<div id="post-body-content">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">
						<form method="post" name="<?php esc_html_e( 'txp-anime-list' ); ?>" action="options.php">
							<?php settings_fields( $this->plugin_name ); ?>
							<?php $options = $this->validate( get_option( $this->plugin_name ) ); ?>
							<h2><span class="dashicons dashicons-desktop"></span> <?php esc_html_e( 'Display settings', 'txp-anime-list' ); ?></h2>
							 <div class="inside">
								<ul class="striped">
									<li>
										<!-- Add rel="nofollow" to links -->
										<fieldset>
											<legend class="screen-reader-text"><span><?php esc_html_e( 'Add rel="nofollow" to title links.', 'txp-anime-list' ); ?></span></legend>
											<label for="<?php echo esc_html( $this->plugin_name ); ?>-nofollow">
												<input type="checkbox"
													 id="<?php echo esc_html( $this->plugin_name ); ?>-nofollow"
													 name="<?php echo esc_html( $this->plugin_name ); ?>[nofollow]"
													 value="1" <?php checked( $options['nofollow'], 1 ); ?>/>
												<span><?php esc_html_e( 'Add rel="nofollow" to title links.', 'txp-anime-list' ); ?></span>
											</label>
										</fieldset>
									</li>
									<li>
										<!-- Open links in new window / tab  -->
										<fieldset>
											<legend class="screen-reader-text"><span><?php esc_html_e( 'Open links in new tab / window.', 'txp-anime-list' ); ?></span></legend>
											<label for="<?php echo esc_html( $this->plugin_name ); ?>-newtab">
												<input type="checkbox"
													 id="<?php echo esc_html( $this->plugin_name ); ?>-newtab"
													 name="<?php echo esc_html( $this->plugin_name ); ?>[newtab]"
													 value="1" <?php checked( $options['newtab'], 1 ); ?>/>
												<span><?php esc_html_e( 'Open links in new tab / window.', 'txp-anime-list' ); ?></span>
											</label>
										</fieldset>
									</li>
									<li>
										<!-- Incude cover images -->
										<fieldset>
											<legend class="screen-reader-text"><span><?php esc_html_e( 'Display title covers.', 'txp-anime-list' ); ?></span></legend>
											<label for="<?php echo esc_html( $this->plugin_name ); ?>-covers">
												<input type="checkbox"
													 id="<?php echo esc_html( $this->plugin_name ); ?>-covers"
													 name="<?php echo esc_html( $this->plugin_name ); ?>[covers]"
													 value="1" <?php checked( $options['covers'], 1 ); ?>/>
												<span><?php esc_html_e( 'Display title covers.', 'txp-anime-list' ); ?></span>
											</label>
										</fieldset>
									</li>
									<li>
										<!-- Disable plugin CSS -->
										<fieldset>
											<legend class="screen-reader-text"><span><?php esc_html_e( 'Disable plugin CSS.', 'txp-anime-list' ); ?></span></legend>
											<label for="<?php echo esc_html( $this->plugin_name ); ?>-css">
												<input type="checkbox"
													 id="<?php echo esc_html( $this->plugin_name ); ?>-css"
													 name="<?php echo esc_html( $this->plugin_name ); ?>[css]"
													 value="1" <?php checked( $options['css'], 1 ); ?>/>
												<span><?php esc_html_e( 'Disable plugin CSS. You will need to add your own using the customisation functionality of your theme.', 'txp-anime-list' ); ?></span>
											</label>
										</fieldset>
									</li>
									<li>
										<!-- Display alternate titles -->
										<fieldset>
											<legend class="screen-reader-text"><span><?php esc_html_e( 'Display alternate titles.', 'txp-anime-list' ); ?></span></legend>
											<label for="<?php echo esc_html( $this->plugin_name ); ?>-alttitles">
												<input type="checkbox"
													 id="<?php echo esc_html( $this->plugin_name ); ?>-alttitles"
													 name="<?php echo esc_html( $this->plugin_name ); ?>[alttitles]"
													 value="1" <?php checked( $options['alttitles'], 1 ); ?>/>
												<span><?php esc_html_e( 'Display the alternate title, below the canonical title.', 'txp-anime-list' ); ?></span>
											</label>
										</fieldset>
									</li>
									<li>
										<!-- Sort titles alphabetically -->
										<fieldset>
											<legend class="screen-reader-text"><span><?php esc_html_e( 'Sort title list alphabetically.', 'txp-anime-list' ); ?></span></legend>
											<label for="<?php echo esc_html( $this->plugin_name ); ?>-sort">
												<input type="checkbox"
													 id="<?php echo esc_html( $this->plugin_name ); ?>-sort"
													 name="<?php echo esc_html( $this->plugin_name ); ?>[sort]"
													 value="1" <?php checked( $options['sort'], 1 ); ?>/>
												<span><?php esc_html_e( 'Sort anime list alphabetically, by canonical title.', 'txp-anime-list' ); ?></span>
											</label>
										</fieldset>
									</li>
								</ul>
							</div>
							<h2><span class="dashicons dashicons-admin-users"></span> <?php esc_html_e( 'Kitsu settings', 'txp-anime-list' ); ?></h2>
							<div class="inside">
								<ul class="striped">
									<li>
										<!-- Kitsu username -->
										<fieldset>
											<legend class="screen-reader-text"><span><?php esc_html_e( 'Enter Kitsu username.', 'txp-anime-list' ); ?></span></legend>
											<input type="text"
												 class="regular-text"
												 id="<?php echo esc_html( $this->plugin_name ); ?>-username"
												 name="<?php echo esc_html( $this->plugin_name ); ?>[username]"
												 value="<?php echo esc_html( $options['username'] ); ?>"
											/>
											<span><?php esc_html_e( 'Kitsu username.' ); ?></span>
											<p class="description" id="<?php echo esc_html( $this->plugin_name ); ?>-username-description">
												<?php esc_html_e( 'Your current username at the Kitsu website.', 'txp-ping-recorder' ); ?>
											</p>
										</fieldset>
									</li>
									<li>
										<!-- Kitsu user id -->
										<fieldset>
											<legend class="screen-reader-text"><span><?php esc_html_e( 'Kitsu user id.', 'txp-anime-list' ); ?></span></legend>
											<input type="text"
												 class="regular-text"
												 id="<?php echo esc_html( $this->plugin_name ); ?>-userid"
												 name="<?php echo esc_html( $this->plugin_name ); ?>[userid]"
												 value="<?php echo esc_html( $options['userid'] ); ?>"
												 readonly
											/>
											<span><?php esc_html_e( 'Kitsu user id.' ); ?></span>
											<p class="description" id="<?php echo esc_html( $this->plugin_name ); ?>-userid-description">
												<?php esc_html_e( 'Your unique numeric Kitsu user id (Used with the Kitsu API).', 'txp-ping-recorder' ); ?>
											</p>
										</fieldset>
									</li>
								</ul>
							</div>
							<div class="inside">
								<?php submit_button( 'Save all changes', 'primary','submit', true ); ?>
							</div>
						</form>
					</div>
				</div>
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">
						<h2><?php esc_html_e( 'Shortcode instructions', 'txp-anime-list' ); ?></h2>
						<div class="inside">
							<p><?php esc_html_e( 'Use the following shortcode to display the list of active plugins in a post or page.', 'txp-anime-list' ); ?></p>
							<pre>[<?php echo esc_html( $this->plugin_name ); ?>]</pre>
						</div>
					</div>
				</div>
			</div>
			 <!-- Sidebar -->
			<div id="postbox-container-1" class="postbox-container">
				<div class="metabox-sortables">
					<div class="postbox">
						<h2><span class="dashicons dashicons-info"></span> <?php esc_html_e( 'More information' ); ?></h2>
						<div class="inside">
							<p><?php esc_html_e( 'The purpose of this plugin is to display a list of the Anime that you are currently watching as listed on the Kitsu website.', 'txp-anime-list' ); ?></p>
							<p><?php esc_html_e( 'More information on this plugin is available from the links below.', 'txp-anime-list' ); ?></p>
							<ul class="striped">
								<li><span class="dashicons dashicons-admin-plugins"></span> <a href="https://techxplorer.com/projects/txp-anime-list"><?php esc_html_e( 'Plugin homepage.', 'txp-anime-list' ); ?></a></li>
								<li><span class="dashicons dashicons-twitter"></span> <a href="https://twitter.com/techxplorer"><?php esc_html_e( 'My Twitter profile.', 'txp-anime-list' ); ?></a></li>
								<li><span class="dashicons dashicons-admin-home"></span> <a href="https://techxplorer.com/"><?php esc_html_e( 'My website.', 'txp-anime-list' ); ?></a></li>
								<li><span class="dashicons dashicons-media-video"></span> <a href="https://kitsu.io/"><?php esc_html_e( 'Kitsu website', 'txp-anime-list' ); ?></a></li>
							</ul>
					</div>
				</div>
			</div>
			<br class="clear">
		</div>
	</div>
</div>
