<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UseController;
Route::resource('users', UseController::class)->names([
    'index' => 'Admin.Users.index',
    'create' => 'Admin.Users.create',
    'show' => 'Admin.Users.show',
    'store' => 'Admin.Users.store'
]);
//
