<x-layout>
    <div class="flex flex-col items-center justify-center w-full h-full gap-4 pt-[100px] px-4">
        <h1>add Supplier</h1>
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
        <form action="{{ route('AddSupplier') }}" method="POST" class="w-full flex flex-col gap-4 px-40 pb-10">
            @csrf
            <div class="flex flex-col gap-1 w-full">
                <label for="">Supplier Name</label>
                <input type="text" name="name" class="p-4 rounded-md" placeholder="Add Supplier Name...">
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1 w-full">
                <label for="">No HP</label>
                <input type="text" name="no_hp" class="p-4 rounded-md" placeholder="Add No HP...">
                @error('no_hp')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1 w-full">
                <label for="">Alamat</label>
                <input type="text" name="alamat" class="p-4 rounded-md" placeholder="Add Alamat...">
                @error('alamat')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1 w-full">
                <label for="">Email</label>
                <input type="email" name="email" class="p-4 rounded-md" placeholder="Add Email...">
                @error('email')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1 w-full">
                <label for="">Bahan Utama</label>
                <select name="bahan_utama" id="" class="p-4 rounded-md">
                    <option value="" disabled selected>Pilih Bahan Utama</option>
                    <option value="Combed 20">Combed 20</option>
                    <option value="Combed 24s">Combed 24s</option>
                    <option value="Combed 30s">Combed 30s</option>
                </select>
                @error('bahan_utama')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1 w-full">
                <label for="">Bahan Tambahan</label>
                <select name="bahan_tambahan" id="" class="p-4 rounded-md">
                    <option value="" disabled selected>Pilih Bahan Tambahan</option>
                    <option value="Asahi">Asahi</option>
                    <option value="Parasut">Parasut</option>
                    <option value="Jaring">Jaring</option>
                </select>
                @error('bahan_tambahan')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1 w-full">
                <label for="">Jenis Kancing</label>
                <select name="jenis_kancing" id="" class="p-4 rounded-md">
                    <option value="" disabled selected>Pilih jenis Kancing</option>
                    <option value="Wangki">Wangki</option>
                    <option value="PDH">PDH</option>
                    <option value="Jas">Jas</option>
                </select>
                @error('jenis_kancing')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex flex-col gap-1 w-full">
                <label for="">Jenis Sleting</label>
                <select name="jenis_sleting" id="" class="p-4 rounded-md">
                    <option value="" disabled selected>Pilih jenis Kancing</option>
                    <option value="Gigi Halus">Gigi Halus</option>
                    <option value="Gigi Kasar">Gigi Kasar</option>
                </select>
                @error('jenis_kancing')
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
