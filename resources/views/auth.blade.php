<x-login.form>
    <form action="{{ route('AuthVerify') }}" method="POST" class="w-full flex flex-col gap-4">
        @csrf
        <div class="flex flex-col gap-1">
            <label for="email" class="text-[#222222] text-[12px]">Email*</label>
            <input type="text" name="email" id="email" placeholder="Masukan Email..."
                class="input input-secondary w-full" />
            @error('email')
                <span class="text-red-400">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col gap-1">
            <div class="flex justify-between">
                <label for="password" class="text-[#222222] text-[12px]">Password*</label>
            </div>
            <input type="password" name="password" id="password" placeholder="Masukan Password..."
                class="input input-secondary w-full" />
        </div>
        <button type="submit" class="btn btn-secondary">Login </button>
    </form>

</x-login.form>
