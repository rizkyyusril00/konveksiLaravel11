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

        <h1 class="text-[32px] text-secondary font-semibold">Supplier</h1>

        <div class="flex items-center justify-between gap-4">
            <form method="GET" action="/supplier" class="flex gap-2">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama..."
                        class="input input-bordered input-secondary pr-10 w-40 text-[14px]" />
                    <button type="submit" class="absolute top-4 right-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                            </path>
                        </svg>
                    </button>
                </div>
                <button type="submit" class="btn btn-outline btn-secondary text-[14px]">Search</button>
                <a href="/supplier" class="btn btn-outline btn-secondary text-[14px]">Clear</a>
            </form>
            {{-- btn add --}}
            <a href="/add/supplier" class="btn btn-secondary w-fit flex items-center gap-2 group">
                <span class="text-[12px] text-primary">Add Supplier</span>
                <svg class="group-hover:rotate-180 transition-all duration-300 ease-in-out fill-primary"
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                    viewBox="0 0 256 256">
                    <path
                        d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z">
                    </path>
                </svg>
            </a>
        </div>

        {{-- tabel --}}
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead class="bg-accent w-full">
                    <tr class="text-[12px] text-secondary">
                        <th class="rounded-tl-sm rounded-bl-sm">No</th>
                        <th>Supplier</th>
                        <th class="min-w-[200px]">Alamat</th>
                        <th>No. Hp</th>
                        <th>Email</th>
                        <th>Bahan Utama</th>
                        <th>Bahan Tambahan</th>
                        <th>Jenis Kancing</th>
                        <th>Jenis Sleting</th>
                        <th class="rounded-tr-sm rounded-br-sm">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($suppliers) > 0)
                        @foreach ($suppliers as $supplier)
                            <tr class="text-[14px] text-secondary">
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ ucwords($supplier->name) }}</td>
                                <td>{{ $supplier->alamat }}</td>
                                <td>{{ $supplier->no_hp }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->bahan_utama }}</td>
                                <td>{{ $supplier->bahan_tambahan ?? '-' }}</td>
                                <td>{{ $supplier->jenis_kancing }}</td>
                                <td>{{ $supplier->jenis_sleting }}</td>
                                <td>
                                    <div class="w-fit flex gap-3">
                                        <a href="/updateSupplier/{{ $supplier->id }}" class="">
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
                                            <button @click="open = true">
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
                                                        <h3 class="text-lg font-bold">Delete Supplier Ini?</h3>
                                                        <p class="py-4">Apakah anda yakin akan hapus Supplier dengan
                                                            nama
                                                            <span class="font-bold">{{ $supplier->name }} </span>
                                                            ?
                                                        </p>
                                                        <div class="flex items-center gap-2">
                                                            <button @click="open = false"
                                                                class="btn btn-secondary w-auto">
                                                                Cancel
                                                            </button>
                                                            <a @click="open = false"
                                                                href="/deleteSupplier/{{ $supplier->id }}"
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
                            <td colspan="9" class="text-center align-middle text-secondary font-bold">No data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- pagination --}}
        {{ $suppliers->appends(request()->query())->links() }}

    </div>
</x-layout>
