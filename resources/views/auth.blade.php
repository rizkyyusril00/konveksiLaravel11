<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Auth</title>
</head>

<body class="bg-slate-200">
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
    <div class="flex items-center justify-center h-screen w-screen">
        <div class="flex flex-col gap-6 items-center p-6 rounded-md bg-violet-200 border border-secondary">
            <div class="flex items-center flex-col gap-3">
                <h1>Log In</h1>
                <span>Silahkan Login Untuk Akses Dashboard</span>
            </div>
            {{-- form login --}}
            <form action="{{ route('AuthVerify') }}" method="POST" class="w-full flex flex-col gap-4">
                @csrf
                <div class="flex flex-col gap-1">
                    <label for="email">Email*</label>
                    <input type="text" name="email" id="email" placeholder="Masukan Email..."
                        class="input w-full" />
                    @error('email')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex flex-col gap-1">
                    <div class="flex justify-between">
                        <label for="password">Password*</label>
                        <span>Forget Password?</span>
                    </div>
                    <input type="password" name="password" id="password" placeholder="Masukan Password..."
                        class="input w-full" />
                </div>
                <button type="submit" class="btn btn-primary">Login </button>
                <span class="text-center">Don't have an account? <span>Sign Up</span></span>
            </form>
        </div>
    </div>
</body>

</html>
