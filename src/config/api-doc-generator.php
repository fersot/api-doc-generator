<?php
return [
    'output_format' => 'yaml', 
    'output_path' => base_path('docs/api-docs.yaml'), 
    'base_url' => env('APP_URL', 'http://localhost'), 
    'swagger_ui_path' => 'swagger',
];