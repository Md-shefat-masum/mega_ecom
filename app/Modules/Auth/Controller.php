<?php

namespace App\Modules\Auth;

use App\Modules\Auth\Actions\Login;
use App\Modules\Auth\Actions\Register;
use App\Modules\Auth\Actions\VerifyOtp;

use App\Http\Controllers\Controller as ControllersController;
use App\Modules\Auth\Actions\CheckUser;
use App\Modules\Auth\Validations\LoginValidation;
use App\Modules\Auth\Validations\RegisterValidation;
use App\Modules\Auth\Validations\OTPValidation;


class Controller extends ControllersController
{

    public function login(LoginValidation $request)
    {
        $data = Login::execute($request);
        return $data;
    }
    public function SendOtp(RegisterValidation $request)
    {
        $data = Register::generateOTP($request);
        return $data;
    }
    public function VerifyOtp(OTPValidation $request)
    {
        $data = VerifyOtp::execute($request);
        return $data;
    }

    public function checkUser()
    {
        $data = CheckUser::execute();
        return $data;
    }
}
