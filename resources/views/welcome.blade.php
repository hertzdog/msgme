<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MSGME</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <!-- PWA -->
        <!-- Chrome for Android theme color -->
        <meta name="theme-color" content="#000000">
        <link rel="apple-touch-icon" href="/images/icons/icon-512x512.png">
        <style>
                .ad2hs-prompt {
                    background-color: rgb(55, 214, 84); /* Green */
                    border: none;
                    display: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 16px;
                    position: absolute;
                    margin: 0 1rem 1rem;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    width: calc(100% - 32px);
                }
                
                .ios-prompt {
                    background-color: #37d654;
                    border: 1px solid #666;
                    display: none;
                    padding: 0.8rem 1rem 0 0.5rem;
                    text-decoration: none;
                    font-size: 16px;
                    color: #fff;
                    position: absolute;
                    margin: 0 auto 1rem;
                    left: 1rem;
                    right: 1rem;
                    bottom: 0;
                }
            </style>

        <link rel="manifest" href="/manifest.json">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    MSGME
                </div>
            </div>            
        </div>
         <!-- PWA install buttons --> 
         <button type="button" class="ad2hs-prompt">Install MSGME</button>
            <div class="ios-prompt">
                <span style="color: rgb(187, 187, 187); float: right; margin-top: -14px; margin-right: -11px;">&times;</span>
                <img src="/images/icons/icon-96x96.png" style="float: left; height: 80px; width: auto; margin-top: -8px; margin-right: 1rem;">
                <p style="margin-top: -3px; line-height: 1.3rem;">To install this Web App in your iPhone/iPad press <img src="/images/icons/Ei-share-apple.svg" style="display: inline-block; margin-top: 4px; margin-bottom: -4px; height: 20px; width: auto;"> and then Add to Home Screen.</p>
            </div>
        </div>
         <!-- PWA Scripts -->
         <script type="text/javascript">
                // Initialize the service worker
                if ('serviceWorker' in navigator) {
                    navigator.serviceWorker.register('/service-worker.js', {
                        scope: '.'
                    }).then(function (registration) {
                        // Registration was successful
                        console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
                    }, function (err) {
                        // registration failed :(
                        console.log('Laravel PWA: ServiceWorker registration failed: ', err);
                    });
                }
        </script>

        <script type="text/javascript">
            function addToHomeScreen() {
                let a2hsBtn = document.querySelector(".ad2hs-prompt");  // hide our user interface that shows our A2HS button
                a2hsBtn.style.display = 'none';  // Show the prompt
                deferredPrompt.prompt();  // Wait for the user to respond to the prompt
                deferredPrompt.userChoice
                    .then(function(choiceResult){
                        if (choiceResult.outcome === 'accepted') {
                            console.log('User accepted the A2HS prompt');
                        } else {
                            console.log('User dismissed the A2HS prompt');
                        }
                        deferredPrompt = null;
                        });
                }
            function showAddToHomeScreen() {
                let a2hsBtn = document.querySelector(".ad2hs-prompt");
                a2hsBtn.style.display = "block";
                a2hsBtn.addEventListener("click", addToHomeScreen);
                }
            let deferredPrompt;
            window.addEventListener('beforeinstallprompt', function (e) {
                // Prevent Chrome 67 and earlier from automatically showing the prompt
                e.preventDefault();
                // Stash the event so it can be triggered later.
                deferredPrompt = e;
                showAddToHomeScreen();
            });

            function showIosInstall() {
                let iosPrompt = document.querySelector(".ios-prompt");
                iosPrompt.style.display = "block";
                iosPrompt.addEventListener("click", () => {
                    iosPrompt.style.display = "none";
                });
            }

            // Detects if device is on iOS
            const isIos = () => {
                const userAgent = window.navigator.userAgent.toLowerCase();
                return /iphone|ipad|ipod/.test( userAgent );
                }
            // Detects if device is in standalone mode
            const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);
            // Checks if should display install popup notification:
            if (isIos() && !isInStandaloneMode()) {
                // this.setState({ showInstallMessage: true });
                showIosInstall();
                }
        </script>

    </body>
</html>
