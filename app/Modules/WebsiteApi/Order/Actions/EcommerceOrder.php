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

            // dd($request->all());
            $orderDetails = $request->all();


            $userType = auth()->user()->role?->name;

            $cartItems = self::$cartModel::with(['product', 'product.medicine_product_verient'])
                ->where('user_id', auth()->id())
                ->get();

            $cartSubtotal = $cartItems->sum(function ($cartItem) use ($userType) {
                if ($cartItem->product_type == 'medicine') {
                    return $cartItem->product->medicine_price * $cartItem->quantity;
                } else {
                    return $cartItem->product->current_price * $cartItem->quantity;
                }

                return 0;
            });



            $total = $cartSubtotal;


            // dd($orderDetails, auth()->user()->toArray(), $cartItems->toArray(), $cartSubtotal);
            $delivery_address_details = [
                "user_name" => $request->user_name,
                "phone" => $request->phone,
                "email" => $request->email,
                "address" => $request->address,
                "division_name" => DB::table('location_state_divisions')->where('id', $request->state_division_id)->first()->name,
                "district_name" => DB::table('location_districts')->where('id', $request->district_id)->first()->name,
                "station_name" => DB::table('location_stations')->where('id', $request->station_id)->first()->name,
            ];

            $orderInfo = [
                "order_id" => self::generateUniqueOrderId(),
                "date" => Carbon::now()->toDateString(),
                "user_type" => "ecommerce",
                "user_id" => auth()->user()->id,
                "is_delivered" => 0,
                "delivery_address_details" => ($delivery_address_details),
                "order_status" => 'pending',
                "delivery_method" => "home_delivery",
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



            if ($order = self::$model::create($orderInfo)) {
                $product_items = "";
                foreach ($cartItems as $key => $cartItem) {

                    self::$orderProductmodel::create([
                        'sales_ecommerce_order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'product_price' => $cartItem->product->type == 'medicine' ? $cartItem->product->medicine_price : $cartItem->product->current_price,
                        'product_name' => $cartItem->product->title,
                        'discount_type' => null,
                        'tax' => null,
                        'price' => $cartItem->product->type == 'medicine' ? $cartItem->product->medicine_price : $cartItem->product->current_price,
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
