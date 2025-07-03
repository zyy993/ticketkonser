<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg border border-gray-200">
        <h1 class="text-xl font-bold text-center mb-4 text-blue-700">🎫 E-TICKET</h1>

        <div class="mb-4 text-center">
            <img
                src="{{ $order->ticket->event->image_path ? asset('storage/' . $order->ticket->event->image_path) : asset('img/deadline.jpg') }}"
                alt="{{ $order->ticket->event->name ?? 'Event' }}"
                class="mx-auto rounded-md object-cover h-40 w-full"
            >
        </div>

        <div class="space-y-3 text-gray-800 text-sm">
            <div>
                <span class="font-semibold">Nama Event:</span>
                {{ $order->ticket->event->name ?? '-' }}
            </div>

            <div>
                <span class="font-semibold">Lokasi:</span>
                {{ $order->ticket->event->location ?? '-' }}
            </div>

            <div>
                <span class="font-semibold">Tanggal Acara:</span>
                {{ optional($order->ticket->event->date)->format('d F Y') ?? '-' }}
            </div>

            <div>
                <span class="font-semibold">Waktu:</span>
                Gates open at {{ optional($order->ticket->event->gates_open)->format('H:i') ?? '-' }} |
                Show starts at {{ optional($order->ticket->event->show_starts)->format('H:i') ?? '-' }}
            </div>

            <hr class="my-3">

            <div>
                <span class="font-semibold">Zona:</span> {{ strtoupper($order->ticket->zone) }}
            </div>

            <div>
                <span class="font-semibold">Seat Number:</span> {{ $order->ticket->seat_number }}
            </div>

            <div>
                <span class="font-semibold">Harga Tiket:</span>   Rp{{ number_format($order->total_harga + ($order->harga_tiket * 0.15), 0, ',', '.') }}
            </div>

            <div>
                <span class="font-semibold">Status:</span>
                <span class="{{ $order->status === 'accepted' ? 'text-green-600 font-bold' : 'text-yellow-600' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div>
                <span class="font-semibold">Kode Pembayaran:</span>
                {{ str_pad($order->id, 11, '0', STR_PAD_LEFT) }}
            </div>
        </div>

        <div class="text-center mt-6 no-print">
            <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                🖨️ Cetak Tiket
            </button>
        </div>
         <li><a href="{{ route('home.tampil') }}" class="hover:underline">Home</a></li>
                 
    </div>
</body>
</html>
