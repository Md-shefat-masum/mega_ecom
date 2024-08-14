<?php

namespace App\Modules\WebsiteApi\Cart\Actions;

class Store
{
    static $model = \App\Modules\WebsiteApi\Cart\Models\Model::class;

    public static function execute()
    {
        try {

            // dd(request()->all());

            $isCartExist = self::$model::where('product_id', request()->product_id)->where('user_id', auth()->user()->id)->first();

            if ($isCartExist) {
                $isCartExist->quantity = $isCartExist->quantity + request()->quantity;
                $isCartExist->save();
                return messageResponse('Cart Quantity updated', $isCartExist, 200);
            }

            $requestData = [
                'product_id' => request()->product_id,
                'quantity' => request()->quantity ?? 1,
                'user_id' =>  auth()->id() ?? 3,
                'product_type' => request()->product_type ?? 'product',
            ];

            $data = self::$model::query()->create($requestData);
            return messageResponse('Item added into cart', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
