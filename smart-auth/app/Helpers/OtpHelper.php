<?php

namespace App\Helpers;

class OtpHelper
{
    public static function generate(): string
    {
        return str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public static function expiresAt(int $minutes = 5): \Carbon\Carbon
    {
        return now()->addMinutes($minutes);
    }

    public static function isExpired(\Carbon\Carbon $expiresAt): bool
    {
        return now()->greaterThan($expiresAt);
    }

    public static function verify(string $input, string $stored): bool
    {
        return hash_equals($stored, $input);
    }
}