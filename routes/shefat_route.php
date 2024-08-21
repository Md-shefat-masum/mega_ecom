<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // Route::get('/',function(){
    //     return view('app');
    // });
    Route::get('/', 'Website\WebsiteController@home')->name('website_home');

    Route::get('/blogs', 'Website\WebsiteController@blogs')->name('website_blogs');
    Route::get('/blog-details/{slug}', 'Website\WebsiteController@blogDetails')->name('website_blog_details');

    Route::get('/products/{slug}', 'Website\WebsiteController@products')->name('website_products');
    Route::get('/category/{slug}', 'Website\WebsiteController@products')->name('website_products');
    Route::get('/category-group/{slug}', 'Website\WebsiteController@category_group_products')->name('category_group_products');

    Route::get('/product-details/{slug}', 'Website\WebsiteController@products_details')->name('website_products_details');
    Route::get('/offer-products/{slug}', 'Website\WebsiteController@offer_products')->name('offer_products');

    Route::get('/cart', 'Website\WebsiteController@cart')->name('website_cart');
    Route::get('/checkout', 'Website\WebsiteController@checkout')->name('website_checkout');

    Route::get('/contact', 'Website\WebsiteController@contact')->name('website_contact');
    Route::get('/about', 'Website\WebsiteController@about')->name('website_about');
    Route::get('/terms-conditions', 'Website\WebsiteController@terms_conditions')->name('website_terms_conditions');
    Route::get('/returns-exchanges', 'Website\WebsiteController@returns_exchanges')->name('website_returns_exchanges');
    Route::get('/shipping-delivery', 'Website\WebsiteController@shipping_delivery')->name('website_shipping_delivery');
    Route::get('/search-results', 'Website\WebsiteController@search_results')->name('search_results');

    Route::get('/profile', 'Website\ProfileController@profile')->name('website_profile');
    Route::get('/profile/orders', 'Website\ProfileController@orders')->name('website_profile_orders');
    Route::get('/profile/order-details/{slug}', 'Website\ProfileController@order_details')->name('order_details');
    Route::get('/profile/wish-list', 'Website\ProfileController@wish_list')->name('website_profile_wish_list');
    Route::get('/profile/compare-list', 'Website\ProfileController@compare_list')->name('website_profile_compare_list');
    Route::get('/profile/account', 'Website\ProfileController@account')->name('website_profile_account');
    Route::get('/profile/address', 'Website\ProfileController@address')->name('website_profile_address');
    Route::get('/profile/password', 'Website\ProfileController@password')->name('website_profile_password');

    Route::post('/profile/edit-account', 'Website\ProfileController@edit_account')->name('website_edit_account')->middleware('auth:api');
    Route::post('/profile/edit-address', 'Website\ProfileController@edit_address')->name('website_edit_address');

    Route::get('/login', 'Website\AuthController@login')->name('login');
    Route::get('/register', 'Website\AuthController@register')->name('register');

    Route::get('/uploads_variant', 'Website\TestController@uploads_variant');
    Route::get('/attach_category_into_products', 'Website\TestController@attach_category_into_products');

    Route::get('/product_and_category_upload', 'Website\TestController@product_and_category_upload');
    // Route::get('/upload_categories', 'Website\TestController@upload_categories');
    Route::get('/set_category_image', 'Website\TestController@set_category_image');
    Route::get('/set_nav_category', 'Website\TestController@set_nav_category');

    Route::get('/upload_product_list', 'Website\TestController@upload_product_list');
    Route::get('/upload_product', 'Website\TestController@upload_product');

    Route::get('/undefined', function () {
    });
    Route::get('/null', function () {
    });
    Route::get('/f', function () {
        Storage::disk('project_upload')->putFileAs("ehsan", public_path("uploads/products/-CW-9060039-WW-Gallery-H100i-RGB-PLATINUM-01-228x228.png"), "new.png");
    });
});

Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::view('cache-check', 'cache');
    Route::get('/cache/{file_name}', 'AssetController@cache')->where('file_name', '.*');
    Route::get('/resize/cache/{file_name}', 'AssetController@cache_resize')->where('file_name', '.*');
});

// Route::get("/about", function () {
//     return Inertia::render("About", [
//         'event' => [
//             'title' => 'About',
//             'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
//             'description' => 'My Website - Used Car inventory'
//         ]
//     ]);
// });
