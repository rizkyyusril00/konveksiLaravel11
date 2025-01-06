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
        <form action="{{ route('AddOrder') }}" enctype="multipart/form-data" method="POST"
            class="w-full flex flex-col gap-4 px-40 py-4">
            <h1 class="text-[24px] text-start text-secondary font-semibold">Tambah Order</h1>
            @csrf
            {{-- customer --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Customer</label>
                <input type="text" name="customer" value="{{ old('customer') }}"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Nama Customer...">
                @error('customer')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- admin --}}
            <div class="hidden">
                @auth('admin')
                    <input type="text" name="admin" class="p-4 rounded-md hidden" placeholder="Nama Admin..."
                        value="{{ auth('admin')->user()->name }}">
                @else('user')
                    <input type="text" name="admin" class="p-4 rounded-md hidden" placeholder="Nama Admin..."
                        value="{{ auth('user')->user()->name }}">
                @endauth
                @error('admin')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- tgl order --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Tanggal Order</label>
                <input type="date" name="tanggal_order" value="{{ old('tanggal_order') }}"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Tanggal Order...">
                @error('tanggal_order')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- tgl selesai --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Tanggal Selesai..."
                    min="{{ old('tanggal_order') }}">
                @error('tanggal_selesai')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- jenis pakaian --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Jenis Pakaian</label>
                <select name="jenis_pakaian" id="" class="text-secondary text-[16px] p-4 rounded-md">
                    <option value="" disabled selected>Pilih jenis pakaian</option>
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
                <select name="bahan_utama" id="" class="text-secondary text-[16px] p-4 rounded-md">
                    <option value="" disabled selected>Pilih Bahan Utama</option>
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
                <select name="bahan_tambahan" id="" class="text-secondary text-[16px] p-4 rounded-md">
                    <option value="" disabled selected>Pilih Bahan Tambahan</option>
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
                <select name="jenis_kancing" id="" class="text-secondary text-[16px] p-4 rounded-md">
                    <option value="" disabled selected>Pilih jenis Kancing</option>
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
                <select name="penjahit_id" class="text-secondary text-[16px] p-4 rounded-md">
                    <option value="" disabled selected>Pilih Penjahit</option>
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
                <select name="pemotong_id" class="text-secondary text-[16px] p-4 rounded-md">
                    <option value="" disabled selected>Pilih Pemotong</option>
                    @if (count($pemotongs) > 0)
                        @foreach ($pemotongs as $pemotong)
                            <option value="{{ $pemotong->id }}">{{ $pemotong->name }}</option>
                        @endforeach
                    @else
                        <option value="" disabled>Tidak Ada Pemotong</option>
                    @endif
                </select>
                @error('pemotong')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- items --}}
            <div class="flex flex-col w-full gap-2" x-data="{
                items: [
                    { size: '', quantity: null, harga_satuan: null }
                ],
                toggleItem() {
                    if (this.items.length < 3) {
                        this.items.push({ size: '', quantity: null, harga_satuan: null });
                    } else {
                        this.items = [{ size: '', quantity: null, harga_satuan: null }];
                    }
                }
            }">
                <!-- Items -->
                <template x-for="(item, index) in items" :key="index">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-4">
                            <!-- Size -->
                            <div class="flex flex-col gap-1 w-1/5">
                                <label :for="'size' + index" class="text-secondary text-[16px]">Size</label>
                                <select :name="`items[${index}][size]`" :id="'size' + index"
                                    class="text-secondary text-[16px] p-4 rounded-md" x-model="item.size">
                                    <option value="" disabled selected>Pilih Size</option>
                                    <option value="XXL">XXL</option>
                                    <option value="XL">XL</option>
                                    <option value="L">L</option>
                                </select>
                            </div>
                            <!-- Quantity -->
                            <div class="flex flex-col gap-1 w-2/5">
                                <label :for="'quantity' + index" class="text-secondary text-[16px]">Quantity</label>
                                <input type="number" :name="`items[${index}][quantity]`" :id="'quantity' + index"
                                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Quantity..."
                                    x-model.number="item.quantity">
                            </div>
                            <!-- Harga Satuan -->
                            <div class="flex flex-col gap-1 w-2/5">
                                <label :for="'harga_satuan' + index" class="text-secondary text-[16px]">Harga
                                    Satuan</label>
                                <input type="number" :name="`items[${index}][harga_satuan]`"
                                    :id="'harga_satuan' + index" class="text-secondary text-[16px] p-4 rounded-md"
                                    placeholder="Harga Satuan..." x-model.number="item.harga_satuan">
                            </div>
                        </div>
                        <!-- Total Harga -->
                        <div class="w-full">
                            <label :for="'total_harga' + index" class="text-[#222222] text-[16px]">Total Harga</label>
                            <input type="number" :name="`items[${index}][total_harga]`" :id="'total_harga' + index"
                                class="p-4 rounded-md" placeholder="Total Harga..."
                                :value="item.quantity * item.harga_satuan || 0" readonly>
                        </div>
                    </div>
                </template>

                <!-- Add/Reset Button -->
                <div class="cursor-pointer w-fit group flex items-center gap-1" @click="toggleItem">
                    <span x-show="items.length < 3" class="text-info text-[14px]">Tambah Quantity</span>
                    <span x-show="items.length >= 3" class="text-error text-[14px]">Reset</span>
                    <svg x-show="items.length < 3"
                        class="fill-info group-hover:rotate-180 transition-all duration-300 ease-in-out"
                        xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z">
                        </path>
                    </svg>
                    <svg x-show="items.length >= 3" class="fill-error" xmlns="http://www.w3.org/2000/svg"
                        width="14" height="14" fill="#000000" viewBox="0 0 256 256">
                        <path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128Z"></path>
                    </svg>
                </div>
            </div>

            {{-- status --}}
            <div class="flex flex-col w-full gap-2">
                <label for="" class="text-secondary text-[16px]">Status</label>
                <select name="status" id="" class="text-secondary text-[16px] p-4 rounded-md">
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="Antrian">Antrian</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Selesai">Selesai</option>
                </select>
                @error('status')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- upload gambar --}}
            <div class="flex flex-col w-full gap-2">
                <label for="image_order" class="text-[#222222] text-[16px]">Upload Gambar</label>
                <input type="file" name="image_order"
                    class="file-input file-input-bordered file-input-secondary file-input-md w-full max-w-xs">
                @error('image_order')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- submit --}}
            <div class="flex items-center gap-3">
                <a href="/order" class="btn btn-outline btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-secondary w-auto">Add</button>
            </div>

        </form>
    </div>
</x-layout>
