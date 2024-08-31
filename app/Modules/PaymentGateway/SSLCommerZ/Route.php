<?php


use Illuminate\Support\Facades\Route;
use App\Modules\PaymentGateway\SSLCommerZ\Controller\SslCommerzPaymentController;


// SSLCOMMERZ Start
Route::prefix('v1')->group(function () {
    Route::any('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
});
//SSLCOMMERZ END

/*<<<<---- NOTE --->>>>>
|--------------------------------------------------------------------------
| Only one dependency on this package that is  ssl_route.php
|--------------------------------------------------------------------------
*/
