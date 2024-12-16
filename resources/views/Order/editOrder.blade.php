<x-layout>
    <div class="flex flex-col items-center justify-center w-full h-full gap-4 pt-[100px] px-4">
        <h1>Edit Order</h1>
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
        <form action="{{ route('EditOrder') }}" method="POST" class="w-full flex flex-col gap-4 px-40">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}" id="">
            <div class="flex flex-col gap-1 w-full">
                <label for="">Customer</label>
                <input type="text" name="customer" value="{{ $order->customer }}" class="p-4 rounded-md"
                    placeholder="Add Customer...">
                @error('customer')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Admin</label>
                <input type="text" name="admin" value="{{ $order->admin }}" class="p-4 rounded-md"
                    placeholder="Add admin...">
                @error('admin')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Tanggal Order</label>
                <input type="date" name="tanggal_order" value="{{ $order->getTanggalOrderForInput() }}"
                    class="p-4 rounded-md" placeholder="Tanggal Order...">
                @error('tanggal_order')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ $order->getTanggalSelesaiForInput() }}"
                    class="p-4 rounded-md" placeholder="Tanggal Selesai..." min="{{ old('tanggal_order') }}">
                @error('tanggal_selesai')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Jenis Pakaian</label>
                <select name="jenis_pakaian" id="" class="p-4 rounded-md">
                    <option value="{{ $order->jenis_pakaian }}" disabled selected>{{ $order->jenis_pakaian }}</option>
                    <option value="Kemeja">Kemeja</option>
                    <option value="Kaos">Kaos</option>
                    <option value="Batik">Batik</option>
                </select>
                @error('jenis_pakaian')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Bahan Utama</label>
                <select name="bahan_utama" id="" class="p-4 rounded-md">
                    <option value="{{ $order->bahan_utama }}" disabled selected>{{ $order->bahan_utama }}</option>
                    <option value="Combed 20">Combed 20</option>
                    <option value="Combed 24s">Combed 24s</option>
                    <option value="Combed 30s">Combed 30s</option>
                </select>
                @error('bahan_utama')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Bahan Tambahan</label>
                <select name="bahan_tambahan" id="" class="p-4 rounded-md">
                    <option value="{{ $order->bahan_tambahan }}" disabled selected>{{ $order->bahan_tambahan }}
                    </option>
                    <option value="Asahi">Asahi</option>
                    <option value="Parasut">Parasut</option>
                    <option value="Jaring">Jaring</option>
                </select>
                @error('bahan_tambahan')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Jenis Kancing</label>
                <select name="jenis_kancing" id="" class="p-4 rounded-md">
                    <option value="{{ $order->jenis_kancing }}" disabled selected>{{ $order->jenis_kancing }}</option>
                    <option value="Wangki">Wangki</option>
                    <option value="PDH">PDH</option>
                    <option value="Jas">Jas</option>
                </select>
                @error('jenis_kancing')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Penjahit</label>
                <select name="penjahit" id="" class="p-4 rounded-md">
                    <option value="{{ $order->penjahit }}" disabled selected>{{ $order->penjahit }}</option>
                    <option value="Asep">Asep</option>
                    <option value="Agus">Agus</option>
                    <option value="Ali">Ali</option>
                </select>
                @error('penjahit')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Pemotong</label>
                <select name="pemotong" id="" class="p-4 rounded-md">
                    <option value="{{ $order->pemotong }}" disabled selected>{{ $order->pemotong }}</option>
                    <option value="Asep">Asep</option>
                    <option value="Agus">Agus</option>
                    <option value="Ali">Ali</option>
                </select>
                @error('pemotong')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Size</label>
                <select name="size" id="" class="p-4 rounded-md">
                    <option value="{{ $order->size }}" disabled selected>{{ $order->size }}</option>
                    <option value="xxl">xxl</option>
                    <option value="xl">xl</option>
                    <option value="l">l</option>
                </select>
                @error('size')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Jumlah Potong</label>
                <input type="text" name="jumlah_potong" value="{{ $order->jumlah_potong }}"
                    class="p-4 rounded-md" placeholder="Jumalah Potong...">
                @error('jumlah_potong')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Harga Satuan</label>
                <input type="text" name="harga_satuan" value="{{ $order->harga_satuan }}" class="p-4 rounded-md"
                    placeholder="Harga Satuan...">
                @error('harga_satuan')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Status</label>
                <select name="status" id="" class="p-4 rounded-md">
                    <option value="{{ $order->status }}" disabled selected>{{ $order->status }}</option>
                    <option value="Antrian">Antrian</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Selesai">Selesai</option>
                </select>
                @error('status')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- submit --}}
            <button type="submit" class="btn btn-success w-[100px]">Edit</button>
        </form>
    </div>
</x-layout>
