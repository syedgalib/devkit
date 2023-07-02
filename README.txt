=== DevKit ===
Contributors: syedgalibahmed
Tags: debug, debugging, php debugging, wp debugging, wordpress debugging
Requires at least: 5.2
Tested up to: 6.2.2
Stable tag: 0.1.0
Requires PHP: 7.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

A debugging tool for WordPress.

== Description ==

DevKit is a debugging tool for WordPress.

## Uses
### Add Log
```php
apply_filters( 'devkit_add_log', [ 'test' => 123 ], 'my-plugin', __FILE__, __LINE__ );
```

### Print Logs
```php
do_action( 'devkit_print_log' );
```

### Clear Logs
```php
do_action( 'devkit_clear_log' );
```

## REST API
### Get Logs
```php
$route = 'https://site.com/wp-json/devkit/logs' // GET Request
```

### Clear Logs
```php
$route = 'https://site.com/wp-json/devkit/logs' // DELETE Request
```

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin files to the `/wp-content/plugins/wp-logger` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Plugin Name screen to configure the plugin
1. (Make your instructions match the desired user flow for activating and installing your plugin. Include any steps that might be needed for explanatory purposes)


== Changelog ==
= 0.1.0 =
Initial release

