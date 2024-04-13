<?php
/**
 * Plugin Name: HadesBoard Price Box
 * Description: Custom Elementor addon for personalized price boxes with limitless customization options.
 * Plugin URI:  https://hadesboard.com/
 * Version:     1.0.0
 * Author:      Mohamad Gandomi
 * Author URI:  https://hadesboard.com/
 * Text Domain: hb-price-box
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define("HBPB_PDU", plugin_dir_url(__FILE__));

function hb_price_box() {

	// Load plugin file
	require_once( __DIR__ . '/includes/plugin.php' );

	// Run the plugin
	\HB_Price_Box\Plugin::instance();

}
add_action( 'plugins_loaded', 'hb_price_box' );