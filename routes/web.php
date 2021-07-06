<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function () {
    Route::get('/', function (){return redirect()->route('admin.dashboard');});

    Route::middleware('guest')->get('/login', function (){
        return view('admin.auth.login');
    })->name('admin.login');

    Route::middleware('guest')->get('/registration', function (){
        return view('admin.auth.register');
    })->name('admin.reg');
    
    Route::post('/login', [App\Http\Controllers\admin\authController::class, 'login'])->name('post.admin.login');
    Route::post('/logout', [App\Http\Controllers\admin\authController::class, 'logout'])->name('post.admin.logout');
    
    Route::middleware(['isAdmin','auth'])->group(function ()
    {
       Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');

       Route::prefix('posts')->group(function ()
       {
           Route::view('/', 'admin.post.list')->name('post.list');
           Route::view('/write', 'admin.post.write')->name('post.write');
           Route::get('/all',[App\Http\Controllers\PostController::class, 'all'])->name('all.post');
           Route::post('/store',[App\Http\Controllers\PostController::class, 'store'])->name('store.post');
           Route::post('/updateVisibility',[App\Http\Controllers\PostController::class, 'updateVisibility'])->name('updateVisibility.post');
           Route::get('/edit/{id}',[App\Http\Controllers\PostController::class, 'edit'])->name('edit.post');
           Route::post('/{id}',[App\Http\Controllers\PostController::class, 'update'])->name('update.post');
       });

    });

});


Route::view('/', 'welcome')->name('home');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('storage')->group(function ()
{
    Route::post('upload-handle',[App\Http\Controllers\StorageController::class, 'store'])->name('upload');
    Route::post('remove-storage-handle',[App\Http\Controllers\StorageController::class, 'destroy'])->name('destroy.file');
});

Route::resource('categories',App\Http\Controllers\CategoryController::class);
Route::view('home', 'blogs.index')->name('blogs');
Route::get('{slug}',[App\Http\Controllers\PostController::class, 'show'])->name('blog.detail');
// Route::prefix('')->group(function ()
// {
// });


Route::get('message', function ()
{
    $message['user'] = 'Rifqy';
    $message['message'] = 'test message';
    event(new App\Events\NewMessage($message));

    return "kuntilaman";
});
