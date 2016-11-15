#WPPM Example Plugin
## Example Plugin demonstrating WPPM usage

This is a simple plugin that uses the hanamura/wp-post-type package to add a custom post type.
 
Including the package is simple - it's added to composer.json as a required package, along with WPPM:

```json
{
  "require": {
      "hotsource/wppm": "v0.1.1-alpha",
      "hanamura/wp-post-type":"1.1.0"
  }
}

```

Then inside the main plugin file, we call the WPPM autoloader which does all the necessary autoloading and version checking to ensure that conflicts are prevented:
```php
require_once __DIR__ . "/vendor/hotsource/wppm/wppm.php";
if ( ! WPPM::autoload( __FILE__ ) )
      return;

```


__Note: this plugin is completely unsupported and is for demonstration purposes only. It works against the 0.1.1-alpha version of WPPM which may change considerably in the future.__

### Links
https://packagist.org/packages/hotsource/wppm/