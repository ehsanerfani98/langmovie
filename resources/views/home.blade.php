@extends('layout')

@section('content')
    <!-- معرفی اپلیکیشن -->
    <section class="py-16 px-4 bg-white">
        <div class="container mx-auto">

            <div class="text-center mb-5">
                <h2 class="text-3xl font-bold text-primary mb-4">یادگیری زبان با فیلم</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">لنگ مووی اپلیکیشنی نوآورانه برای یادگیری زبان انگلیسی از
                    طریق فیلم‌های کوتاه و جذاب.<br>با روشی متفاوت و لذت‌بخش، زبان انگلیسی را به آسانی یاد بگیرید.
                </p>
                <div class="flex justify-center mb-5">
                    <img class="md:w-1/3" src="{{ asset('images') }}/chitoz.png" alt="یادگیری زبان با فیلم">
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:gap-5 items-center justify-center">
                <div class="md:w-1/2 mb-10 md:mb-0 md:pl-10">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">یادگیری آسان و سریع</h3>
                    <p class="text-gray-600 mb-4">اپلیکیشن ما با استفاده از فیلم‌های کوتاه و متنوع، یادگیری زبان
                        انگلیسی را به تجربه‌ای لذت‌بخش تبدیل کرده است.</p>
                    <p class="text-gray-600 mb-4">هر فیلم شامل مکالمات واقعی با تلفظ صحیح است که به شما کمک می‌کند
                        در کوتاه‌ترین زمان ممکن پیشرفت کنید.</p>
                    <ul class="text-gray-600 space-y-2 mt-6">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary mr-2 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span>فیلم‌های کوتاه و جذاب با موضوعات متنوع</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary mr-2 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span>یادگیری تلفظ صحیح در موقعیت های واقعی</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-primary mr-2 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span>برنامه‌های آموزشی متناسب با سطح شما</span>
                        </li>
                    </ul>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="relative">
                        <img src="{{ asset('images') }}/7_1739465375160.png" alt="یادگیری زبان با فیلم"
                            class="w-full h-auto">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 px-4 bg-gray-50" id="options">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-primary mb-4">امکانات لنگ مووی</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">به روشی جذاب و موثر زبان انگلیسی یاد بگیرید!</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- ویژگی اول -->
                <div class="bg-white rounded-xl p-8 text-center card-hover transition duration-300">
                    <h3 class="text-xl text-primary font-bold mb-3">۳ میلیون سکانس فیلم و انیمیشن در ژانرهای مختلف
                    </h3>
                    <p class="text-gray-600">لغات و اصطلاحات انگلیسی را در بیش از ۳ میلیون سکانس‌ در فیلم ها و
                        انیمیشن های مختلف می توانید جستجو کنید و به حافظه بسپارید.</p>
                </div>

                <!-- ویژگی دوم -->
                <div class="bg-white rounded-xl p-8 text-center card-hover transition duration-300">
                    <h3 class="text-xl text-primary font-bold mb-3">نمایش همزمان زیرنویس انگلیسی</h3>
                    <p class="text-gray-600">در تمامی سکانس ها، به طور همزمان زیرنویس انگلیسی نمایش داده می شود.
                    </p>
                </div>

                <!-- ویژگی سوم -->
                <div class="bg-white rounded-xl p-8 text-center card-hover transition duration-300">
                    <h3 class="text-xl text-primary font-bold mb-3">امکان ذخیره کردن لغات و اصطلاحات</h3>
                    <p class="text-gray-600">هر سکانس مربوط به لغت یا اصلاح ای که جستجو کردید رو می توانید ذخیره
                        کنید تا بعداً آن را دوباره ببینید و مرور کنید.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- بخش هرو -->
    <section class="gradient-bg text-white py-16 px-4">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">آموزش زبان با فیلم‌های جذاب</h1>
            <p class="text-xl mb-10 opacity-90">یادگیری زبان انگلیسی از طریق فیلم‌های کوتاه و جذاب با تلفظ صحیح</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button
                    class="bg-white text-primary font-bold py-3 px-8 rounded-full hover:bg-opacity-90 transition transform hover:-translate-y-1">
                    دانلود اپلیکیشن
                </button>
                <a href="{{ route('login') }}"
                    class="bg-transparent border-2 border-white text-white font-bold py-3 px-8 rounded-full hover:bg-white hover:bg-opacity-10 transition">
                    همین حالا امتحان کن
                </a>
            </div>
        </div>
    </section>

    <!-- ویژگی‌ها -->
    <section class="py-16 px-4 bg-white" id="Features">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-primary mb-4">ویژگی‌های لنگ مووی</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">در هر مکان و هر زمان زبان انگلیسی یاد بگیرید.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- ویژگی اول -->
                <div class="bg-gray-50 rounded-xl p-8 text-center card-hover transition duration-300">
                    <div
                        class="w-16 h-16 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                            <path fill="#fff"
                                d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2M9 11V5h6v6zm6 2v6H9v-6zM5 5h2v2H5zm0 4h2v2H5zm0 4h2v2H5zm0 4h2v2H5zm14.002 2H17v-2h2.002zm-.001-4H17v-2h2.001zm0-4H17V9h2.001zM17 7V5h2v2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">فیلم‌های آموزشی</h3>
                    <p class="text-gray-600">فیلم‌های کوتاه و جذاب با موضوعات متنوع برای یادگیری عملی زبان</p>
                    <img src="{{ asset('images') }}/ChatGPT Image Aug 6, 2025, 03_12_43 PM.png" alt="فیلم‌های آموزشی"
                        class="mt-6 rounded-lg modern-img">
                </div>

                <!-- ویژگی دوم -->
                <div class="bg-gray-50 rounded-xl p-8 text-center card-hover transition duration-300">
                    <div
                        class="w-16 h-16 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                            <path fill="#fff"
                                d="m11.307 4l-6 16h2.137l1.875-5h6.363l1.875 5h2.137l-6-16zm-1.239 9L12.5 6.515L14.932 13z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">تلفظ صحیح</h3>
                    <p class="text-gray-600">آموزش تلفظ صحیح کلمات و جملات توسط اساتید بومی زبان</p>
                    <img src="{{ asset('images') }}/ChatGPT Image Aug 6, 2025, 03_07_09 PM.png" alt="تلفظ صحیح"
                        class="mt-6 rounded-lg modern-img">
                </div>

                <!-- ویژگی سوم -->
                <div class="bg-gray-50 rounded-xl p-8 text-center card-hover transition duration-300">
                    <div
                        class="w-16 h-16 rounded-full bg-primary bg-opacity-10 flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                            <path fill="#fff"
                                d="m10 10.414l4 4l5.707-5.707L22 11V5h-6l2.293 2.293L14 11.586l-4-4l-7.707 7.707l1.414 1.414z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">پیشرفت سریع</h3>
                    <p class="text-gray-600">برنامه‌های آموزشی متناسب با سطح کاربر برای پیشرفت مستمر</p>
                    <img src="{{ asset('images') }}/ChatGPT Image Aug 6, 2025, 03_09_53 PM.png" alt="پیشرفت سریع"
                        class="mt-6 rounded-lg modern-img">
                </div>
            </div>
        </div>
    </section>

    <!-- بخش اطلاعات -->
    <section class="py-16 px-4 bg-gray-50">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row md:gap-5 items-center justify-center">
                <div class="md:w-1/2 mb-10 md:mb-0 md:pl-10">
                    <h2 class="text-3xl font-bold text-primary mb-6">آموزش زبان با فیلم‌های کوتاه</h2>
                    <p class="text-gray-600 mb-6">اپلیکیشن ما امکان یادگیری زبان انگلیسی را از طریق فیلم‌های کوتاه
                        و جذاب فراهم می‌کند. هر فیلم شامل مکالمات واقعی با تلفظ صحیح است.</p>
                    <p class="text-gray-600 mb-8">با استفاده از روش تکرار و تمرین، کلمات و جملات جدید به صورت طبیعی
                        در ذهن شما ثبت می‌شوند و یادگیری لذت‌بخش‌تر می‌شود.</p>
                    <button class="bg-primary text-white font-bold py-3 px-8 rounded-full hover:bg-opacity-90 transition">
                        دانلود اپلیکیشن
                    </button>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="relative">
                        <img src="{{ asset('images') }}/movies.png" alt="آموزش زبان" class="w-full h-auto">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- نظرات کاربران -->
    <section class="py-16 px-4 bg-white">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-primary mb-4">تجربه کاربران</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">نظرات کاربران درباره اپلیکیشن آموزش زبان لنگ مووی</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- نظر اول -->
                <div class="testimonial-card bg-white rounded-xl p-8">
                    <div class="flex items-center mb-6">
                        {{-- <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="احمد محمدی"
                        class="w-12 h-12 rounded-full object-cover mr-4"> --}}
                        <div>
                            <h4 class="font-bold">احمد محمدی</h4>
                            <p class="text-gray-500 text-sm">طراح گرافیک</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"فیلم‌های آموزشی بسیار جذاب و کاربردی هستند. تلفظ صحیح و
                        موضوعات متنوع باعث شد در کمتر از یک ماه پیشرفت چشمگیری داشته باشم."</p>
                </div>

                <!-- نظر دوم -->
                <div class="testimonial-card bg-white rounded-xl p-8">
                    <div class="flex items-center mb-6">
                        {{-- <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="فاطمه رضایی"
                        class="w-12 h-12 rounded-full object-cover mr-4"> --}}
                        <div>
                            <h4 class="font-bold">فاطمه رضایی</h4>
                            <p class="text-gray-500 text-sm">توسعه‌دهنده وب</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"روش آموزش با فیلم بسیار مؤثر است. هر روز 15 دقیقه با اپلیکیشن
                        کار می‌کنم و نتیجه را می‌بینم. توصیه می‌کنم!"</p>
                </div>
            </div>
        </div>
    </section>
@endsection
