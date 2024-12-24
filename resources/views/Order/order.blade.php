<x-layout>
    <div class="w-[80%] pt-[100px] px-4 h-screen bg-primary flex flex-col gap-4">

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

        <div class="flex items-center justify-between gap-2">
            <form method="GET" action="/" class="flex gap-2">
                <div class="relative">
                    <input type="text" name="search" value="" placeholder="Cari nama..."
                        class="input input-bordered input-accent pr-10 w-40 text-[14px]" />
                    <button type="submit" class="absolute top-4 right-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                            </path>
                        </svg>
                    </button>
                </div>
                <select name="filter" class="select select-bordered select-secondary w-[90px] text-[14px]">
                    <option value="" selected disabled>Filter</option>
                    @foreach ($filterOptions as $option)
                        <option value="{{ $option }}" {{ request('filter') == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline btn-secondary text-[14px]">Search</button>
                <a href="/" class="btn btn-outline btn-secondary text-[14px]">Clear</a>
            </form>
            {{-- btn add --}}
            <a href="{{ route('AddOrder') }}" class="btn btn-success w-fit flex items-center gap-2 group">
                <span class="text-[12px]">Add Order</span>
                <svg class="group-hover:rotate-180 transition-all duration-300 ease-in-out"
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                    viewBox="0 0 256 256">
                    <path
                        d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z">
                    </path>
                </svg>
            </a>
        </div>

        <a href="{{ route('logout') }}" class="btn btn-error">Logout</a>
        @auth('admin')
            <span>{{ auth('admin')->user()->name }}</span>
        @elseif('user')
            <span>{{ auth('user')->user()->name }} xx</span>
        @else
            <span>anomali</span>
        @endauth

        {{-- tabel --}}
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead class="bg-slate-200">
                    <tr class="text-[12px] text-secondary">
                        <th class="w-auto">No</th>
                        <th class="w-[200px]">
                            <a class="flex items-center gap-[2px]"
                                href="{{ route('order', array_merge(request()->query(), ['orderBy' => 'customer', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                <span>Customer</span>
                                @if (request('orderBy') === 'customer')
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
                        <th class="w-auto">Tanggal Order</th>
                        <th class="w-auto">
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
                        <th class="min-w-[150px]">Kuantitas</th>
                        <th class="min-w-[100px]">Total</th>
                        <th class="w-auto">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($orders) > 0)
                        @foreach ($orders as $order)
                            <tr class="text-[14px] text-secondary">
                                <td>{{ $loop->iteration }}</td>
                                <td class="flex items-center gap-2 w-[250px]">
                                    {{-- image --}}
                                    <div class="w-20 h-12 rounded-md bg-slate-200">
                                        <img src="{{ asset('storage/' . $order->image_order) }}"
                                            alt="{{ $order->image_customer }} {{ asset('storage/' . $order->image_order) }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-semibold">
                                            {{ $order->customer }}
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
                                    <a
                                        class="{{ $order->status === 'Antrian' ? 'bg-blue-300' : ($order->status === 'Selesai' ? 'bg-green-300' : 'bg-orange-300') }}  p-1 flex justify-center items-center gap-1 rounded-md bg-opacity-20">
                                        <div
                                            class="{{ $order->status === 'Antrian' ? 'bg-blue-600' : ($order->status === 'Selesai' ? 'bg-green-600' : 'bg-orange-600') }} w-1 h-1 mt-[2px] rounded-full">
                                        </div>
                                        <span
                                            class="{{ $order->status === 'Antrian' ? 'text-blue-600' : ($order->status === 'Selesai' ? 'text-green-600' : 'text-orange-600') }} text-[14px]">
                                            {{ $order->status }}
                                        </span>
                                    </a>
                                </td>
                                <td>{{ $order->tanggal_order }}</td>
                                <td>{{ $order->tanggal_selesai }}</td>
                                <td>{{ $order->jenis_pakaian }}</td>
                                <td>{{ $order->bahan_utama }}</td>
                                <td>{{ $order->bahan_tambahan ?? '-' }}</td>
                                <td>{{ $order->jenis_kancing }}</td>
                                <td>{{ $order->penjahit->name }}</td>
                                <td>{{ $order->pemotong->name }}</td>
                                <td>
                                    <ol class="list-disc">
                                        <li>{{ $order->quantity }} /
                                            RP {{ number_format($order->harga_satuan, 0, ',', '.') }}
                                        </li>
                                        @if ($order->quantity_2 && $order->harga_satuan_2)
                                            <li>{{ $order->quantity_2 }} / RP {{ $order->harga_satuan_2 }}</li>
                                        @endif
                                    </ol>
                                </td>
                                <td>RP {{ number_format($order->total_harga + $order->total_harga_2, 0, ',', '.') }}
                                </td>

                                <td class="">
                                    <div class="flex gap-3">
                                        <a href="" class="">
                                            <svg class="fill-secondary hover:fill-info transition-all duration-300 ease-in-out"
                                                xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="" viewBox="0 0 256 256">
                                                <path
                                                    d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="/updateOrder/{{ $order->id }}" class="">
                                            <svg class="fill-secondary hover:fill-info transition-all duration-300 ease-in-out"
                                                xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="" viewBox="0 0 256 256">
                                                <path
                                                    d="M227.32,73.37,182.63,28.69a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H216a8,8,0,0,0,0-16H115.32l112-112A16,16,0,0,0,227.32,73.37ZM136,75.31,152.69,92,68,176.69,51.31,160ZM48,208V179.31L76.69,208Zm48-3.31L79.32,188,164,103.31,180.69,120Zm96-96L147.32,64l24-24L216,84.69Z">
                                                </path>
                                            </svg>
                                        </a>
                                        <div x-data="{ open: false }" x-init="open = localStorage.getItem('modal-open') === 'true';
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
                                                    class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50"
                                                    @click.self="open = false">

                                                    <div class="bg-white p-6 rounded-lg shadow-lg w-fit">
                                                        <h3 class="text-lg font-bold">Delete Order Ini?</h3>
                                                        <p class="py-4">Apakah anda yakin akan hapus order dengan
                                                            nama
                                                            customer
                                                            <span class="font-bold">{{ $order->customer }} </span>
                                                            ?
                                                        </p>
                                                        <div class="flex items-center gap-2">
                                                            <button @click="open = false"
                                                                class="btn bg-primary border border-accent w-auto hover:bg-accent hover:text-primary">
                                                                Cancel
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
                            <td colspan="3" class="text-center align-middle text-secondary font-bold">No data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- pagination --}}
        {{ $orders->appends(request()->query())->links() }}

    </div>
</x-layout>
