<?php

namespace App\Repositories\Interfaces;

interface OtpRepositoryInterface
{
    public function create(array $data);
    public function findValidOtp($userId, $otp, $type);
    public function deleteByUser($userId);
}