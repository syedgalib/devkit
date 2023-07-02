<?php

final class DevKitLogger {

    private static ?DevKitLogger $instance = null;
    private string $date_format = 'Y-m-d h:i:s A';

    private function __construct() {
        $this->init();
    }

    public static function get_instance(): DevKitLogger {

        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function init() {
        add_filter( 'devkit_add_log', [ $this, 'logger_add'], 10, 4 );
        add_action( 'devkit_print_log', [ $this, 'logger_print'], 10, 1 );
        add_action( 'devkit_clear_log', [ $this, 'logger_clear'], 10, 1 );
    }

    public function logger_add( $data = [], $namespace = null, $file = null, $line = null ) {
        $logger_file_path = $this->get_logger_file_path();
        $logs             = $this->get_logger_data( $logger_file_path );

        if ( ! empty( $data ) ) {
            $date = new DateTime( 'now' );

            $logs[] = [
                'data'      => $data,
                'namespace' => $namespace,
                'file'      => $file,
                'line'      => $line,
                'time'      => $date->format( $this->date_format )
            ];

            file_put_contents( $logger_file_path, json_encode( $logs ) );
        }
    
        return $logs;
    }

    public function logger_print() {
        $logger_file_path = $this->get_logger_file_path();

        echo '<pre>';
        print_r( $this->get_logger_data( $logger_file_path ) );
        echo '</pre>';
    }

    public function logger_clear() {
        $logger_file_path = $this->get_logger_file_path();
        file_put_contents( $logger_file_path, '[]' );
    }

    private function get_logger_data( $logger_file_path ) {
        $contents = file_get_contents( $logger_file_path );
        $data     = json_decode( $contents, true );
        return is_array( $data ) ? $data : [];
    }

    private function get_logger_file_path() {
        return dirname( __FILE__ ) . '/logs.json';
    }

}

if ( ! function_exists( 'DevKitLogger' ) ) {
    function DevKitLogger(): DevKitLogger {
        return DevKitLogger::get_instance();
    }
}

DevKitLogger();