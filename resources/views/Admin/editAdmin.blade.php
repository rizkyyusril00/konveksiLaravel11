<x-layout>
    <div class="flex flex-col items-center justify-center w-full h-full gap-4 pt-[100px] px-4">
        <h1>Edit User</h1>
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
        <form action="{{ route('EditUser') }}" method="POST" class="w-full flex flex-col gap-4 px-40">
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
            <div class="flex items-center gap-3">
                <a href="/user"
                    class="btn btn-primary border border-accent w-auto hover:bg-accent hover:text-primary">Cancel</a>
                <button type="submit" class="btn btn-success w-[100px]">Edit</button>
            </div>
        </form>

    </div>
</x-layout>
