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
        <form action="{{ route('AddSupplier') }}" method="POST"
            class="w-full flex flex-col gap-4 p-3 md:px-8 2xl:px-4 md:py-4">
            <a href="/supplier" class="flex md:hidden items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-secondary" width="16" height="16"
                    fill="#000000" viewBox="0 0 256 256">
                    <path
                        d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z">
                    </path>
                </svg>
                <span class="text-[14px] text-secondary">Kembali</span>
            </a>
            <h1 class="text-[24px] text-start text-secondary font-semibold">Tambah Supplier</h1>
            @csrf
            {{-- name --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="name" class="text-secondary text-[16px]">Nama Supplier</label>
                <input autocomplete="on" id="name" type="text" name="name"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Nama Supplier...">
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- no hp --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="no_hp" class="text-secondary text-[16px]">No HP</label>
                <input id="no_hp" type="text" name="no_hp" class="text-secondary text-[16px] p-4 rounded-md"
                    placeholder="No HP...">
                @error('no_hp')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- alamat --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="alamat" class="text-secondary text-[16px]">Alamat</label>
                <input id="alamat" type="text" name="alamat" class="text-secondary text-[16px] p-4 rounded-md"
                    placeholder="Alamat...">
                @error('alamat')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- email --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="email" class="text-secondary text-[16px]">Email</label>
                <input autocomplete="on" id="email" type="email" name="email"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Email...">
                @error('email')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- bahan utama --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="bahan_utama" class="text-secondary text-[16px]">Bahan Utama</label>
                <select id="bahan_utama" name="bahan_utama"
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="" disabled selected class="text-[12px] md:text-[16px]">Pilih Bahan Utama
                    </option>
                    @php
                        $bahanUtama = [
                            'Combed 20',
                            'Combed 24s',
                            'Combed 30s',
                            'Heavy cotton',
                            'Lacoste 20s',
                            'Lacoste 24s',
                            'Diadora',
                            'Adidas',
                            'American drill',
                            'Pasada',
                            'Ribstock',
                            'Canvas',
                            'Parasut',
                            'Fleece Cotton',
                            'Fleece PE',
                            'Fleece CVC',
                            'Baby Terry',
                            'Milano',
                            'Brazil',
                            'Waffle',
                            'Embose',
                        ];
                    @endphp

                    @foreach ($bahanUtama as $bahan)
                        <option value="{{ $bahan }}" class="text-[12px] md:text-[16px]">{{ $bahan }}
                        </option>
                    @endforeach
                </select>
                @error('bahan_utama')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- bahan tambahan --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="bahan_tambahan" class="text-secondary text-[16px]">Bahan Tambahan</label>
                <select name="bahan_tambahan" id="bahan_tambahan"
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="" disabled selected class="text-[12px] md:text-[16px]">Pilih Bahan Tambahan
                    </option>
                    @php
                        $bahanTambahan = ['Asahi', 'Parasut', 'Jaring', 'Polar', 'Dakron', 'Despo'];
                    @endphp

                    @foreach ($bahanTambahan as $bahan)
                        <option value="{{ $bahan }}" class="text-[12px] md:text-[16px]">{{ $bahan }}
                        </option>
                    @endforeach
                </select>
                @error('bahan_tambahan')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- jenis kancing --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="jenis_kancing" class="text-secondary text-[16px]">Jenis Kancing</label>
                <select name="jenis_kancing" id="jenis_kancing"
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="" disabled selected class="text-[12px] md:text-[16px]">Pilih jenis Kancing
                    </option>
                    @php
                        $jenisKancing = ['Wangki', 'PDH', 'Jas'];
                    @endphp

                    @foreach ($jenisKancing as $kancing)
                        <option value="{{ $kancing }}" class="text-[12px] md:text-[16px]">{{ $kancing }}
                        </option>
                    @endforeach
                </select>
                @error('jenis_kancing')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- jenis sleting --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="jenis_sleting" class="text-secondary text-[16px]">Jenis Sleting</label>
                <select name="jenis_sleting" id="jenis_sleting"
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="" disabled selected class="text-[12px] md:text-[16px]">Pilih jenis Kancing
                    </option>
                    <option value="Gigi Halus" class="text-[12px] md:text-[16px]">Gigi Halus</option>
                    <option value="Gigi Kasar" class="text-[12px] md:text-[16px]">Gigi Kasar</option>
                </select>
                @error('jenis_kancing')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- submit --}}
            <div class="flex items-center gap-3">
                <a href="/supplier" class="btn btn-outline btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-secondary w-auto">Tambah</button>
            </div>
        </form>
    </div>
</x-layout>
