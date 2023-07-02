<?php

namespace DevKit\API;

use WP_REST_Request;
use WP_REST_Server;

class Logger extends Base {

    protected $rest_base = 'logs';

    public function register_routes() {
        register_rest_route(
            $this->namespace, 
            '/' . $this->rest_base,
            [
                [
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => [ $this, 'get_items' ],
                    'permission_callback' => [ $this, 'check_admin_permission' ],
                ],
                [
                    'methods'             => WP_REST_Server::DELETABLE,
                    'callback'            => [ $this, 'delete_items' ],
                    'permission_callback' => [ $this, 'check_admin_permission' ],
                ],
            ],
        );
    }

    /**
	 * Retrieves a collection of items.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
    public function get_items( $request ) {
        return rest_ensure_response( apply_filters( 'devkit_add_log', null ) );
    }

    /**
	 * Deletes a collection of items.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
	 */
    public function delete_items( $request ) {

        do_action( 'devkit_clear_log' );

        return rest_ensure_response( apply_filters( 'devkit_add_log', null ) );
    }
}