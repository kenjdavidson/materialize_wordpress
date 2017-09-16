<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.kenjdavidson.com/web/materialize-wordpress
 * @since             1..0.0
 * @package           MaterializeWordpress
 *
 * @wordpress-plugin
 * Plugin Name:       Materialize Wordpress
 * Plugin URI:        http://www.kenjdavidson.com/web/materialize-wordpress
 * Description:       Add Materialize CSS/JS framework to Wordpress 
 * Version:           1.0.0
 * Author:            Ken Davidson
 * Author URI:        http://kenjdavidson.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mcssw
 * Domain Path:       /languages
 */

// If this file isn't caled through the Wordpress framework, then the page
// should not be loaded
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Import the MaterializeWordpress class
require plugin_dir_path(__FILE__) . 'MaterializeWordpress.php';

// Register activation and deactivation hooks
register_activation_hook( __FILE__, array('MaterializeWordpress','activate' ) );
register_deactivation_hook( __FILE__, array('MaterializeWordpress','deactivate') );

// Instantiate the MaterializeWordpress class
$materializeWordpress = new MaterializeWordpress();