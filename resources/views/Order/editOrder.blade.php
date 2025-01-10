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
        <form action="{{ route('EditOrder') }}" enctype="multipart/form-data" method="POST"
            class="w-full flex flex-col gap-4 px-40 py-4">
            <h1 class="text-[24px] text-start text-secondary font-semibold">Edit Order</h1>
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}" id="">
            {{-- customer --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Customer</label>
                <select name="customer_id" id="" class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->customer->name }}" disabled selected>{{ $order->customer->name }}
                    </option>
                    @if (count($customers) > 0)
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    @else
                        <option value="" disabled>Tidak Ada Customer</option>
                    @endif
                </select>
                @error('customer_id')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- admin --}}
            <div class="hidden">
                <label for="">Admin</label>
                <input type="text" name="admin" value="{{ $order->admin }}" class="p-4 rounded-md"
                    placeholder="Add admin...">
                @error('admin')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- tgl order --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Tanggal Order</label>
                <input type="date" name="tanggal_order" value="{{ $order->getTanggalOrderForInput() }}"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Tanggal Order...">
                @error('tanggal_order')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- tgl selesai --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ $order->getTanggalSelesaiForInput() }}"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Tanggal Selesai..."
                    min="{{ old('tanggal_order') }}">
                @error('tanggal_selesai')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- jenis pakaian --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Jenis Pakaian</label>
                <select name="jenis_pakaian" id=""
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->jenis_pakaian }}" disabled selected>{{ $order->jenis_pakaian }}
                    </option>
                    <option value="Kemeja">Kemeja</option>
                    <option value="Kaos">Kaos</option>
                    <option value="Batik">Batik</option>
                </select>
                @error('jenis_pakaian')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- bahan utama --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Bahan Utama</label>
                <select name="bahan_utama" id="" class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->bahan_utama }}" disabled selected>{{ $order->bahan_utama }}</option>
                    <option value="Combed 20">Combed 20</option>
                    <option value="Combed 24s">Combed 24s</option>
                    <option value="Combed 30s">Combed 30s</option>
                </select>
                @error('bahan_utama')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- bahan tambahan --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Bahan Tambahan</label>
                <select name="bahan_tambahan" id=""
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->bahan_tambahan }}" disabled selected>
                        {{ $order->bahan_tambahan ?? '-' }}
                    </option>
                    <option value="Asahi">Asahi</option>
                    <option value="Parasut">Parasut</option>
                    <option value="Jaring">Jaring</option>
                </select>
                @error('bahan_tambahan')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- jenis kancing --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Jenis Kancing</label>
                <select name="jenis_kancing" id=""
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->jenis_kancing }}" disabled selected>{{ $order->jenis_kancing }}
                    </option>
                    <option value="Wangki">Wangki</option>
                    <option value="PDH">PDH</option>
                    <option value="Jas">Jas</option>
                </select>
                @error('jenis_kancing')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- penjahit --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Penjahit</label>
                <select name="penjahit_id" id=""
                    class="select bg-white text-secondary text-[16px] rounded-md">
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
            </div>
            {{-- pemotong --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Pemotong</label>
                <select name="pemotong_id" id=""
                    class="select bg-white text-secondary text-[16px] rounded-md">
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
            </div>
            {{-- item --}}
            @foreach ($order->items as $index => $item)
                <div class="flex flex-col gap-2">
                    <div x-data="{
                        jumlah_potong: {{ $order->items[$index]['quantity'] ?? $index }},
                        harga_satuan: {{ $order->items[$index]['harga_satuan'] ?? 0 }},
                        get total_harga() {
                            return this.jumlah_potong * this.harga_satuan;
                        }
                    }" class="flex flex-col gap-2">
                        <div class="flex items-center gap-4">
                            {{-- size --}}
                            <div class="flex flex-col gap-1 w-1/5">
                                <label for="size" class="text-secondary text-[16px]">Size</label>
                                <select name="items[{{ $index }}][size]" id="size"
                                    class="select bg-white text-secondary text-[16px] rounded-md">
                                    <option value="{{ $item['size'] ?? '-' }}" selected>{{ $item['size'] ?? '-' }}
                                    </option>
                                    <option value="XXL">XXL</option>
                                    <option value="XL">XL</option>
                                    <option value="L">L</option>
                                </select>
                                @error('size')
                                    <span class="text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- quantity --}}
                            <div class="flex flex-col gap-1 w-2/5">
                                <label for="jumlah_potong" class="text-secondary text-[16px]">Quantity</label>
                                <input type="number" name="items[{{ $index }}][quantity]" id="jumlah_potong"
                                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Jumlah Potong..."
                                    x-model.number="jumlah_potong">
                                @error('jumlah_potong')
                                    <span class="text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- harga satuan --}}
                            <div class="flex flex-col gap-2 w-2/5">
                                <label for="harga_satuan" class="text-secondary text-[16px]">Harga Satuan</label>
                                <input type="number" name="items[{{ $index }}][harga_satuan]"
                                    id="harga_satuan" class="text-secondary text-[16px] p-4 rounded-md"
                                    placeholder="Harga Satuan..." x-model.number="harga_satuan">
                                @error('harga_satuan')
                                    <span class="text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class=" gap-2 w-full hidden">
                            <label for="total_harga">Total Harga</label>
                            <input type="text" name="items[{{ $index }}][total_harga]" id=""
                                class="p-4 rounded-md" readonly x-bind:value="total_harga">
                            @error('total_harga')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- status --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Status</label>
                <select name="status" id="" class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->status }}" disabled selected>{{ $order->status }}</option>
                    <option value="Antrian">Antrian</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Selesai">Selesai</option>
                </select>
                @error('status')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- note --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Catatan</label>
                <textarea name="note" class="textarea textarea-bordered text-secondary text-[16px] p-4 rounded-md"
                    placeholder="Masukan catatan anda...">{{ $order->note }}</textarea>
                @error('note')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- upload gambar --}}
            <div class="flex flex-col w-full gap-2">
                <label for="image_order">Upload Gambar</label>
                <input type="file" name="image_order"
                    class="file-input file-input-bordered file-input-secondary file-input-md w-full max-w-xs">
                @if ($order->image_order == null)
                    <div class="flex gap-2">
                        <figure class="w-24 h-24 rounded-md">
                            <div class="w-full h-full bg-slate-200 flex items-center justify-center">
                                <span class="text-center text-secondary">No Img</span>
                            </div>
                        </figure>
                        <span class="text-center text-secondary">Tidak ada gambar Sebelumnya</span>
                    </div>
                @else
                    <div class="flex gap-2">
                        <figure class="w-24 h-24 rounded-md">
                            <img src="{{ asset('storage/' . $order->image_order) }}" alt="Current Image"
                                class="w-full h-full object-cover rounded-md">
                        </figure>
                        <span class="text-center text-secondary">Gambar Sebelumnya</span>
                    </div>
                @endif
                @error('image_order')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- submit --}}
            <div class="flex items-center gap-3">
                <a href="/" class="btn btn-outline btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-secondary">Edit</button>
            </div>
        </form>
    </div>
</x-layout>
