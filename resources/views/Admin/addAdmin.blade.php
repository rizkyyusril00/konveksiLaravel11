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
        <form action="{{ route('AddUser') }}" method="POST"
            class="w-full flex flex-col gap-4 p-3 md:px-8 2xl:px-4 md:py-4">
            <a href="/user" class="flex md:hidden items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-secondary" width="16" height="16"
                    fill="#000000" viewBox="0 0 256 256">
                    <path
                        d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z">
                    </path>
                </svg>
                <span class="text-[14px] text-secondary">Kembali</span>
            </a>
            <h1 class="text-[24px] text-start text-secondary font-semibold">Tambah User</h1>
            @csrf
            {{-- nama --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="name" class="text-secondary text-[16px]">Nama</label>
                <input autocomplete="on" id="name" type="text" name="name"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Add Name...">
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- email --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="email" class="text-secondary text-[16px]">Email</label>
                <input autocomplete="on" id="email" type="email" name="email"
                    class="text-secondary text-[16px] p-4 rounded-md" placeholder="Add Email...">
                @error('email')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- password --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="password" class="text-secondary text-[16px]">Password</label>
                <input id="password" type="password" name="password" class="text-secondary text-[16px] p-4 rounded-md"
                    placeholder="Add password...">
                @error('password')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- role --}}
            <div class="flex flex-col gap-2 w-full">
                <label for="role" class="text-secondary text-[16px]">Role</label>
                <select id="role" name="role" id="" class="text-secondary text-[16px] p-4 rounded-md">
                    <option value="" disabled selected class="text-[12px] md:text-[16px]">Pilih Role</option>
                    <option value="admin" class="text-[12px] md:text-[16px]">Super Admin</option>
                    <option value="user" class="text-[12px] md:text-[16px]">Admin</option>
                </select>
                @error('role')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- submit --}}
            <div class="flex items-center gap-3">
                <a href="/user" class="btn btn-outline btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-secondary w-auto">Tambah</button>
            </div>
        </form>
    </div>
</x-layout>
