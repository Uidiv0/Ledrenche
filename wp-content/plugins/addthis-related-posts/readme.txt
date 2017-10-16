=== Related Posts by AddThis ===
Contributors: abramsm, jgrodel, bradaddthis.com, addthis_paul, addthis_matt, ribin_addthis, addthis_elsa, addthisleland
Tags: AddThis, related posts, related pages, related content, recommended content, content recommendations, widget, post, posts, pages, plugin, related
Requires at least: 3.0
Tested up to: 4.8.1
Stable tag: 2.1.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

AddThis Related Posts for WordPress can help increase your visitors’ time on site and decrease your bounce rate.



== Description ==

Get visitors reading more of your posts and trafficking more pages on your site by installing the AddThis Related Posts WordPress plugin. With AddThis, you can recommend your site’s most popular content, and what’s most relevant to your visitors. Widgets and shortcodes are available for this plugin. You can also use our optional analytics to discover how your content is performing.

With the AddThis Related Posts WordPress plugin, you get tools such as:

= What's Next =

* Appears as users scroll down your post or page
* Customize the title
* Choose between light, gray, dark and transparent themes
* Position this tool on either the bottom left or right side of your site

= Recommended Content Footer =

* Appears on the bottom of your page
* Customize the title
* Choose between light, gray, and dark themes

This is just the start of what comes with the AddThis Related Posts WordPress plugin!

<a href="https://www.addthis.com/register">Sign up for a free AddThis account</a> on AddThis.com to access more Related Post tools and get analytics that show how your content is performing. After you register, these analytics are accessible by logging into your AddThis.com account and visiting your AddThis dashboard. Analytics include your top shared content, referring social networks, and more.

You can also <a href="https://www.addthis.com/plans">upgrade to AddThis Pro</a> for additional Related Post features, such as promoting or hiding content by choosing specific URLs from your site or others.

We also have plugins specifically available for:

* <a href="http://wordpress.org/extend/plugins/addthis/">Share Buttons</a>
* <a href="http://wordpress.org/extend/plugins/addthis-follow/">Follow Buttons</a>
* <a href="http://wordpress.org/extend/plugins/addthis-all">Website Tools: Our All-In-One WordPress plugin</a>

<em>For our Website Tools plugin, tools are configured in your AddThis account on AddThis.com.</em>

<a href="http://www.addthis.com/academy/">AddThis Academy</a> | <a href="http://www.addthis.com/privacy">Privacy Policy</a>



== Installation ==

For an automatic installation through WordPress:

1. Go to the 'Add New' plugins screen in your WordPress admin area
1. Search for 'AddThis'
1. Click 'Install Now' and activate the plugin

For a manual installation via FTP:

1. Upload the addthis folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' screen in your WordPress admin area

To upload the plugin through WordPress, instead of FTP:

1. Upload the downloaded zip file on the 'Add New' plugins screen (see the 'Upload' tab) in your WordPress admin area and activate.



== Frequently Asked Questions ==

= Is AddThis free? =

Many of our tools are free, but Pro users get the benefit of exclusive widgets, priority support and deeper analytics.

= Do I need to create an account? =

No, you do not need to create an account in order to control a limited number of AddThis related post tools from within WordPress. In order to use more AddThis tools, more options and see your site's analytics you will need to create an account with AddThis. It requires an email address and name, but that's it.

= Is JavaScript required? =

All AddThis website tools require JavaScript. JavaScript must be enabled. We load the actual interface via JavaScript at run-time, which allows us to upgrade the core functionality of the menu itself automatically everywhere whenever a new social sharing services comes out.

= Why use AddThis? =

1. Ease of use. AddThis is easy to install, customize and localize. We've worked hard to make a suite of simple and beautiful website tools on the internet.
1. Performance. The AddThis menu code is tiny and fast. We constantly optimize its behavior and design to make sharing a snap.
1. Peace of mind. AddThis gathers the best services on the internet so you don't have to, and backs them up with industrial strength analytics, code caching, active tech support and a thriving developer community.
1. Flexibility. AddThis can be customized via an API, and served securely via SSL. Share just about anything, anywhere ­­your way.
1. Global reach. AddThis sends content to 200+ sharing services 60+ languages, to over 2 billion unique users in countries all over the world.

= What PHP version is required? =

This plugin requires PHP 5.2.4 or greater and is tested on the following versions of PHP:

* 5.2.4
* 5.2.17
* 5.3.29
* 5.4.45
* 5.5.38
* 5.6.31
* 7.0.22
* 7.1.8

= Who else uses AddThis? =

Over 15,000,000 sites have installed AddThis. With over 2 billion unique users, AddThis is helping share content all over the world, in more than sixty languages.

= Are there filters? =

Yes! There are lots of filters in this plugin.

Filters allow developers to hook into this plugin's functionality in upgrade-safe ways to define very specific behavior by writing their own PHP code snippets.

Developer <a href="https://plugins.svn.wordpress.org/addthis-all/trunk/documentation.filters.md">documentation</a> on our filters is available. This documentation lists all the filters for our plugins. This plugin does not include filters for sharing tools or follow tools.

= Are there widgets? =

