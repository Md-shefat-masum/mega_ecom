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
                ->where('type', 'register')
                ->latest('created_at')
                ->first();

            if (!$otpRecord) {
                return messageResponse('Invalid OTP', [], 400, 'error');
            }
            DB::table('otp_codes')
                ->where('phone_number', $requestData['phone_number'])
                ->where('otp', $requestData['otp'])
                ->where('type', 'register')
                ->latest('created_at')
                ->delete();
            // Proceed with user registration
            unset($requestData['otp']);
            $user = self::$model::create($requestData);
            // Remove used OTP

            $data['access_token'] = $user->createToken('accessToken')->accessToken;
            $data['user'] = $user;
            return messageResponse('OTP Matched', $data, 200, 'success');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
