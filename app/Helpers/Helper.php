<?php

use App\Models\Banner;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use App\Models\UserDailyLimit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// if (!function_exists('getRoles')) {
//     function getRoles()
//     {
//         return Auth::user()->roles->pluck('name');
//     }
// }

// if (!function_exists('getPermissions')) {
//     function getPermissions()
//     {
//         return Auth::user()->permissions->pluck('name');
//     }
// }

if (!function_exists('isCompletedInfo')) {
    function isCompletedInfo()
    {
        $info = Auth::user()->additionalinformation;
        if ($info && !empty($info->job) && !empty($info->economic_unit) && !empty($info->ceo_name)) {
            return true;
        }
        return false;
    }
}

if (!function_exists('get_setting')) {
    function get_setting($key)
    {
        if ($setting = Setting::where('key', $key)->first()) {
            return $setting->value;
        }

        return false;
    }
}

if (!function_exists('get_settings')) {
    function get_settings()
    {
        if ($setting = Setting::all()) {
            return $setting;
        }
    }
}

if (!function_exists('insert_setting')) {
    function insert_setting($key, $value)
    {
        $setting = new Setting();
        $setting->key = $key;
        $setting->value = $value;
        if ($setting->save()) {
            return true;
        }
    }
}

if (!function_exists('update_setting')) {
    function update_setting($key, $value)
    {
        if ($setting = Setting::where('key', $key)->first()) {
            $setting->value = $value;
        } else {
            $setting = new Setting();
            $setting->key = $key;
            $setting->value = $value;
        }
        if ($setting->save()) {
            return true;
        }
    }
}

if (!function_exists('get_setting_collection')) {
    function get_setting_collection($settings, $key)
    {
        if ($option = $settings->where('key', $key)->first()) {
            return $option->value;
        }

        return false;
    }
}

if (!function_exists('send_sms')) {
    function send_sms($mobile, $message)
    {

        $user = 'webcomnaghilo';
        $pass = 'webcomco1403';
        $fromNum = '+985000404223';
        $input_data = array(
            'verification-code' => $message,
        );
        $rcpt_nm = array($mobile);
        $pattern_code = 'zj9xvrhyabn5vnx';

        $url = 'https://ippanel.com/patterns/pattern?username=' . $user . '&password=' . urlencode($pass) . '&from=' . $fromNum . '&to=' . json_encode($rcpt_nm) . '&input_data=' . urlencode(json_encode($input_data)) . '&pattern_code=' . $pattern_code;
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handler);
    }
}

if (!function_exists('get_table_list')) {
    function get_table_list($model_name, $is_active = false)
    {
        $modelClass = "App\\Models\\$model_name";

        if (class_exists($modelClass)) {
            if ($is_active) {
                return $modelClass::where('is_active', 1)->get();
            } else {
                return $modelClass::all();
            }
        }

        return collect();
    }
}

if (!function_exists('emptyDoc')) {
    function emptyDoc()
    {
        $user = Auth::user()->load('document');
        $doc = $user->document;

        if (!$doc)
            return true;

        if ($doc->needs_correction)
            return true;

        $requiredFields = match ($doc->type) {
            'real' => ['type', 'first_name', 'last_name', 'mobile', 'national_id'],
            'legal' => ['type', 'first_name', 'last_name', 'mobile', 'national_id', 'company_name', 'company_address'],
            default => [],
        };

        foreach ($requiredFields as $field) {
            if (empty($doc->$field)) {
                return true;
            }
        }

        if (!$doc->is_verified)
            return true;

        return false;
    }
}

if (!function_exists('isConfirmDoc')) {
    function isConfirmDoc()
    {
        $status = false;
        $user = Auth::user()->load('document');
        $doc = $user->document;
        if (!$doc) {
            return true;
        }
        $requiredFields = match ($doc->type) {
            'real' => ['type', 'first_name', 'last_name', 'mobile', 'national_id'],
            'legal' => ['type', 'first_name', 'last_name', 'mobile', 'national_id', 'company_name', 'company_address'],
            default => [],
        };

        foreach ($requiredFields as $field) {
            if (empty($doc->$field)) {
                $status = true;
                break;
            }
        }

        if (!$status) {
            if (!$doc->is_verified && !$doc->needs_correction) {
                return false;
            }
            if ($doc->needs_correction) {
                return true;
            }
        }

        return true;
    }
}

