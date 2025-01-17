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
        <form action="{{ route('EditOrder') }}" enctype="multipart/form-data" method="POST"
            class="w-full flex flex-col gap-4 p-3 md:px-8 2xl:px-4 md:py-4">
            <a href="/" class="flex md:hidden items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-secondary" width="16" height="16"
                    fill="#000000" viewBox="0 0 256 256">
                    <path
                        d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z">
                    </path>
                </svg>
                <span class="text-[14px] text-secondary">Kembali</span>
            </a>
            <h1 class="text-[24px] text-start text-secondary font-semibold">Edit Order</h1>
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}" id="">
            {{-- customer --}}
            <div class="flex flex-col w-full gap-2">
                <label for="customer_id" class="text-secondary text-[16px]">Customer</label>
                <select name="customer_id" id="customer_id"
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->customer->name }}" disabled selected class="text-[12px] md:text-[16px]">
                        {{ $order->customer->name }}
                    </option>
                    @if (count($customers) > 0)
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" class="text-[12px] md:text-[16px]">{{ $customer->name }}
                            </option>
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
                <label for="admin">Admin</label>
                <input id="admin" type="text" name="admin" value="{{ $order->admin }}" class="p-4 rounded-md"
                    placeholder="Add admin...">
                @error('admin')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- tgl order --}}
            <div class="flex flex-col w-full gap-2">
                <label for="tanggal_order" class="text-secondary text-[16px]">Tanggal Order</label>
                <input id="tanggal_order" type="date" name="tanggal_order"
                    value="{{ $order->getTanggalOrderForInput() }}" class="text-secondary text-[16px] p-4 rounded-md"
                    placeholder="Tanggal Order...">
                @error('tanggal_order')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- tgl selesai --}}
            <div class="flex flex-col w-full gap-2">
                <label for="tanggal_selesai" class="text-secondary text-[16px]">Tanggal Selesai</label>
                <input id="tanggal_selesai" type="date" name="tanggal_selesai"
                    value="{{ $order->getTanggalSelesaiForInput() }}" class="text-secondary text-[16px] p-4 rounded-md"
                    placeholder="Tanggal Selesai..." min="{{ old('tanggal_order') }}">
                @error('tanggal_selesai')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- jenis pakaian --}}
            <div class="flex flex-col w-full gap-2">
                <label for="jenis_pakaian" class="text-secondary text-[16px]">Jenis Pakaian</label>
                <select name="jenis_pakaian" id="jenis_pakaian"
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->jenis_pakaian }}" disabled selected class="text-[12px] md:text-[16px]">
                        {{ $order->jenis_pakaian }}
                    </option>
                    <option value="Kemeja" class="text-[12px] md:text-[16px]">Kemeja</option>
                    <option value="Kaos" class="text-[12px] md:text-[16px]">Kaos</option>
                    <option value="Batik" class="text-[12px] md:text-[16px]">Batik</option>
                </select>
                @error('jenis_pakaian')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- bahan utama --}}
            <div class="flex flex-col w-full gap-2">
                <label for="bahan_utama" class="text-secondary text-[16px]">Bahan Utama</label>
                <select name="bahan_utama" id="bahan_utama"
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->bahan_utama }}" disabled selected class="text-[12px] md:text-[16px]">
                        {{ $order->bahan_utama }}</option>
                    <option value="Combed 20" class="text-[12px] md:text-[16px]">Combed 20</option>
                    <option value="Combed 24s" class="text-[12px] md:text-[16px]">Combed 24s</option>
                    <option value="Combed 30s" class="text-[12px] md:text-[16px]">Combed 30s</option>
                </select>
                @error('bahan_utama')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- bahan tambahan --}}
            <div class="flex flex-col w-full gap-2">
                <label for="bahan_tambahan" class="text-secondary text-[16px]">Bahan Tambahan</label>
                <select name="bahan_tambahan" id="bahan_tambahan"
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->bahan_tambahan }}" disabled selected
                        class="text-[12px] md:text-[16px]">
                        {{ $order->bahan_tambahan ?? '-' }}
                    </option>
                    <option value="Asahi" class="text-[12px] md:text-[16px]">Asahi</option>
                    <option value="Parasut" class="text-[12px] md:text-[16px]">Parasut</option>
                    <option value="Jaring" class="text-[12px] md:text-[16px]">Jaring</option>
                </select>
                @error('bahan_tambahan')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- jenis kancing --}}
            <div class="flex flex-col w-full gap-2">
                <label for="jenis_kancing" class="text-secondary text-[16px]">Jenis Kancing</label>
                <select name="jenis_kancing" id="jenis_kancing"
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->jenis_kancing }}" disabled selected class="text-[12px] md:text-[16px]">
                        {{ $order->jenis_kancing ?? '-' }}
                    </option>
                    <option value="Wangki" class="text-[12px] md:text-[16px]">Wangki</option>
                    <option value="PDH" class="text-[12px] md:text-[16px]">PDH</option>
                    <option value="Jas" class="text-[12px] md:text-[16px]">Jas</option>
                </select>
                @error('jenis_kancing')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- penjahit --}}
            <div class="flex flex-col w-full gap-2">
                <label for="penjahit_id" class="text-secondary text-[16px]">Penjahit</label>
                <select name="penjahit_id" id="penjahit_id"
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->penjahit->name }}" disabled selected
                        class="text-[12px] md:text-[16px]">{{ $order->penjahit->name }}
                    </option>
                    @if (count($penjahits) > 0)
                        @foreach ($penjahits as $penjahit)
                            <option value="{{ $penjahit->id }}" class="text-[12px] md:text-[16px]">
                                {{ $penjahit->name }}</option>
                        @endforeach
                    @else
                        <option value="" disabled class="text-[12px] md:text-[16px]">Tidak Ada Penjahit</option>
                    @endif
                </select>
                @error('penjahit_id')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- pemotong --}}
            <div class="flex flex-col w-full gap-2">
                <label for="pemotong_id" class="text-secondary text-[16px]">Pemotong</label>
                <select name="pemotong_id" id="pemotong_id"
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->pemotong->name }}" disabled selected
                        class="text-[12px] md:text-[16px]">{{ $order->pemotong->name }}
                    </option>
                    @if (count($pemotongs) > 0)
                        @foreach ($pemotongs as $pemotong)
                            <option value="{{ $pemotong->id }}" class="text-[12px] md:text-[16px]">
                                {{ $pemotong->name }}</option>
                        @endforeach
                    @else
                        <option value="" disabled class="text-[12px] md:text-[16px]">Tidak Ada Pemotong</option>
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
                        <div class="flex items-center gap-1 md:gap-4">
                            {{-- size --}}
                            <div class="flex flex-col gap-1 w-[25%] md:w-1/5">
                                <label for="size" class="text-secondary text-[16px]">Size</label>
                                <select name="items[{{ $index }}][size]" id="size"
                                    class="select bg-white text-secondary text-[16px] rounded-md">
                                    <option value="{{ $item['size'] ?? '-' }}" selected
                                        class="text-[12px] md:text-[16px]">{{ $item['size'] ?? '-' }}
                                    </option>
                                    <option value="XXL" class="text-[12px] md:text-[16px]">XXL</option>
                                    <option value="XL" class="text-[12px] md:text-[16px]">XL</option>
                                    <option value="L" class="text-[12px] md:text-[16px]">L</option>
                                    <option value="M" class="text-[12px] md:text-[16px]">M</option>
                                    <option value="S" class="text-[12px] md:text-[16px]">S</option>
                                </select>
                                @error('size')
                                    <span class="text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- quantity --}}
                            <div class="flex flex-col gap-1 w-[35%] md:w-2/5">
                                <label for="jumlah_potong" class="text-secondary text-[16px]">Quantity</label>
                                <input type="number" name="items[{{ $index }}][quantity]" id="jumlah_potong"
                                    class="text-secondary text-[16px] input bg-white rounded-md"
                                    placeholder="Jumlah Potong..." x-model.number="jumlah_potong">
                                @error('jumlah_potong')
                                    <span class="text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- harga satuan --}}
                            <div class="flex flex-col gap-2 w-[36%] md:w-2/5">
                                <label for="harga_satuan" class="text-secondary text-[16px]">Harga Satuan</label>
                                <input type="number" name="items[{{ $index }}][harga_satuan]"
                                    id="harga_satuan" class="text-secondary text-[16px] input bg-white rounded-md"
                                    placeholder="Harga Satuan..." x-model.number="harga_satuan">
                                @error('harga_satuan')
                                    <span class="text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class=" gap-2 w-full hidden">
                            <label for="total_harga">Total Harga</label>
                            <input type="text" name="items[{{ $index }}][total_harga]" id="total_harga"
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
                <label for="status" class="text-secondary text-[16px]">Status</label>
                <select name="status" id="status" class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->status }}" disabled selected class="text-[12px] md:text-[16px]">
                        {{ $order->status }}</option>
                    <option value="Antrian" class="text-[12px] md:text-[16px]">Antrian</option>
                    <option value="Diproses" class="text-[12px] md:text-[16px]">Diproses</option>
                    <option value="Selesai" class="text-[12px] md:text-[16px]">Selesai</option>
                </select>
                @error('status')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- note --}}
            <div class="flex flex-col w-full gap-2">
                <label for="note" class="text-secondary text-[16px]">Catatan</label>
                <textarea id="note" name="note" class="textarea textarea-bordered text-secondary text-[16px] p-4 rounded-md"
                    placeholder="Masukan catatan anda...">{{ $order->note }}</textarea>
                @error('note')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- upload gambar --}}
            <div class="flex flex-col w-full gap-2">
                <label for="image_order">Upload Gambar</label>
                <input id="image_order" type="file" name="image_order"
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
                        <figure class="w-32 h-36w-32 rounded-md">
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
