<?php

/**
  *
 * @link              http://mimo.studio
 * @since             1.0.0
 * @package           Mimo_Social
 *
 * @wordpress-plugin
 * Plugin Name:       Mimo Social
 * Plugin URI:        http://mimo.studio
 * Description:       Create custom share bar with your favorite social networks.
 * Version:           1.2.0
 * Author:            mimothemes
 * Author URI:        http://mimo.studio
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mimo-social
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mimo-social-activator.php
 */
function activate_mimo_social() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mimo-social-activator.php';
	Mimo_Social_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mimo-social-deactivator.php
 */
function deactivate_mimo_social() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mimo-social-deactivator.php';
	Mimo_Social_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mimo_social' );
register_deactivation_hook( __FILE__, 'deactivate_mimo_social' );
add_filter( 'the_content', 'mimo_social_filter_the_content' , 10 );

function mimo_social_filter_the_content( $content ) {
	$general_settings = get_option( 'mimo_social_settings' );
	
	$mimo_social_settings_where = isset($general_settings['mimo_social_where']) ? $general_settings['mimo_social_where'] : NULL;
	$top_content = '';
	$custom_content = $content;
	$bottom_content = '';

	if(is_single() && $mimo_social_settings_where && in_array('top', $mimo_social_settings_where ) == true  ) {
    $top_content = '[mimo_social class="mimo-social-top"]';
    
    
	}

	if(is_single() && $mimo_social_settings_where && in_array('bottom', $mimo_social_settings_where ) == true ) {
    
    $bottom_content = '[mimo_social class="mimo-social-bottom"]';
    
	}

	$all_content = $top_content;
	$all_content .= $custom_content;
	$all_content .= $bottom_content;

	return $all_content;
}
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mimo-social.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mimo_social() {

	$plugin = new Mimo_Social();
	$plugin->run();

}
run_mimo_social();