if (!function_exists('remainingDays')) {
    function remainingDays()
    {
        $remainingDays = Carbon::parse(now())->diffInDays(getCurrentSubscript()->ends_at);

        return round($remainingDays);
    }
}

if (!function_exists('getCurrentSubscript')) {
    function getCurrentSubscript()
    {
        $user = auth()->user();

        return $user->subscriptions()
            ->with('subscription')
            ->where('ends_at', '>', now())
            ->where(function ($query) {
                $query
                    ->whereHas('payment', fn($q) => $q->where('status', 'paid'))
                    ->orWhereHas('subscription', fn($q) => $q->where('price', 0));
            })
            ->latest('ends_at')
            ->first();
    }
}


if (!function_exists('walletBalance')) {
    function walletBalance(User $user)
    {

        $wallet = $user->wallet;

        if (!$wallet) {
            return 0;
        }

        return $wallet->balance;
    }
}

if (!function_exists('chargeWallet')) {
    function chargeWallet(Payment $payment)
    {
        $user = auth()->user();

        $wallet = $user->wallet()->firstOrCreate(['user_id' => $user->id]);

        $wallet->increment('balance', $payment->amount);

        $wallet->transactions()->create([
            'type' => 'credit',
            'amount' => $payment->amount,
            'payment_id' => $payment->id,
            'description' => 'شارژ کیف پول',
        ]);
    }
}

if (!function_exists('useWallet')) {
    function useWallet(int $amount, string $description = 'خرید از کیف پول', ?Payment $payment = null)
    {
        $user = auth()->user();
        $wallet = $user->wallet;

        if (!$wallet || $wallet->balance < $amount) {
            return false;
        }

        DB::transaction(function () use ($wallet, $amount, $description, $payment) {
            $wallet->decrement('balance', $amount);
            $wallet->transactions()->create([
                'type' => 'debit',
                'amount' => $amount,
                'payment_id' => $payment?->id,
                'description' => $description,
            ]);
        });

        return true;
    }
}

if (!function_exists('getSliders')) {
    function getSliders()
    {
        return Slider::where('is_active', true)
            ->orderBy('order')
            ->get();
    }
}

if (!function_exists('getBanners')) {
    function getBanners()
    {
        return Banner::where('is_active', true)
            ->orderBy('order')
            ->get();
    }
}


/**
 * گرفتن یا ساختن رکورد محدودیت روزانه برای کاربر در تاریخ امروز.
 */
if (!function_exists('getUserDailyLimit')) {
    function getUserDailyLimit(User $user): UserDailyLimit
    {
        return UserDailyLimit::firstOrCreate(
            [
                'user_id' => $user->id,
                'date' => Carbon::today()->toDateString(),
            ],
            [
                'searches_count' => 0,
            ]
        );
    }
}

/**
 * بررسی اینکه آیا کاربر به سقف مجاز جستجوی روزانه خود رسیده است یا نه.
 */
if (!function_exists('hasReachedSearchLimit')) {
    function hasReachedSearchLimit(User $user): bool
    {
        $limit = getUserDailyLimit($user);
        $sub = getCurrentSubscript();
        $max = optional($sub->subscription)->daily_search_limit ?? 0;
        return $limit->searches_count >= $max;
    }
}


/**
 * افزایش شمارنده جستجوی روزانه برای کاربر به اندازه ۱.
 */
if (!function_exists('incrementSearchCount')) {
    function incrementSearchCount(User $user): void
    {
        $limit = getUserDailyLimit($user);
        $limit->increment('searches_count');
    }
}

if (!function_exists('getSegmentLimit')) {
    function getSegmentLimit()
    {
        return getCurrentSubscript()->subscription->daily_segment_limit;
    }
}

/**
 * بررسی اینکه آیا کاربر به سقف مجاز جستجوی روزانه خود رسیده است یا نه برای پلن رایگان.
 */
if (!function_exists('hasReachedSearchLimitFreePlan')) {
    function hasReachedSearchLimitFreePlan(User $user): bool
    {
        $limit = getUserDailyLimit($user);
        $max = 3;
        return $limit->searches_count >= $max;
    }
}