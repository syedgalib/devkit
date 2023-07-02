<?php

// If uninstall.php is not called by WordPress, die
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

// Include Helpers
include __DIR__ . '/utils/helper-functions.php';

class WPLoggerUninstall {

    public function __construct() {
        $this->uninstall_mu_plugins();
    }

    public function uninstall_mu_plugins(): void {
        if ( ! devkit_can_use_wp_filesystem() ) {
            return;
        }

        global $wp_filesystem;

        $mu_plugin_path = WPMU_PLUGIN_DIR;

        if ( ! file_exists( $mu_plugin_path ) ) {
            return;
        }

        foreach( devkit_get_mu_plugins() as $mu_plugin ) {
            // Delete The Plugin Loader
            $loader_path = $mu_plugin_path . "/{$mu_plugin}.php";

            if ( file_exists( $loader_path ) ) {
                $wp_filesystem->delete( $loader_path );
            }

            // Delete The Plugin
            $plugin_path = $mu_plugin_path . "/{$mu_plugin}";

            if ( file_exists( $plugin_path ) ) {
                $wp_filesystem->delete( $plugin_path, true );
            }
        }
    }
}

new WPLoggerUninstall();

