<?php

namespace App\Modules\WebsiteApi\Product;

use App\Http\Controllers\Controller as ControllersController;

use App\Modules\WebsiteApi\Product\Actions\GetAllProduct;
use App\Modules\WebsiteApi\Product\Actions\GetAllBestSellingProduct;
use App\Modules\WebsiteApi\Product\Actions\GetAllFeaturedProduct;
use App\Modules\WebsiteApi\Product\Actions\GetAllFeaturedProductsByCategoryId;
use App\Modules\WebsiteApi\Product\Actions\GetAllFeaturedProductsByBrandId;
use App\Modules\WebsiteApi\Product\Actions\GetAllProductsByCategoryId;
use App\Modules\WebsiteApi\Product\Actions\GetProductDetails;
use App\Modules\WebsiteApi\Product\Actions\GetAllProductOffers;
use App\Modules\WebsiteApi\Product\Actions\GetAllOfferProductsByOfferId;
use App\Modules\WebsiteApi\Product\Actions\GetInitialProductDetails;
use App\Modules\WebsiteApi\Product\Actions\GetSingleCategoryGroupWithProduct;
use App\Modules\WebsiteApi\Product\Actions\GetProductCategoryVarients;
use App\Modules\WebsiteApi\Product\Actions\GetProductCategoryWiseBrands;

class Controller extends ControllersController
{

    public function GetAllProduct()
    {
        $data = GetAllProduct::execute();
        return $data;
    }
    public function GetAllBestSellingProduct()
    {
        $data = GetAllBestSellingProduct::execute();
        return $data;
    }
    public function GetAllFeaturedProduct()
    {
        $data = GetAllFeaturedProduct::execute();
        return $data;
    }
    public function GetAllFeaturedProductsByCategoryId($slug)
    {
        $data = GetAllFeaturedProductsByCategoryId::execute($slug);
        return $data;
    }
    public function GetAllFeaturedProductsByBrandId($slug)
    {
        $data = GetAllFeaturedProductsByBrandId::execute($slug);
        return $data;
    }
    public function GetAllProductsByCategoryId($slug)
    {
        $data = GetAllProductsByCategoryId::execute($slug);
        return $data;
    }
    public function GetProductDetails($slug)
    {
        $data = GetProductDetails::execute($slug);
        return $data;
    }
    public function GetInitialProductDetails($slug)
    {
        $data = GetInitialProductDetails::execute($slug);
        return $data;
    }
    public function GetAllProductOffers()
    {
        $data = GetAllProductOffers::execute();
        return $data;
    }
    public function GetAllOfferProductsByOfferId($slug)
    {
        $data = GetAllOfferProductsByOfferId::execute($slug);
        return $data;
    }
    public function GetSingleCategoryGroupWithProduct($slug)
    {
        $data = GetSingleCategoryGroupWithProduct::execute($slug);
        return $data;
    }
    public function GetProductCategoryVarients($slug)
    {
        $data = GetProductCategoryVarients::execute($slug);
        return $data;
    }
    public function GetProductCategoryBrands($slug)
    {
        $data = GetProductCategoryWiseBrands::execute($slug);
        return $data;
    }
}
