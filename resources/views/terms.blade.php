@extends('layout')

@push('style')
    <style>
        /* Terms Page Styles */
        .terms-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .terms-section {
            margin-bottom: 2.5rem;
        }

        .terms-title {
            position: relative;
            padding-right: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .terms-title:before {
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

        .terms-list {
            list-style-type: none;
            counter-reset: terms-counter;
        }

        .terms-list li {
            position: relative;
            padding-right: 2rem;
            margin-bottom: 1rem;
            counter-increment: terms-counter;
        }

        .terms-list li:before {
            content: counter(terms-counter);
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

        .highlight-box {
            background-color: #ffeff4;
            border-right: 4px solid #ea7699;
            padding: 1.5rem;
            border-radius: 0 8px 8px 0;
            margin: 1.5rem 0;
        }
    </style>
@endpush
@section('content')
    <div class="container mx-auto terms-container py-10">
        <div class="bg-white rounded-xl shadow-md p-8 md:p-12">
            <!-- عنوان صفحه -->
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-primary mb-4">قوانین استفاده از خدمات لنگ مووی</h1>
                <p class="text-gray-600">آخرین بروزرسانی: مرداد ۱۴۰۴</p>
            </div>

            <!-- مقدمه -->
            <div class="terms-section">
                <p class="text-gray-700 mb-6">
                    این صفحه توضیحاتی درباره شرایط استفاده از وب‌سایت لنگ مووی به آدرس LangMovie.ir و تمامی سرویس‌ها، امکانات و خدمات ارائه‌شده در آن را بیان می‌کند.
                    با دسترسی یا استفاده از خدمات ما، به این شرایط متعهد می‌شوید. لطفاً پیش از استفاده، این متن را به‌دقت مطالعه کرده و در صورت وجود هرگونه سؤال، از طریق راه‌های ارتباطی ما پرس‌وجو کنید.
                </p>
            </div>


            <!-- بخش قوانین -->
            <div class="terms-section">
                <h2 class="text-2xl font-bold terms-title">حساب کاربری</h2>
                <ul class="terms-list">
                    <li class="mb-4">برای استفاده از برخی امکانات وب‌سایت، ممکن است نیاز به ایجاد حساب کاربری داشته باشید.</li>
                    <li class="mb-4">ثبت اطلاعاتی مانند شماره تلفن همراه یا ایمیل معتبر، بخشی از فرآیند ثبت‌نام است و کاربر موظف است اطلاعات صحیح و به‌روز ارائه کند.</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2 class="text-2xl font-bold terms-title">مالکیت محتوا</h2>
                <ul class="terms-list">
                    <li class="mb-4">تمامی محتوای موجود در لنگ مووی شامل متن‌ها، تصاویر، ویدئوها، طراحی گرافیکی، رابط کاربری، کدهای برنامه، لوگو و نام تجاری، متعلق به لنگ مووی است و تحت حمایت قوانین کپی‌رایت و مالکیت فکری قرار دارد.</li>
                    <li class="mb-4">استفاده از این موارد بدون دریافت مجوز کتبی از لنگ مووی، ممنوع است. کاربران تنها در چارچوب قوانین و با اجازه رسمی می‌توانند از این محتوا بهره‌برداری کنند.</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2 class="text-2xl font-bold terms-title">تغییر یا توقف خدمات</h2>
                <ul class="terms-list">
                    <li class="mb-4">ما همواره در تلاشیم خدمات و امکانات سایت را بهبود دهیم. به همین دلیل، ممکن است برخی ویژگی‌ها تغییر، حذف یا جایگزین شوند و یا خدمات جدیدی اضافه گردد.</li>
                    <li class="mb-4">در برخی موارد نیز امکان دارد بخشی از سرویس‌ها به‌طور موقت یا دائم متوقف شوند. ادامه استفاده از خدمات پس از اعمال تغییرات، به معنی پذیرش نسخه جدید شرایط استفاده خواهد بود.</li>
                    <li class="mb-4">اگر تصمیم گرفتید دیگر از خدمات لنگ مووی استفاده نکنید، می‌توانید با ما تماس بگیرید تا حساب کاربری شما غیرفعال شود. توجه داشته باشید که برخی اطلاعات مانند سوابق تراکنش‌ها، طبق الزامات قانونی، قابل حذف نخواهند بود.</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2 class="text-2xl font-bold terms-title">تخلف از شرایط استفاده</h2>
                <ul class="terms-list">
                    <li class="mb-4">دسترسی به خدمات و محتوای لنگ مووی تنها از طریق وب‌سایت رسمی ما مجاز است.</li>
                    <li class="mb-4">استفاده از ربات‌ها، اسکریپرها، کرولرها یا هر ابزار مشابه برای دریافت محتوا یا دستکاری خدمات، موجب مسدود شدن دائم حساب کاربری و لغو اشتراک بدون بازگشت وجه خواهد شد.</li>
                </ul>
            </div>

            <div class="terms-section">
                <h2 class="text-2xl font-bold terms-title">به‌روزرسانی این شرایط</h2>
                <ul class="terms-list">
                    <li class="mb-4">شرایط استفاده ممکن است در گذر زمان تغییر کند. در صورت بروز تغییرات مهم، کاربران از طریق اعلان در سایت یا ایمیل مطلع خواهند شد.</li>
                    <li class="mb-4">نسخه به‌روزشده جایگزین نسخه قبلی خواهد شد.</li>
                </ul>
            </div>

            <div class="terms-section">
                <div class="highlight-box">
                    <h3 class="font-bold text-lg text-primary">توجه مهم:</h3>
                    <p class="text-gray-700">
                        این قوانین ممکن است در آینده تغییر کند. هر گونه تغییر در قوانین در همین صفحه منتشر خواهد شد و ادامه
                        استفاده از اپلیکیشن پس از اعمال تغییرات به منزله پذیرش شرایط جدید توسط شما خواهد بود.
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection