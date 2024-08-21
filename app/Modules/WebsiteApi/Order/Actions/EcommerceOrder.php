<?php

namespace App\Modules\WebsiteApi\Order\Actions;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class EcommerceOrder
{
    static $model = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\Model::class;
    static $orderProductmodel = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\SalesEcommerceOrderProductModel::class;
    static $cartModel = \App\Modules\WebsiteApi\Cart\Models\Model::class;

    public static function execute($request)
    {
        try {

            $orderDetails = $request->all();



            $cartItems  = self::$cartModel::where('user_id', auth()->id())->get();
            $cartSubtotal = $cartItems->sum(function ($cartItem) {
                return $cartItem->product->current_price * $cartItem->quantity;
            });



            $total = $cartSubtotal;

            // dd($orderDetails, auth()->user()->toArray(), $cartItems->toArray(), $cartSubtotal);

            $orderInfo = [
                "order_id" => self::generateUniqueOrderId(),
                "date" => Carbon::now()->toDateString(),
                "user_type" => "ecommerce",
                "user_id" => auth()->user()->id,
                "is_delivered" => 0,
                "order_status" => 'pending',
                // "user_address_id" => ($orderDetails["address_id"] ?? auth()->user()?->user_address->id) ?? null,
                "delivery_method" => "home_delivery",
                // "delivery_address_id" => ($orderDetails["address_id"] ?? auth()->user()?->user_address->id) ?? null,

                "delivery_charge" => $orderDetails["delivery_charge"] ?? 0,
                "additional_charge" => 0,
                "product_coupon_id" => null,
                "coupon_discount" => null,
                "discount" => null,
                "discount_type" => null,
                "is_paid" => 0,
                "paid_amount" => null,
                "paid_status" => 'due',
                "payment_method" => $orderDetails["payment_type"],

                "subtotal" => $cartSubtotal,
                "total" =>  $total + $orderDetails["delivery_charge"] ?? 0,
            ];

            // dd($orderInfo);




            if ($order = self::$model::create($orderInfo)) {
                $product_items = "";
                foreach ($cartItems as $key => $cartItem) {

                    self::$orderProductmodel::create([
                        'sales_ecommerce_order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'product_price' => $cartItem->product->current_price,
                        'product_name' => $cartItem->product->title,
                        'discount_type' => null,
                        'tax' => null,
                        'price' => $cartItem->product->current_price,
                        'qty' => $cartItem->quantity,
                        'subtotal' => $order->subtotal,
                        'tax_total' =>  0,
                        'total' => $order->total,
                    ]);

                    $product_items .= $key + 1 . ". " . $cartItem->product->title . "\n";
                    $product_items .= "৳ " . ($cartItem->product->current_price) . " x $cartItem->quantity = ৳ " . $cartItem->product->current_price * $cartItem->quantity . "\n";
                    $product_items .=  "\n";
                }


                self::$cartModel::where('user_id', auth()->id())->delete();
            }

            $order_details = self::$model::with('user')->where('order_id', $orderInfo['order_id'])->first();

            $payload = [
                "order_details" => $order_details,
                "address_details" =>  $orderDetails,
            ];

            return messageResponse('Order Successfully completed', $payload, 200, 'success');
        } catch (\Exception $e) {
            dd($e);
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
