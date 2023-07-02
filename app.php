<?php

use DevKit\Utility\Serve;
use DevKit\API;

final class DevKit {

    private static ?DevKit $instance = null;

    private function __construct() {
        // Register Services
        $controllers = $this->get_services();
        Serve::register_services( $controllers );

        // Miscellaneous
        register_activation_hook( DEVKIT_FILE, [ $this, 'activate_mu_plugins' ] );
        register_deactivation_hook( DEVKIT_FILE, [ $this, 'deactivate_mu_plugins' ] );
    }

    public static function get_instance(): DevKit {

        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function get_services() {
        return [
            API\Init::class,
        ];
    }

    public function activate_mu_plugins(): void {
        if ( ! devkit_can_use_wp_filesystem() ) {
            return;
        }

        global $wp_filesystem;

        $mu_plugin_path = WPMU_PLUGIN_DIR;

        if ( ! file_exists( $mu_plugin_path ) ) {
            wp_mkdir_p( $mu_plugin_path );
        }

        foreach( devkit_get_mu_plugins() as $mu_plugin ) {
            // Install The Plugin If Does Not Exists
            $plugin_dest_path = $mu_plugin_path . "/{$mu_plugin}/";

            if ( ! file_exists( $plugin_dest_path ) ) {
                $plugin_src_path = __DIR__ . "/mu-plugins/{$mu_plugin}/";
                
                $wp_filesystem->mkdir( $plugin_dest_path );
                copy_dir( $plugin_src_path, $plugin_dest_path );
            }

            // Install The Plugin Loader If Does Not Exists
            $loader_dest_path = $mu_plugin_path . "/{$mu_plugin}.php";

            if ( ! file_exists( $loader_dest_path ) ) {
                $loader_src_path = __DIR__ . "/mu-plugins/{$mu_plugin}.php";
                $wp_filesystem->copy( $loader_src_path, $loader_dest_path );
            }

        }
    }

    public function deactivate_mu_plugins(): void {
        if ( ! devkit_can_use_wp_filesystem() ) {
            return;
        }

        global $wp_filesystem;

        $mu_plugin_path = WPMU_PLUGIN_DIR;

        if ( ! file_exists( $mu_plugin_path ) ) {
            return;
        }

        foreach( devkit_get_mu_plugins() as $mu_plugin ) {
            $loader_dest_path = $mu_plugin_path . "/{$mu_plugin}.php";

            if ( file_exists( $loader_dest_path ) ) {
                $wp_filesystem->delete( $loader_dest_path );
            }
        }
    }
}