<?php
/**
 * Plugin Name: Gallery Ticker
 * Version: 1.0
 * Plugin URI: https://www.csilverman.com/
 * Description: This applies Flickity to WordPress galleries, and also adds a LazyBlocks-based text ticker. It requires the LazyBlocks plugin to function.
 * Author: Chris Silverman
 * Author URI: https://www.csilverman.com/
 * Requires at least: 4.0
 * Tested up to: 4.0
 *
 * @package WordPress
 * @author Chris Silverman
 * @since 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//	https://wordpress.stackexchange.com/questions/127818/how-to-make-a-plugin-require-another-plugin
add_action( 'admin_init', 'child_plugin_has_parent_plugin' );
function child_plugin_has_parent_plugin() {
    if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'lazy-blocks/lazy-blocks.php' ) ) {
        add_action( 'admin_notices', 'ticker_plugin_notice' );

        deactivate_plugins( plugin_basename( __FILE__ ) );

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }
}

function ticker_plugin_notice(){
    ?><div class="error"><p>⚠️ Text Ticker requires the Lazy Blocks plugin to function. Please install and activate Lazy Blocks before activating Text Ticker.</p></div><?php
}

add_action( 'wp_enqueue_scripts', 'my_plugin_assets' );
function my_plugin_assets() {
    wp_register_style( 'flickity', plugins_url( '/flickity/flickity.min.css' , __FILE__ ) );
    wp_register_script( 'flickity', plugins_url( '/flickity/flickity.pkgd.min.js' , __FILE__ ), array( 'jquery' ) );

		wp_register_style( 'flickity-fade', plugins_url( '/flickity/flickity-fade.css' , __FILE__ ) );
    wp_register_script( 'flickity-fade', plugins_url( '/flickity/flickity-fade.js' , __FILE__ ), array( 'jquery' ) );

		wp_register_style( 'text-ticker', plugins_url( '/css/text-ticker.css' , __FILE__ ) );
		wp_register_script( 'text-ticker', plugins_url( '/js/text-ticker.js' , __FILE__ ), array( 'jquery' ) );

    wp_enqueue_style( 'flickity' );
    wp_enqueue_script( 'flickity' );

		wp_enqueue_style( 'text-ticker' );
    wp_enqueue_script( 'text-ticker' );

		wp_enqueue_style( 'flickity-fade' );
    wp_enqueue_script( 'flickity-fade' );

}
