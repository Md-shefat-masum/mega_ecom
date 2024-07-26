<?php

namespace App\Modules\WebsiteApi\Product\Actions;

class GetInitialProductDetails
{
    static $ProductModel = \App\Modules\ProductManagement\Product\Models\Model::class;

    public static function execute($slug)
    {
        try {

            $with = [
                'product_image:id,product_id,url',
                'product_categories:id,title',
                'product_brand:id,title',
                'product_region',
                'product_region.country',
            ];

            $fields = request()->input('fields') ?? ['*'];
            if (empty($fields)) {
                $fields = ['*'];
            }

            $data = self::$ProductModel::query()
                ->with($with)
                ->select($fields)
                ->where('slug', $slug)
                ->first();

            $data->product_images = $data->product_images()->select('id', 'product_id', 'url')->skip(1)->take(10)->get();

            if (!$data) {
                return messageResponse('Data not found...', [], 404, 'error');
            }

            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
