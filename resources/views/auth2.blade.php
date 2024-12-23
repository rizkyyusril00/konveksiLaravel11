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

<body class="bg-slate-200 overflow-hidden">
    <div class="flex items-center justify-center h-screen w-screen">
        <div class="relative w-[350px] h-[500px] [perspective:1000px]" x-data="{ flipped: false }">
            <div class="relative w-full h-full [transform-style:preserve-3d] transition-transform duration-700"
                :class="flipped ? '[transform:rotateY(180deg)]' : ''">
                <!-- Front Side (Login) -->
                <div
                    class="absolute w-full h-full bg-violet-200 border border-secondary flex flex-col gap-6 items-center p-6 rounded-md [backface-visibility:hidden]">
                    <div class="flex items-center flex-col gap-3">
                        <h1>Log In</h1>
                        <span>Silahkan Login Untuk Akses Dashboard</span>
                    </div>
                    <!-- Form Login -->
                    <form action="" class="w-full flex flex-col gap-4">
                        <div class="flex flex-col gap-1">
                            <label for="username">Username*</label>
                            <input type="text" name="username" id="username" placeholder="Masukan Username..."
                                class="input w-full" />
                        </div>
                        <div class="flex flex-col gap-1">
                            <div class="flex justify-between">
                                <label for="password">Password*</label>
                                <span>Forget Password?</span>
                            </div>
                            <input type="password" name="password" id="password" placeholder="Masukan Password..."
                                class="input w-full" />
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    <span class="text-center">Don't have an account?
                        <a href="#" @click.prevent="flipped = true" class="text-blue-600 cursor-pointer">Sign
                            Up</a>
                    </span>
                </div>
                <!-- Back Side (Sign Up) -->
                <div
                    class="absolute w-full h-full bg-violet-100 border border-secondary flex flex-col gap-6 items-center p-6 rounded-md [backface-visibility:hidden] [transform:rotateY(180deg)]">
                    <div class="flex items-center flex-col gap-3">
                        <h1>Sign Up</h1>
                        <span>Buat akun untuk akses dashboard</span>
                    </div>
                    <!-- Form Sign Up -->
                    <form action="" class="w-full flex flex-col gap-4">
                        <div class="flex flex-col gap-1">
                            <label for="signup-username">Username*</label>
                            <input type="text" name="signup-username" id="signup-username"
                                placeholder="Masukan Username..." class="input w-full" />
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="signup-email">Email*</label>
                            <input type="email" name="signup-email" id="signup-email" placeholder="Masukan Email..."
                                class="input w-full" />
                        </div>
                        <div class="flex flex-col gap-1">
                            <label for="signup-password">Password*</label>
                            <input type="password" name="signup-password" id="signup-password"
                                placeholder="Masukan Password..." class="input w-full" />
                        </div>
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </form>
                    <span class="text-center">Already have an account?
                        <a href="#" @click.prevent="flipped = false" class="text-blue-600 cursor-pointer">Log
                            In</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
