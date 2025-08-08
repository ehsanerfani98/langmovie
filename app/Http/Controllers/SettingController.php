<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:setting-list', ['only' => ['edit']]);
        $this->middleware('permission:setting-edit', ['only' => ['update']]);
    }

    public function edit()
    {
        $settings = get_settings();
        return view('admin.setting.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        update_setting('payment_gateway_type', $request->payment_gateway_type);
        update_setting('payment_gateway_status', $request->payment_gateway_status);
        update_setting('merchantId', $request->merchantId);
        update_setting('payment_gateway_unit', $request->payment_gateway_unit);
        update_setting('apiKey', $request->apiKey);
        update_setting('originator', $request->originator);
        update_setting('patternCode', $request->patternCode);
        update_setting('sms_status', $request->sms_status);
        return redirect()->back()->with('success', 'تنظیمات با موفقیت ذخیره شد.');

    }
}
