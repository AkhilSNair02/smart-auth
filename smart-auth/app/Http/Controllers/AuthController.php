<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class AuthController
{
    public function __construct(protected AuthService $authService) {}

   public function register(Request $request): JsonResponse
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    try {
        $this->authService->register($request->all());
        return response()->json(['message' => 'Registration successful. OTP sent to your email.']);
    } catch (Throwable $e) {
        return response()->json(['message' => $e->getMessage()], 422);
    }
}
    public function verifyOtp(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|string|size:6',
        ]);

        try {
            $this->authService->verifyOtp($request->email, $request->otp);
            return response()->json(['message' => 'Account verified successfully.']);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            $token = $this->authService->login($request->email, $request->password);
            return response()->json(['token' => $token]);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function forgotPassword(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        try {
            $this->authService->forgotPassword($request->email);
            return response()->json(['message' => 'Password reset OTP sent to your email.']);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'otp'      => 'required|string|size:6',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $this->authService->resetPassword(
                $request->email,
                $request->otp,
                $request->password
            );
            return response()->json(['message' => 'Password reset successful.']);
        } catch (Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json(['user' => $request->user()]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully.']);
    }
}