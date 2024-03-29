<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResources([
    'litigation' => LitigationController::class,
    'categories' => CategoryController::class,
    'settings'   => SettingController::class,
    'messages'   => MessageController::class,
    'reviews'    => ReviewController::class,
    'lawyers'    => LawyerController::class,
    'slides'     => SlideController::class,
    'blog'       => BlogController::class,
]);

Route::get('/relatedPosts/{blog}', [BlogController::class, 'related']);
Route::get('/dashboard', [SettingController::class, 'dashboard']);