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
        <form action="{{ route('EditPembelian') }}" method="POST"
            class="w-full flex flex-col gap-4 p-3 md:px-8 2xl:px-4 md:py-4">
            <a href="/pembelian" class="flex md:hidden items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-secondary" width="16" height="16"
                    fill="#000000" viewBox="0 0 256 256">
                    <path
                        d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z">
                    </path>
                </svg>
                <span class="text-[14px] text-secondary">Kembali</span>
            </a>
            <h1 class="text-[24px] text-start text-secondary font-semibold">Edit Pembelian</h1>
            @csrf
            <input type="hidden" name="pembelian_id" value="{{ $pembelian->id }}" id="">
            {{-- invoice --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="invoice" class="text-secondary text-[16px]">Invoice</label>
                <input autocomplete="on" id="invoice" type="text" name="invoice"
                    class="text-secondary text-[16px] p-4 rounded-md" value="{{ $pembelian->invoice }}"
                    placeholder="Invoice...">
                @error('invoice')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- name supplier --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="name_supplier" class="text-secondary text-[16px]">Nama Supplier</label>
                <input autocomplete="on" id="name_supplier" type="text" name="name_supplier"
                    class="text-secondary text-[16px] p-4 rounded-md" value="{{ $pembelian->name_supplier }}"
                    placeholder="Nama Supplier...">
                @error('name_supplier')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- name barang --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="name" class="text-secondary text-[16px]">Nama Barang</label>
                <input autocomplete="on" id="name" type="text" name="name"
                    class="text-secondary text-[16px] p-4 rounded-md" value="{{ $pembelian->name }}"
                    placeholder="Nama Barang...">
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- tgl pembelian --}}
            <div class="flex flex-col w-full gap-2">
                <label for="tanggal_pembelian" class="text-secondary text-[16px]">Tanggal Pembelian</label>
                <input id="tanggal_pembelian" type="date" name="tanggal_pembelian"
                    value="{{ $pembelian->getTanggalPembelianForInput() }}"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Tanggal Pembelian...">
                @error('tanggal_pembelian')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- tgl tempo --}}
            <div class="flex flex-col w-full gap-2">
                <label for="tanggal_tempo" class="text-secondary text-[16px]">Tanggal Tempo</label>
                <input id="tanggal_tempo" type="date" name="tanggal_tempo"
                    value="{{ $pembelian->getTanggalTempoForInput() }}"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Tanggal Tempo..."
                    min="{{ old('tanggal_pembelian') }}">
                @error('tanggal_tempo')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- jumlah --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="jumlah" class="text-secondary text-[16px]">Jumlah Barang</label>
                <input id="jumlah" type="number" name="jumlah" class="text-secondary text-[16px] p-4 rounded-md"
                    value="{{ $pembelian->jumlah }}" placeholder="Jumlah barang...">
                @error('jumlah')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- bayar --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="bayar" class="text-secondary text-[16px]">Bayar</label>
                <input id="bayar" type="number" name="bayar" class="text-secondary text-[16px] p-4 rounded-md"
                    value="{{ $pembelian->bayar }}" placeholder="Bayar...">
                @error('bayar')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- hutang --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="hutang" class="text-secondary text-[16px]">Hutang</label>
                <input id="hutang" type="number" name="hutang"
                    class="text-secondary text-[16px] p-4 rounded-md" value="{{ $pembelian->hutang ?? null }}"
                    placeholder="Hutang...">
                @error('hutang')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- status --}}
            <div class="flex flex-col gap-2 w-full">
                <span class="text-secondary text-[16px]">Pilih Status</span>
                <div class="flex items-center gap-1">
                    <input id="tipe1" type="radio" name="status" class="radio radio-secondary radio-sm"
                        value="Lunas" {{ $pembelian->status == 'Lunas' ? 'checked' : '' }}>
                    <label for="tipe1" class="text-secondary text-[16px]">Lunas</label>
                </div>
                <div class="flex items-center gap-1">
                    <input id="tipe2" type="radio" name="status" class="radio radio-secondary radio-sm"
                        value="Belum Lunas" {{ $pembelian->status == 'Belum Lunas' ? 'checked' : '' }}>
                    <label for="tipe2" class="text-secondary text-[16px]">Belum Lunas</label>
                </div>
                @error('status')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center gap-3">
                <a href="/status" class="btn btn-outline btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-secondary">Edit</button>
            </div>
        </form>
    </div>
</x-layout>
