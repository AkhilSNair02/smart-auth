<?php

namespace App\Repositories\Eloquent;

use App\Models\Otp;
use App\Repositories\Interfaces\OtpRepositoryInterface;

class OtpRepository implements OtpRepositoryInterface
{
    public function create(array $data)
    {
        return Otp::create($data);
    }

    public function findValidOtp($userId, $otp, $type)
    {
        return Otp::where('user_id', $userId)
            ->where('otp_code', $otp)
            ->where('type', $type)
            ->where('expires_at', '>', now())
            ->first();
    }

    public function deleteByUser($userId)
    {
        return Otp::where('user_id', $userId)->delete();
    }
}