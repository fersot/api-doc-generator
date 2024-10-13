# Laravel API Documentation Generator

This Laravel package automatically generates API documentation in **OpenAPI 3.0** format (YAML or JSON) by reading and parsing PHPDoc annotations from your controllers. It also integrates a customizable **Swagger UI** for visualizing and interacting with the API documentation.

## Installation

You can install the package via Composer:

```bash
composer require fersot/api-doc-generator
```

## Usage

### API Documentation Generation

To generate OpenAPI documentation, the `generateOpenApiYaml` method can be used. This will parse the controllers' PHPDoc annotations and output an OpenAPI YAML file.

```php
use Fersot\ApiDocGenerator;

$apiDocGenerator = new ApiDocGenerator();
$apiDocGenerator->generateOpenApiYaml('path/to/output/api-docs.yaml', 'App\Http\Controllers\YourController');
```

This will generate a YAML file containing the API documentation based on your controller's annotations. The file can be used to visualize the API with tools like Swagger UI.

### Customizing Swagger UI Route

The package serves the Swagger UI interface, allowing you to view the generated OpenAPI documentation. The default route is `/swagger`, but you can change this route in the configuration file.

```php
// config/api-doc-generator.php
return [
    'swagger_ui_path' => 'api-docs', // Change the default Swagger UI path
    'output_path' => base_path('docs/api-docs.yaml'), // Path to the OpenAPI file
];
```

After modifying the configuration, you can access the Swagger UI at the new route, e.g., `http://localhost/api-docs`.

### Example

```php
use Fersot\ApiDocGenerator;

$apiDocGenerator = new ApiDocGenerator();

// Generate OpenAPI YAML documentation for specific controllers
$apiDocGenerator->generateOpenApiYaml('path/to/output/api-docs.yaml', 'App\Http\Controllers\UserController');

// Access the Swagger UI at the configured route
```

### Configuration

After installing the package, publish the configuration file to customize the output format, output path, and Swagger UI route.

```bash
php artisan vendor:publish --tag=config
```

The configuration file `api-doc-generator.php` will be published to your `config` directory. It includes the following options:

```php
return [
    'output_format' => 'yaml', // Can be 'yaml' or 'json'
    'output_path' => base_path('docs/api-docs.yaml'), // Default output path for the OpenAPI file
    'base_url' => env('APP_URL', 'http://localhost'), // Base URL for your API
    'swagger_ui_path' => 'swagger', // Route to serve Swagger UI, e.g., '/swagger'
];
```

### Requirements

- PHP >= 8.1
- Laravel >= 8.x
- Swagger UI 3.x

## Author

- **Your Name** - [youremail@example.com](mailto:youremail@example.com) ([GitHub](https://github.com/yourusername))

## Contributing

Contributions are welcome! Feel free to submit pull requests or open an issue if you find any bugs or have any suggestions for improvements.

## License

This package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support Me ☕️

Thanks for visiting my repository! If you like my work and want to support me in building more awesome projects, you can do so through [Buy Me a Coffee](https://buymeacoffee.com/yourusername).

[![Buy Me a Coffee](https://img.shields.io/badge/Buy%20Me%20a%20Coffee-FF813F?style=for-the-badge&logo=buymeacoffee&logoColor=white)](https://buymeacoffee.com/yourusername)
