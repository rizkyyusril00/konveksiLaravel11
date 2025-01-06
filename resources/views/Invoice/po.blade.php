<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- font inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>PO</title>
</head>

<body class="bg-primary overflow-hidden">
    <div class="flex items-center justify-center h-screen w-screen">
        <div class="w-[80%] h-auto bg-primary rounded-[10px] flex flex-col gap-3 p-4">
            <h1 class="text-[24px] text-right text-secondary font-semibold">FORM WORKSHEET</h1>
            {{-- header --}}
            <div class="flex items-center justify-between gap-10">
                {{-- logo company --}}
                <div class="flex items-center gap-4 border-b-2 border-secondary pb-2">
                    <figure class="w-14 h-14">
                        <img src="/img/LOGO.png" alt="logo_company" class="w-full h-full">
                    </figure>
                    <div class="flex flex-col gap-1 font-bold">
                        <span class="text-secondary text-[20px]">
                            CV. CIPTA
                            <span class="text-[#e62737] text-[20px]">CEMPAKA</span>
                        </span>
                        <span class="text-secondary text-[12px] italic">EXPRESS PRODUCTION WITH PRIDE AND QUALITY</span>
                    </div>
                </div>
                {{-- worksheet --}}
                <div class="flex items-center gap-2">
                    {{-- print --}}
                    <button class="btn btn-secondary print:hidden" onclick="window.print()">Cetak</button>
                    {{-- no order --}}
                    <div class="flex flex-col p-2 w-36 border-2 border-secondary">
                        <span class="text-secondary">No. Order :</span>
                        <span class="text-secondary font-bold">{{ $order->id }}</span>
                    </div>
                    {{-- deadline --}}
                    <div class="flex flex-col p-2 w-36 border-2 border-secondary">
                        <span class="text-secondary">Jatuh Tempo :</span>
                        <span class="text-secondary font-bold">{{ $order->tanggal_selesai }}</span>
                    </div>
                </div>

            </div>
            {{-- img order --}}
            <figure class="w-[250px] h-56 rounded-[12px] flex items-center justify-center bg-red-200">
                @if ($order->image_order == null)
                    <span class="text-center text-secondary">No img</span>
                @else
                    <img src="{{ asset('storage/' . $order->image_order) }}"
                        alt="{{ $order->image_customer }} {{ asset('storage/' . $order->image_order) }}"
                        class="w-full h-full object-cover rounded-[8px]">
                @endif
            </figure>
            {{-- footer --}}
            <div class="flex items-center gap-2 relative">
                {{-- box 1 --}}
                <div class="flex w-2/3">
                    {{-- kiri --}}
                    <div class="flex flex-col w-1/3 border-y border-l border-black">
                        <div class="flex flex-col p-1">
                            <span>Ukuran :</span>
                            <ul>
                                @foreach ($order->items as $item)
                                    <li class="flex justify-between">
                                        <span>{{ $item['size'] }}</span>
                                        <span class="pr-24">{{ $item['quantity'] }}</span>
                                    </li>
                                @endforeach
                                <li class="pt-4 flex justify-between text-[#e62737]">
                                    <span class="">TOTAL</span>
                                    <span class="pr-16">{{ $totalQuantity }} Pcs</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{-- kiri --}}
                    <div class="flex flex-col w-2/3 border border-black">
                        <div class="flex flex-col p-1">
                            <span class="mb-1">Note :</span>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque molestias temporibus vitae
                                assumenda. Quisquam deleniti cumque dicta quos tempore. Id cumque quibusdam dignissimos
                                minima incidunt, in rem nemo, expedita voluptate recusandae molestias numquam maxime ut,
                                modi nisi fuga rerum hic.</p>
                        </div>
                    </div>
                </div>
                {{-- box 2 --}}
                <div class="w-1/3 absolute pl-2 top-0 right-0">
                    <table class="table-auto border-collapse border border-black w-full">
                        <tbody>
                            <tr>
                                <td class="border border-black p-1 text-center">Raw Material</td>
                                <td class="border border-black p-1 text-center">{{ $order->bahan_utama }}</td>
                            </tr>
                            <tr>
                                <td class="border border-black p-1 text-center">Cutting</td>
                                <td class="border border-black p-1 text-center">{{ $order->pemotong->name }}</td>
                            </tr>
                            <tr>
                                <td class="border border-black p-1 text-center">Sewing</td>
                                <td class="border border-black p-1 text-center">{{ $order->penjahit->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
