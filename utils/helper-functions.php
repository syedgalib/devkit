<?php

function devkit_can_use_wp_filesystem() {
    if ( ! function_exists( 'WP_Filesystem' ) ) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
    }

    return WP_Filesystem() ? true : false;
}

function devkit_get_mu_plugins(): array {
    return [
        'devkit-logger',
    ];
}