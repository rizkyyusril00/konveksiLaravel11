<x-layout>
    <div class="flex flex-col items-center justify-center w-full h-full gap-4 pt-4 px-4 bg-primary">
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
        <form action="{{ route('EditKaryawan') }}" method="POST" class="w-full flex flex-col gap-4 px-40 py-4">
            <h1 class="text-[24px] text-start text-secondary font-semibold">Edit karyawan</h1>
            @csrf
            <input type="hidden" name="karyawan_id" value="{{ $karyawan->id }}" id="">
            {{-- name --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="" class="text-secondary text-[16px]">Nama</label>
                <input type="text" name="name" value="{{ $karyawan->name }}"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Nama Karyawan...">
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- pekerjaan --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="" class="text-secondary text-[16px]">Pekerjaan</label>
                <select name="pekerjaan" id="" class="text-secondary text-[16px] p-4 rounded-md">
                    <option value="value="{{ $karyawan->pekerjaan }}"" disabled selected>{{ $karyawan->pekerjaan }}
                    </option>
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
                <input type="text" name="upah" value="{{ $karyawan->upah }}"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Upah Karyawan...">
                @error('upah')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- submit --}}
            <div class="flex items-center gap-3">
                <a href="/karyawan" class="btn btn-outline btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-secondary">Edit</button>
            </div>
        </form>
    </div>
</x-layout>
