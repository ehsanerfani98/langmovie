<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Ippanel\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OtpController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Send OTP code to the given phone number
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^[0][9][0-9]{9,9}$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'شماره موبایل نامعتبر است',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Send OTP
        $result = $this->otpService->send($request->input('phone'));

        if (!$result['success']) {
            return response()->json($result, 500);
        }

        return response()->json($result);
    }

    /**
     * Verify OTP code
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^[0][9][0-9]{9,9}$/',
            'code' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'اطلاعات ارسالی نامعتبر است',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Verify OTP
        $result = $this->otpService->verify(
            $request->input('phone'),
            $request->input('code')
        );

        if (!$result['success']) {
            return response()->json($result, 400);
        }

        // بررسی وجود کاربر
        $phone = $request->input('phone');
        $user = User::where('phone', $phone)->first();

        if ($user) {
            Auth::login($user);
            return response()->json([
                'success' => true,
                'message' => 'ورود با موفقیت انجام شد',
                'redirect' => route('dashboard'),
            ]);

        } else {
            // اگر کاربر جدید است، ایجاد یک کاربر جدید با اطلاعات حداقلی
            $user = User::create([
                'phone' => $phone,
                'password' => null,
            ]);
            $user->assignRole('User');

            // ذخیره شماره موبایل در سشن برای استفاده در فرم ثبت‌نام
            // session(['registered_phone' => $phone]);
            Auth::login($user);

            return response()->json([
                'success' => true,
                'message' => 'ورود با موفقیت انجام شد',
                'redirect' => route('dashboard'),
            ]);
        }
    }

}