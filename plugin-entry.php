<?php
/**
 * Plugin Name: Bigup Web: Social
 * Plugin URI: https://jeffersonreal.com
 * Description: A simple social media widget.
 * Version: 0.13
 * Author: Jefferson Real
 * Author URI: https://jeffersonreal.com
 * License: GPL2
 *
 * @package bigup_social
 * @author Jefferson Real <me@jeffersonreal.com>
 * @copyright Copyright (c) 2021, Jefferson Real
 * @license GPL2+
 * @link https://jeffersonreal.com
 */


/**
 * Init the wallOMatic (enqueue the wallOMatic scripts and styles)
 */
function bigup_social_scripts_and_styles() {
    wp_register_style( 'bigup_social_widget_css', plugins_url ( 'css/widget.css', __FILE__ ), array(), '0.1', 'all' );
}
add_action( 'wp_enqueue_scripts', 'bigup_social_scripts_and_styles' );

/**
* Init the widget
*/
include( plugin_dir_path( __FILE__ ) . 'parts/widget.php');
