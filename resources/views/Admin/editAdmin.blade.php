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
                <div class="alert alert-error">
                    <span class="text-primary">{{ Session::get('fail') }}</span>
                    <span @click="open = false" class="cursor-pointer text-primary">x</span>
                </div>
            </div>
        @endif
        <form action="{{ route('EditUser') }}" method="POST"
            class="w-full flex flex-col gap-4 px-2 pb-24 md:px-8 2xl:px-4 md:py-4">
            <h1 class="text-[24px] text-start text-secondary font-semibold">Edit User</h1>
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="flex flex-col gap-1 w-full">
                <label for="">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="p-4 rounded-md"
                    placeholder="Add Name...">
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1 w-full">
                <label for="">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="p-4 rounded-md"
                    placeholder="Add Email...">
                @error('email')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1 w-full">
                <label for="">Role</label>
                <select name="role" id="" class="p-4 rounded-md">
                    <option value="{{ $user->role }}" disabled selected class="text-[12px] md:text-[16px]">
                        {{ $user->role }}</option>
                    <option value="admin" class="text-[12px] md:text-[16px]">Super Admin</option>
                    <option value="user" class="text-[12px] md:text-[16px]">Admin</option>
                </select>
                @error('role')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center gap-3">
                <a href="/user" class="btn btn-outline btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-secondary">Edit</button>
            </div>
        </form>

    </div>
</x-layout>
