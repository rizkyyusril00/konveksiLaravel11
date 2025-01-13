<x-layout>
    <div class="w-full md:w-[75%] lg:w-[80%] pt-4 px-2 md:pl-12 md:pr-4 lg:px-4 h-screen bg-primary flex flex-col gap-4">
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
        <form action="{{ route('AddKaryawan') }}" method="POST" class="w-full flex flex-col gap-4 px-8 py-4">
            <h1 class="text-[24px] text-start text-secondary font-semibold">Tambah Karyawan</h1>
            @csrf
            {{-- name --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="" class="text-secondary text-[16px]">Nama</label>
                <input type="text" name="name" class="text-secondary text-[16px] p-4 rounded-md"
                    placeholder="Nama Karyawan...">
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- pekerjaan --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="" class="text-secondary text-[16px]">Pekerjaan</label>
                <select name="pekerjaan" id="" class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="" disabled selected>Pilih Pekerjaan</option>
                    <option value="Penjahit">Penjahit</option>
                    <option value="Pemotong">Pemotong</option>
                </select>
                @error('pekerjaan')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- upah --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="" class="text-secondary text-[16px]">Upah</label>
                <input type="text" name="upah" class="text-secondary text-[16px] p-4 rounded-md"
                    placeholder="Upah Karyawan...">
                @error('upah')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- submit --}}
            <div class="flex items-center gap-3">
                <a href="/karyawan" class="btn btn-outline btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-secondary w-auto">Tambah</button>
            </div>
        </form>
    </div>
</x-layout>
