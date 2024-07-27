<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ProductManagement\Product\Models\Model as Product;
use Illuminate\Cache\RateLimiting\Limit;

class ProductController extends Controller
{
    public function featured_products()
    {
        $data = Product::where('is_featured', 1)->limit(24)->with('product_image')->get();
        return response()->json($data)->header('Cache-Control', 'public, max-age=300')
            ->header('Expires', now()->addMinutes(120)->toRfc7231String());
    }

    public function product($slug)
    {
        $with = [
            'product_image:id,product_id,url',
            'product_categories:id,title',
            'product_brand:id,title',
            'product_region',
            'product_region.country',
        ];
        $data = Product::where('slug', $slug)
            ->with($with)
            ->select([
                "id",
                "title",
                "short_description",
                "customer_sales_price",
                "discount_type",
                "discount_amount",
                "product_brand_id",
                "sku",
            ])
            ->first();
        $data->product_images = $data->product_images()
            ->select('id', 'product_id', 'url')->skip(1)
            ->take(10)->get()->reverse();

        return response()->json($data);
    }
}
