# DevKit Kit
DevKit is a debugging tool for WordPress.

## Examples

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
