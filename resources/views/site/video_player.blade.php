<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لنگ مووی | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('site-assets/css/style.css') }}">

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            height: 100%;
        }

        .video-container {
            position: relative;
            width: 100%;
            height: calc(var(--vh, 1vh) * 100);
            background: black;
            overflow: hidden;
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .overlay {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 2;
        }

        .center {
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .left {
            left: 1rem;
        }

        .right {
            right: 1rem;
        }

        .badge {
            position: absolute;
            top: 1rem;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 4px 12px;
            border-radius: 16px;
            font-weight: bold;
            color: white;
            z-index: 3;
        }

        .subtitle {
            position: absolute;
            bottom: 60px;
            width: 100%;
            text-align: center;
            font-size: 2.5rem;
            color: white;
            text-shadow: 0 0 5px black;
            z-index: 3;
        }

        .highlight {
            color: #ffbc00;
            font-weight: bold;
            background-color: rgba(0, 0, 0, 0.72);
            border: 1px solid #ffbc00;
            padding: 0px 10px;
            border-radius: 4px;
            margin: 0 4px;
        }

        @media (max-width: 768px) {
            .subtitle {
                font-size: 4vw;
                bottom: 12vw;
            }
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            .subtitle {
                font-size: 2vw;
                bottom: 8vw;
            }
        }

        .loader {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s ease-in-out infinite;
            z-index: 10;
        }

        @keyframes spin {
            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="video-container">
        <div id="videoLoader" class="loader"></div>
        <video id="videoPlayer" playsinline autoplay></video>
        <div class="overlay center" id="playIcon">
            <svg fill="#ffffff" height="50px" width="50px" version="1.1" id="Capa_1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 191.255 191.255" xml:space="preserve" stroke="#ffffff">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M162.929,66.612c-2.814-1.754-6.514-0.896-8.267,1.917s-0.895,6.513,1.917,8.266c6.544,4.081,10.45,11.121,10.45,18.833 s-3.906,14.752-10.45,18.833l-98.417,61.365c-6.943,4.329-15.359,4.542-22.512,0.573c-7.154-3.97-11.425-11.225-11.425-19.406 V34.262c0-8.181,4.271-15.436,11.425-19.406c7.153-3.969,15.569-3.756,22.512,0.573l57.292,35.723 c2.813,1.752,6.513,0.895,8.267-1.917c1.753-2.812,0.895-6.513-1.917-8.266L64.512,5.247c-10.696-6.669-23.661-7-34.685-0.883 C18.806,10.48,12.226,21.657,12.226,34.262v122.73c0,12.605,6.58,23.782,17.602,29.898c5.25,2.913,10.939,4.364,16.616,4.364 c6.241,0,12.467-1.754,18.068-5.247l98.417-61.365c10.082-6.287,16.101-17.133,16.101-29.015S173.011,72.899,162.929,66.612z">
                    </path>
                </g>
            </svg>
        </div>




        <div class="overlay left" onclick="prevVideo()">
            <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                stroke="#ffffff">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M18.0003 12.0001V14.6701C18.0003 17.9801 15.6503 19.3401 12.7803 17.6801L10.4703 16.3401L8.16031 15.0001C5.29031 13.3401 5.29031 10.6301 8.16031 8.97005L10.4703 7.63005L12.7803 6.29005C15.6503 4.66005 18.0003 6.01005 18.0003 9.33005V12.0001Z"
                        stroke="#ffffff" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </g>
            </svg>
        </div>

        <div class="overlay right" onclick="nextVideo()">
            <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                stroke="#ffffff">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M6 12.0002V9.33017C6 6.02017 8.35 4.66017 11.22 6.32017L13.53 7.66017L15.84 9.00017C18.71 10.6602 18.71 13.3702 15.84 15.0302L13.53 16.3702L11.22 17.7102C8.35 19.3402 6 17.9902 6 14.6702V12.0002Z"
                        stroke="#ffffff" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </g>
            </svg>
        </div>

        <div class="badge" id="videoCounter"></div>
        <div class="subtitle" id="subtitleBox"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    <script>
        const loader = document.getElementById('videoLoader');

        // تنظیم ارتفاع واقعی موبایل
        const setRealVH = () => {
            const vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
        };
        window.addEventListener('resize', setRealVH);
        window.addEventListener('orientationchange', setRealVH);
        window.addEventListener('load', setRealVH);

        const videos = @json($videos);
        const highlight = @json($highlight);
        let currentIndex = 0;
        let current = videos[currentIndex];
        let cues = [];
        let isPaused = true;

        const video = document.getElementById('videoPlayer');
        const subtitleBox = document.getElementById('subtitleBox');
        const playIcon = document.getElementById('playIcon');

        const parseTime = (timeStr) => {
            const [h, m, s] = timeStr.split(/[:.]/).map(Number);
            return h * 3600 + m * 60 + s;
        };

        const parseVTT = (vttText) => {
            const lines = vttText.split('\n');
            const result = [];
            for (let i = 0; i < lines.length; i++) {
                if (lines[i].includes('-->')) {
                    const [start, end] = lines[i].split('-->').map(s => parseTime(s.trim()));
                    let text = '';
                    while (++i < lines.length && lines[i].trim() !== '') {
                        text += lines[i] + ' ';
                    }
                    result.push({
                        start,
                        end,
                        text: text.trim()
                    });
                }
            }
            return result;
        };

        const updateSubtitle = () => {
            const t = video.currentTime;
            const cue = cues.find(c => t >= c.start && t <= c.end);
            let text = cue ? cue.text : '';
            if (highlight && text) {
                const re = new RegExp(`(${highlight.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
                text = text.replace(re, '<span class="highlight">$1</span>');
            }
            subtitleBox.innerHTML = text;
        };

        const triggerResize = () => {
            const event = new Event('resize');
            window.dispatchEvent(event);
        };

        const loadSubtitles = async () => {
            try {
                const res = await fetch(current.subtitle);
                const text = await res.text();
                cues = parseVTT(text);
            } catch (e) {
                console.warn('مشکل در بارگذاری زیرنویس:', e);
                cues = [];
            }
        };

        const loadVideo = async () => {
            current = videos[currentIndex];

            if (!current || !current.subtitle || !current.video) {
                console.error('ساختار ویدیو نامعتبر است:', current);
                return;
            }

            loader.style.display = 'block'; // ← نمایش لودینگ

            if (Hls.isSupported()) {
                const hls = new Hls();
                hls.loadSource(current.video);
                hls.attachMedia(video);
                hls.on(Hls.Events.MANIFEST_PARSED, () => {
                    video.play();
                    isPaused = false;
                    playIcon.style.display = 'none';
                    loader.style.display = 'none'; // ← مخفی کردن لودینگ بعد از آماده شدن
                });
            } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
                video.src = current.video;
                video.addEventListener('loadedmetadata', () => {
                    video.play();
                    isPaused = false;
                    playIcon.style.display = 'none';
                    loader.style.display = 'none'; // ← مخفی کردن لودینگ
                });
            } else {
                console.warn('پخش HLS پشتیبانی نمی‌شود.');
                loader.style.display = 'none';
            }

            video.addEventListener('loadedmetadata', triggerResize);
            updateVideoCounter();
        };

        const nextVideo = async () => {
            if (currentIndex < videos.length - 1) {
                currentIndex++;
                await loadVideo();
                await loadSubtitles();
                triggerResize();
            }
        };

        const prevVideo = async () => {
            if (currentIndex > 0) {
                currentIndex--;
                await loadVideo();
                await loadSubtitles();
                triggerResize();
            }
        };

        const togglePlay = () => {
            if (video.paused) {
                video.play().then(() => {
                    isPaused = false;
                    playIcon.style.display = 'none';
                }).catch(err => {
                    console.warn('Play failed:', err);
                });
            } else {
                video.pause();
                isPaused = true;
                playIcon.style.display = 'block';
            }
        };

        window.addEventListener('resize', () => {
            const videoWidth = video.offsetWidth;
            const videoHeight = video.offsetHeight;
            subtitleBox.style.bottom = `${videoHeight * 0.15}px`;
            subtitleBox.style.fontSize = `${videoWidth * 0.035}px`;
        });

        window.addEventListener('DOMContentLoaded', async () => {
            await loadVideo();
            await loadSubtitles();
            triggerResize();
            video.addEventListener('timeupdate', updateSubtitle);
            video.addEventListener('ended', async () => {
                if (currentIndex < videos.length - 1) {
                    await nextVideo();
                } else {
                    playIcon.style.display = 'block';
                }
            });
        });

        const updateVideoCounter = () => {
            const total = videos.length;
            const currentNumber = currentIndex + 1;
            document.getElementById('videoCounter').innerText =
                `${toPersianNumber(currentNumber)}/${toPersianNumber(total)} ویدیو`;
        };

        const toPersianNumber = (num) => {
            const persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            return num.toString().split('').map(d => persianDigits[parseInt(d)] ?? d).join('');
        };

        document.querySelector('.video-container').addEventListener('click', (e) => {
            if (e.target.closest('.left') || e.target.closest('.right')) return;
            togglePlay();
        });
    </script>
</body>

</html>
