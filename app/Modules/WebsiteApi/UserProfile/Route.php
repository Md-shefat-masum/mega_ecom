<?php

use App\Modules\WebsiteApi\UserProfile\Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::get('get-user-dashboard-info', [Controller::class,'getUserDashboardInfo']);

});
