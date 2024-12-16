<x-layout>
    <div class="w-[80%] pt-[100px] px-4 h-screen bg-slate-300 flex flex-col gap-4">
        {{-- btn add --}}
        <a href="{{ route('AddPakaian') }}" class="btn btn-success w-fit">Add Jenis Pakaian</a>
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

        <form method="GET" action="/pakaian" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama..."
                class="input input-bordered w-[200px]" />
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="/pakaian" class="btn btn-primary">Clear</a>
        </form>

        {{ $pakaians->appends(request()->query())->links() }}


        {{-- tabel --}}
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                    <tr>
                        <th class="w-[33%]">No</th>
                        <th class="w-[33%]">Name</th>
                        <th class="w-[33%]">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($pakaians) > 0)
                        @foreach ($pakaians as $pakaian)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pakaian->name }}</td>
                                <td class="w-fit flex items-center gap-4">
                                    <a href="/updatePakaian/{{ $pakaian->id }}"
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
                                                    <h3 class="text-lg font-bold">Delete Jenis Pakaian Ini?</h3>
                                                    <p class="py-4">Apakah anda yakin akan hapus jenis pakaian
                                                        <span class="font-bold">{{ $pakaian->name }} </span>
                                                        ?
                                                    </p>
                                                    <div class="flex items-center gap-2">
                                                        <button @click="open = false"
                                                            class="btn bg-primary border border-accent w-auto hover:bg-accent hover:text-primary">
                                                            Cancel
                                                        </button>
                                                        <a @click="open = false"
                                                            href="/deletePakaian/{{ $pakaian->id }}"
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
