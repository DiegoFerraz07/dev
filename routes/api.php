<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsersController;
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

Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
}); 
 
Route::prefix('users')->middleware('jwt.auth')->group(function () {
    // List users
    Route::get('/', [UsersController::class, 'index']);

    // List single users
    Route::get('/{id}', [UsersController::class, 'find']);

    // Create new users
    Route::post('/', [UsersController::class, 'store']);

    // Update users
    Route::put('/{id}', [UsersController::class, 'update'])->name('api.users.update');

    // Delete users
    Route::delete('/{id}', [UsersController::class, 'delete']);

    //Follow users
    Route::post('/follow', [UsersController::class,'follow']);
});

Route::prefix('posts')->middleware('jwt.auth')->group(function (){
    // List all posts
    Route::get('/', [PostController::class, 'index'])->name('api.posts.index');
    
    Route::delete('/delete{id}', [PostController::class, 'delete'])->name('api.posts.delete');
    
    Route::get('/add', [PostController::class, 'add'])->name('api.posts.add');

    // Create new post
    Route::post('/store', [PostController::class, 'store'])->name('api.posts.store');

    Route::get('/edit', [PostController::class, 'edit'])->name('api.posts.edit');

    // Update post
    Route::put('/update', [PostController::class, 'update'])->name('api.posts.update'); 
});

//rigistration
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

//login
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

//search user
Route::post('/me', [AuthController::class, 'me'])->name('auth.me');

//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


