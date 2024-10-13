<?php

namespace Fersot;

use phpDocumentor\Reflection\DocBlockFactory;
use ReflectionClass;

class ApiDocGenerator
{
    private $docFactory;

    public function __construct()
    {
        $this->docFactory = DocBlockFactory::createInstance();
    }

    public function generateDocumentation(string $controllerClass): array
    {
        $reflectedClass = new ReflectionClass($controllerClass);
        $docBlock = $this->docFactory->create($reflectedClass->getDocComment());

        $methodsDoc = [];
        foreach ($reflectedClass->getMethods() as $method) {
            if ($method->isPublic()) {
                $methodDoc = $this->docFactory->create($method->getDocComment());
                $methodsDoc[$method->getName()] = $this->parseMethodDoc($methodDoc);
            }
        }

        return [
            'class' => $controllerClass,
            'description' => $docBlock->getSummary(),
            'methods' => $methodsDoc,
        ];
    }

    private function parseMethodDoc($docBlock)
    {
        return [
            'summary' => $docBlock->getSummary(),
            'tags' => $docBlock->getTags(),
        ];
    }
    public function generateOpenApiYaml(string $outputFile, string $controllerClass): void
    {
        $documentation = $this->generateDocumentation($controllerClass);
        
        $openApiDoc = [
            'openapi' => '3.0.0',
            'info' => [
                'title' => 'API Documentation',
                'version' => '1.0.0',
            ],
            'paths' => $this->generatePaths($documentation),
        ];

        file_put_contents($outputFile, Yaml::dump($openApiDoc, 4, 2));
        echo "OpenAPI documentation generated at: $outputFile\n";
    }

    private function generatePaths(array $documentation): array
    {
        $paths = [];

        foreach ($documentation['methods'] as $method => $doc) {
            $path = '/' . strtolower($method);
            
            $paths[$path] = [
                'get' => [
                    'summary' => $doc['summary'],
                    'responses' => [
                        '200' => [
                            'description' => 'Successful response',
                        ],
                    ],
                ],
            ];
        }

        return $paths;
    }
}