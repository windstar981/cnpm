<?php

use Illuminate\Support\Facades\Route;
use Tool\PluginInterest\Http\Controllers\PluginInterestController;


Route::get('/plugin', [PluginInterestController::class, 'index']);

