<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://trend.app
 * @since             1.0.0
 * @package           trendappend
 *
 * @wordpress-plugin
 * Plugin Name:       TREND
 * Plugin URI:        https://brands.trend.app/plugins/wordpress/
 * Description:       TREND Official WordPress Plugin
 * Version:           1.0.2
 * Author:            TrendAppend
 * Author URI:        http://trend.app/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       trendappend
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'trendappend_VERSION', '1.0.2' );
define("TRENDAPPEND_API_URL","https://api.trend.app");
define("TRENDAPPEND_EMBED_URL","https://embed.trend.app");
define("TRENDAPPEND_COMMUNITY_URL","https://trend.app");
define("TRENDAPPEND_BUSINESS_URL","https://brands.trend.app");
define("TRENDAPPEND_ADS_URL","https://sellers.trend.app");

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-trendappend-activator.php
 */
function trendappend_activate_trendappend() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-trendappend-activator.php';
	trendappend_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-trendappend-deactivator.php
 */
function trendappend_deactivate_trendappend() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-trendappend-deactivator.php';
	trendappend_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'trendappend_activate_trendappend' );
register_deactivation_hook( __FILE__, 'trendappend_deactivate_trendappend' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-trendappend.php';


function trendappend_settings_link( $links ) {
	$settings_link = '<a href="tools.php?page=trendappend">' . __( 'Settings' ) . '</a>';
	$signup_link = '<a href="'.TRENDAPPEND_COMMUNITY_URL.'/signup/">' . __( 'Free Account' ) . '</a>';
	$premium_link = '<a href="'.TRENDAPPEND_BUSINESS_URL.'/plugins/wordpress/">' . __( 'Documentation' ) . '</a>';
	$terms_link = '<a href="'.TRENDAPPEND_BUSINESS_URL.'/terms-of-use/">' . __( 'Terms of use' ) . '</a>';
	$policy_link = '<a href="'.TRENDAPPEND_BUSINESS_URL.'/privacy-policy">' . __( 'Privacy Policy' ) . '</a>';
	array_push( $links, $settings_link );
	array_push( $links, $signup_link );
	array_push( $links, $premium_link );
	array_push( $links, $terms_link );
	array_push( $links, $policy_link );
  	return $links;
}

$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'trendappend_settings_link' );
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_trendappend() {

	$plugin = new trendappend();
	$plugin->run();

}
run_trendappend();

