<?php

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\DeadLineController;
use App\Http\Controllers\Admin\EducationLevelController;
use App\Http\Controllers\Admin\NoWordsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaperTypeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SubjectController;

use App\Http\Controllers\Admin\ReferenceStyleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/about', function () {
    return view('about');
})->name('about.show');
Route::get('/contact', function () {
    return view('contact');
})->name('contact.show');
Route::get('/blog', [App\Http\Controllers\HomeController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}',[App\Http\Controllers\HomeController::class, 'blogshow'])->name('blog.show');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('order-submit', [App\Http\Controllers\UserOrderController::class, 'store'])->name('order-submit');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=>['auth']], function (){
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
   



    Route::resource('dead_lines', DeadLineController::class);
    Route::resource('educations', EducationLevelController::class);
    Route::resource('no_words', NoWordsController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('posts', PostController::class);
    Route::resource('paper_types', PaperTypeController::class);
    Route::resource('reference_styles', ReferenceStyleController::class);
    Route::resource('subjects', SubjectController::class);

    // Route::get('settings','SettingsController@index')->name('settings');
    // Route::put('profile-update','SettingsController@updateProfile')->name('profile.update');
    // Route::put('password-update','SettingsController@updatePassword')->name('password.update');

    // Route::resource('tag','TagController');
    // Route::resource('category','CategoryController');
    // Route::resource('post','PostController');

    // Route::get('/pending/post','PostController@pending')->name('post.pending');
    // Route::put('/post/{id}/approve','PostController@approval')->name('post.approve');

    // Route::get('/favorite','FavoriteController@index')->name('favorite.index');

    // Route::get('authors','AuthorController@index')->name('author.index');
    // Route::delete('authors/{id}','AuthorController@destroy')->name('author.destroy');

    // Route::get('comments','CommentController@index')->name('comment.index');
    // Route::delete('comments/{id}','CommentController@destroy')->name('comment.destroy');

    // Route::get('/subscriber','SubscriberController@index')->name('subscriber.index');
    // Route::delete('/subscriber/{subscriber}','SubscriberController@destroy')->name('subscriber.destroy');
});

