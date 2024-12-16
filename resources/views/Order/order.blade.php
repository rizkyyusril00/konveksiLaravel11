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

        <div class="flex items-center gap-2">
            <form method="GET" action="/order" class="flex gap-2">
                <input type="text" name="search" value="" placeholder="Cari nama..."
                    class="input input-bordered w-[200px]" />
                <select name="filter" class="select select-bordered w-[150px]">
                    <option value="">Semua Status</option>
                    @foreach ($filterOptions as $option)
                        <option value="{{ $option }}" {{ request('filter') == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="/order" class="btn btn-primary">Clear</a>
            </form>
            {{-- btn add --}}
            <a href="{{ route('AddOrder') }}" class="btn btn-success w-fit">Add Order</a>
        </div>

        {{ $orders->appends(request()->query())->links() }}


        {{-- tabel --}}
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>
                            <a
                                href="{{ route('order', array_merge(request()->query(), ['orderBy' => 'customer', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                Customer
                                @if (request('orderBy') === 'customer')
                                    @if (request('direction') === 'asc')
                                        <span>&#9650;</span> <!-- Panah naik untuk A-Z -->
                                    @else
                                        <span>&#9660;</span> <!-- Panah turun untuk Z-A -->
                                    @endif
                                @else
                                    <span>&#9660;</span> <!-- Default panah naik -->
                                @endif

                            </a>
                        </th>
                        <th>Admin</th>
                        <th>Tanggal Order</th>
                        <th><a
                                href="{{ route('order', array_merge(request()->query(), ['orderBy' => 'tanggal_selesai', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                Tanggal Selesai
                                @if (request('orderBy') === 'tanggal_selesai')
                                    @if (request('direction') === 'asc')
                                        <span>&#9650;</span> <!-- Panah naik untuk ASC -->
                                    @else
                                        <span>&#9660;</span> <!-- Panah turun untuk DESC -->
                                    @endif
                                @else
                                    <span>&#9660;</span> <!-- Default panah naik -->
                                @endif
                            </a></th>
                        <th>Jenis Pakaian</th>
                        <th>Bahan Utama</th>
                        <th>Bahan Tambahan</th>
                        <th>Jenis Kancing</th>
                        <th>Penjahit</th>
                        <th>Pemotong</th>
                        <th>Size</th>
                        <th>Jumalah Potong</th>
                        <th>Harga Satuan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($orders) > 0)
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->customer }}</td>
                                <td>{{ $order->admin }}</td>
                                <td>{{ $order->tanggal_order }}</td>
                                <td>{{ $order->tanggal_selesai }}</td>
                                <td>{{ $order->jenis_pakaian }}</td>
                                <td>{{ $order->bahan_utama }}</td>
                                <td>{{ $order->bahan_tambahan ?? '-' }}</td>
                                <td>{{ $order->jenis_kancing }}</td>
                                <td>{{ $order->penjahit }}</td>
                                <td>{{ $order->pemotong }}</td>
                                <td>{{ $order->size }}</td>
                                <td>{{ $order->jumlah_potong }}</td>
                                <td>{{ $order->harga_satuan }}</td>
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
                                <td class="w-fit flex items-center gap-4">
                                    <a href="/updateOrder/{{ $order->id }}"
                                        class="btn btn-outline btn-info hover:text-green-400 w-[80px]">Edit</a>

                                    <div x-data="{ open: false }" x-init="open = localStorage.getItem('modal-open') === 'true';
                                    $watch('open', value => localStorage.setItem('modal-open', value))">
                                        <!-- Button to open modal -->
                                        <button @click="open = true" class="btn btn-outline btn-error">Delete</button>

                                        <!-- Modal -->
                                        <template x-if="open">
                                            <div x-transition:enter="transition transform ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-50"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="transition transform ease-in duration-300"
                                                x-transition:leave-start="opacity-100 scale-100"
                                                x-transition:leave-end="opacity-0 scale-50"
                                                class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center"
                                                @click.self="open = false">

                                                <div class="bg-white p-6 rounded-lg shadow-lg w-fit">
                                                    <h3 class="text-lg font-bold">Delete Order Ini?</h3>
                                                    <p class="py-4">Apakah anda yakin akan hapus order dengan nama
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
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center align-middle">No data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
