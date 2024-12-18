<x-layout>
    <div class="flex flex-col items-center justify-center w-full h-full gap-4 pt-[100px] px-4">
        <h1>Add karyawan</h1>
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
        <form action="{{ route('AddKaryawan') }}" method="POST" class="w-full flex flex-col gap-4 px-40">
            @csrf
            <div class="flex flex-col gap-1 w-full">
                <label for="">Name</label>
                <input type="text" name="name" class="p-4 rounded-md" placeholder="Add Name...">
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1 w-full">
                <label for="">Pekerjaan</label>
                <select name="pekerjaan" id="" class="p-4 rounded-md">
                    <option value="" disabled selected>Pilih Pekerjaan</option>
                    <option value="Penjahit">Penjahit</option>
                    <option value="Pemotong">Pemotong</option>
                </select>
                @error('pekerjaan')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1 w-full">
                <label for="">Upah/Potong</label>
                <input type="text" name="upah" class="p-4 rounded-md" placeholder="Add Name...">
                @error('upah')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- submit --}}
            <div class="flex items-center gap-3">
                <a href="/karyawan"
                    class="btn btn-primary border border-accent w-auto hover:bg-accent hover:text-primary"">Cancel</a>
                <button type="submit" class="btn btn-success w-auto">Add</button>
            </div>
        </form>
    </div>
</x-layout>
