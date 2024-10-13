<?php

namespace Fersot\ApiDocGenerator\Console\Commands;

use Illuminate\Console\Command;
use Fersot\ApiDocGenerator\ApiDocGenerator;

class GenerateApiDoc extends Command
{
    protected $signature = 'doc:generate {controller?}';
    protected $description = 'Generate API documentation in OpenAPI format.';

    public function handle()
    {
        $controller = $this->argument('controller');
        $outputPath = config('api-doc-generator.output_path');

        $this->info("Output Path: {$outputPath}"); // Agrega esta línea para depuración

        $apiDocGenerator = new ApiDocGenerator();

        if ($controller) {
            // Generar documentación para un controlador específico
            $this->info("Generating API documentation for controller: {$controller}");
            $apiDocGenerator->generateOpenApiYaml($outputPath, $controller);
            $this->info("API documentation generated at: {$outputPath}");
        } else {
            // Generar documentación para todos los controladores
            $this->info("Generating API documentation for all controllers...");

            // Obtener todos los controladores
            $controllers = $this->getAllControllers();

            foreach ($controllers as $controllerClass) {
                $apiDocGenerator->generateOpenApiYaml($outputPath, $controllerClass);
            }

            $this->info("API documentation generated at: {$outputPath}");
        }
    }

    private function getAllControllers()
    {
        $controllerNamespace = 'App\Http\Controllers';
        $controllers = [];

        foreach (glob(app_path('Http/Controllers/*.php')) as $file) {
            $filename = basename($file, '.php');
            $fullClassName = $controllerNamespace . '\\' . $filename;

            if (class_exists($fullClassName)) {
                $controllers[] = $fullClassName;
            }
        }

        return $controllers;
    }
}
