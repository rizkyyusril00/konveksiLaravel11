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


        {{ $karyawans->appends(request()->query())->links() }}

        <div class="flex items-center gap-4">
            <form method="GET" action="/" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama..."
                    class="input input-bordered w-[200px]" />
                <select name="filter" class="select select-bordered w-[150px]">
                    <option value="">Semua Pekerjaan</option>
                    @foreach ($filterOptions as $option)
                        <option value="{{ $option }}" {{ request('filter') == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="/" class="btn btn-primary">Clear</a>
            </form>
            {{-- btn add --}}
            <a href="{{ route('AddKaryawan') }}" class="btn btn-success w-fit">Add Karyawan</a>
        </div>

        {{-- tabel --}}
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                    <tr class="w-fit">
                        <th class="w-fit">No</th>
                        <th class="w-fit">Name</th>
                        <th class="w-fit">Pekerjaan</th>
                        <th class="w-20">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($karyawans) > 0)
                        @foreach ($karyawans as $karyawan)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $karyawan->name }}</td>
                                <td>{{ $karyawan->pekerjaan }}</td>
                                <td class="w-fit flex items-center gap-4">
                                    <a href="/updateKaryawan/{{ $karyawan->id }}"
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
                                                    <h3 class="text-lg font-bold">Delete Karyawan Ini?</h3>
                                                    <p class="py-4">Apakah anda yakin akan hapus karyawan dengan nama
                                                        <span class="font-bold">{{ $karyawan->name }} </span>
                                                        ?
                                                    </p>
                                                    <div class="flex items-center gap-2">
                                                        <button @click="open = false"
                                                            class="btn bg-primary border border-accent w-auto hover:bg-accent hover:text-primary">
                                                            Cancel
                                                        </button>
                                                        <a @click="open = false"
                                                            href="/deleteKaryawan/{{ $karyawan->id }}"
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
                            <td colspan="10" class="text-center align-middle">No data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
