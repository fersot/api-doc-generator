<?php
return [
    'output_format' => 'yaml', 
    'output_path' => storage_path('api-docs/openapi.yaml'),
    'base_url' => env('APP_URL', 'http://localhost'), 
    'swagger_ui_path' => 'swagger',
];