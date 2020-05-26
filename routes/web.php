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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::prefix("admin")->middleware('auth')->group(function () {

    Route::get('/home', 'Backend\HomeGetController@index')->name("index");
    Route::get('/files', 'Backend\Files\FileManagementController@getFiles')->name("files");
    Route::get('/logout', 'Backend\HomeGetController@getLogout')->name("backend-logout");


    Route::prefix("blogs")->middleware('Blog')->group(function () {
        Route::get('/', 'Backend\Blogs\BlogController@getBlogs')->name("blogs");
        Route::get('/blog-add', 'Backend\Blogs\BlogController@getBlogsAdd')->name("blog-add");
        Route::get('/blog-edit/{blogId}', 'Backend\Blogs\BlogController@getBlogsEdit')->name("blog-edit");
        Route::get('/blog-category', 'Backend\Blogs\BlogController@getBlogsCategory')->name("blog-category");
        Route::get('/blog-category-add', 'Backend\Blogs\BlogController@getBlogsCategoryAdd')->name("blog-category-add");
        Route::get('/blog-category-edit/{categoryId}', 'Backend\Blogs\BlogController@getBlogsCategoryEdit')->name("blog-category-edit");

        Route::post('/', 'Backend\Blogs\BlogController@postBlogs')->name("blogs");
        Route::post('/blog-add', 'Backend\Blogs\BlogController@postBlogsAdd')->name("blog-add");
        Route::post('/blog-edit/{blogId}', 'Backend\Blogs\BlogController@postBlogsEdit')->name("blog-edit");
        Route::post('/blog-category', 'Backend\Blogs\BlogController@postBlogsCategory')->name("blog-category");
        Route::post('/blog-category-add', 'Backend\Blogs\BlogController@postBlogsCategoryAdd')->name("blog-category-add");
        Route::post('/blog-category-edit/{categoryId}', 'Backend\Blogs\BlogController@postBlogsCategoryEdit')->name("blog-category-edit");
    });

    Route::prefix("menus")->middleware('Admin')->group(function () {
        Route::get('/', 'Backend\Menus\MenusController@getMenus')->name("menus");
        Route::get('/menu-add', 'Backend\Menus\MenusController@getMenusAdd')->name("menu-add");
        Route::get('/menu-edit/{menuId}', 'Backend\Menus\MenusController@getMenusEdit')->name("menu-edit");
        Route::post('/', 'Backend\Menus\MenusController@postMenus')->name("menus");
        Route::post('/menu-add', 'Backend\Menus\MenusController@postMenusAdd')->name("menu-add");
        Route::post('/menu-edit/{menuId}', 'Backend\Menus\MenusController@postMenusEdit')->name("menu-edit");
    });

    Route::prefix("pages")->middleware('Admin')->group(function () {
        Route::get('/', 'Backend\Pages\PagesController@getPages')->name("pages");
        Route::get('/page-add', 'Backend\Pages\PagesController@getPagesAdd')->name("page-add");
        Route::get('/page-edit/{pageId}', 'Backend\Pages\PagesController@getPagesEdit')->name("page-edit");
        Route::post('/', 'Backend\Pages\PagesController@postPages')->name("pages");
        Route::post('/page-add', 'Backend\Pages\PagesController@postPagesAdd')->name("page-add");
        Route::post('/page-edit/{pageId}', 'Backend\Pages\PagesController@postPagesEdit')->name("page-edit");
    });

    Route::prefix("sliders")->middleware('Admin')->group(function () {
        Route::get('/', 'Backend\Sliders\SlidersController@getSliders')->name("sliders");
        Route::get('/slider-add', 'Backend\Sliders\SlidersController@getSlidersAdd')->name("slider-add");
        Route::get('/slider-edit/{sliderId}', 'Backend\Sliders\SlidersController@getSlidersEdit')->name("slider-edit");
        Route::post('/', 'Backend\Sliders\SlidersController@postSliders')->name("sliders");
        Route::post('/slider-add', 'Backend\Sliders\SlidersController@postSlidersAdd')->name("slider-add");
        Route::post('/slider-edit/{sliderId}', 'Backend\Sliders\SlidersController@postSlidersEdit')->name("slider-edit");
    });

    Route::prefix("users")->middleware('Admin')->group(function () {
        Route::get('/', 'Backend\Users\UsersController@getUsers')->name("users");
        Route::get('/user-add', 'Backend\Users\UsersController@getUsersAdd')->name("user-add");
        Route::get('/user-edit/{userId}', 'Backend\Users\UsersController@getUsersEdit')->name("user-edit");
        Route::post('/', 'Backend\Users\UsersController@postUsers')->name("users");
        Route::post('/user-add', 'Backend\Users\UsersController@postUsersAdd')->name("user-add");
        Route::post('/user-edit/{userId}', 'Backend\Users\UsersController@postUsersEdit')->name("user-edit");
    });

    Route::prefix("settings")->middleware('Admin')->group(function () {
        Route::get('/', 'Backend\Settings\SettingsController@getSettings')->name("settings");
        Route::get('/setting-edit/{settingId}', 'Backend\Settings\SettingsController@getSettingsEdit')->name("setting-edit");
        Route::post('/', 'Backend\Settings\SettingsController@postSettings')->name("settings");
        Route::post('/setting-edit/{settingId}', 'Backend\Settings\SettingsController@postSettingsEdit')->name("setting-edit");
    });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
