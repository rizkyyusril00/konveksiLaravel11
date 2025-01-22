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
                    <button onclick="window.print()"
                        class="flex items-center justify-center bg-secondary w-8 h-8 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="hover:scale-[1.03] transition-all duration-300 ease-in-out" width="18"
                            height="18" fill="#ffffff" viewBox="0 0 256 256">
                            <path
                                d="M214.67,72H200V40a8,8,0,0,0-8-8H64a8,8,0,0,0-8,8V72H41.33C27.36,72,16,82.77,16,96v80a8,8,0,0,0,8,8H56v32a8,8,0,0,0,8,8H192a8,8,0,0,0,8-8V184h32a8,8,0,0,0,8-8V96C240,82.77,228.64,72,214.67,72ZM72,48H184V72H72ZM184,208H72V160H184Zm40-40H200V152a8,8,0,0,0-8-8H64a8,8,0,0,0-8,8v16H32V96c0-4.41,4.19-8,9.33-8H214.67c5.14,0,9.33,3.59,9.33,8Zm-24-52a12,12,0,1,1-12-12A12,12,0,0,1,200,116Z">
                            </path>
                        </svg>
                    </button>

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
            <figure class="w-[360px] h-[200px] rounded-[12px] flex items-center justify-center">
                @if ($order->image_order == null)
                    <span class="text-center text-secondary">No img</span>
                @else
                    <img src="{{ asset('storage/' . $order->image_order) }}"
                        alt="{{ $order->image_customer }} {{ asset('storage/' . $order->image_order) }}"
                        class="rounded-[8px]">
                @endif
            </figure>
            {{-- footer --}}
            <div class="flex items-center gap-2 relative">
                {{-- box 1 --}}
                <div class="flex w-2/3">
                    {{-- kiri --}}
                    <div class="flex flex-col w-1/3 border-y border-l border-secondary">
                        <div class="flex flex-col pt-1 pl-1 pr-14">
                            <span class="text-[14px] text-secondary">Ukuran :</span>
                            <ul>
                                @foreach ($order->items as $item)
                                    <li class="flex justify-between">
                                        <span class="text-[11px] text-secondary">{{ $item['size'] }}</span>
                                        <span class="text-[11px] text-secondary">{{ $item['quantity'] }}</span>
                                    </li>
                                @endforeach
                                <li class="pt-1 flex justify-between font-bold text-[#e62737]">
                                    <span class="text-[13px]">TOTAL</span>
                                    <span class="text-[13px]">{{ $totalQuantity }} Pcs</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{-- kiri --}}
                    <div class="flex flex-col w-2/3 border border-secondary">
                        <div class="flex flex-col p-1">
                            <span class="text-[14px] text-secondary mb-1">Note :</span>
                            <p class="text-[14px] text-secondary">{{ $order->note ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                {{-- box 2 --}}
                <div class="w-1/3 absolute pl-2 top-0 right-0">
                    <table class="table-auto border-collapse border border-secondary w-full">
                        <tbody>
                            <tr>
                                <td class="border border-secondary p-1 text-center text-[14px] text-secondary">Raw
                                    Material</td>
                                <td class="border border-secondary p-1 text-center text-[14px] text-secondary">
                                    {{ $order->bahan_utama->name }}</td>
                            </tr>
                            <tr>
                                <td class="border border-secondary p-1 text-center text-[14px] text-secondary">Cutting
                                </td>
                                <td class="border border-secondary p-1 text-center text-[14px] text-secondary">
                                    {{ $order->pemotong->name }}</td>
                            </tr>
                            <tr>
                                <td class="border border-secondary p-1 text-center text-[14px] text-secondary">Sewing
                                </td>
                                <td class="border border-secondary p-1 text-center text-[14px] text-secondary">
                                    {{ $order->penjahit->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
