@extends('layout')

@push('style')
    <style>
        /* Privacy Policy Page Styles */
        .privacy-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .privacy-section {
            margin-bottom: 2.5rem;
        }

        .privacy-title {
            position: relative;
            padding-right: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .privacy-title:before {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background-color: #fb9ab7;
            border-radius: 50%;
        }

        .privacy-list {
            list-style-type: none;
            counter-reset: privacy-counter;
        }

        .privacy-list li {
            position: relative;
            padding-right: 2rem;
            margin-bottom: 1rem;
            counter-increment: privacy-counter;
        }

        .privacy-list li:before {
            content: counter(privacy-counter);
            position: absolute;
            right: 0;
            top: 0;
            background-color: #fb9ab7;
            color: white;
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        .note-box {
            background-color: #ffeff4;
            border-right: 4px solid #ea7699;
            padding: 1.5rem;
            border-radius: 0 8px 8px 0;
            margin: 1.5rem 0;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
        }

        .data-table th, .data-table td {
            padding: 1rem;
            border: 1px solid #e2e8f0;
            text-align: right;
        }

        .data-table th {
            background-color: #f8fafc;
            font-weight: 600;
        }
    </style>
@endpush
@section('content')
    <div class="container mx-auto privacy-container py-10">
        <div class="bg-white rounded-xl shadow-md p-8 md:p-12">
            <!-- عنوان صفحه -->
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-primary mb-4">سیاست حفظ حریم خصوصی لنگ مووی</h1>
                <p class="text-gray-600">آخرین بروزرسانی: مرداد ۱۴۰۴</p>
            </div>

            <!-- مقدمه -->
            <div class="privacy-section">
                <p class="text-gray-700 mb-6">
                    ما در لنگ مووی برای حریم خصوصی کاربران ارزش ویژه‌ای قائل هستیم و متعهدیم از اطلاعات شخصی که در اختیار ما قرار می‌دهید، به‌طور کامل محافظت کنیم.
                </p>
                <p class="text-gray-700">
                    از آنجا که در ارائه خدمات اینترنتی و موبایلی، جمع‌آوری و پردازش برخی داده‌ها اجتناب‌ناپذیر است، لطفاً این سیاست حفظ حریم خصوصی را به‌دقت مطالعه کنید. همچنین ممکن است در آینده، پیام‌ها یا اطلاعیه‌هایی درباره تغییرات سیاست‌های حریم خصوصی از طریق حساب کاربری یا ایمیل برایتان ارسال شود.
                </p>
            </div>

            <!-- بخش اطلاعات جمع‌آوری شده -->
            <div class="privacy-section">
                <h2 class="text-2xl font-bold privacy-title">چه اطلاعاتی از شما جمع‌آوری می‌کنیم؟</h2>
                <p class="text-gray-700 mb-4">
                    اطلاعات شما ممکن است در دو حالت جمع‌آوری شود:
                </p>
                <ul class="privacy-list">
                    <li class="mb-4">به‌صورت خودکار هنگام استفاده از خدمات لنگ مووی (مانند گزارش‌های فنی، اطلاعات سرور، و داده‌های مربوط به دستگاه)</li>
                    <li class="mb-4">به‌طور مستقیم زمانی که اطلاعات را خودتان در اختیار ما می‌گذارید (مثل ثبت‌نام، ارتباط با پشتیبانی یا پر کردن فرم‌ها)</li>
                </ul>

                <div class="note-box">
                    <h3 class="font-bold text-lg text-primary mb-3">این داده‌ها می‌تواند شامل موارد زیر باشد:</h3>
                    <ul class="list-disc pr-5 text-gray-700">
                        <li class="mb-2">نوع دستگاه، سیستم‌عامل و زبان آن</li>
                        <li class="mb-2">شناسه منحصربه‌فرد دستگاه</li>
                        <li class="mb-2">سوابق جستجو و انتخاب‌های شما</li>
                        <li class="mb-2">اطلاعات ثبت‌نام شامل شماره تلفن همراه، آدرس ایمیل و رمز عبور (به‌صورت رمزنگاری‌شده)</li>
                        <li class="mb-2">جزئیات خریدها و تراکنش‌های انجام‌شده در سایت</li>
                    </ul>
                </div>
            </div>

            <!-- بخش اهداف جمع‌آوری -->
            <div class="privacy-section">
                <h2 class="text-2xl font-bold privacy-title">هدف از جمع‌آوری اطلاعات</h2>
                <p class="text-gray-700 mb-4">
                    ما از داده‌های جمع‌آوری‌شده برای اهداف زیر استفاده می‌کنیم:
                </p>
                <ul class="privacy-list">
                    <li class="mb-4">تحلیل عملکرد وب‌سایت و رفع مشکلات فنی</li>
                    <li class="mb-4">افزایش امنیت و جلوگیری از سوءاستفاده‌ها</li>
                    <li class="mb-4">بهبود تجربه کاربری و انطباق خدمات با نیازهای شما</li>
                    <li class="mb-4">تحلیل رفتار کاربران برای بهینه‌سازی پیشنهادها و محتوای ارائه‌شده</li>
                    <li class="mb-4">پردازش تراکنش‌ها و خریدهای شما</li>
                    <li class="mb-4">نمایش پیشنهادهای مرتبط یا پرطرفدار</li>
                </ul>
            </div>

            <!-- بخش اشتراک اطلاعات -->
            <div class="privacy-section">
                <h2 class="text-2xl font-bold privacy-title">اشتراک‌گذاری اطلاعات با دیگران</h2>
                <ul class="privacy-list">
                    <li class="mb-4">لنگ مووی به هیچ عنوان اطلاعات شخصی شما را به اشخاص یا شرکت‌های ثالث نمی‌فروشد.</li>
                    <li class="mb-4">تنها در صورت الزام قانونی یا دریافت دستور از مراجع قضایی ذی‌صلاح، ممکن است بخشی از اطلاعات شما در اختیار نهادهای مربوطه قرار گیرد.</li>
                </ul>
            </div>

            <!-- بخش امنیت -->
            <div class="privacy-section">
                <h2 class="text-2xl font-bold privacy-title">امنیت اطلاعات شخصی شما</h2>
                <ul class="privacy-list">
                    <li class="mb-4">حفاظت از اطلاعات حساب کاربری، یکی از اولویت‌های اصلی ماست.</li>
                    <li class="mb-4">اگر تلفن همراه شما گم یا سرقت شد، یا قصد تغییر ایمیل و شماره تلفن مرتبط با حساب خود را داشتید، سریعاً به ما اطلاع دهید تا بتوانیم حساب شما را ایمن‌سازی یا مسدود کنیم.</li>
                    <li class="mb-4">مسئولیت محافظت از رمز عبور و جلوگیری از دسترسی افراد غیرمجاز به حساب کاربری بر عهده شماست. لنگ مووی در صورت استفاده یا سوءاستفاده شخص ثالث از حساب شما، مسئولیتی نخواهد داشت.</li>
                </ul>
            </div>

            <!-- نتیجه‌گیری -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h3 class="text-xl font-bold text-primary mb-4">تغییرات در سیاست حفظ حریم خصوصی</h3>
                <p class="text-gray-700 mb-6">
                    ما ممکن است این سیاست حفظ حریم خصوصی را به‌صورت دوره‌ای به‌روزرسانی کنیم. در صورت ایجاد تغییرات مهم، از طریق ایمیل یا اعلان درون‌برنامه‌ای شما را مطلع خواهیم کرد.
                </p>
                <p class="text-gray-700">
                    در صورت داشتن هرگونه سوال درباره این سیاست‌ها، لطفاً از طریق اطلاعات تماس موجود در سایت با ما ارتباط برقرار کنید.
                </p>
            </div>
        </div>
    </div>
@endsection