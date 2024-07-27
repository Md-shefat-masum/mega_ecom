<?php

namespace App\Modules\WebsiteApi\UserProfile;

use App\Modules\WebsiteApi\UserProfile\Actions\GetUserDashboardInfo;


use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function getUserDashboardInfo()
    {
        $data = GetUserDashboardInfo::execute();
        return $data;
    }


}
