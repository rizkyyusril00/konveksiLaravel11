<x-layout>
    <div
        class="w-full lg:w-[80%] pt-4 px-2 md:pl-14 md:pr-4 lg:px-4 h-full md:h-screen bg-primary flex flex-col gap-4 overflow-x-hidden overflow-y-scroll md:overflow-y-auto md:overflow-x-auto">
        @if (Session::has('fail'))
            <div x-data="{ open: true }" x-init="setTimeout(() => open = false, 3000)" x-show="open"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                class="toast toast-top toast-center z-40">
                <div class="alert alert-success">
                    <span class="text-red-400">{{ Session::get('fail') }}</span>
                    <span @click="open = false" class="cursor-pointer text-primary">x</span>
                </div>
            </div>
        @endif
        <form action="{{ route('AddItem') }}" method="POST"
            class="w-full flex flex-col gap-4 p-3 md:px-8 2xl:px-4 md:py-4">
            <a href="/item" class="flex md:hidden items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-secondary" width="16" height="16"
                    fill="#000000" viewBox="0 0 256 256">
                    <path
                        d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z">
                    </path>
                </svg>
                <span class="text-[14px] text-secondary">Kembali</span>
            </a>
            <h1 class="text-[24px] text-start text-secondary font-semibold">Tambah Item</h1>
            @csrf
            {{-- Tipe --}}
            <div class="flex flex-col gap-2 w-full">
                <span class="text-secondary text-[16px]">Pilih Tipe</span>
                <div class="flex items-center gap-1">
                    <input id="tipe1" type="radio" name="tipe" checked="checked"
                        class="radio radio-secondary radio-sm" value="Bahan Utama">
                    <label for="tipe1" class="text-secondary text-[16px]">Bahan Utama</label>
                </div>
                <div class="flex items-center gap-1">
                    <input id="tipe2" type="radio" name="tipe" class="radio radio-secondary radio-sm"
                        value="Bahan Tambahan">
                    <label for="tipe2" class="text-secondary text-[16px]">Bahan Tambahan</label>
                </div>
                @error('tipe')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- name --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="name" class="text-secondary text-[16px]">Nama Item</label>
                <input autocomplete="on" id="name" type="text" name="name"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Nama Item...">
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- sisa --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="sisa" class="text-secondary text-[16px]">Sisa</label>
                <input id="sisa" type="text" name="sisa" class="text-secondary text-[16px] p-4 rounded-md"
                    placeholder="Sisa...">
                @error('sisa')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- submit --}}
            <div class="flex items-center gap-3">
                <a href="/item" class="btn btn-outline btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-secondary w-auto">Tambah</button>
            </div>
        </form>
    </div>
</x-layout>
