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


Route::prefix("admin")->group(function () {

    Route::get('/home', 'HomeGetController@index')->name("index");


    Route::prefix("blogs")->group(function () {
        Route::get('/', 'Blogs\BlogController@getBlogs')->name("blogs");
        Route::get('/blog-add', 'Blogs\BlogController@getBlogsAdd')->name("blog-add");
        Route::get('/blog-edit/{blogId}', 'Blogs\BlogController@getBlogsEdit')->name("blog-edit");
        Route::get('/blog-category', 'Blogs\BlogController@getBlogsCategory')->name("blog-category");
        Route::get('/blog-category-add', 'Blogs\BlogController@getBlogsCategoryAdd')->name("blog-category-add");
        Route::get('/blog-category-edit/{categoryId}', 'Blogs\BlogController@getBlogsCategoryEdit')->name("blog-category-edit");

        Route::post('/', 'Blogs\BlogController@postBlogs')->name("blogs");
        Route::post('/blog-add', 'Blogs\BlogController@postBlogsAdd')->name("blog-add");
        Route::post('/blog-edit/{blogId}', 'Blogs\BlogController@postBlogsEdit')->name("blog-edit");
        Route::post('/blog-category', 'Blogs\BlogController@postBlogsCategory')->name("blog-category");
        Route::post('/blog-category-add', 'Blogs\BlogController@postBlogsCategoryAdd')->name("blog-category-add");
        Route::post('/blog-category-edit/{categoryId}', 'Blogs\BlogController@postBlogsCategoryEdit')->name("blog-category-edit");
    });

    Route::prefix("menus")->group(function () {
        Route::get('/', 'Menus\MenusController@getMenus')->name("menus");
        Route::get('/menu-add', 'Menus\MenusController@getMenusAdd')->name("menu-add");
        Route::get('/menu-edit/{menuId}', 'Menus\MenusController@getMenusEdit')->name("menu-edit");
        Route::post('/', 'Menus\MenusController@postMenus')->name("menus");
        Route::post('/menu-add', 'Menus\MenusController@postMenusAdd')->name("menu-add");
        Route::post('/menu-edit/{menuId}', 'Menus\MenusController@postMenusEdit')->name("menu-edit");
    });

    Route::prefix("pages")->group(function () {
        Route::get('/', 'Pages\PagesController@getPages')->name("pages");
        Route::get('/page-add', 'Pages\PagesController@getPagesAdd')->name("page-add");
        Route::get('/page-edit/{pageId}', 'Pages\PagesController@getPagesEdit')->name("page-edit");
        Route::post('/', 'Pages\PagesController@postPages')->name("pages");
        Route::post('/page-add', 'Pages\PagesController@postPagesAdd')->name("page-add");
        Route::post('/page-edit/{pageId}', 'Pages\PagesController@postPagesEdit')->name("page-edit");
    });

    Route::prefix("sliders")->group(function () {
        Route::get('/', 'Sliders\SlidersController@getSliders')->name("sliders");
        Route::get('/slider-add', 'Sliders\SlidersController@getSlidersAdd')->name("slider-add");
        Route::get('/slider-edit/{sliderId}', 'Sliders\SlidersController@getSlidersEdit')->name("slider-edit");
        Route::post('/', 'Sliders\SlidersController@postSliders')->name("sliders");
        Route::post('/slider-add', 'Sliders\SlidersController@postSlidersAdd')->name("slider-add");
        Route::post('/slider-edit/{sliderId}', 'Sliders\SlidersController@postSlidersEdit')->name("slider-edit");
    });

    Route::prefix("users")->group(function () {
        Route::get('/', 'Users\UsersController@getUsers')->name("users");
        Route::get('/user-add', 'Users\UsersController@getUsersAdd')->name("user-add");
        Route::get('/user-edit', 'Users\UsersController@getUsersEdit')->name("user-edit");
    });

    Route::prefix("settings")->group(function () {
        Route::get('/', 'Settings\SettingsController@getSettings')->name("settings");
        Route::get('/setting-edit', 'Settings\SettingsController@getSettingsEdit')->name("setting-edit");
    });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
