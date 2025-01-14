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
        <form action="{{ route('EditKaryawan') }}" method="POST"
            class="w-full flex flex-col gap-4 px-2 pb-24 md:px-8 2xl:px-4 md:py-4">
            <h1 class="text-[24px] text-start text-secondary font-semibold">Edit karyawan</h1>
            @csrf
            <input type="hidden" name="karyawan_id" value="{{ $karyawan->id }}" id="">
            {{-- name --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="name" class="text-secondary text-[16px]">Nama</label>
                <input autocomplete="on" id="name" type="text" name="name" value="{{ $karyawan->name }}"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Nama Karyawan...">
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- pekerjaan --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="pekerjaan" class="text-secondary text-[16px]">Pekerjaan</label>
                <select name="pekerjaan" id="pekerjaan" class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $karyawan->pekerjaan }}" class="text-[12px] md:text-[16px]" disabled selected>
                        {{ $karyawan->pekerjaan }}
                    </option>
                    <option value="Penjahit" class="text-[12px] md:text-[16px]">Penjahit</option>
                    <option value="Pemotong" class="text-[12px] md:text-[16px]">Pemotong</option>
                </select>
                @error('pekerjaan')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- upah --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="upah" class="text-secondary text-[16px]">Upah</label>
                <input id="upah" type="text" name="upah" value="{{ $karyawan->upah }}"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Upah Karyawan...">
                @error('upah')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- submit --}}
            <div class="flex items-center gap-3">
                <a href="/karyawan" class="btn btn-outline btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-secondary">Edit</button>
            </div>
        </form>
    </div>
</x-layout>
