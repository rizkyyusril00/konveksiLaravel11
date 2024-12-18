<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Auth</title>
</head>

<body class="bg-slate-200">
    <div class="flex items-center justify-center h-screen w-screen">
        <div class="flex flex-col gap-6 items-center p-6 rounded-md bg-violet-200 border border-secondary">
            <div class="flex items-center flex-col gap-3">
                <h1>Log In</h1>
                <span>Silahkan Login Untuk Akses Dashboard</span>
            </div>
            {{-- form login --}}
            <form action="" class="w-full flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <label for="username">Userame*</label>
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
                <span class="text-center">Don't have an account? <span>Sign Up</span></span>
            </form>
        </div>
    </div>
</body>

</html>
