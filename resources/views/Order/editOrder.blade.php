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
                <select id="bahan_utama_id" name="bahan_utama_id"
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->bahan_utama->name }}" disabled selected
                        class="text-[12px] md:text-[16px]">{{ $order->bahan_utama->name }}
                    </option>
                    @if (count($bahan_utama) > 0)
                        @foreach ($bahan_utama as $bahan)
                            <option value="{{ $bahan->id }}" class="text-[12px] md:text-[16px]">
                                {{ $bahan->name }}</option>
                        @endforeach
                    @else
                        <option value="" disabled>Tidak Ada Bahan Utama</option>
                    @endif
                </select>
                @error('bahan_utama_id')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- bahan tambahan --}}
            <div class="flex flex-col w-full gap-2">
                <label for="bahan_tambahan" class="text-secondary text-[16px]">Bahan Tambahan</label>
                <select id="bahan_tambahan_id" name="bahan_tambahan_id" id=""
                    class="select bg-white text-secondary text-[16px] rounded-md">
                    <option value="{{ $order->bahan_tambahan->name ?? null }}" disabled selected
                        class="text-[12px] md:text-[16px]">{{ $order->bahan_tambahan->name ?? '-' }}
                    </option>
                    @if (count($bahan_tambahan) > 0)
                        @foreach ($bahan_tambahan as $bahan)
                            <option value="{{ $bahan->id }}" class="text-[12px] md:text-[16px]">
                                {{ $bahan->name }}</option>
                        @endforeach
                    @else
                        <option value="" disabled>Tidak Ada Bahan Tambahan</option>
                    @endif
                </select>
                @error('bahan_tambahan_id')
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
                        jumlah_potong: {{ $item['quantity'] ?? 0 }},
                        harga_satuan: '{{ $item['harga_satuan'] ?? 0 }}',
                        get total_harga() {
                            return this.jumlah_potong * this.removeRupiah(this.harga_satuan);
                        },
                        formatRupiah(value) {
                            const number = value.replace(/\D/g, '');
                            return 'Rp. ' + number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        },
                        removeRupiah(value) {
                            return value.replace(/\D/g, '');
                        }
                    }" class="flex flex-col gap-2">
                        <div class="flex items-center gap-1 md:gap-4">
                            {{-- Size --}}
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

                            {{-- Quantity --}}
                            <div class="flex flex-col gap-1 w-[35%] md:w-2/5">
                                <label for="jumlah_potong" class="text-secondary text-[16px]">Quantity</label>
                                <input type="number" name="items[{{ $index }}][quantity]" id="jumlah_potong"
                                    class="text-secondary text-[16px] input bg-white rounded-md"
                                    placeholder="Jumlah Potong..." x-model.number="jumlah_potong">
                                @error('jumlah_potong')
                                    <span class="text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Harga Satuan --}}
                            <div class="flex flex-col gap-2 w-[36%] md:w-2/5">
                                <label for="harga_satuan" class="text-secondary text-[16px]">Harga Satuan</label>
                                <input type="text" name="items[{{ $index }}][harga_satuan]"
                                    id="harga_satuan" class="text-secondary text-[16px] input bg-white rounded-md"
                                    placeholder="Harga Satuan..." x-model="harga_satuan"
                                    x-on:input="harga_satuan = formatRupiah($event.target.value)"
                                    x-on:blur="harga_satuan = removeRupiah(harga_satuan)" />
                                @error('harga_satuan')
                                    <span class="text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Total Harga --}}
                        <div class="w-full hidden">
                            <label for="total_harga">Total Harga</label>
                            <input type="text" name="items[{{ $index }}][total_harga]" id="total_harga"
                                class="p-4 rounded-md" placeholder="Total Harga..." :value="total_harga" readonly>
                            @error('total_harga')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- diskon dan pajak --}}
            <div class="flex items-center gap-1 md:gap-4 w-full">
                {{-- Diskon --}}
                <div class="flex flex-col gap-2 w-[48%] md:w-1/2">
                    <label for="diskon" class="text-secondary text-[16px]">Diskon (%)</label>
                    <input id="diskon" type="number" name="diskon"
                        class="text-secondary text-[16px] p-4 rounded-md" placeholder="Diskon..." />
                    @error('diskon')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Pajak --}}
                <div class="flex flex-col gap-2 w-[48%] md:w-1/2">
                    <label for="pajak" class="text-secondary text-[16px]">Pajak (%)</label>
                    <input id="pajak" type="number" name="pajak"
                        class="text-secondary text-[16px] p-4 rounded-md" placeholder="Pajak..." />
                    @error('pajak')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
            </div>
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
                <button type="submit" class="btn btn-secondary">Simpan</button>
            </div>
        </form>
    </div>
</x-layout>
