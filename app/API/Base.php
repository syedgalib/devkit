<?php

namespace DevKit\API;

use WP_REST_Controller;
use WP_Error;

abstract class Base extends WP_REST_Controller {

    public function __construct() {
        $this->namespace = DEVKIT_SLUG;
        add_action( 'rest_api_init', [ $this, 'register_routes' ] );
    }

    public function check_admin_permission() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return $this->error_admin_check_failed();
        }

        return true;
    }

    public function error_admin_check_failed() {
        return new WP_Error(
            'admin_check_failed',
            __( 'You are not allowed to perform this operation.', 'debug-kit' ),
            [ 'status' => rest_authorization_required_code() ]
        );
    }

}