Yes! There are widgets available for all AddThis inline tools (the ones that don't float on the page).

If you register with an AddThis Pro account, you'll also see widgets for our Pro tools.

Developer <a href="https://plugins.svn.wordpress.org/addthis-all/trunk/documentation.widgets.md">documentation</a> on our widgets is also available. This documentation lists all the widgets for our plugins. This plugin does not include widgets for sharing tools or follow tools.

= Are there shortcodes? =

Yes! There are lots of shortcodes in this plugin. There are shortcodes are available for all AddThis inline tools (the ones that don't float on the page).

If you register with an AddThis Pro account, the shortcodes for our Pro tools will work for you, too.

See our <a href="https://plugins.svn.wordpress.org/addthis-all/trunk/documentation.shortcodes.md">documentation</a> on our shortcodes. This documentation lists all the shortcodes for our plugins. This plugin does not include shortcodes for sharing tools or follow tools.



== Changelog ==

= 2.1.1 =
* Fix for PHP notice from AddThisPlugin.php on line 610
* Changing the permission capability used for determining when users can edit AddThis settings from activate_plugins to manage_options. This will allow most admins on multi-site instances to edit settings. <a href="https://codex.wordpress.org/Roles_and_Capabilities">More information on WordPress roles and capabilities.</a>

= 2.1.0 =
* Fix for PHP notice from AddThisFeature.php line 652
* Removing line breaks from HTML added to public pages
* Not using addthis.layers() json on page when user is using their AddThis account as this creates buggy behavior
* Disabling the wp_trim_excerpt by default as it's the most likely to cause theme issues
* Adding error message if browser can't talk to addthis.com and communication with AddThis APIs are required for funtionality.
* Compatibility updates for version 6.1.0 of <a href="https://wordpress.org/plugins/addthis/">Share Buttons by AddThis</a>.
* Adding requested AddThisWidgetByDomClass functionality that will allow users adding a widget via PHP to customze the URL, title, description and image used for that share. Please see the <a href="https://plugins.svn.wordpress.org/addthis-all/trunk/documentation.widgets.md">widget documentation</a> for more infromation.

= 2.0.1 =
* Fixing shortcode bug.
* Eliminating PHP Notice on AddThisPlugin.php line 1433
* Compatibility updates for version 6.0.0 of <a href="https://wordpress.org/plugins/addthis/">Share Buttons by AddThis</a>. This plugin is no longer compatible with version before 6.0.0 of <a href="https://wordpress.org/plugins/addthis/">Share Buttons by AddThis</a>.

= 2.0.0 =
* Adding meta box to allow site editors to disable automatically added tools when editing posts and pages. Compatible with the <a href="https://wordpress.org/support/plugin/addthis">Share Button by AddThis</a> meta box. If disabled in one, auto adding of tools will be disabled in both.
* Redesigned the plugin's widgets to work with AddThis's support of multiple definitions of the same tool type. The class for the new widget is AddThisWidgetByDomClass. Widgets created through WordPress's UI will automatically be migrated to use the new class. However, any hard coded use of the old widget classes will need to be updated before upgrading. Deleted widget classes: AddThisRecommendedContentHorizontalWidget, AddThisRecommendedContentVerticalWidget. Developer <a href="https://plugins.svn.wordpress.org/addthis-all/trunk/documentation.widgets.md">documentation</a> on the new widget is available.
* Fix for PHP Warning on AddThisFollowButtonsToolParent.php line 127
* Doing profile ID validation directly in the browser rather than proxying through a WordPress backend AJAX call. This will make this plugin work in environments where the WordPress server can't talk to AddThis.com.
* Fix for PHP Warning on AddThisFollowButtonsToolParent.php line 127
* Doing profile ID validation in the browser rather than proxying through a WordPress backend AJAX call. This will make this plugin work with a profile ID for "Ignore the tool configurations in this profile" mode in environments where the WordPress server can't talk to AddThis.com.

= 1.0.0 =
If you're upgrading to this, you are super special beta user.



== Upgrade Notice ==

= 2.1.1 =
Fix for PHP notice from AddThisPlugin.php on line 610. Changing the permission capability used for determining when users can edit AddThis settings from activate_plugins to manage_options. This will allow most admins on multi-site instances to edit settings. <a href="https://codex.wordpress.org/Roles_and_Capabilities">More information on WordPress roles and capabilities.</a>

= 2.1.0 =
Fixs for PHP errors, whitespace issues, changes in default and upgraded settings. Adding requested AddThisWidgetByDomClass functionality that will allow users adding a widget via PHP to customze the URL, title, description and image used for that share.

= 2.0.1 =
Fixing shortcode bug. Eliminating PHP Notice on AddThisPlugin.php line 1433. Compatibility updates for version 6.0.0 of <a href="https://wordpress.org/plugins/addthis/">Share Buttons by AddThis</a>. This plugin is no longer compatible with version before 6.0.0 of <a href="https://wordpress.org/plugins/addthis/">Share Buttons by AddThis</a>.

= 2.0.0 =
Fix for PHP Warning on AddThisFollowButtonsToolParent.php line 127. Doing profile ID validation in the browser rather than proxying through a WordPress backend AJAX call. This will make this plugin work with a profile ID for "Ignore the tool configurations in this profile" mode in environments where the WordPress server can't talk to AddThis.com. Redesigned the plugin's widgets (including renaming classes) to work with AddThis.com's support of multiple definitions of the same tool type (see changelog for details). Adding meta box support.

= 1.0.0 =
If you're upgrading to this, you are super special beta user.

