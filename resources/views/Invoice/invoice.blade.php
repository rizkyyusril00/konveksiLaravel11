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
    <title>Invoice</title>
</head>

<body class="bg-primary">
    <div class="flex items-center justify-center h-screen w-screen">
        <div class="w-[80%] h-auto bg-primary rounded-[10px] flex flex-col gap-4 p-4">
            {{-- header --}}
            <div class="flex items-center justify-between">
                {{-- logo company --}}
                <figure class="w-28 h-16">
                    <img src="/img/logo.png" alt="logo_company" class="w-full h-full object-cover">
                </figure>
                {{-- invoice --}}
                <div class="flex flex-col gap-2">
                    <h1 class="text-[24px] text-right text-secondary font-semibold">INVOICE</h1>
                    <div class="flex flex-col gap-1 w-[300px]">
                        <div class="flex justify-between items-center gap-3">
                            <span class="text-right w-1/2">Invoice</span>
                            <span class="w-1/2 text-right">INV/109</span>
                        </div>
                        <div class="flex justify-between items-center gap-3">
                            <span class="text-right w-1/2">Tanggal</span>
                            <span class="w-1/2 text-right">14 Dec 2024</span>
                        </div>
                        <div class="flex justify-between items-center gap-3">
                            <span class="text-right w-1/2">Jatuh Tempo</span>
                            <span class="w-1/2 text-right">14 Dec 2024</span>
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
                                <div class="flex items-center gap-2">
                                    <figure class="w-14 h-14 flex items-center justify-center bg-red-100 rounded-md">
                                        img
                                    </figure>
                                    <div class="flex flex-col gap-1">
                                        <span>Antonio</span>
                                        <span>PO ID: 190</span>
                                    </div>
                                </div>
                            </td>
                            <td>Rudi</td>
                            <td>Pino</td>
                            <td>
                                <ol class="list-disc">
                                    <li>Combed 20</li>
                                    <li>Parasut</li>
                                    <li>Wangki</li>
                                </ol>
                            </td>
                            <td>Kaos</td>
                            <td>2 Pcs</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- Tagihan --}}
            <div class="flex justify-between">
                <div class="flex flex-col gap-3">
                    <h2 class="">Tagihan Kepada :</h2>
                    <div class="flex flex-col gap-1">
                        <span class="">Antonio Sutanto</span>
                        <span>Jl. Raya No. 1, Jakarta</span>
                        <span>Telp: 0909020</span>
                        <span>Email: GtN6o@example.com</span>
                    </div>
                </div>
                <div class="relative w-[250px]">
                    <div class="flex flex-col gap-1 w-[250px] absolute bottom-0">
                        <div class="flex justify-between items-center gap-1">
                            <span class="text-right w-1/2">Subtotal: </span>
                            <span class="w-1/2 text-right">Rp. 100.000</span>
                        </div>
                        <div class="flex justify-between items-center gap-1">
                            <span class="text-right w-1/2">Diskon: </span>
                            <span class="w-1/2 text-right">Rp. 50.000</span>
                        </div>
                        <div class="flex justify-between items-center gap-1">
                            <span class="text-right w-1/2">Pajak: </span>
                            <span class="w-1/2 text-right">Rp. 10.000</span>
                        </div>
                        <div class="flex justify-between items-center gap-1">
                            <span class="text-right w-1/2">Total: </span>
                            <span class="w-1/2 text-right">Rp. 500.000</span>
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
