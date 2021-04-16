# WP Customize Nonce
A WordPress plugin which allows you to customize the nonce generation and validation, sticking close to the original structure defined 
in the core.

This plugin replaces the pluggable functions `wp_create_nonce` and `wp_verify_nonce`, and it is completely configurable 
by defining constants. Read more for details.

## Requirements
- __PHP__: >= 7.1;
- __WP__: >= 4.0.0

## Installation
Right now it is not available in the official WP plugins repository.
At the current stage the preferred method to install this plugin is __via [Composer](https://getcomposer.org/)__:
```
composer require riccardooliva91/wp-customize-nonce
```
If you are using some WP boilerplate (such as [Bedrock](https://roots.io/bedrock/)) you should launch this command in 
your root folder, and the autoloader will do the rest. In case you are cloning this repository manually instead, be sure  
to make Composer generate the autoloader for you in the plugin's folder:
```
cd wordpress-customize-nonce
composer install --no-dev
```

## Configuration
This plugin's functionalities are entirely managed by defining constants.

The two main "chunks" of the nonces you'll get to customize are the __UID__ and the __session token__, both of which have
their own sets of constants. The preferred location to define them is the `wp-config.php` file.

### Generation strategy
The `WCN_UID_METHOD` and `WCN_TOKEN_METHOD` define the generation strategy for both the UID and the session token:

```php
define( 'WCN_UID_METHOD', 'default' );
define( 'WCN_TOKEN_METHOD', 'default' );
```
Please note that __the UID and token generation strategies__ are not tied together, they can of course be generated and 
validated with different strategies.

There are different possible values, some of them require the definition of an additional constant:
- `default`: default WP behaviour;
- `ip`: uses the `HTTP_X_REAL_IP` value in the `$_SERVER` global;
- `none`: skips this chunk in both the nonce generation and validation;
- `url_param`: uses a __GET__ parameter of your choice for both the generation and validation.
    - If you choose this approach, be sure to define the `WCN_UID_URL_PARAMETER_NAME` or `WCN_TOKEN_URL_PARAMETER_NAME` based on your needs:
    ```php
    define( 'WCN_UID_URL_PARAMETER_NAME', 'param_name' );
    define( 'WCN_TOKEN_URL_PARAMETER_NAME', 'param_name' );
    ```
- `cookie`: uses a cookie value for both the generation and validation.
    - If you choose this approach, be sure to define the `WCN_UID_COOKIE_NAME` or `WCN_TOKEN_COOKIE_NAME` based on your needs:
    ```php
    define( 'WCN_UID_COOKIE_NAME', 'cookie_name' );
    define( 'WCN_TOKEN_COOKIE_NAME', 'cookie_name' );
    ```
- `fixed`: uses a fixed value of your choice.
    - If you choose this approach, be sure to define the `WCN_UID` or `WCN_TOKEN` based on your needs:
    ```php
    define( 'WCN_UID', 'my_value' );
    define( 'WCN_TOKEN', 'my_value' );
    ```
    Setting those constant as `null` will have the same result as the `none` approach.

### Optional customizations
There is a set of constants which you can define if you want to dig deep into the customization process. 
None of this is mandatory.

### Validate older nonces
By default, WordPress validates nonces up to 24 hours (customizable as stated [in the Codex](https://codex.wordpress.org/WordPress_Nonces)).
If a nonce is up to 12 hours old, `wp_verify_nonce` will return `1`, and it will return `2` if the nonce is between 
12 and 24 hours old.
If you wish so, you can disable the validation of nonces ot "type `2`" by defining the following constant:
```php
define( 'WCN_VALIDATE_OLD_NONCES', false );
```

### Change the nonce schema
By default, WordPress hashes the string that will be used as nonce with the `NONCE_KEY` defined in `wp-config.php`. 
If you defined one your own, or for some reason you want to use another one, you can do so by defining:
```php 
define( 'WCN_NONCE_SCHEMA', 'your_schema_name' );
```
Please note that the schema name shoult be just that (e.g. `auth`) and the `_KEY` or `_SCHEMA` suffixes are not needed, 
as WP will fill them itself. Again, it is mandatory that the salt is __defined alongside the others in `wp-config.php`__. 

### Nonce length
By default, WordPress trims the generated string:
```php
substr( wp_hash( $i . '|' . $action . '|' . $uid . '|' . $token, 'nonce' ), -12, 10 ); // note substr() offset and length
```
You can customize that like this:
```php 
define( 'WCN_NONCE_OFFSET', 0 ); // Default: -12
define( 'WCN_NONCE_LENGTH', 20 ); // Default: 10
```