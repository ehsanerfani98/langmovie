<?php

use App\Facades\ZarinPal;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfobillController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\OtpLoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SendbillController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDailyLimitController;
use App\Http\Controllers\UserDocumentController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\WalletController;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/terms', function () {
    return view('terms');
})->name('terms');
Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

// Route::get('/upload/submit', function (Request $request) {
//     dd($request->all());
// })->name('upload.submit');



Auth::routes();


// =========================================== Dashboard Route =========================================== //
Route::middleware(['auth', 'redirect.by.role'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('services', ServiceController::class);
    Route::get('settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('subscriptions', SubscriptionController::class);

    Route::resource('documents', UserDocumentController::class);
    Route::delete('documents/files/{id}', [UserDocumentController::class, 'deleteFile'])->name('documents.files.destroy');
    Route::resource('transactions', TransactionController::class);
    Route::resource('wallets', WalletController::class);
    // Route::resource('subscriptions', SubscriptionsController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('dailylimits', UserDailyLimitController::class);
    Route::resource('video', VideoController::class);
    Route::post('users/{user}/unblock', [UserController::class, 'unblock'])->name('users.unblock');
});

Route::middleware(['auth'])->group(function () {
    Route::get('users/profile/edit', [UserController::class, 'user_edit_profile'])->name('users.edit.profile');
    Route::put('users/profile/update', [UserController::class, 'user_update_profile'])->name('users.update.profile');
    Route::resource('users', UserController::class);
});


// =========================================== Site Route =========================================== //
// Route::middleware(['auth', 'profile.complete', 'hasActiveSubscription'])->group(function () {
Route::middleware(['auth', 'rate.limit.blocker'])->group(function () {
    // Route::get('user/buy/service/{id}', [\App\Http\Controllers\Site\UserController::class, 'buy_service'])->name('user.buy.service');
    Route::get('player', [SiteController::class, 'player'])->name('user.video.player');
});

Route::middleware(['auth'])->group(function () {
    Route::get('user/home', [\App\Http\Controllers\Site\UserController::class, 'home'])->name('user.home');
    Route::get('user/edit/profile', [\App\Http\Controllers\Site\UserController::class, 'edit_profile'])->name('user.profile.edit');
    Route::put('user/doc/store', [\App\Http\Controllers\Site\UserController::class, 'store_docs'])->name('user.doc.store');
    Route::put('user/doc/store', [\App\Http\Controllers\Site\UserController::class, 'store_docs'])->name('user.doc.store');
    Route::get('user/transactions', [\App\Http\Controllers\Site\UserController::class, 'user_transactions'])->name('user.transactions');
    Route::get('user/subscriptions', [\App\Http\Controllers\Site\UserController::class, 'user_subscriptions'])->name('user.subscriptions');
    Route::get('user/profile/details', [\App\Http\Controllers\Site\UserController::class, 'user_profile_details'])->name('user.profile.details');
    Route::get('user/wallet', [\App\Http\Controllers\Site\UserController::class, 'user_wallet'])->name('user.wallet');
    Route::post('user/wallet/payment', [\App\Http\Controllers\Site\UserController::class, 'user_wallet_payment'])->name('user.wallet.payment');
    Route::get('user/wallet/payment/verify', [\App\Http\Controllers\Site\UserController::class, 'user_wallet_payment_verify'])->name('user.wallet.payment.verify');
    Route::get('user/subscriptions/expire', [\App\Http\Controllers\Site\UserController::class, 'expire_sub'])->name('user.subscriptions.expire');
    Route::get('subscript/plans', [SiteController::class, 'subscript_plans'])->name('user.subscript.plans');
    Route::post('subscript/select/{subscription_id}', [SiteController::class, 'select_subscription'])->name('user.subscript.select');
    Route::post('subscript/payment', [SiteController::class, 'payment_subscription'])->name('user.subscript.payment');
    Route::get('subscript/payment/verify/', [SiteController::class, 'payment_verify_subscription'])->name('user.subscript.payment.verify');
    Route::post('/upload-temp-file', [UploadController::class, 'uploadTemp'])->name('upload.temporary.file');
});

Route::middleware(['auth'])->group(function () {
    Route::get('user/doc/register', [\App\Http\Controllers\Site\UserController::class, 'doc_register'])->name('user.doc.register');
});

// =========================================== Otp Route =========================================== //
Route::post('/otp/send', [OtpController::class, 'send'])->middleware('throttle:5,1');
Route::post('/otp/verify', [OtpController::class, 'verify']);
Route::get('/login-otp', [OtpLoginController::class, 'showLoginForm'])->name('login.otp');
Route::get('/register-otp', [OtpLoginController::class, 'showRegistrationForm'])->name('otp.register');
Route::post('/register-otp/complete', [OtpLoginController::class, 'completeRegistration'])->name('otp.register.complete');






// Route::get('/create-data', function () {


//     $user = User::create(
//         [
//             // 'name' => 'احسان باوقار',
//             // 'email' => 'admin@admin.com',
//             'password' => Hash::make('12345678'),
//             'phone' => '09191816172',
//         ]
//     );


//     $permisions = [
//         'user-list' => 'لیست کاربران',
//         'user-create' => 'ایجاد کاربر',
//         'user-edit' => 'ویرایش کاربر',
//         'user-delete' => 'حذف کاربر',
//         'role-list' => 'لیست نقش ها',
//         'role-create' => 'ایجاد نقش',
//         'role-edit' => 'ویرایش نقش',
//         'role-delete' => 'حذف نقش',
//         'setting-list' => 'لیست تنظیمات',
//         'setting-edit' => 'ویرایش تنظیمات',
//         'subscrib-list' => 'لیست اشتراک ها',
//         'subscrib-create' => 'ایجاد اشتراک جدید',
//         'subscrib-edit' => 'ویرایش اشتراک',
//         'subscrib-delete' => 'حذف اشتراک',
//         'slider-list' => 'لیست اسلایدر ها',
//         'slider-create' => 'ایجاد اسلایدر جدید',
//         'slider-edit' => 'ویرایش اسلایدر',
//         'slider-delete' => 'حذف اسلایدر',
//         'banner-list' => 'لیست بنر ها',
//         'banner-create' => 'ایجاد بنر جدید',
//         'banner-edit' => 'ویرایش بنر',
//         'banner-delete' => 'حذف بنر',
//         'video-list' => 'لیست ویدیو ها',
//         'video-create' => 'ایجاد ویدیو جدید',
//         'video-edit' => 'ویرایش ویدیو',
//         'video-delete' => 'حذف ویدیو',
//         'dashboard' => 'پیشخوان',
//     ];

//     foreach ($permisions as $name => $title) {
//         Permission::create(
//             [
//                 'name' => $name,
//                 'title' => $title,
//                 'guard_name' => 'web'
//             ]
//         );
//     }

//     $role = Role::create(
//         [
//             'name' => 'Admin',
//             'title' => 'ادمین',
//             'guard_name' => 'web'
//         ]
//     );

//     $permissionsID = Permission::pluck('id');
//     $role = Role::where('id', $role->id)->first();
//     $role->syncPermissions($permissionsID);
//     $user->assignRole('Admin');


//     // $user->givePermissionTo('role-list');
//     // $user->givePermissionTo('role-create');
//     // $user->givePermissionTo('role-edit');
//     // $user->givePermissionTo('role-delete');
//     // $user->givePermissionTo('dashboard');
//     // $user->givePermissionTo('user-list');
//     // $user->givePermissionTo('user-create');
//     // $user->givePermissionTo('user-edit');
//     // $user->givePermissionTo('user-delete');
//     // $user->givePermissionTo('user-login-mobile');
//     // $user->givePermissionTo('setting-list');
//     // $user->givePermissionTo('setting-edit');

//     // dd($user->getPermissionNames());

//     return 'دیتا با موفقیت ساخته شد';
// });



// Route::get('/create-permissions', function () {

//     $permisions = [
//         'video-list' => 'لیست ویدیو ها',
//         'video-create' => 'ایجاد ویدیو جدید',
//         'video-edit' => 'ویرایش ویدیو',
//         'video-delete' => 'حذف ویدیو',
//     ];

//     foreach ($permisions as $name => $title) {
//         Permission::create(
//             [
//                 'name' => $name,
//                 'title' => $title,
//                 'guard_name' => 'web'
//             ]
//         );
//     }

//     return 'دیتا با موفقیت ساخته شد';
// });


// Route::get('order', function (Request $request) {

//     $result = ZarinPal::request(
//         500000,
//         "http://127.0.0.1:8000/payment-test",
//         'خرید نشان معتبر',
//         'customer@example.com',
//         '09123456789',
//         get_setting('payment_gateway_unit')
//     );

//     if ($result['success']) {
//         // Store the authority for verification later
//         $authority = $result['authority'];

//         // Redirect the user to ZarinPal payment page
//         return redirect($result['paymentUrl']);
//     } else {
//         // Handle error
//         return 'Error: ' . $result['error']['message'];
//     }
// })->name('order');

// Route::get('payment-test', function (Request $request) {
//     $authority = $request->input('Authority');
//     $status = $request->input('Status');

//     if ($status !== 'OK') {
//         return 'Payment was canceled by user.';
//     }

//     // Verify the payment
//     $result = ZarinPal::verify($authority, 500000);

//     if ($result['success']) {
//         $referenceId = $result['referenceId'];
//         dd($result);
//         // return redirect()->route('timeline');
//     } else {
//         return 'Error in payment verification: ' . $result['error']['message'];
//     }
// });
