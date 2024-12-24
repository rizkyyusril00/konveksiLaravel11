<x-layout>
    <div class="flex flex-col items-center justify-center w-full h-full gap-4 pt-[100px] px-4">
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
        <form action="{{ route('EditOrder') }}" enctype="multipart/form-data" method="POST"
            class="w-full flex flex-col gap-4 px-40 py-4">
            <h1 class="text-center">Edit Order</h1>
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
                    <option value="{{ $order->bahan_tambahan }}" disabled selected>{{ $order->bahan_tambahan ?? '-' }}
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
                <select name="penjahit_id" id="" class="p-4 rounded-md">
                    <option value="{{ $order->penjahit->name }}" disabled selected>{{ $order->penjahit->name }}
                    </option>
                    @if (count($penjahits) > 0)
                        @foreach ($penjahits as $penjahit)
                            <option value="{{ $penjahit->id }}">{{ $penjahit->name }}</option>
                        @endforeach
                    @else
                        <option value="" disabled>Tidak Ada Penjahit</option>
                    @endif
                </select>
                @error('penjahit_id')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="">Pemotong</label>
                <select name="pemotong_id" id="" class="p-4 rounded-md">
                    <option value="{{ $order->pemotong->name }}" disabled selected>{{ $order->pemotong->name }}
                    </option>
                    @if (count($pemotongs) > 0)
                        @foreach ($pemotongs as $pemotong)
                            <option value="{{ $pemotong->id }}">{{ $pemotong->name }}</option>
                        @endforeach
                    @else
                        <option value="" disabled>Tidak Ada Pemotong</option>
                    @endif
                </select>
                @error('pemotong_id')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <div x-data="{
                    jumlah_potong: {{ $order->jumlah_potong ?? 0 }},
                    harga_satuan: {{ $order->harga_satuan ?? 0 }},
                    get total_harga() {
                        return this.jumlah_potong * this.harga_satuan;
                    }
                }">
                    <div class="flex items-center gap-4">
                        <div class="flex flex-col gap-1 w-1/5">
                            <label for="size">Size</label>
                            <select name="size" id="size" class="p-4 rounded-md">
                                <option value="{{ $order->size }}" selected>{{ ucfirst($order->size) }}</option>
                                <option value="XXL">XXL</option>
                                <option value="XL">XL</option>
                                <option value="L">L</option>
                            </select>
                            @error('size')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-1 w-2/5">
                            <label for="jumlah_potong">Jumlah Potong</label>
                            <input type="number" name="jumlah_potong" id="jumlah_potong" class="p-4 rounded-md"
                                placeholder="Jumlah Potong..." x-model.number="jumlah_potong">
                            @error('jumlah_potong')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-2 w-2/5">
                            <label for="harga_satuan">Harga Satuan</label>
                            <input type="number" name="harga_satuan" id="harga_satuan" class="p-4 rounded-md"
                                placeholder="Harga Satuan..." x-model.number="harga_satuan">
                            @error('harga_satuan')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                    <div class="hidden gap-2 w-full">
                        <label for="total_harga">Total Harga</label>
                        <input type="text" name="total_harga" id="" class="p-4 rounded-md" readonly
                            x-bind:value="total_harga">
                        @error('total_harga')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


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
                <label for="image_order">Upload Gambar</label>
                <input type="file" name="image_order" class="p-4 rounded-md">
                @if ($order->image_order)
                    <div class="flex gap-2">
                        <div class="w-20 h-20 rounded-md">
                            <img src="{{ asset('storage/' . $order->image_order) }}" alt="Current Image"
                                class="w-full h-full object-cover rounded-md">
                        </div>
                        <span>Gambar Sebelumnya</span>
                    </div>
                @endif
                @error('image_order')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- submit --}}
            <div class="flex items-center gap-3">
                <a href="/"
                    class="btn btn-primary border border-accent w-auto hover:bg-accent hover:text-primary"">Cancel</a>
                <button type="submit" class="btn btn-success w-[100px]">Edit</button>
            </div>
        </form>
    </div>
</x-layout>
