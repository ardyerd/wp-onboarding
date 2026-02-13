<?php
/**
 * Plugin Name: WooCommerce AI Insights
 * Description: A plugin that provides AI-powered insights for WooCommerce store owners.
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define( 'WCAI_VERSION', '1.0.0' );
define( 'WCAI_PATH', plugin_dir_path( __FILE__ ) );
define( 'WCAI_URL', plugin_dir_url( __FILE__ ) );

require_once WCAI_PATH . 'includes/class-db.php';
require_once WCAI_PATH . 'includes/class-aggregator.php';
require_once WCAI_PATH . 'includes/class-ai-service.php';
require_once WCAI_PATH . 'includes/class-admin-ui.php';

register_activation_hook( __FILE__, [ 'WCAI_DB', 'create_table' ] );

add_action( 'plugins_loaded', function() {
    new WCAI_Admin_UI();
} );