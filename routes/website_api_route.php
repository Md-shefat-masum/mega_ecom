<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/nav-categories', 'Api\CategoryController@featured');
    Route::get('/brands', 'Api\CategoryController@brands');
    Route::get('/varients', 'Api\CategoryController@varients');

    Route::get('/category/{slug}', 'Api\CategoryController@category');

    Route::get('/featured-products', 'Api\ProductController@featured_products');
});


Route::get('/set-question', function () {
    DB::table('product_questions')->update(['is_approved' => 1]);
});

Route::get('/set-is-available', function () {
    $data =  DB::table('products')->where('purchase_price', 0)->update(['is_available' => 0]);
});
Route::get('/pget', function () {
    $data =  DB::table('products')->where('id', 184)->first();
    return $data;
});

Route::get('/fixed-discount-product', function () {
    $products = DB::table('products')->select('id', 'customer_sales_price', 'discount_amount')->get();

    foreach ($products as $product) {

        $new_discount_amount = ($product->customer_sales_price * 5 / 100);

        DB::table('products')
            ->where('id', $product->id)
            ->update(['discount_amount' => $new_discount_amount]);
    }
});

Route::get('/set-related-products', function () {
    DB::table('related_product')->truncate();
    for ($i = 1; $i <= 10; $i++) {
        DB::table('related_product')->insert([
            'product_id' => 1,
            'related_product_id' => $i + 1,
        ]);
    }
});
Route::get('/set-related-compare-products', function () {
    DB::table('related_compare_product')->truncate();
    for ($i = 1; $i <= 10; $i++) {
        DB::table('related_compare_product')->insert([
            'product_id' => 1,
            'related_product_id' => $i + 1,
        ]);
    }
});

Route::get('/set-related-price-review-products', function () {
    DB::table('price_review_product')->truncate();
    for ($i = 1; $i <= 10; $i++) {
        DB::table('price_review_product')->insert([
            'product_id' => 1,
            'related_product_id' => $i + 1,
        ]);
    }
});

Route::get('/update-category-group-id', function () {
    DB::table('product_category_products')->where('id', '>', '0')->update([
        'product_category_group_id' => 3,
    ]);
});

Route::get('/offer-product-create', function () {
    DB::table('product_offer_product')->truncate();
    for ($i = 1; $i <= 100; $i++) {
        DB::table('product_offer_product')->insert([
            'product_id' => $i,
            'product_offer_id' => rand(1, 4),
        ]);
    }
});


Route::get('/product-category-brands', function () {
    $model = \App\Modules\ProductManagement\ProductCategory\Models\Model::class;
    DB::table('product_category_brand')->truncate();
    $category = $model::with('products')->first();

    if ($category) {
        foreach ($category->products as $item) {
            $product_brand = DB::table('product_category_brand')
                ->where('product_brand_id', $item->product_brand_id)->first();
            if (!$product_brand) {
                DB::table('product_category_brand')->insert([
                    'product_category_id' => $category->id,
                    'product_brand_id' => $item->product_brand_id,
                    // 'total_product' => $item->product_brand_id
                ]);

                $productsCount = $category->products()
                    ->where('products.product_brand_id', $item->product_brand_id)
                    // ->where('customer_sales_price', '>', '0')
                    ->count();
                DB::table('product_category_brand')
                    ->where('product_category_id', $category->id)
                    ->where('product_brand_id', $item->product_brand_id)
                    ->update([
                        'total_product' => $productsCount
                    ]);
            }
        }
    }
});

Route::get('/product_category_varient', function () {
    DB::table('product_category_varient')->where('product_category_id', 2)->update([
        'product_category_id' => 1
    ]);
});
