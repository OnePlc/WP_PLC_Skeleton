<?php

/**
 * WP PLC Skeleton Single View
 *
 * @package   OnePlace\Skeleton\Modules
 * @copyright 2020 Verein onePlace
 * @license   https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html GNU General Public License, version 2
 * @link      https://1plc.ch/wordpress-plugins/swissknife
 */

namespace OnePlace\Skeleton\Modules;

use OnePlace\Skeleton\Plugin;

final class Singleview {
    /**
     * Main instance of the module
     *
     * @since 1.0.0
     * @var Plugin|null
     */
    private static $instance = null;

    /**
     * Disable wordpress comments entirely
     *
     * @since 1.0.0
     */
    public function register() {
        # Register Settings
        add_action( 'admin_init', [ $this, 'registerSettings' ] );

        # Enable Custom Rewrite if set
        if(get_option('plcskeleton_singleview_rewrite_active') == 1) {
            add_action('init', [$this,'enableCustomRewriteRule'], 10, 0);
        }
    }

    /**
     * Register Plugin Settings in Wordpress
     *
     * @since 1.0.0
     */
    public function registerSettings() {
        // Sub Module Handling
        register_setting( 'wpplc_skeleton_singleview', 'plcskeleton_singleview_slug', 'skeleton' );
        register_setting( 'wpplc_skeleton_singleview', 'plcskeleton_singleview_rewrite_active', false );
    }

    /**
     * Enable Rewrite Rule for Single View
     *
     * @since 1.0.0
     */
    public function enableCustomRewriteRule() {
        # Only enable if slug is set
        if(get_option('plcskeleton_singleview_slug')) {
            // Article Category
            add_rewrite_tag('%skeleton_id%', '([^&]+)');

            $sSingleViewSlug = get_option('plcskeleton_singleview_slug');
            $iBasePageID = get_option('plcskeleton_singleview_base_page');

            // Article Category
            add_rewrite_rule('^'.$sSingleViewSlug.'/([^/]*)/?', 'index.php?page_id=' . $iBasePageID . '&skeleton_id=$matches[1]', 'top');
        }
    }

    /**
     * Loads the module main instance and initializes it.
     *
     * @return bool True if the plugin main instance could be loaded, false otherwise.
     * @since 1.0.0
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