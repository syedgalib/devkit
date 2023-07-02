<?php

/**
 * DevKit - Logger
 * 
 * Plugin Name: DevKit - Logger
 * Description: A PHP debugging tool for WordPress.
 */

$path = __DIR__ . '/devkit-logger/devkit-logger.php';

if ( file_exists( $path ) ) {
    include_once $path;
}