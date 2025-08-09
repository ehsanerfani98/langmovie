<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لنگ مووی | آموزش زبان با فیلم</title>
    <link rel="shortcut icon" href="{{ asset('admin/img/logo.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        vazir: ['Vazirmatn', 'sans-serif']
                    },
                    colors: {
                        primary: '#ff6cb0',
                        secondary: '#ffffff'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
        }

        .permissions img {
            height: 82px;
            width: 66px;
            background: white;
            border-radius: 6px;
            padding: 4px;
            box-shadow: 0px 4px 10px 4px #db5f83;
        }

        .hero-image {
            background: linear-gradient(45deg, #ff6cb0, #ffb6c1);
            box-shadow: 0 20px 50px rgba(255, 108, 176, 0.3);
            border-radius: 20px;
            overflow: hidden;
            transform: perspective(1000px) rotateY(-10deg);
        }

        .feature-card {
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .app-screenshot {
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: rotate(5deg);
            border: 10px solid #fff;
        }

        .testimonial-card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #e97497 0%, #fea2bd 100%);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .feature-icon {
            transition: all 0.3s ease;
        }

        .feature-icon:hover {
            transform: scale(1.1);
        }

        /* Mobile Menu Styles */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            z-index: 1000;
            padding: 20px;
            overflow-y: auto;
        }

        .mobile-menu.active {
            right: 0;
        }

        .menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Modern Image Styles */
        .modern-img {
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .modern-img:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .img-frame {
            border: 8px solid white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>

    @stack('style')
</head>

<body class="bg-white text-gray-800">
    <!-- Mobile Menu Overlay -->
    <div class="menu-overlay"></div>

    <!-- Mobile Menu -->
    <div class="mobile-menu">
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-1">
                <div class="w-10 h-10 rounded-full flex items-center justify-center mr-2">
                    <a href="{{ route('home') }}"><img src="{{ asset('admin/img/logo.png') }}" alt="لنگ مووی"></a>
                </div>
                <h1 class="text-xl font-bold">لنگ مووی</h1>
            </div>

        </div>
        <nav class="flex flex-col space-y-4">
            <a href="{{ route('home') }}" class="px-4 py-3 rounded-lg hover:bg-gray-100 transition">خانه</a>
            <a href="#options" class="px-4 py-3 rounded-lg hover:bg-gray-100 transition">امکانات</a>
            <a href="#Features" class="px-4 py-3 rounded-lg hover:bg-gray-100 transition">ویژگی ها</a>
            <a href="{{ route('privacy') }}" class="px-4 py-3 rounded-lg hover:bg-gray-100 transition">حریم
                خصوصی</a>
            <a href="{{ route('terms') }}" class="px-4 py-3 rounded-lg hover:bg-gray-100 transition">قوانین</a>
            <a href="{{ route('login') }}"
                class="bg-primary text-white font-bold py-3 px-6 rounded-full hover:bg-opacity-90 transition mt-4">
                ورود
            </a>
        </nav>
    </div>

    <!-- هدر -->
    <header class="gradient-bg text-white py-2 px-4 shadow-md">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center justify-between w-full md:w-auto md:mb-0">
                <div class="flex items-center w-20 bg-white rounded-2xl p-2">
                    <a href="{{ route('home') }}"><img class="img-fluid" src="{{ asset('admin/img/logo.png') }}"
                            alt="لنگ مووی"></a>
                </div>
                <button class="md:hidden open-menu text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="hidden md:flex space-x-1 space-x-reverse">
                <a href="/" class="px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition">خانه</a>
                <a href="#options"
                    class="px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition">امکانات</a>
                <a href="#Features" class="px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition">ویژگی
                    ها</a>
                <a href="{{ route('privacy') }}"
                    class="px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition">حریم
                    خصوصی</a>
                <a href="{{ route('terms') }}"
                    class="px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-20 transition">قوانین</a>
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-white bg-opacity-20 transition">ورود</a>
            </nav>
        </div>
    </header>

    <!-- بخش اصلی -->
    <main>
        @yield('content')
    </main>

    <!-- فوتر -->
    <footer class="gradient-bg text-white py-12 px-4">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center w-20 bg-white rounded-2xl p-2 mb-4">
                        <a href="{{ route('home') }}"><img src="{{ asset('admin/img/logo.png') }}" alt="لنگ مووی"></a>
                    </div>
                    <p class="opacity-80 mb-6">اپلیکیشن آموزش زبان با فیلم‌های کوتاه و جذاب برای یادگیری مؤثر زبان
                        انگلیسی</p>
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center hover:bg-opacity-30 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z">
                                </path>
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center hover:bg-opacity-30 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 2C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10 5.523 0 10-4.477 10-10 0-5.523-4.477-10-10-10zm0 18c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8-3.582 8-8 8zm-2-12a2 2 0 10-.001 3.999A2 2 0 0010 8zm6 0a2 2 0 10-.001 3.999A2 2 0 0016 8zm-8 7a4 4 0 117.999.001A4 4 0 018 15z">
                                </path>
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center hover:bg-opacity-30 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-6">لینک‌های مفید</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}"
                                class="opacity-80 hover:opacity-100 hover:mr-1 transition-all">خانه</a>
                        </li>
                        <li><a href="#" class="opacity-80 hover:opacity-100 hover:mr-1 transition-all">دانلود
                                اپلیکیشن</a></li>
                        <li><a href="{{ route('terms') }}"
                                class="opacity-80 hover:opacity-100 hover:mr-1 transition-all">قوانین</a>
                        </li>
                        <li><a href="{{ route('privacy') }}"
                                class="opacity-80 hover:opacity-100 hover:mr-1 transition-all">حریم خصوصی</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-6">تماس با ما</h4>
                    <ul class="space-y-5 opacity-80">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>قزوین / مهرگان / نیک پی /<br> امامت پنجم / بلوک ششم شرقی/ واحد ۱۹</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            <span>۰۹۱۹-۱۸۱۶۱۷۲</span>
                            |
                            <span>۰۲۸-۳۲۵۲۶۶۳۶</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>ehsan.bavaghar1989@gmail.com</span>
                        </li>
                    </ul>
                </div>


                <div>
                    <h4 class="text-lg font-bold mb-6">مجوزها</h4>

                    <div class="flex md:flex-row items-center gap-4 permissions">
                        <a referrerpolicy='origin' target='_blank'
                            href='https://trustseal.enamad.ir/?id=634664&Code=FTsAnb9pdUE35gAA4AZYxDi3zsEkHDcP'><img
                                referrerpolicy='origin'
                                src='https://trustseal.enamad.ir/logo.aspx?id=634664&Code=FTsAnb9pdUE35gAA4AZYxDi3zsEkHDcP'
                                alt='' style='cursor:pointer;' code='FTsAnb9pdUE35gAA4AZYxDi3zsEkHDcP'></a>
                        <div>
                            <script src="https://www.zarinpal.com/webservice/TrustCode" type="text/javascript"></script>
                        </div>
                    </div>

                </div>
            </div>

            <div class="border-t border-white border-opacity-20 mt-12 pt-8 text-center opacity-70">
                <p>© 2025 لنگ مووی | تمامی حقوق محفوظ است.</p>
            </div>
        </div>
    </footer>
    <style>
        .bg-primary {
            --tw-bg-opacity: 1;
            background-color: rgb(254 153 180);
        }

        .text-primary {
            --tw-text-opacity: 1;
            color: rgb(237 126 159);
        }
    </style>
    <script>
        // Mobile Menu Toggle
        const openMenuBtn = document.querySelector('.open-menu');
        const mobileMenu = document.querySelector('.mobile-menu');
        const menuOverlay = document.querySelector('.menu-overlay');

        openMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.add('active');
            menuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });



        menuOverlay.addEventListener('click', () => {
            mobileMenu.classList.remove('active');
            menuOverlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
    </script>
    <script>
        ! function(t, e, n) {
            t.yektanetAnalyticsObject = n, t[n] = t[n] || function() {
                t[n].q.push(arguments)
            }, t[n].q = t[n].q || [];
            var a = new Date,
                r = a.getFullYear().toString() + "0" + a.getMonth() + "0" + a.getDate() + "0" + a.getHours(),
                c = e.getElementsByTagName("script")[0],
                s = e.createElement("script");
            s.id = "ua-script-GSCl4bYc";
            s.dataset.analyticsobject = n;
            s.async = 1;
            s.type = "text/javascript";
            s.src = "https://cdn.yektanet.com/rg_woebegone/scripts_v3/GSCl4bYc/rg.complete.js?v=" + r, c.parentNode
                .insertBefore(s, c)
        }(window, document, "yektanet");
    </script>
</body>

</html>
