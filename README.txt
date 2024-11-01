=== Plugin Name ===
Contributors: techxplorer
Tags: anime, kitsu, hummingbird, post, page, shortcode
Requires at least: 4.4.2
Tested up to: 4.8
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Integrates with Kitsu to display a list of Anime titles on your site.

== Description ==

Using a shortcode in a post or page, this plugin allows you to list the titles
that are in your 'currently watching' section of your Anime library on [Kitsu](https://kitsu.io/).

**Important Support Notice**
Development of this plugin has ceased, and it is now officially unsupported.
If you are still using this plugin you are strongly encouraged to find an alternative.

The features of this plugin are:

* Automatically add nofollow to the title links
* Automatically have links open in a new tab/window
* Show title cover images as part of the list

The list of anime titles can be styled to match your theme.

Original robot artwork by [Ragakawaw](http://www.dreamstime.com/ragakawaw_info) and available at [Dreamstime](http://www.dreamstime.com/stock-illustration-super-war-robot-illustration-image47037276).

== Installation ==

Before installing and using this plugin:

* Ensure that you have a [Kitsu](https://kitsu.io/) account
* You have anime titles listed in the 'Currently Watching' section of your library

To install this plugin:

* Upload the plugin files to the `/wp-content/plugins/techxplorers-anime-list` directory, or install the plugin through the WordPress plugins screen directly
* Activate the plugin through the 'Plugins' screen in WordPress
* Update the settings for the plugin, especially your Kitsu username
* Add the [txp-anime-list] shortcode to the page or post where you want the list of anime titles to be displayed

== Frequently Asked Questions ==

= What section of the anime library is displayed? =

Currently only those titles listed in the 'Currently Watching' section are displayed.

= Are you going to show other sections of the library? =

Unlikely, but I'm open to suggestions.

= Can I display the list of titles in a widget =

No. To simplify the code base the widget functionality has been removed in version 1.5.0 of this plugin.

If it is a feature that users want, I could be convinced to add it back.

= Is it possible to style the list of anime titles? =

Yes. The list of anime titles is contained in a div tag with the `txp-anime-list` class. Targeting this class with your
custom CSS will let you style the list of anime titles in posts, pages and the sidebar.

The default CSS can be disabled to make customisation easier.

= Can I add the nofollow attribute to the links? =

Yes. There is a setting for the plugin that you can turn on to add the `rel="nofollow" attribute.

= Can the links automatically open in a new tab / window? =

Yes. There is a setting for the plugin that you can turn on to add the `target="_blank"` attribute to the links.

= Can I include anime title covers in the list? =

Yes. There is a setting that you can enable to do this.

== Changelog ==

= 1.5.2 =
* Confirm compatibility with WordPress 4.8
* Fix code style errors using latest WordPress code style
* Fix display of alternate title

= 1.5.1 =
* Fix bug in deactivator class

= 1.5.0 =
* Update plugin to use the new Kitsu API
* Remove the widget functionality

= 1.4.1 =
* Fix a bug introduced in version 1.4.0

= 1.4.0 =
* Add notice about deprecation of Hummingbird API
* Remove dependency on genericons

= 1.3.2 =
* Fix regressions introduced in version 1.3.0

= 1.3.1 =
* Fix missing updates to README.txt and version string

= 1.3.0 =
* Fix security related issue when the 'Open links in new tab / window.' option is enabled
* Fix code style errors using latest WordPress code style

= 1.2.2 =
* Fix the styling of the profile link in the sidebar widget

= 1.2.1 =
* Fix a typo in the path to the Genericons stylesheet for the admin page

= 1.2.0 =
* Add the ability to sort titles alphabetically

= 1.1.0 =

* Add a widget to display anime title covers in the sidebar
* Add an option to display the alternate title below the canonical title

= 1.0 =

* Initial release

== Upgrade Notice ==

= 1.5.0 =
This version uses the new Kitsu API to display the list of Anime titles, as the old Hummingbird API has been deprecated.
