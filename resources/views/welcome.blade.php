<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback CSS akan tetap dipertahankan -->
        <style>/* Tailwind CSS tetap dipertahankan untuk fallback */</style>
    @endif
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen flex flex-col p-6 lg:p-8 items-center justify-center">
    
    <!-- Navigation -->
    @if (Route::has('login'))
        <nav class="w-full lg:max-w-4xl max-w-[335px] mb-6 flex justify-end gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" 
                   class="btn btn-outline">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" 
                   class="btn btn-ghost">
                    Log in
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" 
                       class="btn btn-outline">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif

    <!-- Main Content -->
    <div class="flex items-center justify-center w-full flex-1">
        <main class="max-w-[335px] lg:max-w-4xl w-full">
            <div class="flex flex-col lg:flex-row">
                
                <!-- Left Content Panel -->
                <div class="content-panel">
                    <h1 class="text-lg font-medium mb-2">Let's get started</h1>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        Laravel has an incredibly rich ecosystem. <br>
                        We suggest starting with the following.
                    </p>

                    <!-- Resource Links -->
                    <div class="space-y-4 mb-8">
                        <div class="resource-item">
                            <div class="bullet"></div>
                            <span>
                                Read the
                                <a href="https://laravel.com/docs" target="_blank" class="link">
                                    Documentation
                                    <svg class="external-icon" viewBox="0 0 10 11">
                                        <path d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001" 
                                              stroke="currentColor" stroke-linecap="square"/>
                                    </svg>
                                </a>
                            </span>
                        </div>

                        <div class="resource-item">
                            <div class="bullet"></div>
                            <span>
                                Watch video tutorials at
                                <a href="https://laracasts.com" target="_blank" class="link">
                                    Laracasts
                                    <svg class="external-icon" viewBox="0 0 10 11">
                                        <path d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001" 
                                              stroke="currentColor" stroke-linecap="square"/>
                                    </svg>
                                </a>
                            </span>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <a href="https://cloud.laravel.com" target="_blank" 
                       class="btn btn-primary">
                        Deploy now
                    </a>
                </div>

                <!-- Right Graphic Panel -->
                <div class="graphic-panel">
                    <!-- Laravel Logo -->
                    <div class="logo-container">
                        <svg class="laravel-logo" viewBox="0 0 438 104" fill="none">
                            <!-- Logo path data disederhanakan -->
                            <path d="M17.2036 -3H0V102.197H49.5189V86.7187H17.2036V-3Z" fill="currentColor"/>
                            <!-- Sisakan path utama logo -->
                        </svg>
                    </div>

                    <!-- Graphic (Light/Dark mode) -->
                    <div class="graphic-container">
                        <!-- Light mode graphic -->
                        <svg class="graphic light-mode" viewBox="0 0 440 376" fill="none">
                            <!-- Graphic path disederhanakan -->
                        </svg>

                        <!-- Dark mode graphic -->
                        <svg class="graphic dark-mode" viewBox="0 0 440 376" fill="none">
                            <!-- Graphic path disederhanakan -->
                        </svg>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Spacer for navigation -->
    @if (Route::has('login'))
        <div class="h-14 lg:h-0"></div>
    @endif

    <!-- Custom CSS untuk styling yang disederhanakan -->
    <style>
        /* Button Styles */
        .btn {
            @apply inline-block px-5 py-1.5 rounded-sm text-sm leading-normal transition-all duration-200;
        }
        .btn-outline {
            @apply border text-[#1b1b18] dark:text-[#EDEDEC] border-[#19140035] dark:border-[#3E3E3A] 
                   hover:border-[#1915014a] dark:hover:border-[#62605b];
        }
        .btn-ghost {
            @apply text-[#1b1b18] dark:text-[#EDEDEC] border border-transparent 
                   hover:border-[#19140035] dark:hover:border-[#3E3E3A];
        }
        .btn-primary {
            @apply bg-[#1b1b18] dark:bg-[#eeeeec] border border-black dark:border-[#eeeeec] 
                   text-white dark:text-[#1C1C1A] hover:bg-black dark:hover:bg-white 
                   dark:hover:border-white;
        }

        /* Content Panel */
        .content-panel {
            @apply flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] 
                   dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] 
                   dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg 
                   lg:rounded-tl-lg lg:rounded-br-none;
        }

        /* Resource Items */
        .resource-item {
            @apply flex items-center gap-4 py-2 relative;
        }
        .resource-item::before {
            @apply content-[''] absolute left-[0.4rem] top-1/2 bottom-0 
                   border-l border-[#e3e3e0] dark:border-[#3E3E3A];
        }
        .bullet {
            @apply flex items-center justify-center rounded-full bg-[#FDFDFC] dark:bg-[#161615] 
                   shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] 
                   w-3.5 h-3.5 border border-[#e3e3e0] dark:border-[#3E3E3A] relative z-10;
        }
        .bullet::after {
            @apply content-[''] rounded-full bg-[#dbdbd7] dark:bg-[#3E3E3A] w-1.5 h-1.5;
        }

        /* Links */
        .link {
            @apply inline-flex items-center space-x-1 font-medium underline underline-offset-4 
                   text-[#f53003] dark:text-[#FF4433] ml-1 hover:opacity-80;
        }
        .external-icon {
            @apply w-2.5 h-2.5;
        }

        /* Graphic Panel */
        .graphic-panel {
            @apply bg-[#fff2f2] dark:bg-[#1D0002] relative lg:-ml-px -mb-px lg:mb-0 
                   rounded-t-lg lg:rounded-t-none lg:rounded-r-lg aspect-[335/376] 
                   lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden;
        }
        .graphic-panel::after {
            @apply content-[''] absolute inset-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg 
                   shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] 
                   dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d];
        }

        /* Logo Container */
        .logo-container {
            @apply w-full text-[#F53003] dark:text-[#F61500] transition-all duration-750 
                   opacity-100 starting:opacity-0 starting:translate-y-6;
        }
        .laravel-logo {
            @apply w-full max-w-none;
        }

        /* Graphic Container */
        .graphic-container {
            @apply relative -mt-[4.9rem] -ml-8 lg:ml-0 lg:-mt-[6.6rem];
        }
        .graphic {
            @apply w-[448px] max-w-none transition-all delay-300 duration-750 
                   opacity-100 starting:opacity-0 starting:translate-y-4;
        }
        .graphic.light-mode {
            @apply dark:hidden;
        }
        .graphic.dark-mode {
            @apply hidden dark:block;
        }
    </style>

</body>
</html>