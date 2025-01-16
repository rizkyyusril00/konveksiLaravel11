<x-layout>
    <div class="w-full lg:w-[80%] pt-4 px-2 md:pl-52 md:pr-4 lg:px-4 h-screen bg-primary flex flex-col gap-4">

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
        @if (Session::has('error'))
            <div x-data="{ open: true }" x-init="setTimeout(() => open = false, 3000)" x-show="open"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                class="toast toast-top toast-center z-40">
                <div class="alert alert-error">
                    <span class="text-primary">{{ Session::get('error') }}</span>
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
                <h1 class="text-[32px] text-secondary font-semibold">Karyawan</h1>
                {{-- btn add --}}
                <a href="{{ route('AddKaryawan') }}"
                    class="btn h-10 min-h-10 btn-secondary w-fit md:hidden flex items-center gap-2 group">
                    <svg class="group-hover:rotate-180 transition-all duration-300 ease-in-out fill-primary"
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                        viewBox="0 0 256 256">
                        <path
                            d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z">
                        </path>
                    </svg>
                    <span class="text-[12px] text-primary">Tambah Karyawan</span>
                </a>
            </div>
        </div>

        {{-- action --}}
        <div class="hidden md:flex items-center justify-between gap-2">
            <form method="GET" action="/karyawan" class="flex flex-col gap-2 w-full">
                <div class="flex justify-between">
                    <div class="flex items-center gap-2">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama..."
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
                        <select name="filter"
                            class="hidden lg:block select select-bordered select-secondary w-fit h-10 min-h-10 text-[14px]">
                            <option value="" disabled selected>Pekerjaan</option>
                            @foreach ($filterOptions as $option)
                                <option value="{{ $option }}"
                                    {{ request('filter') == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                        <div class="hidden lg:flex items-center gap-2">
                            <select name="bulan"
                                class="select select-bordered select-secondary w-fit h-10 min-h-10 text-[14px]">
                                <option value="" disabled selected>Bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                            <select name="tahun"
                                class="select select-bordered select-secondary w-fit h-10 min-h-10 text-[14px]">
                                <option value="" disabled selected>Tahun</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}"
                                        {{ request('tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="btn h-10 min-h-10 btn-outline btn-secondary text-[14px]">Cari</button>
                        <a href="/karyawan" class="flex items-center justify-center bg-secondary w-8 h-8 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="hover:scale-[1.03] transition-all duration-300 ease-in-out" width="18"
                                height="18" fill="#ffffff" viewBox="0 0 256 256">
                                <path
                                    d="M235.5,216.81c-22.56-11-35.5-34.58-35.5-64.8V134.73a15.94,15.94,0,0,0-10.09-14.87L165,110a8,8,0,0,1-4.48-10.34l21.32-53a28,28,0,0,0-16.1-37,28.14,28.14,0,0,0-35.82,16,.61.61,0,0,0,0,.12L108.9,79a8,8,0,0,1-10.37,4.49L73.11,73.14A15.89,15.89,0,0,0,55.74,76.8C34.68,98.45,24,123.75,24,152a111.45,111.45,0,0,0,31.18,77.53A8,8,0,0,0,61,232H232a8,8,0,0,0,3.5-15.19ZM67.14,88l25.41,10.3a24,24,0,0,0,31.23-13.45l21-53c2.56-6.11,9.47-9.27,15.43-7a12,12,0,0,1,6.88,15.92L145.69,93.76a24,24,0,0,0,13.43,31.14L184,134.73V152c0,.33,0,.66,0,1L55.77,101.71A108.84,108.84,0,0,1,67.14,88Zm48,128a87.53,87.53,0,0,1-24.34-42,8,8,0,0,0-15.49,4,105.16,105.16,0,0,0,18.36,38H64.44A95.54,95.54,0,0,1,40,152a85.9,85.9,0,0,1,7.73-36.29l137.8,55.12c3,18,10.56,33.48,21.89,45.16Z">
                                </path>
                            </svg>
                        </a>
                    </div>
                    {{-- btn add --}}
                    <a href="{{ route('AddKaryawan') }}"
                        class="btn h-10 min-h-10 btn-secondary w-fit flex items-center gap-2 group">
                        <svg class="group-hover:rotate-180 transition-all duration-300 ease-in-out fill-primary"
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z">
                            </path>
                        </svg>
                        <span class="text-[12px] text-primary">Tambah Karyawan</span>
                    </a>
                </div>
                {{-- bulan&tahun --}}
                <div class="flex flex-col gap-0">
                    <div class="lg:hidden flex items-center gap-2">
                        <select name="filter"
                            class="lg:hidden block select select-bordered select-secondary w-fit h-10 min-h-10 text-[14px]">
                            <option value="" disabled selected>Pekerjaan</option>
                            @foreach ($filterOptions as $option)
                                <option value="{{ $option }}"
                                    {{ request('filter') == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                        <select name="bulan"
                            class="lg:hidden flex select select-bordered select-secondary w-fit h-10 min-h-10 text-[14px]">
                            <option value="" disabled selected>Bulan</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                        <select name="tahun"
                            class="lg:hidden flex select select-bordered select-secondary w-fit h-10 min-h-10 text-[14px]">
                            <option value="" disabled selected>Tahun</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}"
                                    {{ request('tahun') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <span class="text-[12px] text-secondary">
                        @if (request('bulan') && request('tahun'))
                            Filter pada bulan:
                            {{ \Carbon\Carbon::createFromFormat('m', request('bulan'))->format('F') }}
                            {{ request('tahun') }}
                        @endif
                    </span>
                </div>
            </form>
        </div>

        {{-- action mobile --}}
        <form x-data="{ showSelects: false }" method="GET" action="/karyawan" class="md:hidden flex flex-col gap-2">
            <div class="flex items-center gap-2">
                {{-- search --}}
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama..."
                        class="input input-bordered input-sm input-secondary pr-10 w-36 text-[14px]" />
                    <button type="submit" class="absolute top-2 right-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000"
                            viewBox="0 0 256 256">
                            <path
                                d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                            </path>
                        </svg>
                    </button>
                </div>
                <button type="submit" class="btn btn-sm btn-outline btn-secondary text-[14px]">Cari</button>
                <a href="/karyawan"
                    class="flex items-center justify-center bg-secondary w-[30px] h-[30px] rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="hover:scale-[1.03] transition-all duration-300 ease-in-out" width="18"
                        height="18" fill="#ffffff" viewBox="0 0 256 256">
                        <path
                            d="M235.5,216.81c-22.56-11-35.5-34.58-35.5-64.8V134.73a15.94,15.94,0,0,0-10.09-14.87L165,110a8,8,0,0,1-4.48-10.34l21.32-53a28,28,0,0,0-16.1-37,28.14,28.14,0,0,0-35.82,16,.61.61,0,0,0,0,.12L108.9,79a8,8,0,0,1-10.37,4.49L73.11,73.14A15.89,15.89,0,0,0,55.74,76.8C34.68,98.45,24,123.75,24,152a111.45,111.45,0,0,0,31.18,77.53A8,8,0,0,0,61,232H232a8,8,0,0,0,3.5-15.19ZM67.14,88l25.41,10.3a24,24,0,0,0,31.23-13.45l21-53c2.56-6.11,9.47-9.27,15.43-7a12,12,0,0,1,6.88,15.92L145.69,93.76a24,24,0,0,0,13.43,31.14L184,134.73V152c0,.33,0,.66,0,1L55.77,101.71A108.84,108.84,0,0,1,67.14,88Zm48,128a87.53,87.53,0,0,1-24.34-42,8,8,0,0,0-15.49,4,105.16,105.16,0,0,0,18.36,38H64.44A95.54,95.54,0,0,1,40,152a85.9,85.9,0,0,1,7.73-36.29l137.8,55.12c3,18,10.56,33.48,21.89,45.16Z">
                        </path>
                    </svg>
                </a>
                {{-- toggle select --}}
                <div @click="showSelects = !showSelects"
                    class="flex items-center justify-center bg-secondary w-[30px] h-[30px] rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="hover:scale-[1.03] transition-all duration-300 ease-in-out" width="18"
                        height="18" fill="#ffffff" viewBox="0 0 256 256">
                        <path
                            d="M64,105V40a8,8,0,0,0-16,0v65a32,32,0,0,0,0,62v49a8,8,0,0,0,16,0V167a32,32,0,0,0,0-62Zm-8,47a16,16,0,1,1,16-16A16,16,0,0,1,56,152Zm80-95V40a8,8,0,0,0-16,0V57a32,32,0,0,0,0,62v97a8,8,0,0,0,16,0V119a32,32,0,0,0,0-62Zm-8,47a16,16,0,1,1,16-16A16,16,0,0,1,128,104Zm104,64a32.06,32.06,0,0,0-24-31V40a8,8,0,0,0-16,0v97a32,32,0,0,0,0,62v17a8,8,0,0,0,16,0V199A32.06,32.06,0,0,0,232,168Zm-32,16a16,16,0,1,1,16-16A16,16,0,0,1,200,184Z">
                        </path>
                    </svg>
                </div>
            </div>
            {{-- selects --}}
            <div x-show="showSelects" x-transition class="flex items-center gap-2">
                {{-- select pekerjaan --}}
                <select name="filter" class="select select-bordered select-secondary select-sm w-fit text-[14px]">
                    <option value="" disabled selected>Pekerjaan</option>
                    @foreach ($filterOptions as $option)
                        <option value="{{ $option }}" {{ request('filter') == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                <select name="bulan" class="select select-sm select-bordered select-secondary w-fit text-[14px]">
                    <option value="" disabled selected>Bulan</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                        </option>
                    @endfor
                </select>
                <select name="tahun" class="select select-sm select-bordered select-secondary w-fit text-[14px]">
                    <option value="" disabled selected>Tahun</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>
            <span class="text-[12px] text-secondary">
                @if (request('bulan') && request('tahun'))
                    Filter pada bulan:
                    {{ \Carbon\Carbon::createFromFormat('m', request('bulan'))->format('F') }}
                    {{ request('tahun') }}
                @endif
            </span>
        </form>

        {{-- tabel --}}
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead class="bg-accent">
                    <tr class="text-[12px] text-secondary">
                        <th class="rounded-tl-lg rounded-bl-sm">No</th>
                        <th>Name</th>
                        <th>Pekerjaan</th>
                        <th>Upah/Potong</th>
                        <th>Total Order</th>
                        <th>Total Upah</th>
                        <th class="rounded-tr-lg rounded-br-sm sticky right-0 bg-accent">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($karyawans) > 0)
                        @foreach ($karyawans as $karyawan)
                            <tr class="text-[14px] text-secondary even:bg-accent">
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ ucwords($karyawan->name) }}</td>
                                <td>{{ $karyawan->pekerjaan }}</td>
                                <td>RP {{ number_format($karyawan->upah, 0, ',', '.') }}</td>
                                <td>{{ $karyawan->total_order }}</td>
                                <td>Rp {{ number_format($karyawan->upah * $karyawan->total_order, 0, ',', '.') }}</td>
                                <td
                                    class="w-[5%] sticky right-0 {{ $loop->iteration % 2 === 0 ? 'bg-accent' : 'bg-primary' }}">
                                    <div class="w-fit flex gap-3">
                                        <a href="/updateKaryawan/{{ $karyawan->id }}" class="">
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
                                                    class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 px-2 md:px-0"
                                                    @click.self="open = false">

                                                    <div class="bg-white p-6 rounded-lg shadow-lg w-fit">
                                                        <h3 class="text-lg font-bold">Hapus Karyawan Ini?</h3>
                                                        <p class="py-4">Apakah anda yakin akan hapus karyawan dengan
                                                            nama
                                                            <span class="font-bold">{{ $karyawan->name }} </span>
                                                            ?
                                                        </p>
                                                        <div class="flex items-center gap-2">
                                                            <button @click="open = false"
                                                                class="btn btn-secondary w-auto">
                                                                Tidak
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center align-middle text-secondary font-bold">No data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- pagination --}}
        {{ $karyawans->appends(request()->query())->links() }}

    </div>
</x-layout>
