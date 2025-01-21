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
    <title>Invoice</title>
</head>

<body class="bg-primary">
    <div class="flex items-center justify-center h-screen w-screen">
        <div class="w-[80%] h-auto bg-primary rounded-[10px] flex flex-col gap-4 p-4">
            {{-- header --}}
            <div class="flex items-center justify-between">
                {{-- logo company --}}
                <figure class="w-24 h-24">
                    <img src="/img/LOGO.png" alt="logo_company" class="w-full h-full">
                </figure>
                {{-- invoice --}}
                <div class="flex flex-col gap-2">
                    <div class="flex items-center justify-end gap-2">
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
                        <h1 class="text-[24px] text-right text-secondary font-semibold">INVOICE</h1>
                    </div>
                    <div class="flex flex-col gap-1 w-[300px]">
                        <div class="flex justify-between items-center gap-3">
                            <span class="text-right w-1/2">Invoice</span>
                            <span class="w-1/2 text-right">INV/{{ $order->id }}</span>
                        </div>
                        <div class="flex justify-between items-center gap-3">
                            <span class="text-right w-1/2">Tanggal</span>
                            <span class="w-1/2 text-right">{{ $order->tanggal_order }}</span>
                        </div>
                        <div class="flex justify-between items-center gap-3">
                            <span class="text-right w-1/2">Jatuh Tempo</span>
                            <span class="w-1/2 text-right">{{ $order->tanggal_selesai }}</span>
                        </div>
                    </div>

                </div>
            </div>
            {{-- table --}}
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <!-- head -->
                    <thead class="bg-slate-200">
                        <tr>
                            <th class="w-auto">No</th>
                            <th class="w-auto">Name</th>
                            <th class="w-auto">Pemotong</th>
                            <th class="w-auto">Penjahit</th>
                            <th class="w-auto">Bahan</th>
                            <th class="w-auto">Jenis Item</th>
                            <th class="w-auto">Jumlah Item</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr>
                            <th>1</th>
                            <td>
                                <div class="flex flex-col gap-1">
                                    <span>{{ ucwords($order->customer->name) }}</span>
                                    <span>PO ID: {{ $order->id }}</span>
                                </div>
                            </td>
                            <td>{{ $order->pemotong->name }}</td>
                            <td>{{ $order->penjahit->name }}</td>
                            <td>
                                <ol class="list-disc">
                                    <li>{{ $order->bahan_utama->name }}</li>
                                    <li>{{ $order->bahan_tambahan->name ?? '-' }}</li>
                                </ol>
                            </td>
                            <td>{{ $order->jenis_pakaian }}</td>
                            <td>
                                {{ count($order->items) }} pcs
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- Tagihan --}}
            <div class="flex justify-between">
                <div class="flex gap-4">
                    <figure class="w-40 h-40 rounded-[12px]">
                        @if ($order->image_order == null)
                            <div class="flex items-center justify-center w-full h-full bg-slate-200">
                                <span class="text-center text-secondary">No img</span>
                            </div>
                        @else
                            <img src="{{ asset('storage/' . $order->image_order) }}" alt=""
                                classname="w-full h-full rounded-[12px] object-cover">
                        @endif
                    </figure>
                    <div class="flex flex-col gap-3">
                        <h2 class="">Tagihan Kepada :</h2>
                        <div class="flex flex-col gap-1">
                            <span class="">{{ ucwords($order->customer->name) }}</span>
                            <span class="">{{ ucwords($order->customer->no_hp) }}</span>
                            <span class="">{{ ucwords($order->customer->email) }}</span>
                        </div>
                    </div>
                </div>
                <div class="relative w-[250px]">
                    <div class="flex flex-col gap-1 w-[250px] absolute bottom-0" x-data="{
                        subtotal: @php $totalHarga = 0;
                            foreach ($order->items as $item) {
                                $totalHarga += $item['total_harga'] ?? 0;
                            } @endphp
                        {{ $totalHarga }},
                        diskon: {{ $order->diskon ?? 0 }},
                        pajak: {{ $order->pajak ?? 0 }},
                        getTotal() {
                            return this.subtotal - this.diskon + this.pajak;
                        }
                    }">
                        {{-- subtotal --}}
                        <div class="flex justify-between items-center gap-1">
                            <span class="text-right w-1/2">Subtotal: </span>
                            <span class="w-1/2 text-right" x-text="'RP ' + subtotal.toLocaleString('id-ID')"></span>
                        </div>
                        {{-- diskon --}}
                        <div class="flex justify-between items-center gap-1">
                            <span class="text-right w-1/2">Diskon: </span>
                            <span class="w-1/2 text-right" x-text="'Rp. ' + diskon.toLocaleString('id-ID')"></span>
                        </div>
                        {{-- pajak --}}
                        <div class="flex justify-between items-center gap-1">
                            <span class="text-right w-1/2">Pajak: </span>
                            <span class="w-1/2 text-right" x-text="'Rp. ' + pajak.toLocaleString('id-ID')"></span>
                        </div>
                        {{-- total --}}
                        <div class="flex justify-between items-center gap-1">
                            <span class="text-right w-1/2">Total: </span>
                            <span class="w-1/2 text-right" x-text="'Rp. ' + getTotal().toLocaleString('id-ID')"></span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 w-[300px] invisible bg-yellow-400">
                        <div class="flex justify-between items-center gap-3">
                            <span class="text-right w-1/2">Subtotal: </span>
                            <span class="w-1/2 text-right">Rp. 100.000</span>
                        </div>
                        <div class="flex justify-between items-center gap-3">
                            <span class="text-right w-1/2">Diskon</span>
                            <span class="w-1/2 text-right">Rp. 50.000</span>
                        </div>
                        <div class="flex justify-between items-center gap-3">
                            <span class="text-right w-1/2">Pajak</span>
                            <span class="w-1/2 text-right">Rp. 10.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
