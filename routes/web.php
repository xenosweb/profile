<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\AdminController;
use App\Http\Controller\ContactController;
use App\Http\Controller\HomeController;
use App\Http\Controller\PortfolioController;
use App\Http\Controller\PostController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about-us', function() {
    return view('about-us');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    // BEM naming

    // Contact page admin
    Route::prefix('admin/contact')->group(function(){
        Route::get('/all', [ContactController::class, 'contactView'])->name('contact.all');
        Route::post('/save', [ContactController::class, 'contactSave'])->name('contact.save');
        Route::get('/edit/{id}', [ContactController::class, 'contactEdit'])->name('contact.edit');
        Route::post('/update', [ContactController::class, 'contactUpdate'])->name('contact.update');
        Route::get('/delete/{id}', [ContactController::class, 'contactDelete'])->name('contact.delete');
    });

    // Message from Contact Page
    Route::prefix('admin/message')->group(function(){
        Route::get('/all', [ContactController::class, 'messageView'])->name('message.all');
    });

    // Portfolio admin
    Route::prefix('admin/portfolio')->group(function(){
        Route::get('/all', [PortfolioController::class, 'portfolioView'])->name('portfolio.all');
        Route::post('/save', [PortfolioController::class, 'portfolioSave'])->name('portfolio.save');
        Route::get('/edit/{id}', [PortfolioController::class, 'portfolioEdit'])->name('portfolio.edit');
        Route::post('/update', [PortfolioController::class, 'portfolioUpdate'])->name('portfolio.update');
        Route::get('/delete/{id}', [PortfolioController::class, 'portfolioDelete'])->name('portfolio.delete');
    });
    
    // Post admin
    Route::prefix('admin/post')->group(function(){
        Route::get('/all', [PostController::class, 'postView'])->name('post.all');
        Route::post('/save', [PostController::class, 'postSave'])->name('post.save');
        Route::get('/edit/{id}', [PostController::class, 'postEdit'])->name('post.edit');
        Route::post('/update', [PostController::class, 'postUpdate'])->name('post.update');
        Route::get('/delete/{id}', [PostController::class, 'postDelete'])->name('post.delete');
    }); 
    
    // Post admin
    Route::prefix('admin/category')->group(function(){
        Route::get('/all', [PostController::class, 'categoryView'])->name('category.all');
        Route::post('/save', [PostController::class, 'categorySave'])->name('category.save');
        Route::get('/edit/{id}', [PostController::class, 'categoryEdit'])->name('category.edit');
        Route::post('/update', [PostController::class, 'categoryUpdate'])->name('category.update');
        Route::get('/delete/{id}', [PostController::class, 'categoryDelete'])->name('category.delete');
    });
});
