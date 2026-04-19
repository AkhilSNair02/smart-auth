<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\OtpRepositoryInterface;
use App\Helpers\OtpHelper;
use App\Events\UserRegistered;         
use App\Events\UserVerified;
use App\Events\ForgotPasswordRequested;  
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthService
{
    protected $userRepo;
    protected $otpRepo;

    public function __construct(
        UserRepositoryInterface $userRepo,
        OtpRepositoryInterface  $otpRepo
    ) {
        $this->userRepo = $userRepo;
        $this->otpRepo  = $otpRepo;
    }

  

    public function register(array $data): void
    {
        $data['password']    = bcrypt($data['password']);
        $data['is_verified'] = false;

        $user = $this->userRepo->create($data);

        $otp = OtpHelper::generate();

        $this->otpRepo->deleteByUser($user->id);

        $this->otpRepo->create([
            'user_id'    => $user->id,
            'otp_code'   => $otp,
            'type'       => 'register',
            'expires_at' => OtpHelper::expiresAt(),
        ]);

        event(new UserRegistered($user, $otp));
    }

    

    public function verifyOtp(string $email, string $otp): void
    {
        $user = $this->userRepo->findByEmail($email);

        if (!$user) {
            throw new Exception("User not found.");
        }

        $validOtp = $this->otpRepo->findValidOtp($user->id, $otp, 'register');

        if (!$validOtp) {
            throw new Exception("Invalid or expired OTP.");
        }

        $this->userRepo->update($user, ['is_verified' => true]);

        $this->otpRepo->deleteByUser($user->id);

        event(new UserVerified($user));
    }

    public function login(string $email, string $password): string
    {
        $user = $this->userRepo->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            throw new Exception("Invalid credentials.");
        }

        if (!$user->is_verified) {
            throw new Exception("Please verify your account before logging in.");
        }

        return $user->createToken('auth_token')->plainTextToken;
    }

    public function forgotPassword(string $email): void
    {
        $user = $this->userRepo->findByEmail($email);

        if (!$user) {
            throw new Exception("No account found with that email.");
        }

        $otp = OtpHelper::generate();

        $this->otpRepo->deleteByUser($user->id);

        $this->otpRepo->create([
            'user_id'    => $user->id,
            'otp_code'   => $otp,
            'type'       => 'reset',
            'expires_at' => OtpHelper::expiresAt(),
        ]);

        event(new ForgotPasswordRequested($user, $otp));
    }


    public function resetPassword(string $email, string $otp, string $newPassword): void
    {
        $user = $this->userRepo->findByEmail($email);

        if (!$user) {
            throw new Exception("User not found.");
        }

        $validOtp = $this->otpRepo->findValidOtp($user->id, $otp, 'reset');

        if (!$validOtp) {
            throw new Exception("Invalid or expired OTP.");
        }

        $this->userRepo->update($user, [
            'password' => bcrypt($newPassword),
        ]);

        $this->otpRepo->deleteByUser($user->id);
    }
}