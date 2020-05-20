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


Route::prefix("admin")->group(function (){

    Route::get('/home', 'HomeGetController@index')->name("index");

    Route::get('/blogs', 'Blogs\BlogController@getBlogs')->name("blogs");
    Route::get('/blog-add', 'Blogs\BlogController@getBlogsAdd')->name("blog-add");
    Route::get('/blog-edit/{blogId}', 'Blogs\BlogController@getBlogsEdit')->name("blog-edit");
    Route::get('/blog-category', 'Blogs\BlogController@getBlogsCategory')->name("blog-category");
    Route::get('/blog-category-add', 'Blogs\BlogController@getBlogsCategoryAdd')->name("blog-category-add");
    Route::get('/blog-category-edit/{categoryId}', 'Blogs\BlogController@getBlogsCategoryEdit')->name("blog-category-edit");

    Route::post('/blogs', 'Blogs\BlogController@postBlogs')->name("blogs");
    Route::post('/blog-add', 'Blogs\BlogController@postBlogsAdd')->name("blog-add");
    Route::post('/blog-edit/{blogId}', 'Blogs\BlogController@postBlogsEdit')->name("blog-edit");
    Route::post('/blog-category', 'Blogs\BlogController@postBlogsCategory')->name("blog-category");
    Route::post('/blog-category-add', 'Blogs\BlogController@postBlogsCategoryAdd')->name("blog-category-add");
    Route::post('/blog-category-edit/{categoryId}', 'Blogs\BlogController@postBlogsCategoryEdit')->name("blog-category-edit");


    Route::get('/menus', 'Menus\MenusController@getMenus')->name("menus");
    Route::get('/menu-add', 'Menus\MenusController@getMenusAdd')->name("menu-add");
    Route::get('/menu-edit/{menuId}', 'Menus\MenusController@getMenusEdit')->name("menu-edit");
    Route::post('/menus', 'Menus\MenusController@postMenus')->name("menus");
    Route::post('/menu-add', 'Menus\MenusController@postMenusAdd')->name("menu-add");
    Route::post('/menu-edit/{menuId}', 'Menus\MenusController@postMenusEdit')->name("menu-edit");

    Route::get('/pages', 'Pages\PagesController@getPages')->name("pages");
    Route::get('/page-add', 'Pages\PagesController@getPagesAdd')->name("page-add");
    Route::get('/page-edit/{pageId}', 'Pages\PagesController@getPagesEdit')->name("page-edit");
    Route::post('/pages', 'Pages\PagesController@postPages')->name("pages");
    Route::post('/page-add', 'Pages\PagesController@postPagesAdd')->name("page-add");
    Route::post('/page-edit/{pageId}', 'Pages\PagesController@postPagesEdit')->name("page-edit");

    Route::get('/sliders', 'Sliders\SlidersController@getSliders')->name("sliders");
    Route::get('/slider-add', 'Sliders\SlidersController@getSlidersAdd')->name("slider-add");
    Route::get('/slider-edit', 'Sliders\SlidersController@getSlidersEdit')->name("slider-edit");

    Route::get('/users', 'Users\UsersController@getUsers')->name("users");
    Route::get('/user-add', 'Users\UsersController@getUsersAdd')->name("user-add");
    Route::get('/user-edit', 'Users\UsersController@getUsersEdit')->name("user-edit");

    Route::get('/settings', 'Settings\SettingsController@getSettings')->name("settings");
    Route::get('/setting-edit', 'Settings\SettingsController@getSettingsEdit')->name("setting-edit");

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
