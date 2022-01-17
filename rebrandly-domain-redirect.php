<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://rebrandly.com
 * @since             1.0.0
 * @package           Rebrandly_Domain_Redirect
 *
 * @wordpress-plugin
 * Plugin Name:       Rebrandly Domain Redirect
 * Plugin URI:        https://github.com/rebrandly/wordpress-plugin-rebrandly-redirect
 * Description:       Connect your WordPress application with Rebrandly and create branded links re-using the same domain name
 * Version:           1.0.0
 * Author:            Rebrandly
 * Author URI:        https://rebrandly.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       rebrandly-domain-redirect
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
define( 'REBRANDLY_DOMAIN_REDIRECT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rebrandly-domain-redirect-activator.php
 */
function activate_rebrandly_domain_redirect() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rebrandly-domain-redirect-activator.php';
	Rebrandly_Domain_Redirect_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rebrandly-domain-redirect-deactivator.php
 */
function deactivate_rebrandly_domain_redirect() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rebrandly-domain-redirect-deactivator.php';
	Rebrandly_Domain_Redirect_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rebrandly_domain_redirect' );
register_deactivation_hook( __FILE__, 'deactivate_rebrandly_domain_redirect' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rebrandly-domain-redirect.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rebrandly_domain_redirect() {

	$plugin = new Rebrandly_Domain_Redirect();
	$plugin->run();

}
run_rebrandly_domain_redirect();
