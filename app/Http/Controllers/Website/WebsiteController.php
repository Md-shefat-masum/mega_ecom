<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\modules\ProductManagement\Product\Models\Model as ProductModel;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    public function home()
    {
        return Inertia::render('Home/Index', [
            'event' => [
                'title' => 'ETEK Enterprise - Leading Electronics and Gadgets',
                'image' => 'https://etek.com.bd/cache/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function blogs()
    {
        return Inertia::render('Blogs/Index', [
            'event' => [
                'title' => 'ETEK Blogs',
                'image' => 'https://etek.com.bd/cache/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function blogDetails($slug)
    {
        return Inertia::render('Blogs/Details', [
            'slug' => $slug,
            'event' => [
                'title' => 'ETEK Blog Details',
                'image' => 'https://etek.com.bd/cache/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function products($slug)
    {
        $category = DB::table('product_categories')->select('title','slug')->where('slug',$slug)->first();
        $page = request()->page ? request()->page : 1;
        return Inertia::render('Products/Index', [
            'slug' => $slug,
            'page' => $page,
            'event' => [
                'title' => $category->title .' price in bangladesh',
                'image' => 'https://etek.com.bd/cache/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function category_group_products($slug)
    {
        $page = request()->page ? request()->page : 1;
        return Inertia::render('Products/CategoryGroupProduct', [
            'slug' => $slug,
            'event' => [
                'title' => 'ETEK Products',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function products_details($slug)
    {
        // $product = ProductModel::where('slug', $slug)->first();
        return Inertia::render('ProductDetails/Index', [
            'slug' => $slug,
            // 'product_details' => $product,
            'event' => [
                'title' => 'ETEK Product Details',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);

    }
    public function offer_products($slug)
    {
        // $product = ProductModel::where('slug', $slug)->first();
        return Inertia::render('Products/OfferProduct', [
            'slug' => $slug,
            // 'product_details' => $product,
            'event' => [
                'title' => 'ETEK Product Details',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function cart()
    {
        return Inertia::render('Cart/Index', [
            'event' => [
                'title' => 'ETEK Cart',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function checkout()
    {
        return Inertia::render('Checkout/Index', [
            'event' => [
                'title' => 'ETEK Checkout',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function contact()
    {
        return Inertia::render('Contact/Index', [
            'event' => [
                'title' => 'ETEK Contact Us',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function about()
    {
        return Inertia::render('About/Index', [
            'event' => [
                'title' => 'ETEK About Us',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function terms_conditions()
    {
        return Inertia::render('TermsConditions/Index', [
            'event' => [
                'title' => 'ETEK Terms & Conditions',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function returns_exchanges()
    {
        return Inertia::render('ReturnsExchanges/Index', [
            'event' => [
                'title' => 'ETEK Returns & Exchanges',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
    public function shipping_Delivery()
    {
        return Inertia::render('ShippingDelivery/Index', [
            'event' => [
                'title' => 'ETEK Shipping & Delivery',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }

    public function search_results()
    {
        return Inertia::render('GlobalSearchResult/Index', [
            'event' => [
                'title' => 'ETEK Shipping & Delivery',
                'image' => 'https://etek.com.bd/frontend/images/etek_logo.png',
                'description' => 'Best eCommerce in bangladesh'
            ]
        ]);
    }
}
