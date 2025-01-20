<div class="flex flex-col">
    <div class="flex items-center justify-between">
        {{-- logo --}}
        <a href="/" class="w-14 h-14 mb-4 block md:hidden">
            <img src="/img/LOGO.png" alt="logo_company" class="w-full h-full object-cover">
        </a>
        {{-- logout --}}
        <a href="{{ route('logout') }}" class="group tooltip tooltip-left tooltip-secondary block md:hidden"
            data-tip="LogOut">
            <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:fill-error" width="26" height="26"
                fill="#000000" viewBox="0 0 256 256">
                <path
                    d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z">
                </path>
            </svg>
        </a>
    </div>
    <div class="flex justify-between items-center">
        <h1 class="text-[32px] text-secondary font-semibold">{{ $title }}</h1>
        {{-- btn add --}}
        <a href="{{ route($addRoute) }}"
            class="btn h-10 min-h-10 btn-secondary w-fit md:hidden flex items-center gap-2 group">
            <svg class="group-hover:rotate-180 transition-all duration-300 ease-in-out fill-primary"
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000" viewBox="0 0 256 256">
                <path
                    d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z">
                </path>
            </svg>
            <span class="text-[12px] text-primary">Tambah {{ $title }}</span>
        </a>
    </div>
</div>
