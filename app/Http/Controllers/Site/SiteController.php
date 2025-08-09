<?php

namespace App\Http\Controllers\Site;

use App\Facades\ZarinPal;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\UserSubscription;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{

    public function subscript_plans(Request $request)
    {
        $status_payment = $request->has('status_payment') && $request->status_payment == 'upgrade' ? true : false;
        $subscriptions = Subscription::where('is_active', 1)->get();
        return view('site.subscript_plans', compact(['subscriptions', 'status_payment']));
    }

    public function select_subscription(Request $request, $subscription_id)
    {
        $status_payment = $request->has('status_payment') && $request->status_payment == true ? true : false;

        if (!$status_payment) {
            if (auth()->user()->hasActiveSubscription()) {
                return redirect()->back()->with('error', 'شما یک اشتراک فعال دارید');
            }

            $newSubscription = Subscription::findOrFail($subscription_id);

            if ($newSubscription->price == 0) {
                $userSub = UserSubscription::create([
                    'user_id' => Auth::id(),
                    'subscription_id' => $newSubscription->id,
                    'starts_at' => now(),
                    'ends_at' => now()->addDays((int) $newSubscription->duration_days),
                ]);

                return redirect()->route('user.home')->with('success', 'اشتراک رایگان شما با موفقیت فعال شد');
            }
        }

        if ($status_payment) {
            $newSubscription = Subscription::findOrFail($subscription_id);

            $activeSubscription = getCurrentSubscript();

            if (!$activeSubscription) {
                return redirect()->back()->with('error', 'هیچ اشتراک فعالی برای ارتقا یافت نشد');
            }

            // if ($activeSubscription->subscription->duration_days >= $newSubscription->duration_days) {
            //     return redirect()->back()->with('error', 'این اشتراک قبلا خریداری شده است');
            // }

        }


        return view('site.payment_type', compact(['subscription_id', 'status_payment']));
    }

    public function payment_subscription(Request $request)
    {
        $status_payment = $request->has('status_payment') && $request->status_payment == true ? true : false;

        if (!$status_payment) {
            if (auth()->user()->hasActiveSubscription()) {
                return redirect()->route('user.doc.register')->with('error', 'شما یک اشتراک فعال دارید');
            }
        }

        $subscription = Subscription::findOrFail($request->subscription_id);

        if ($request->gateway == 'zarinpal') {

            $payment = Payment::create([
                'user_id' => auth()->id(),
                'type' => 'subscription_direct',
                'amount' => $subscription->price,
                'status' => 'pending',
                'description' => $status_payment ? 'ارتقا اشتراک عضویت / ' . $subscription->name : 'خرید اشتراک عضویت / ' . $subscription->name,
            ]);

            $result = ZarinPal::request(
                $subscription->price,
                route('user.subscript.payment.verify', ['subscription_id' => $subscription->id, 'payment_id' => $payment->id, 'status_payment' => $status_payment]),
                $status_payment ? 'ارتقا اشتراک عضویت / ' . $subscription->name : 'خرید اشتراک عضویت / ' . $subscription->name,
                '',
                auth()->user()->phone,
                get_setting('payment_gateway_unit')
            );

            if ($result['success']) {
                $payment->authority = $result['authority'];
                $payment->save();
                return redirect($result['paymentUrl']);
            } else {
                return 'Error: ' . $result['error']['message'];
            }
        } elseif ($request->gateway == 'wallet') {
            $payment = Payment::create([
                'user_id' => auth()->id(),
                'type' => 'subscription_wallet',
                'amount' => $subscription->price,
                'status' => 'pending',
                'description' => $status_payment ? 'ارتقا اشتراک عضویت / ' . $subscription->name : 'خرید اشتراک عضویت / ' . $subscription->name,
            ]);
            $status_wallet = useWallet($subscription->price, $status_payment ? 'ارتقا اشتراک عضویت / ' . $subscription->name : 'خرید اشتراک عضویت / ' . $subscription->name, $payment);
            if ($status_wallet) {
                if ($status_payment) {
                    $remainingDays = remainingDays();
                    $payment->update(['status' => 'paid', 'description' => 'ارتقا اشتراک عضویت / ' . $subscription->name . ' + ' . $remainingDays . ' روز اشتراک قبلی ']);
                    $this->upgrade_subscript($subscription->id, $payment, $remainingDays);
                    return redirect()->route('user.home')->with('success', 'پرداخت با موفقیت انجام شد');
                } else {
                    $payment->update(['status' => 'paid']);
                    $userSub = UserSubscription::create([
                        'user_id' => $payment->user_id,
                        'subscription_id' => $subscription->id,
                        'starts_at' => now(),
                        'ends_at' => now()->addDays((int) $subscription->duration_days),
                    ]);
                    $payment->update(['user_subscription_id' => $userSub->id]);
                    return redirect()->route('user.home')->with('success', 'پرداخت با موفقیت انجام شد');
                }
            } else {
                return redirect()->route('user.home')->with('success', 'موجودی کیف پول کافی نیست');
            }
        }
    }

    public function payment_verify_subscription(Request $request)
    {

        $status_payment = $request->has('status_payment') && $request->status_payment == true ? true : false;

        $payment = Payment::where('id', $request->payment_id)->first();
        $authority = $request->input('Authority');
        $status = $request->input('Status');

        if ($status !== 'OK') {
            $payment->update(['status' => 'failed']);
            return redirect()->route('user.home')->with('error', 'پرداخت انجام نشد');
        }

        $subscription = Subscription::findOrFail($request->subscription_id);

        $result = ZarinPal::verify($authority, $subscription->price);

        if ($result['success']) {

            $referenceId = $result['referenceId'];

            if ($payment && $payment->status === 'pending') {
                $redirect = DB::transaction(function () use ($payment, $subscription, $referenceId, $status_payment) {
                    if ($status_payment) {
                        $remainingDays = remainingDays();
                        $payment->update(['status' => 'paid', 'transaction_id' => $referenceId, 'description' => 'ارتقا اشتراک عضویت / ' . $subscription->name . ' + ' . $remainingDays . ' روز اشتراک قبلی ']);
                        $this->upgrade_subscript($subscription->id, $payment, $remainingDays);
                        return redirect()->route('user.doc.register')->with('success', 'ارتقای اشتراک با موفقیت انجام شد');
                    } else {
                        $payment->update(['status' => 'paid', 'transaction_id' => $referenceId]);
                        $userSub = UserSubscription::create([
                            'user_id' => $payment->user_id,
                            'subscription_id' => $subscription->id,
                            'starts_at' => now(),
                            'ends_at' => now()->addDays((int) $subscription->duration_days),
                        ]);
                        $payment->update(['user_subscription_id' => $userSub->id]);
                        return redirect()->route('user.home')->with('success', 'پرداخت با موفقیت انجام شد');
                    }
                });
                return $redirect;
            }
        } else {
            $payment->update(['status' => 'failed']);
            return redirect()->route('user.home')->with('error', 'پرداخت ناموفق بود. لطفاً مجدداً تلاش کنید.' . $result['error']['message']);
        }
    }

    public function upgrade_subscript($subscription_id, $payment, $remainingDays)
    {

        $user = auth()->user();
        $newSubscription = Subscription::findOrFail($subscription_id);

        // انقضای اشتراک فعلی
        getCurrentSubscript()->update([
            'ends_at' => now(),
        ]);

        $totalDays = (int) $newSubscription->duration_days + (int) $remainingDays;
        $startsAt = now();
        $endsAt = (clone $startsAt)->addDays($totalDays);

        $userSubscription = UserSubscription::create([
            'user_id' => $user->id,
            'subscription_id' => $newSubscription->id,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
        ]);

        $payment->update(['user_subscription_id' => $userSubscription->id]);

        return true;
    }
    // public function player(Request $request)
    // {
    //     $user = Auth::user();

    //     if (hasReachedSearchLimit($user)) {
    //         return redirect()->back()->with('error', 'تعداد جستجو روزانه شما به اتمام رسید!');
    //     }

    //     $query = $request->input('q');

    //     $videosQuery = Video::query();

    //     if ($query) {
    //         $videosQuery->where('title', 'like', "%{$query}%");
    //     }

    //     $allVideos = $videosQuery->get();
    //     $randomVideos = $allVideos->shuffle()->take(getSegmentLimit())->map(fn($video) => [
    //         'video' => $video->video,
    //         'subtitle' => $video->subtitle,
    //     ]);

    //     if ($randomVideos->isNotEmpty()) {
    //         incrementSearchCount($user);

    //         return view('site.video_player', [
    //             'videos' => $randomVideos,
    //             'highlight' => $query,
    //         ]);
    //     }

    //     return redirect()->back()->with('error', 'در حال حاضر سکانسی برای این ویدیو یافت نشد!');
    // }


    public function player(Request $request)
    {
        $request->validate(
            [
                'q' => 'required|min:3',
            ],
            [
                'q.required' => "لطفا یک عبارت برای جستجو وارد کنید",
                'q.min' => "عبارتی که وارد می کنید باید حداقل ۳ حرف داشته باشد"
            ]
        );

        $user = Auth::user();
        $query = strtolower($request->input('q'));

        // ================= کاربران دارای اشتراک =================
        if ($user->hasActiveSubscription()) {
            if (!$query) {
                $allVideos = Video::all();

                $randomVideos = $allVideos
                    ->filter(fn($video) => !empty($video->video))
                    ->shuffle()
                    ->map(function ($video) {
                        $firstItem = collect($video->video)->first();

                        return [
                            'video' => 'https://dl.langmovie.ir/' . ltrim($firstItem['url'], '/'),
                            'subtitle' => 'https://dl.langmovie.ir/' . ltrim($firstItem['subtitle'], '/'),
                        ];
                    });

                return view('site.video_player', [
                    'videos' => $randomVideos,
                    'highlight' => null,
                ]);
            }

            $cacheKey = "video_search_pro:{$query}";

            $randomVideos = Cache::remember($cacheKey, now()->addHours(24), function () use ($query) {
                $videosQuery = Video::query();

                $videosQuery->whereRaw('LOWER(title) LIKE ?', ['%' . $query . '%']);
                $allVideos = $videosQuery->get();

                return $allVideos
                    ->filter(fn($video) => !empty($video->video))
                    ->shuffle()
                    ->map(function ($video) {
                        $firstItem = collect($video->video)->first();

                        return [
                            'video' => 'https://dl.langmovie.ir/' . ltrim($firstItem['url'], '/'),
                            'subtitle' => 'https://dl.langmovie.ir/' . ltrim($firstItem['subtitle'], '/'),
                        ];
                    });
            });

            if ($randomVideos->isNotEmpty()) {
                return view('site.video_player', [
                    'videos' => $randomVideos,
                    'highlight' => $query,
                ]);
            }
        } else {
            // ================= کاربران بدون اشتراک =================
            if (hasReachedSearchLimitFreePlan($user)) {
                return redirect()->route('user.subscript.plans')->with('error2', "تعداد جستجوهای شما برای امروز به پایان رسید!🙄 <br>فردا دوباره سر بزن😊 <hr>اگه میخوای نامحدود استفاده کنی ، یکی از اشتراک های زیر رو تهیه کن ، حالشو ببر🥰");
            }

            if (!$query) {
                $allVideos = Video::all();

                $randomVideos = $allVideos
                    ->filter(fn($video) => !empty($video->video))
                    ->shuffle()
                    ->take(3)
                    ->map(function ($video) {
                        $firstItem = collect($video->video)->first();

                        return [
                            'video' => 'https://dl.langmovie.ir/' . ltrim($firstItem['url'], '/'),
                            'subtitle' => 'https://dl.langmovie.ir/' . ltrim($firstItem['subtitle'], '/'),
                        ];
                    });

                return view('site.video_player', [
                    'videos' => $randomVideos,
                    'highlight' => null,
                ]);
            }

            $cacheKey = "video_search_free:{$query}";

            $randomVideos = Cache::remember($cacheKey, now()->addHours(24), function () use ($query) {
                $videosQuery = Video::query();

                $videosQuery->whereRaw('LOWER(title) LIKE ?', ['%' . $query . '%']);
                $allVideos = $videosQuery->get();

                return $allVideos
                    ->filter(fn($video) => !empty($video->video))
                    ->shuffle()
                    ->take(3)
                    ->map(function ($video) {
                        $firstItem = collect($video->video)->first();

                        return [
                            'video' => 'https://dl.langmovie.ir/' . ltrim($firstItem['url'], '/'),
                            'subtitle' => 'https://dl.langmovie.ir/' . ltrim($firstItem['subtitle'], '/'),
                        ];
                    });
            });

            if ($randomVideos->isNotEmpty()) {
                incrementSearchCount($user);

                return view('site.video_player', [
                    'videos' => $randomVideos,
                    'highlight' => $query,
                ]);
            }
        }

        return redirect()->back()->with('error', 'در حال حاضر سکانسی برای این ویدیو یافت نشد!');
    }
}
