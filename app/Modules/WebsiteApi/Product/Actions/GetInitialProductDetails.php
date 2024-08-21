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
                'product_brand:id,title,image',
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

            if ($data->type == 'medicine') {
                $data->load(['medicine_product', 'medicine_product_verient']);
                $related_brand_product = [];
                if ($data->medicine_product && $data->medicine_product->p_generic_name) {

                    $related_brand_product = self::$ProductModel::with(['medicine_product', 'medicine_product_verient','product_image:id,product_id,url'])
                        ->select($fields)
                        ->whereHas('medicine_product', function ($query) use ($data) {
                            $query->where('p_generic_name', $data->medicine_product->p_generic_name);
                        })->get();
                    $data->related_brand_product = $related_brand_product;

                }
            }



            $data->product_images = $data->product_images()->select('id', 'product_id', 'url')->skip(1)->take(10)->get();

            if (!$data) {
                return messageResponse('Data not found...', [], 404, 'error');
            }
            $data->product_images = $data->product_images()->select('id', 'product_id', 'url')->skip(1)->take(10)->get();

            $response = entityResponse($data);
            return $response;
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
