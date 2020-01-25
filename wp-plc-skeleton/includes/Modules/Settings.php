<?php

/**
 * WP PLC Skeleton Settings
 *
 * @package   OnePlace\Skeleton\Modules
 * @copyright 2019 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch/wordpress-plugins/swissknife
 */

namespace OnePlace\Skeleton\Modules;

use OnePlace\Skeleton\Plugin;

final class Settings {
    /**
     * Main instance of the module
     *
     * @since 0.1-stable
     * @var Plugin|null
     */
    private static $instance = null;

    /**
     * Disable wordpress comments entirely
     *
     * @since 0.1-stable
     */
    public function register() {
        // Add submenu page for settings
        add_action("admin_menu", [ $this, 'addSubMenuPage' ]);

        // Register Settings
        add_action( 'admin_init', [ $this, 'registerSettings' ] );

        // Add Plugin Languages
        add_action('plugins_loaded', [ $this, 'loadTextDomain' ] );
    }

    /**
     * load text domain (translations)
     *
     * @since 1.0.0
     */
    public function loadTextDomain() {
        load_plugin_textdomain( 'wp-plc-skeleton', false, dirname( plugin_basename(WPPLC_SKELETON_MAIN_FILE) ) . '/language/' );
    }

    /**
     * Register Plugin Settings in Wordpress
     *
     * @since 1.0.0
     */
    public function registerSettings() {
        // Core Settings

        // Sub Module Handling
        register_setting( 'wpplc_skeleton', 'plcskeleton_elementor_active', false );
    }

    /**
     * Add Submenu Page to OnePlace Settings Menu
     *
     * @since 1.0.0
     */
    public function addSubMenuPage() {
        $page_title = 'OnePlace Skeleton';
        $menu_title = 'Skeleton';
        $capability = 'manage_options';
        $menu_slug  = 'oneplace-connect';
        $function   = [$this,'AdminMenu'];
        $icon_url   = 'dashicons-media-code';
        $position   = 5;

        add_submenu_page( $menu_slug, 'OnePlace Connect', 'OnePlace Connect',
            'manage_options', $menu_slug );

        add_submenu_page( $menu_slug, $page_title, $menu_title,
            'manage_options', 'oneplace-shop',  [$this,'renderSettingsPage'] );
    }

    /**
     * Render Settings Page for Plugin
     *
     * @since 1.0.0
     */
    public function renderSettingsPage() {
        require_once __DIR__.'/../view/settings.php';
    }

    /**
     * Loads the module main instance and initializes it.
     *
     * @since 0.1-stable
     *
     * @return bool True if the plugin main instance could be loaded, false otherwise.
     */
    public static function load() {
        if ( null !== static::$instance ) {
            return false;
        }
        static::$instance = new self();
        static::$instance->register();
        return true;
    }
}