<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetAllFeaturedProductsByBrandId
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;
    static $BrandModel = \App\Modules\ProductManagement\ProductBrand\Models\Model::class;

    public static function execute($slug)
    {
        try {

            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'asc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? '*';
            $with = ['product_images:id,product_id,url', 'product_categories:id,title', 'product_brand:id,title'];
            $condition = [];

            $brand = self::$BrandModel::query()->where('slug', $slug)->first();
            if (!$brand) {
                return messageResponse('Brand not found', $slug, 404, 'error');
            }


            $data = self::$ProductModel::query() ->where('is_featured', 1)->where('product_brand_id', $brand->id);

            if (request()->has('get_all') && (int)request()->input('get_all') === 1) {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->limit($pageLimit)
                    ->orderBy($orderByColumn, $orderByType)
                    ->get();
            } else {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->orderBy($orderByColumn, $orderByType)
                    ->paginate($pageLimit);
            }

            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
