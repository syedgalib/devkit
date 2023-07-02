<?php

namespace DevKit\Utility;

class Serve {

    /**
     * Register Services
     *
     * @param array $services Services
     * @return void
     */
    public static function register_services( array $services = [] ) {

        foreach( $services as $service ) {

            if ( ! class_exists( $service ) ) {
                continue;
            }

            new $service();

        }

    }

}