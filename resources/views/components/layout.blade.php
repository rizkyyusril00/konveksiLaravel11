<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- font inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Konveksi</title>
</head>

<body>
    {{-- main --}}
    <div class="block md:flex relative h-screen">
        {{-- side nav --}}
        <div
            class="w-[25%] lg:w-[20%] bg-primary pt-4 px-4 border-r border-accent h-screen hidden md:flex flex-col gap-6 fixed">
            {{-- top nav --}}
            <div class="flex flex-col flex-grow">
                {{-- logo --}}
                <a href="/" class="w-14 h-14 mb-4">
                    <img src="/img/LOGO.png" alt="logo_company" class="w-full h-full ">
                </a>
                {{-- Order --}}
                <a href="/"
                    class="flex items-center gap-2 p-2 hover:bg-accent transition-all duration-300 ease-in-out hover:pl-3 rounded-md {{ request()->is('/') ? 'pl-3 bg-accent text-secondary' : 'pl-0 bg-primary' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M239.18,97.26A16.38,16.38,0,0,0,224.92,86l-59-4.76L143.14,26.15a16.36,16.36,0,0,0-30.27,0L90.11,81.23,31.08,86a16.46,16.46,0,0,0-9.37,28.86l45,38.83L53,211.75a16.38,16.38,0,0,0,24.5,17.82L128,198.49l50.53,31.08A16.4,16.4,0,0,0,203,211.75l-13.76-58.07,45-38.83A16.43,16.43,0,0,0,239.18,97.26Zm-15.34,5.47-48.7,42a8,8,0,0,0-2.56,7.91l14.88,62.8a.37.37,0,0,1-.17.48c-.18.14-.23.11-.38,0l-54.72-33.65a8,8,0,0,0-8.38,0L69.09,215.94c-.15.09-.19.12-.38,0a.37.37,0,0,1-.17-.48l14.88-62.8a8,8,0,0,0-2.56-7.91l-48.7-42c-.12-.1-.23-.19-.13-.5s.18-.27.33-.29l63.92-5.16A8,8,0,0,0,103,91.86l24.62-59.61c.08-.17.11-.25.35-.25s.27.08.35.25L153,91.86a8,8,0,0,0,6.75,4.92l63.92,5.16c.15,0,.24,0,.33.29S224,102.63,223.84,102.73Z">
                        </path>
                    </svg>
                    <span>Order</span>
                </a>
                {{-- supplier --}}
                <a href="/supplier"
                    class="flex items-center gap-2 p-2 hover:bg-accent transition-all duration-300 ease-in-out hover:pl-3 rounded-md {{ request()->is('supplier') ? 'pl-3 bg-accent text-secondary' : 'pl-0 bg-primary' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M223.68,66.15,135.68,18a15.88,15.88,0,0,0-15.36,0l-88,48.17a16,16,0,0,0-8.32,14v95.64a16,16,0,0,0,8.32,14l88,48.17a15.88,15.88,0,0,0,15.36,0l88-48.17a16,16,0,0,0,8.32-14V80.18A16,16,0,0,0,223.68,66.15ZM128,32l80.34,44-29.77,16.3-80.35-44ZM128,120,47.66,76l33.9-18.56,80.34,44ZM40,90l80,43.78v85.79L40,175.82Zm176,85.78h0l-80,43.79V133.82l32-17.51V152a8,8,0,0,0,16,0V107.55L216,90v85.77Z">
                        </path>
                    </svg>
                    <span>Suplier</span>
                </a>
                {{-- customer --}}
                <a href="/customer"
                    class="flex items-center gap-2 p-2 hover:bg-accent transition-all duration-300 ease-in-out hover:pl-3 rounded-md {{ request()->is('customer') ? 'pl-3 bg-accent text-secondary' : 'pl-0 bg-primary' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#000000"
                        viewBox="0 0 256 256">
                        <rect width="256" height="256" fill="none" />
                        <circle cx="80" cy="168" r="32" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <circle cx="80" cy="64" r="32" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <circle cx="176" cy="168" r="32" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M32,224a60,60,0,0,1,96,0,60,60,0,0,1,96,0" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <circle cx="176" cy="64" r="32" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                        <path d="M32,120a60,60,0,0,1,96,0h0a60,60,0,0,1,96,0" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    </svg>
                    <span>Customer</span>
                </a>
                {{-- karyawan --}}
                <a href="/karyawan"
                    class="flex items-center gap-2 p-2 hover:bg-accent transition-all duration-300 ease-in-out hover:pl-3 rounded-md {{ request()->is('karyawan') ? 'pl-3 bg-accent text-secondary' : 'pl-0 bg-primary' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
                        </path>
                    </svg>
                    <span>Karyawan</span>
                </a>
                {{-- user/admin --}}
                @auth('admin')
                    <a href="/user"
                        class="flex items-center gap-2 p-2 hover:bg-accent transition-all duration-300 ease-in-out hover:pl-3 rounded-md {{ request()->is('user') ? 'pl-3 bg-accent text-secondary' : 'pl-0 bg-primary' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z">
                            </path>
                        </svg>
                        <span>User</span>
                    </a>
                @endauth
            </div>
            {{-- bottom nav --}}
            <div class="flex flex-col gap-6 mb-6">
                {{-- mini profile --}}
                <div class="flex justify-between items-center border-t border-accent pt-4 gap-2">
                    {{-- profile --}}
                    <div class="flex items-center gap-2">
                        {{-- img --}}
                        <figure class="w-8 h-8 rounded-full bg-secondary">
                            <img src="/img/profile.jpg" alt="user"
                                class="w-full h-full object-center object-cover rounded-full">
                        </figure>
                        <div class="flex flex-col">
                            @auth('admin')
                                <span class="text-[12px] font-bold">{{ auth('admin')->user()->name }}</span>
                                <span class="text-[12px]">{{ auth('admin')->user()->email }}</span>
                            @elseif('user')
                                <span class="text-[12px] font-bold">{{ auth('user')->user()->name }}</span>
                                <span class="text-[12px]">{{ auth('user')->user()->email }}</span>
                            @endauth
                        </div>
                    </div>
                    {{-- logout --}}
                    <a href="{{ route('logout') }}" class="group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:fill-error" width="20"
                            height="20" fill="#000000" viewBox="0 0 256 256">
                            <path
                                d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        {{-- side nav invisible --}}
        <div class="w-[20%] invisible scale-0"></div>
        {{-- content --}}
        {{ $slot }}
        {{-- mobile nav --}}
        <div
            class="flex items-center justify-center gap-3 md:hidden absolute bottom-0 w-full bg-primary p-4 border-t-2 border-accent">
            {{-- order --}}
            <a href="/"
                class="w-10 h-10 rounded-full flex items-center justify-center hover:mb-2 transition-all duration-300 ease-in-out {{ request()->is('/') ? 'bg-accent mb-2' : 'bg-primary mb-0' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000"
                    viewBox="0 0 256 256">
                    <path
                        d="M239.18,97.26A16.38,16.38,0,0,0,224.92,86l-59-4.76L143.14,26.15a16.36,16.36,0,0,0-30.27,0L90.11,81.23,31.08,86a16.46,16.46,0,0,0-9.37,28.86l45,38.83L53,211.75a16.38,16.38,0,0,0,24.5,17.82L128,198.49l50.53,31.08A16.4,16.4,0,0,0,203,211.75l-13.76-58.07,45-38.83A16.43,16.43,0,0,0,239.18,97.26Zm-15.34,5.47-48.7,42a8,8,0,0,0-2.56,7.91l14.88,62.8a.37.37,0,0,1-.17.48c-.18.14-.23.11-.38,0l-54.72-33.65a8,8,0,0,0-8.38,0L69.09,215.94c-.15.09-.19.12-.38,0a.37.37,0,0,1-.17-.48l14.88-62.8a8,8,0,0,0-2.56-7.91l-48.7-42c-.12-.1-.23-.19-.13-.5s.18-.27.33-.29l63.92-5.16A8,8,0,0,0,103,91.86l24.62-59.61c.08-.17.11-.25.35-.25s.27.08.35.25L153,91.86a8,8,0,0,0,6.75,4.92l63.92,5.16c.15,0,.24,0,.33.29S224,102.63,223.84,102.73Z">
                    </path>
                </svg>
            </a>
            {{-- supplier --}}
            <a href="/supplier"
                class="w-10 h-10 rounded-full flex items-center justify-center hover:mb-2 transition-all duration-300 ease-in-out {{ request()->is('supplier') ? 'bg-accent mb-2' : 'bg-primary mb-0' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000"
                    viewBox="0 0 256 256">
                    <path
                        d="M223.68,66.15,135.68,18a15.88,15.88,0,0,0-15.36,0l-88,48.17a16,16,0,0,0-8.32,14v95.64a16,16,0,0,0,8.32,14l88,48.17a15.88,15.88,0,0,0,15.36,0l88-48.17a16,16,0,0,0,8.32-14V80.18A16,16,0,0,0,223.68,66.15ZM128,32l80.34,44-29.77,16.3-80.35-44ZM128,120,47.66,76l33.9-18.56,80.34,44ZM40,90l80,43.78v85.79L40,175.82Zm176,85.78h0l-80,43.79V133.82l32-17.51V152a8,8,0,0,0,16,0V107.55L216,90v85.77Z">
                    </path>
                </svg>
            </a>
            {{-- customer --}}
            <a href="/customer"
                class="w-10 h-10 rounded-full flex items-center justify-center hover:mb-2 transition-all duration-300 ease-in-out {{ request()->is('customer') ? 'bg-accent mb-2' : 'bg-primary mb-0' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000"
                    viewBox="0 0 256 256">
                    <rect width="256" height="256" fill="none" />
                    <circle cx="80" cy="168" r="32" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    <circle cx="80" cy="64" r="32" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    <circle cx="176" cy="168" r="32" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    <path d="M32,224a60,60,0,0,1,96,0,60,60,0,0,1,96,0" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    <circle cx="176" cy="64" r="32" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                    <path d="M32,120a60,60,0,0,1,96,0h0a60,60,0,0,1,96,0" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                </svg>
            </a>
            {{-- karyawan --}}
            <a href="/karyawan"
                class="w-10 h-10 rounded-full flex items-center justify-center hover:mb-2 transition-all duration-300 ease-in-out {{ request()->is('karyawan') ? 'bg-accent mb-2' : 'bg-primary mb-0' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000"
                    viewBox="0 0 256 256">
                    <path
                        d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
                    </path>
                </svg>
            </a>
            {{-- user/admin --}}
            @auth('admin')
                <a href="/user"
                    class="w-10 h-10 rounded-full flex items-center justify-center hover:mb-2 transition-all duration-300 ease-in-out {{ request()->is('user') ? 'bg-accent mb-2' : 'bg-primary mb-0' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z">
                        </path>
                    </svg>
                </a>
            @endauth
            {{-- action --}}
            <div class="flex items-center gap-1 bg-accent rounded-md p-1">
                {{-- img --}}
                <figure class="w-8 h-8 rounded-full bg-secondary">
                    <img src="/img/profile.jpg" alt="user"
                        class="w-full h-full object-center object-cover rounded-full">
                </figure>
                <a href="{{ route('logout') }}" class="group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:fill-error" width="20"
                        height="20" fill="#000000" viewBox="0 0 256 256">
                        <path
                            d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
