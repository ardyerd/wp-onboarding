<?php
/**
 * Plugin Name: WriteFlow
 * Description: A plugin to enhance the writing experience in WordPress.
 * Version: 1.0
 * Author: Ardy - MadeIndonesia
 */

require_once plugin_dir_path( __FILE__ ) . 'includes/settings.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/rest-api.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function writeflow_register_meta() {
    register_post_meta( 'post', '_writeflow_outline', [
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
    ] );

    register_post_meta('post', '_writeflow_idea', [
        'type' => 'string',
        'single' => true,
        'show_in_rest' => true,
    ]);
}
add_action( 'init', 'writeflow_register_meta' );

function writeflow_enqueue_assets() {
    wp_enqueue_script( 
        'writeflow-editor', 
        plugins_url('build/index.js', __FILE__), 
        ['wp-plugins', 'wp-editor', 'wp-element', 'wp-components', 'wp-data'],
        filemtime( plugin_dir_path( __FILE__ ) . 'build/index.js' ) 
    );
}
add_action( 'enqueue_block_editor_assets', 'writeflow_enqueue_assets' );
