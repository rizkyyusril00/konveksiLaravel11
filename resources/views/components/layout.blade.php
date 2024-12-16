<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Document</title>
</head>

<body>
    <nav class="w-full fixed py-4 px-16 bg-primary border-b-2 border-accent flex justify-between z-40">
        {{-- logo --}}
        <div class="flex items-center gap-8">
            <h1 class="text-3xl">logo</h1>
            <ul class="flex items-center gap-4">
                <li>Menu</li>
                <li>Menu</li>
                <li>Menu</li>
                <li>Menu</li>
            </ul>
        </div>
        {{-- cta --}}
        <div class="flex items-center gap-6">
            <div class="btn bg-primary border border-accent w-[90px] hover:bg-accent hover:text-primary rounded-none">
                button</div>
            <div
                class="btn bg-accent text-primary w-[90px] hover:bg-accent hover:text-primary rounded-none hover:border-accent">
                button
            </div>
        </div>
    </nav>
    {{-- main --}}
    <div class="flex">
        {{-- side nav --}}
        <div class="w-[20%] pt-[100px] px-4 border-r-2 h-screen flex flex-col gap-6 fixed">
            {{-- search --}}
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#000000"
                    viewBox="0 0 256 256" class="absolute top-3 left-2">
                    <path
                        d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                    </path>
                </svg>
                <input type="text" name="" id=""
                    class="py-2 pl-9 pr-2 rounded-none border border-accent focus:outline-none focus:border-accent"
                    placeholder="Search here...">
            </div>
            {{-- menu --}}
            <div class="flex flex-col">
                {{-- Order --}}
                <a href="/order" class="flex items-center gap-2 p-2 bg-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M237.2,151.87v0a47.1,47.1,0,0,0-2.35-5.45L193.26,51.8a7.82,7.82,0,0,0-1.66-2.44,32,32,0,0,0-45.26,0A8,8,0,0,0,144,55V80H112V55a8,8,0,0,0-2.34-5.66,32,32,0,0,0-45.26,0,7.82,7.82,0,0,0-1.66,2.44L21.15,146.4a47.1,47.1,0,0,0-2.35,5.45v0A48,48,0,1,0,112,168V96h32v72a48,48,0,1,0,93.2-16.13ZM76.71,59.75a16,16,0,0,1,19.29-1v73.51a47.9,47.9,0,0,0-46.79-9.92ZM64,200a32,32,0,1,1,32-32A32,32,0,0,1,64,200ZM160,58.74a16,16,0,0,1,19.29,1l27.5,62.58A47.9,47.9,0,0,0,160,132.25ZM192,200a32,32,0,1,1,32-32A32,32,0,0,1,192,200Z">
                        </path>
                    </svg>
                    <span>Order</span>
                </a>
                {{-- karyawan --}}
                <a href="/" class="flex items-center gap-2 p-2 bg-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M237.2,151.87v0a47.1,47.1,0,0,0-2.35-5.45L193.26,51.8a7.82,7.82,0,0,0-1.66-2.44,32,32,0,0,0-45.26,0A8,8,0,0,0,144,55V80H112V55a8,8,0,0,0-2.34-5.66,32,32,0,0,0-45.26,0,7.82,7.82,0,0,0-1.66,2.44L21.15,146.4a47.1,47.1,0,0,0-2.35,5.45v0A48,48,0,1,0,112,168V96h32v72a48,48,0,1,0,93.2-16.13ZM76.71,59.75a16,16,0,0,1,19.29-1v73.51a47.9,47.9,0,0,0-46.79-9.92ZM64,200a32,32,0,1,1,32-32A32,32,0,0,1,64,200ZM160,58.74a16,16,0,0,1,19.29,1l27.5,62.58A47.9,47.9,0,0,0,160,132.25ZM192,200a32,32,0,1,1,32-32A32,32,0,0,1,192,200Z">
                        </path>
                    </svg>
                    <span>Karyawan</span>
                </a>
                {{-- Jenis Pakaian --}}
                <a href="/pakaian" class="flex items-center gap-2 p-2 bg-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M237.2,151.87v0a47.1,47.1,0,0,0-2.35-5.45L193.26,51.8a7.82,7.82,0,0,0-1.66-2.44,32,32,0,0,0-45.26,0A8,8,0,0,0,144,55V80H112V55a8,8,0,0,0-2.34-5.66,32,32,0,0,0-45.26,0,7.82,7.82,0,0,0-1.66,2.44L21.15,146.4a47.1,47.1,0,0,0-2.35,5.45v0A48,48,0,1,0,112,168V96h32v72a48,48,0,1,0,93.2-16.13ZM76.71,59.75a16,16,0,0,1,19.29-1v73.51a47.9,47.9,0,0,0-46.79-9.92ZM64,200a32,32,0,1,1,32-32A32,32,0,0,1,64,200ZM160,58.74a16,16,0,0,1,19.29,1l27.5,62.58A47.9,47.9,0,0,0,160,132.25ZM192,200a32,32,0,1,1,32-32A32,32,0,0,1,192,200Z">
                        </path>
                    </svg>
                    <span>Jenis Pakaian</span>
                </a>
            </div>
        </div>
        {{-- side nav invisible --}}
        <div class="w-[20%] invisible scale-0"></div>
        {{-- content --}}
        {{ $slot }}
    </div>
</body>

</html>
