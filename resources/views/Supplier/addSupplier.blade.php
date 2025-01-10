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
        <form action="{{ route('AddSupplier') }}" method="POST" class="w-full flex flex-col gap-4 px-40 py-4">
            <h1 class="text-[24px] text-start text-secondary font-semibold">Tambah Supplier</h1>
            @csrf
            {{-- name --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="" class="text-secondary text-[16px]">Nama Supplier</label>
                <input type="text" name="name" class="text-secondary text-[16px] p-4 rounded-md"
                    placeholder="Nama Supplier...">
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- no hp --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="" class="text-secondary text-[16px]">No HP</label>
                <input type="text" name="no_hp" class="text-secondary text-[16px] p-4 rounded-md"
                    placeholder="No HP...">
                @error('no_hp')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- alamat --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="" class="text-secondary text-[16px]">Alamat</label>
                <input type="text" name="alamat" class="text-secondary text-[16px] p-4 rounded-md"
                    placeholder="Alamat...">
                @error('alamat')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- email --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="" class="text-secondary text-[16px]">Email</label>
                <input type="email" name="email" class="text-secondary text-[16px] p-4 rounded-md"
                    placeholder="Email...">
                @error('email')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- bahan utama --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="" class="text-secondary text-[16px]">Bahan Utama</label>
                <select name="bahan_utama" id="" class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="" disabled selected>Pilih Bahan Utama</option>
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
                        <option value="{{ $bahan }}">{{ $bahan }}</option>
                    @endforeach
                </select>
                @error('bahan_utama')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- bahan tambahan --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="" class="text-secondary text-[16px]">Bahan Tambahan</label>
                <select name="bahan_tambahan" id=""
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="" disabled selected>Pilih Bahan Tambahan</option>
                    @php
                        $bahanTambahan = ['Asahi', 'Parasut', 'Jaring', 'Polar', 'Dakron', 'Despo'];
                    @endphp

                    @foreach ($bahanTambahan as $bahan)
                        <option value="{{ $bahan }}">{{ $bahan }}</option>
                    @endforeach
                </select>
                @error('bahan_tambahan')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- jenis kancing --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="" class="text-secondary text-[16px]">Jenis Kancing</label>
                <select name="jenis_kancing" id=""
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="" disabled selected>Pilih jenis Kancing</option>
                    @php
                        $jenisKancing = ['Wangki', 'PDH', 'Jas'];
                    @endphp

                    @foreach ($jenisKancing as $kancing)
                        <option value="{{ $kancing }}">{{ $kancing }}</option>
                    @endforeach
                </select>
                @error('jenis_kancing')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- jenis sleting --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="" class="text-secondary text-[16px]">Jenis Sleting</label>
                <select name="jenis_sleting" id=""
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="" disabled selected>Pilih jenis Kancing</option>
                    <option value="Gigi Halus">Gigi Halus</option>
                    <option value="Gigi Kasar">Gigi Kasar</option>
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
