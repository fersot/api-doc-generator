<?php

use Illuminate\Support\Facades\Route;

Route::get(config('api-doc-generator.swagger_ui_path'), function () {
    return view('api-doc-generator::swagger');
})->name('swagger.ui');