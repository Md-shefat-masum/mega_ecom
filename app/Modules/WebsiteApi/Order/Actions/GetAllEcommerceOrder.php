<?php

namespace App\Modules\WebsiteApi\Order\Actions;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GetAllEcommerceOrder
{
    static $model = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\Model::class;

    public static function execute()
    {
        try {
     

            $orderInfo = self::$model::with(
                'order_products',
                'order_products.product',
                'order_products.product.product_image')
                ->where('user_id', auth()->id())
                ->paginate(10);
            if (!$orderInfo) {
                return messageResponse('No order found', [], 200, 'success');
            }

            return entityResponse($orderInfo);
        } catch (\Exception $e) {

            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }

    public static function generateUniqueOrderId()
    {
        $orderId = 'ETEK' . rand(1000000, 999999999);
        while (self::$model::where('order_id', $orderId)->exists()) {
            $orderId = 'ETEK' . rand(1000000, 999999999);
        }
        return $orderId;
    }
}
