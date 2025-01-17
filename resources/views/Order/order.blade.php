<x-layout>
    <div class="w-full md:w-[75%] lg:w-[80%] pt-4 px-3 md:pl-12 md:pr-4 lg:px-4 h-screen bg-primary flex flex-col gap-4">

        {{-- toast --}}
        @if (Session::has('success'))
            <div x-data="{ open: true }" x-init="setTimeout(() => open = false, 3000)" x-show="open"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                class="toast toast-top toast-center z-40">
                <div class="alert alert-success">
                    <span class="text-primary">{{ Session::get('success') }}</span>
                    <span @click="open = false" class="cursor-pointer text-primary">x</span>
                </div>
            </div>
        @endif

        {{-- header --}}
        <div class="flex flex-col">
            <div class="flex items-center justify-between">
                {{-- logo --}}
                <a href="/" class="w-14 h-14 mb-4 block md:hidden">
                    <img src="/img/LOGO.png" alt="logo_company" class="w-full h-full object-cover">
                </a>
                {{-- logout --}}
                <a href="{{ route('logout') }}" class="group tooltip tooltip-left tooltip-secondary block md:hidden"
                    data-tip="LogOut">
                    <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:fill-error" width="26" height="26"
                        fill="#000000" viewBox="0 0 256 256">
                        <path
                            d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z">
                        </path>
                    </svg>
                </a>
            </div>
            <div class="flex justify-between items-center">
                <h1 class="text-[32px] text-secondary font-semibold">Order</h1>
                {{-- btn add --}}
                <a href="{{ route('AddOrder') }}"
                    class="btn h-10 min-h-10 btn-secondary w-fit md:hidden flex items-center gap-2 group">
                    <svg class="group-hover:rotate-180 transition-all duration-300 ease-in-out fill-primary"
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z">
                        </path>
                    </svg>
                    <span class="text-[12px] text-primary">Tambah Order</span>
                </a>
            </div>
        </div>

        {{-- action --}}
        <div class="hidden md:flex items-center justify-between gap-2">
            <form method="GET" action="/" class="flex items-center gap-2">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama..."
                        class="input input-bordered input-secondary pr-10 w-40 h-10 min-h-10 text-[14px]" />
                    <button type="submit" class="absolute top-3 right-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                            </path>
                        </svg>
                    </button>
                </div>

                <select name="filter" class="select h-10 min-h-10 select-bordered select-secondary w-fit text-[14px]">
                    <option value="" selected disabled>Status</option>
                    @foreach ($filterOptions as $option)
                        <option value="{{ $option }}" {{ request('filter') == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn h-10 min-h-10 btn-outline btn-secondary text-[14px]">Cari</button>
                <a href="/" class="flex items-center justify-center bg-secondary w-8 h-8 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="hover:scale-[1.03] transition-all duration-300 ease-in-out" width="18" height="18"
                        fill="#ffffff" viewBox="0 0 256 256">
                        <path
                            d="M235.5,216.81c-22.56-11-35.5-34.58-35.5-64.8V134.73a15.94,15.94,0,0,0-10.09-14.87L165,110a8,8,0,0,1-4.48-10.34l21.32-53a28,28,0,0,0-16.1-37,28.14,28.14,0,0,0-35.82,16,.61.61,0,0,0,0,.12L108.9,79a8,8,0,0,1-10.37,4.49L73.11,73.14A15.89,15.89,0,0,0,55.74,76.8C34.68,98.45,24,123.75,24,152a111.45,111.45,0,0,0,31.18,77.53A8,8,0,0,0,61,232H232a8,8,0,0,0,3.5-15.19ZM67.14,88l25.41,10.3a24,24,0,0,0,31.23-13.45l21-53c2.56-6.11,9.47-9.27,15.43-7a12,12,0,0,1,6.88,15.92L145.69,93.76a24,24,0,0,0,13.43,31.14L184,134.73V152c0,.33,0,.66,0,1L55.77,101.71A108.84,108.84,0,0,1,67.14,88Zm48,128a87.53,87.53,0,0,1-24.34-42,8,8,0,0,0-15.49,4,105.16,105.16,0,0,0,18.36,38H64.44A95.54,95.54,0,0,1,40,152a85.9,85.9,0,0,1,7.73-36.29l137.8,55.12c3,18,10.56,33.48,21.89,45.16Z">
                        </path>
                    </svg>
                </a>
            </form>
            {{-- btn add --}}
            <a href="{{ route('AddOrder') }}"
                class="btn h-10 min-h-10 btn-secondary w-fit flex items-center gap-2 group">
                <svg class="group-hover:rotate-180 transition-all duration-300 ease-in-out fill-primary"
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                    viewBox="0 0 256 256">
                    <path
                        d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z">
                    </path>
                </svg>
                <span class="text-[12px] text-primary">Tambah Order</span>
            </a>
        </div>

        {{-- action mobile --}}
        <form method="GET" action="/" class="md:hidden flex items-center gap-2">
            {{-- search --}}
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama..."
                    class="input input-bordered input-secondary pr-10 w-36 input-sm text-[14px]" />
                <button type="submit" class="absolute top-2 right-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                        </path>
                    </svg>
                </button>
            </div>
            {{-- filter --}}
            <select name="filter" class="select select-sm select-bordered select-secondary w-[90px] text-[14px]">
                <option value="" selected disabled>Filter</option>
                @foreach ($filterOptions as $option)
                    <option value="{{ $option }}" {{ request('filter') == $option ? 'selected' : '' }}>
                        {{ $option }}
                    </option>
                @endforeach
            </select>
            {{-- action --}}
            <button type="submit" class="btn btn-sm btn-outline btn-secondary text-[14px]">Cari</button>
            <a href="/" class="flex items-center justify-center bg-secondary w-[30px] h-[30px] rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="hover:scale-[1.03] transition-all duration-300 ease-in-out" width="18" height="18"
                    fill="#ffffff" viewBox="0 0 256 256">
                    <path
                        d="M235.5,216.81c-22.56-11-35.5-34.58-35.5-64.8V134.73a15.94,15.94,0,0,0-10.09-14.87L165,110a8,8,0,0,1-4.48-10.34l21.32-53a28,28,0,0,0-16.1-37,28.14,28.14,0,0,0-35.82,16,.61.61,0,0,0,0,.12L108.9,79a8,8,0,0,1-10.37,4.49L73.11,73.14A15.89,15.89,0,0,0,55.74,76.8C34.68,98.45,24,123.75,24,152a111.45,111.45,0,0,0,31.18,77.53A8,8,0,0,0,61,232H232a8,8,0,0,0,3.5-15.19ZM67.14,88l25.41,10.3a24,24,0,0,0,31.23-13.45l21-53c2.56-6.11,9.47-9.27,15.43-7a12,12,0,0,1,6.88,15.92L145.69,93.76a24,24,0,0,0,13.43,31.14L184,134.73V152c0,.33,0,.66,0,1L55.77,101.71A108.84,108.84,0,0,1,67.14,88Zm48,128a87.53,87.53,0,0,1-24.34-42,8,8,0,0,0-15.49,4,105.16,105.16,0,0,0,18.36,38H64.44A95.54,95.54,0,0,1,40,152a85.9,85.9,0,0,1,7.73-36.29l137.8,55.12c3,18,10.56,33.48,21.89,45.16Z">
                    </path>
                </svg>
            </a>
        </form>

        {{-- tabel --}}
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead class="bg-accent">
                    <tr class="text-[12px] text-secondary">
                        <th class="w-auto rounded-tl-lg rounded-bl-sm">No</th>
                        <th class="w-[90px] md:w-[200px]">
                            <a class="flex items-center gap-[2px]"
                                href="{{ route('order', array_merge(request()->query(), ['orderBy' => 'customer_id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                <span>Customer</span>
                                @if (request('orderBy') === 'customer_id')
                                    @if (request('direction') === 'asc')
                                        <svg class="fill-secondary mt-[2px]" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14" fill="" viewBox="0 0 256 256">
                                            <path
                                                d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm37.66-101.66a8,8,0,0,1-11.32,11.32L136,107.31V168a8,8,0,0,1-16,0V107.31l-18.34,18.35a8,8,0,0,1-11.32-11.32l32-32a8,8,0,0,1,11.32,0Z">
                                            </path>
                                        </svg> <!-- Panah naik untuk A-Z -->
                                    @else
                                        <svg class="fill-secondary mt-[2px]" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14" fill="" viewBox="0 0 256 256">
                                            <path
                                                d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm37.66-85.66a8,8,0,0,1,0,11.32l-32,32a8,8,0,0,1-11.32,0l-32-32a8,8,0,0,1,11.32-11.32L120,148.69V88a8,8,0,0,1,16,0v60.69l18.34-18.35A8,8,0,0,1,165.66,130.34Z">
                                            </path>
                                        </svg> <!-- Panah turun untuk Z-A -->
                                    @endif
                                @else
                                    <svg class="fill-secondary mt-[2px]" xmlns="http://www.w3.org/2000/svg"
                                        width="14" height="14" fill="" viewBox="0 0 256 256">
                                        <path
                                            d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm37.66-85.66a8,8,0,0,1,0,11.32l-32,32a8,8,0,0,1-11.32,0l-32-32a8,8,0,0,1,11.32-11.32L120,148.69V88a8,8,0,0,1,16,0v60.69l18.34-18.35A8,8,0,0,1,165.66,130.34Z">
                                        </path>
                                    </svg> <!-- Default panah turun -->
                                @endif

                            </a>
                        </th>
                        <th class="w-auto">Admin</th>
                        <th class="w-auto">Status</th>
                        <th class="min-w-[150px]">Tanggal Order</th>
                        <th class="min-w-[150px]">
                            <a class="flex items-center gap-[2px]"
                                href="{{ route('order', array_merge(request()->query(), ['orderBy' => 'tanggal_selesai', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                <span>Tanggal Selesai</span>
                                @if (request('orderBy') === 'tanggal_selesai')
                                    @if (request('direction') === 'asc')
                                        <svg class="fill-secondary mt-[1px]" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14" fill="" viewBox="0 0 256 256">
                                            <path
                                                d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm37.66-101.66a8,8,0,0,1-11.32,11.32L136,107.31V168a8,8,0,0,1-16,0V107.31l-18.34,18.35a8,8,0,0,1-11.32-11.32l32-32a8,8,0,0,1,11.32,0Z">
                                            </path>
                                        </svg> <!-- Panah naik untuk menunjukan deadline -->
                                    @else
                                        <svg class="fill-secondary mt-[1px]" xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14" fill="" viewBox="0 0 256 256">
                                            <path
                                                d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm37.66-85.66a8,8,0,0,1,0,11.32l-32,32a8,8,0,0,1-11.32,0l-32-32a8,8,0,0,1,11.32-11.32L120,148.69V88a8,8,0,0,1,16,0v60.69l18.34-18.35A8,8,0,0,1,165.66,130.34Z">
                                            </path>
                                        </svg> <!-- Panah turun untuk menunjukan yang paling lama -->
                                    @endif
                                @else
                                    <svg class="fill-secondary mt-[1px]" xmlns="http://www.w3.org/2000/svg"
                                        width="14" height="14" fill="" viewBox="0 0 256 256">
                                        <path
                                            d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm37.66-85.66a8,8,0,0,1,0,11.32l-32,32a8,8,0,0,1-11.32,0l-32-32a8,8,0,0,1,11.32-11.32L120,148.69V88a8,8,0,0,1,16,0v60.69l18.34-18.35A8,8,0,0,1,165.66,130.34Z">
                                        </path>
                                    </svg> <!-- Default panah naik -->
                                @endif
                            </a>
                        </th>
                        <th class="w-auto">Jenis Pakaian</th>
                        <th class="w-auto">Bahan Utama</th>
                        <th class="w-auto">Bahan Tambahan</th>
                        <th class="w-auto">Jenis Kancing</th>
                        <th class="w-auto">Penjahit</th>
                        <th class="w-auto">Pemotong</th>
                        <th class="min-w-[180px]">
                            Items</th>
                        <th class="min-w-[120px]">Total</th>
                        <th class="w-auto rounded-tr-lg rounded-br-sm sticky right-0 bg-accent">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($orders) > 0)
                        @foreach ($orders as $order)
                            <tr class="text-[14px] text-secondary">
                                <td>{{ $loop->iteration }}</td>
                                <td class="flex items-center gap-2 w-[190px] md:w-[250px]">
                                    {{-- image --}}
                                    <figure
                                        class="w-20 h-12 rounded-[12px] flex items-center justify-center bg-slate-200">
                                        @if ($order->image_order == null)
                                            <span class="text-center text-secondary">No img</span>
                                        @else
                                            <img src="{{ asset('storage/' . $order->image_order) }}"
                                                alt="{{ $order->image_customer }} {{ asset('storage/' . $order->image_order) }}"
                                                class="w-full h-full object-cover rounded-[8px]">
                                        @endif
                                    </figure>
                                    <div class="flex flex-col">
                                        <span class="font-semibold">
                                            {{ ucwords($order->customer->name) }}
                                        </span>
                                        <span>
                                            PO ID:
                                            <span class="font-semibold">{{ $order->id }}</span>
                                        </span>
                                    </div>
                                </td>
                                <td>{{ $order->admin }}</td>
                                {{-- harus bisa update status --}}
                                <td class="">
                                    <div x-data="{ openStatus: false }" x-init="openStatus = localStorage.getItem('modal-openStatus') === 'true';
                                    $watch('openStatus', value => localStorage.setItem('modal-openStatus', value))">
                                        <!-- Button to open modal -->
                                        <button @click="openStatus = true" class="flex items-center gap-1 group mr-1">
                                            <div
                                                class="{{ $order->status === 'Antrian' ? 'bg-blue-300' : ($order->status === 'Selesai' ? 'bg-green-300' : 'bg-orange-300') }}  p-1 flex justify-center items-center gap-[6px] rounded-md bg-opacity-20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                    class="{{ $order->status === 'Antrian' ? 'fill-blue-600' : ($order->status === 'Selesai' ? 'fill-green-600' : 'fill-orange-600') }}"
                                                    fill="#000000" viewBox="0 0 256 256">
                                                    <path
                                                        d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z">
                                                    </path>
                                                </svg>
                                                <span
                                                    class="{{ $order->status === 'Antrian' ? 'text-blue-600' : ($order->status === 'Selesai' ? 'text-green-600' : 'text-orange-600') }} text-[14px]">
                                                    {{ $order->status }}
                                                </span>
                                            </div>
                                        </button>

                                        <!-- Modal -->
                                        <template x-if="openStatus">
                                            <div x-transition:enter="transition transform ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-50"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="transition transform ease-in duration-300"
                                                x-transition:leave-start="opacity-100 scale-100"
                                                x-transition:leave-end="opacity-0 scale-50"
                                                class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50"
                                                @click.self="openStatus = false">

                                                <div class="bg-white p-6 rounded-lg shadow-lg w-fit">
                                                    <h3 class="text-lg font-bold text-secondary">Ubah Status Dari Order
                                                        Ini?</h3>
                                                    <form @submit="setTimeout(() => { openStatus = false }, 100);"
                                                        action="{{ route('EditOrder') }}" method="POST"
                                                        class="flex flex-col gap-2 my-3">
                                                        @csrf
                                                        <input type="hidden" name="order_id"
                                                            value="{{ $order->id }}">
                                                        <label for="status"
                                                            class="text-secondary text-[16px]">Status</label>
                                                        <select name="status" id="status"
                                                            class="select text-secondary text-[16px] rounded-md">
                                                            <option value="{{ $order->status }}"
                                                                class="text-[12px] md:text-[16px]" disabled selected>
                                                                {{ $order->status }}</option>
                                                            <option value="Antrian"
                                                                class="text-[12px] md:text-[16px]">Antrian
                                                            </option>
                                                            <option value="Diproses"
                                                                class="text-[12px] md:text-[16px]">Diproses
                                                            </option>
                                                            <option value="Selesai"
                                                                class="text-[12px] md:text-[16px]">Selesai
                                                            </option>
                                                        </select>
                                                        @error('status')
                                                            <span class="text-red-400">{{ $message }}</span>
                                                        @enderror

                                                        <div class="flex items-center gap-2">
                                                            <button @click="openStatus = false"
                                                                class="btn btn-secondary w-auto">
                                                                Batal
                                                            </button>
                                                            <button type="submit"
                                                                class="btn btn-info text-white w-[100px] py-2">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </td>
                                <td>{{ $order->tanggal_order }}</td>
                                <td>{{ $order->tanggal_selesai }}</td>
                                <td>{{ $order->jenis_pakaian }}</td>
                                <td>{{ $order->bahan_utama }}</td>
                                <td>{{ $order->bahan_tambahan ?? '-' }}</td>
                                <td>{{ $order->jenis_kancing ?? '-' }}</td>
                                <td>{{ $order->penjahit->name }}</td>
                                <td>{{ $order->pemotong->name }}</td>
                                <td>
                                    <!-- Toggle to show items list -->
                                    <ol
                                        class="item h-auto max-h-16 {{ count($order->items) >= 4 ? 'overflow-y-scroll list-disc' : 'list-disc' }}">
                                        @foreach ($order->items as $item)
                                            <li>{{ $item['size'] ?? '-' }}
                                                ({{ $item['quantity'] ?? '-' }})
                                                /
                                                {{ $item['harga_satuan'] ?? '-' }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>RP
                                    @php
                                        $totalHarga = 0;
                                        foreach ($order->items as $item) {
                                            $totalHarga += $item['total_harga'] ?? 0;
                                        }
                                    @endphp
                                    {{ number_format($totalHarga, 0, ',', '.') }}
                                </td>
                                <td x-data="{ open: false }" :class="{ '': open, 'sticky': !open }"
                                    class="sticky right-0 -z-0 {{ $loop->iteration % 2 === 0 ? 'bg-accent' : 'bg-primary' }}">
                                    <div class="flex gap-3">
                                        <div class="relative hidden md:block" x-data="{ box: false }">
                                            <svg @click="box = !box"
                                                class="fill-secondary hover:fill-info transition-all duration-300 ease-in-out"
                                                xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="" viewBox="0 0 256 256">
                                                <path
                                                    d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z">
                                                </path>
                                            </svg>

                                            {{-- box pop up --}}
                                            <div x-show="box" @click.outside="box = false" x-transition
                                                class="absolute -top-16 -right-5 w-fit py-2 px-5 bg-white border border-gray-300 rounded shadow-lg z-10">
                                                <ol class="list-disc">
                                                    <li>
                                                        <a class="text-secondary hover:text-info" target="_blank"
                                                            href="/invoice/{{ $order->id }}">Invoice</a>
                                                    </li>
                                                    <li>
                                                        <a class="text-secondary hover:text-info" target="_blank"
                                                            href="/po/{{ $order->id }}">PO</a>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                        <a href="/updateOrder/{{ $order->id }}" class="">
                                            <svg class="fill-secondary hover:fill-info transition-all duration-300 ease-in-out"
                                                xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="" viewBox="0 0 256 256">
                                                <path
                                                    d="M227.32,73.37,182.63,28.69a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H216a8,8,0,0,0,0-16H115.32l112-112A16,16,0,0,0,227.32,73.37ZM136,75.31,152.69,92,68,176.69,51.31,160ZM48,208V179.31L76.69,208Zm48-3.31L79.32,188,164,103.31,180.69,120Zm96-96L147.32,64l24-24L216,84.69Z">
                                                </path>
                                            </svg>
                                        </a>
                                        <div x-init="open = localStorage.getItem('modal-open') === 'true';
                                        $watch('open', value => localStorage.setItem('modal-open', value))">
                                            <!-- Button to open modal -->
                                            <button @click="open = true" class="">
                                                <svg class="fill-secondary hover:fill-error transition-all duration-300 ease-in-out"
                                                    xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="" viewBox="0 0 256 256">
                                                    <path
                                                        d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                                                    </path>
                                                </svg>
                                            </button>

                                            <!-- Modal -->
                                            <template x-if="open">
                                                <div x-transition:enter="transition transform ease-out duration-300"
                                                    x-transition:enter-start="opacity-0 scale-50"
                                                    x-transition:enter-end="opacity-100 scale-100"
                                                    x-transition:leave="transition transform ease-in duration-300"
                                                    x-transition:leave-start="opacity-100 scale-100"
                                                    x-transition:leave-end="opacity-0 scale-50"
                                                    class="modal_delete fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 px-2 md:px-0 isolation-auto"
                                                    @click.self="open = false">

                                                    <div class="bg-white p-6 rounded-lg shadow-lg w-fit">
                                                        <h3 class="text-lg font-bold">Hapus Order Ini?</h3>
                                                        <p class="py-4">Apakah anda yakin akan hapus order dengan
                                                            nama customer
                                                            <span class="font-bold">{{ $order->customer->name }}
                                                            </span>
                                                            ?
                                                        </p>
                                                        <div class="flex items-center gap-2">
                                                            <button @click="open = false"
                                                                class="btn btn-secondary w-auto">
                                                                Tidak
                                                            </button>
                                                            <a @click="open = false"
                                                                href="/deleteOrder/{{ $order->id }}"
                                                                class="btn btn-error text-white w-auto py-2">
                                                                Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="15" class="text-center align-middle text-secondary font-bold">No data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- pagination --}}
        <div class="mb-3 md:mb-10">
            {{ $orders->appends(request()->query())->links() }}
        </div>
    </div>
</x-layout>
