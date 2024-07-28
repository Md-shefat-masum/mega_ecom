<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\Validations\LoginValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VerifyOtp
{
    static $model = \App\Modules\UserManagement\User\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();


            $otpRecord = DB::table('otp_codes')
                ->where('phone_number', $requestData['phone_number'])
                ->where('otp', $requestData['otp'])
                ->latest('created_at')
                ->first();

            if (!$otpRecord) {
                return messageResponse('Invalid OTP', $requestData, 400, 'error');
            }
            // Remove used OTP
            DB::table('otp_codes')
                ->where('phone_number', $requestData['phone_number'])
                ->where('otp', $requestData['otp'])
                ->where('type', 'register')
                ->latest('created_at')
                ->delete();
            // Proceed with user registration
            unset($requestData['otp']);
            $user = self::$model::where('phone_number', $requestData['phone_number'])->first();
            if ($user) {
                $data['access_token'] = $user->createToken('accessToken')->accessToken;
                $data['user'] = $user;
            } else {
                $user = self::$model::create($requestData);
                $data['access_token'] = $user->createToken('accessToken')->accessToken;
                $data['user'] = $user;
            }

            return messageResponse('Your OTP successfully Matched', $data, 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
