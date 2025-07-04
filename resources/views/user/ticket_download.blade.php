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
<body class="bg-gradient-to-b from-blue-50 to-white p-8 min-h-screen">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow-xl border border-blue-200 transition-all">
        <h1 class="text-2xl font-bold text-center mb-6 text-blue-800 tracking-wide">🎫 E-TICKET</h1>

        {{-- Gambar Event --}}
        <div class="mb-5 text-center">
            <img
                src="{{ $order->ticket->event->image_path ? asset('storage/' . $order->ticket->event->image_path) : asset('img/deadline.jpg') }}"
                alt="{{ $order->ticket->event->name ?? 'Event' }}"
                class="mx-auto rounded-lg object-cover h-48 w-full shadow-sm border"
            >
        </div>

        {{-- Info Tiket --}}
        <div class="space-y-4 text-gray-800 text-sm">
            <div><span class="font-semibold">🎤 Nama Event:</span> {{ $order->ticket->event->name ?? '-' }}</div>
            <div><span class="font-semibold">📍 Lokasi:</span> {{ $order->ticket->event->location ?? '-' }}</div>
            <div><span class="font-semibold">📅 Tanggal Acara:</span> {{ optional($order->ticket->event->date)->format('d F Y') ?? '-' }}</div>
            <div><span class="font-semibold">⏰ Waktu:</span>
                Gates open at {{ optional($order->ticket->event->gates_open)->format('H:i') ?? '-' }} |
                Show starts at {{ optional($order->ticket->event->show_starts)->format('H:i') ?? '-' }}
            </div>

            <hr class="border-gray-300 my-4">

            <div><span class="font-semibold">🪑 Zona:</span> {{ strtoupper($order->ticket->zone) }}</div>
            <div><span class="font-semibold">💺 Seat Number:</span> {{ $order->ticket->seat_number }}</div>
            <div><span class="font-semibold">💸 Harga Tiket:</span> Rp{{ number_format($order->total_harga + ($order->harga_tiket * 0.15), 0, ',', '.') }}</div>
            <div>
                <span class="font-semibold">📌 Status:</span>
                <span class="{{ $order->status === 'accepted' ? 'text-green-600 font-bold' : 'text-yellow-600 font-semibold' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            <div><span class="font-semibold">🔑 Kode Pembayaran:</span> {{ str_pad($order->id, 11, '0', STR_PAD_LEFT) }}</div>
        </div>

        {{-- QR Code --}}
        <div class="mt-6 text-center">
            <div class="inline-block p-3 bg-gray-100 border rounded shadow-sm">
                {!! QrCode::size(200)->generate($order->id . '|' . $order->seat_name . '|' . $order->total_harga) !!}
            </div>
        </div>

        {{-- Tombol --}}
        <div class="text-center mt-6 no-print">
            <button onclick="window.print()"
                class="bg-blue-700 text-white px-5 py-2 rounded-full hover:bg-blue-800 transition duration-200 shadow-md">
                🖨️ Cetak Tiket
            </button>
        </div>

        {{-- Link kembali ke home --}}
        <div class="text-center mt-4 no-print">
            <a href="{{ route('home.tampil') }}"
               class="text-sm text-blue-600 hover:underline transition duration-150">
                ← Kembali ke Home
            </a>
        </div>
    </div>
</body>

</html>
