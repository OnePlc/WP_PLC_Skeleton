<?php
/**
 * Plugin main file.
 *
 * @package   OnePlace\Skeleton
 * @copyright 2019 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch
 *
 * @wordpress-plugin
 * Plugin Name: WP PLC Skeleton
 * Plugin URI:  https://1plc.ch/wordpress-plugins/skeleton
 * Description: onePlace Skeleton for Wordpress. Widgets and Shortcodes for onePlace Skeletons
 * Version:     1.0.0
 * Author:      Verein onePlace
 * Author URI:  https://1plc.ch
 * License:     GNU General Public License, version 2
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * Text Domain: wp-plc-skeleton
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define Version and directories for further use in plugin
define( 'WPPLC_SKELETON_VERSION', '1.0.1' );
define( 'WPPLC_SKELETON_MAIN_FILE', __FILE__ );
define( 'WPPLC_SKELETON_MAIN_DIR', __DIR__ );
define( 'WPPLC_SKELETON_PUB_DIR','/wp-content/plugins/wp-plc-skeleton');

/**
 * Handles plugin activation.
 *
 * Throws an error if the plugin is activated on an older version than PHP 5.4.
 *
 * @access private
 *
 * @param bool $network_wide Whether to activate network-wide.
 */
function wpplc_skeleton_activate_plugin( $network_wide ) {
    // check php version
    if ( version_compare( PHP_VERSION, '5.4.0', '<' ) ) {
        // show error if version is below 5.4
        wp_die(
            esc_html__( 'WP PLC Skeleton requires PHP version 5.4.', 'wp-plc-skeleton' ),
            esc_html__( 'Error Activating', 'wp-plc-skeleton' )
        );
    }

    // check if oneplace connect is already loaded
    if ( ! defined('WPPLC_CONNECT_VERSION') ) {
        // show error if version cannot be determined
        wp_die(
            esc_html__( 'WP PLC Skeleton requires WP PLC Connect', 'wp-plc-skeleton' ),
            esc_html__( 'Error Activating', 'wp-plc-skeleton' )
        );
    }

    // we currently support multisite - so we just activate on network wide
}
register_activation_hook( __FILE__, 'wpplc_skeleton_activate_plugin' );

/**
 * Handles plugin deactivation.
 *
 * @access private
 *
 * @param bool $network_wide Whether to deactivate network-wide.
 */
function wpplc_skeleton_deactivate_plugin( $network_wide ) {
    if ( version_compare( PHP_VERSION, '5.4.0', '<' ) ) {
        return;
    }

    // deactivation network wide is the same for now
}
register_deactivation_hook( __FILE__, 'wpplc_skeleton_deactivate_plugin' );

// make sure php version is up2date
if ( version_compare( PHP_VERSION, '5.4.0', '>=' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'includes/loader.php';
}