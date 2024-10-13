<?php

namespace Fersot\Console\Commands;

use Illuminate\Console\Command;
use ApiDocGenerator\ApiDocGenerator;

class GenerateApiDoc extends Command
{
    protected $signature = 'doc:generate {controller?}';
    protected $description = 'Generate API documentation in OpenAPI format.';

    public function handle()
    {
        $controller = $this->argument('controller');
        $outputPath = config('api-doc-generator.output_path');

        if ($controller) {
            $this->info("Generating API documentation for controller: {$controller}");
            $apiDocGenerator = new ApiDocGenerator();
            $apiDocGenerator->generateOpenApiYaml($outputPath, $controller);
            $this->info("API documentation generated at: {$outputPath}");
        } else {
            $this->info("Generating API documentation for all controllers...");
            $apiDocGenerator = new ApiDocGenerator();
            $apiDocGenerator->generateOpenApiYaml($outputPath, 'App\Http\Controllers');
            $this->info("API documentation generated at: {$outputPath}");
        }
    }
}