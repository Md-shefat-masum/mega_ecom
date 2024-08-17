<?php

namespace App\Modules\WebsiteApi\Order\Actions;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EcommerceOrder
{
    static $model = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\Model::class;
    static $orderProductmodel = \App\Modules\SalesManagement\SalesEcommerceOrder\Models\SalesEcommerceOrderProductModel::class;
    static $cartModel = \App\Modules\WebsiteApi\Cart\Models\Model::class;

    public static function execute($request)
    {
        try {

            $orderDetails = $request->all();

            // dd($orderDetails);

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
                // "delivery_address_id" =>  ($orderDetails["address_id"] ?? auth()->user()?->user_address->id) ?? null,

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
                "total" =>  $total,
            ];

            // dd($orderInfo);




            if ($order = self::$model::create($orderInfo)) {
                $messag_items = "";
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

                    $messag_items .= $key + 1 . ". " . $cartItem->product->title . "\n";
                    $messag_items .= "৳ " . ($cartItem->product->current_price) . " x $cartItem->quantity = ৳ " . $cartItem->product->current_price * $cartItem->quantity . "\n";
                    $messag_items .=  "\n";
                }
                $date = Carbon::now()->toDateTimeString();
                $order_id = $order->order_id;
                $name = $orderDetails["user_name"];
                $phone = $orderDetails["phone"];
                $address = $orderDetails["address"];
                $content = "
আসসালামু আলাইকুম ওয়ারহমাতুল্লাহ।
নতুন অর্ডার এসেছে
অর্ডার এর সময়: $date
অর্ডার এর বিবরণ
-------------------
$messag_items
-------------------
সর্বমোট মূল্য - ৳ $total
-------------------
অর্ডারকারীর বিবরণ
নাম : $name
মোবাইল নাম্বার : $phone
ঠিকানা : $address
-------------------
বিস্তারিত : https://etek.com.bd/invoice/$order_id";

                try {
                    // sendToTelegram("812239513", $content);
                    sendToTelegram("6555657006", $content);
                } catch (\Exception $e) {
                }

                self::$cartModel::where('user_id', auth()->id())->delete();
            }

            return messageResponse('Order Successfully completed', [$orderInfo], 200, 'success');
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
