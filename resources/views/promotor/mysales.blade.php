<html lang="en">
 <head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>TixMeUp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
   href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
   rel="stylesheet"
  />
  <style>
   /* Custom font for charts */
   .chart-text {
    font-family: Arial, sans-serif;
    font-size: 10px;
    fill: black;
    user-select: none;
   }
   .chart-title {
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-weight: 600;
    fill: black;
    user-select: none;
    text-anchor: middle;
   }
   .chart-title-pink {
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-weight: 700;
    fill: #ff69b4;
    user-select: none;
    text-anchor: middle;
   }
   .bar-label {
    font-family: Arial, sans-serif;
    font-size: 9px;
    fill: black;
    user-select: none;
    text-anchor: middle;
    line-height: 1.1;
   }
   .bar-value {
    font-family: Arial, sans-serif;
    font-size: 11px;
    fill: black;
    user-select: none;
    text-anchor: middle;
    font-weight: 600;
   }
   .axis-label {
    font-family: Arial, sans-serif;
    font-size: 11px;
    fill: black;
    user-select: none;
    text-anchor: middle;
    font-weight: 600;
   }
   .axis-label-vertical {
    font-family: Arial, sans-serif;
    font-size: 11px;
    fill: black;
    user-select: none;
    text-anchor: middle;
    font-weight: 600;
    writing-mode: tb;
   }

   style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9fafb;
            position: relative;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #4a6b8a;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .back-button:hover {
            background-color: #3a5570;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background: white;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #4a6b8a;
            color: white;
        }

        tr:nth-child(even) {
            background: #f3f4f6;
        }

        a {
            color: #4a6b8a;
            text-decoration: none;
            margin-right: 12px;
        }

        a:hover {
            text-decoration: underline;
        }

        .success {
            background: #daf5d8;
            border: 1px solid #34a853;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        button.delete {
            background-color: #dc2626;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button.delete:hover {
            background-color: #b91c1c;
        }

        img {
            width: 80px;
            height: 45px;
            object-fit: cover;
            border-radius: 4px;
        }

        .topbar {
            margin-bottom: 20px;
        }

        .topbar a {
            font-weight: bold;
            font-size: 1.1rem;
        }

        h1 {
            margin-top: 60px;
        }
    </style>
  </style>
 </head>
 <body class="bg-white text-black">
    <!-- Navbar -->
    <a href="{{ route('dashboard.promotor') }}" class="back-button">← Kembali</a>
    <br>
    <br>
  <main class="max-w-4xl mx-auto p-4 space-y-8">


<main class="max-w-4xl mx-auto p-4 space-y-8">
  <!-- Card untuk Grafik -->
  <section class="rounded-lg p-6">
    <div class="relative">
      <h2 class="chart-title absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-full mb-2 font-bold">
        Jumlah Penonton Konser di Indonesia per Event
      </h2>

      <svg
        aria-label="Bar chart showing concert attendance in Indonesia per event"
        class="block mx-auto"
        height="350"
        role="img"
        viewBox="0 0 700 350"
        width="100%"
        style="max-width: 700px"
      >
        <!-- Background box -->
        <rect fill="#f9fafb" x="100" y="10" width="600" height="310" rx="5" stroke="#ccc" stroke-width="1" />

        <!-- Horizontal grid lines -->
        <g stroke="#ccc" stroke-width="1">
          <line x1="100" x2="650" y1="320" y2="320" />
          <line x1="100" x2="650" y1="280" y2="280" />
          <line x1="100" x2="650" y1="240" y2="240" />
          <line x1="100" x2="650" y1="200" y2="200" />
          <line x1="100" x2="650" y1="160" y2="160" />
          <line x1="100" x2="650" y1="120" y2="120" />
          <line x1="100" x2="650" y1="80" y2="80" />
          <line x1="100" x2="650" y1="40" y2="40" />
        </g>

        <!-- Y axis labels -->
        <g class="chart-text axis-label" font-size="10" fill="#000" text-anchor="end">
          <text x="70" y="320">0</text>
          <text x="70" y="280">20,000</text>
          <text x="70" y="240">40,000</text>
          <text x="70" y="200">60,000</text>
          <text x="70" y="160">80,000</text>
          <text x="70" y="120">100,000</text>
          <text x="70" y="80">120,000</text>
          <text x="70" y="40">140,000</text>
        </g>

        <!-- Y axis title -->
        <text transform="rotate(-90)" x="-180" y="20" text-anchor="middle" font-weight="bold" font-size="12">
          Jumlah Penonton
        </text>

        @php
          $colors = ['#ff69b4', '#2563eb', '#7c3aed', '#f97316', '#22c55e', '#facc15', '#e11d48'];
          $maxValue = $data->max('total') > 0 ? $data->max('total') : 1;
        @endphp

        @foreach ($data as $index => $item)
          @php
            $x = 110 + ($index * 80);
            $height = ($item->total / $maxValue) * 280;
            $y = 320 - $height;
          @endphp
          <rect fill="{{ $colors[$index % count($colors)] }}" height="{{ $height }}" width="50" x="{{ $x }}" y="{{ $y }}" />
          <text class="bar-value" x="{{ $x + 25 }}" y="{{ $y - 5 }}" font-size="10" text-anchor="middle">
            {{ number_format($item->total, 0, ',', '.') }}
          </text>
          <text class="bar-label" x="{{ $x + 25 }}" y="340" font-size="10" text-anchor="middle">
            {{ \Illuminate\Support\Str::limit($item->event_name, 10, '..') }}
          </text>
        @endforeach

      </svg>

      <p class="chart-title axis-label text-center block mt-2 font-bold">Event Konser</p>
    </div>
  </section>
</main>

</main>


 <hr class="border-t border-black mb-4" />

   <!-- resources/views/promotor/mysales.blade.php -->




<div class="p-6">

<!-- resources/views/promotor/mysales.blade.php -->


<div class="p-6">
    <h2 class="text-2xl font-bold text-center mb-6">Laporan Penjualan Tiket</h2>

    <div class="flex justify-center space-x-4 mb-6">
        @foreach(array_keys($weeklySales) as $eventName)
            <button
                onclick="showChart('{{ Str::slug($eventName) }}')"
                class="bg-pink-500 hover:bg-pink-600 text-white font-semibold px-4 py-2 rounded shadow"
            >
                {{ $eventName }}
            </button>
        @endforeach
    </div>

    @foreach($weeklySales as $event => $sales)
    <section id="chart-{{ Str::slug($event) }}" class="chart-section border border-black rounded-lg p-6 shadow-sm mb-10 hidden">
        <h3 class="font-bold text-sm mb-2 text-center" style="color: #e91e63;">
            Penjualan Tiket per Minggu - {{ $event }}
        </h3>

        @php
            $max = collect($sales)->max('jumlah');
            $scale = $max > 0 ? 200 / $max : 0;
            $points = [];
            $xBase = 140;
            $xStep = 140;
        @endphp

        <svg
            aria-label="Line chart showing ticket sales per week for {{ $event }}"
            class="block mx-auto mb-6"
            height="260"
            role="img"
            viewBox="0 0 700 260"
            width="100%"
            style="max-width: 700px"
        >
            <rect fill="#f9fafb" x="100" y="10" width="600" height="210" rx="5" stroke="#ccc" stroke-width="1" />

            @for ($i = 0; $i <= 5; $i++)
                @php $y = 220 - ($i * 40); @endphp
                <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="{{ $y }}" y2="{{ $y }}" />
                <text class="chart-text axis-label" dominant-baseline="middle" text-anchor="end" x="70" y="{{ $y }}">
                    {{ number_format($i * ($max / 5)) }}
                </text>
            @endfor

            <text class="chart-text" dominant-baseline="middle" font-weight="600" text-anchor="middle" transform="rotate(-90 15 130)" x="15" y="130">
                Jumlah Tiket Terjual
            </text>

            @foreach($sales as $i => $week)
                @php
                    $x = $xBase + $xStep * $i;
                    $y = 220 - ($week['jumlah'] * $scale);
                    $points[] = "$x,$y";
                @endphp
                <text class="chart-text axis-label" dominant-baseline="middle" text-anchor="middle" x="{{ $x }}" y="240">
                    {{ $week['label'] }}
                </text>
            @endforeach

            <polyline fill="none" points="{{ implode(' ', $points) }}" stroke="#ff69b4" stroke-width="2" />

            @foreach($points as $point)
                @php [$cx, $cy] = explode(',', $point); @endphp
                <circle cx="{{ $cx }}" cy="{{ $cy }}" fill="#ff69b4" r="4" />
            @endforeach
        </svg>
    </section>
    @endforeach
</div>

<script>
    function showChart(id) {
        document.querySelectorAll('.chart-section').forEach(el => el.classList.add('hidden'));
        const target = document.getElementById('chart-' + id);
        if (target) target.classList.remove('hidden');
    }

    // Auto show first chart
    document.addEventListener('DOMContentLoaded', function () {
        const firstChart = document.querySelector('.chart-section');
        if (firstChart) firstChart.classList.remove('hidden');
    });
</script>


</div>


   <hr class="border-t border-black mb-6" />
   <br>
<div class="text-sm">
    <p class="font-bold mb-1">Ticket</p>
    <p>Total Tiket Terjual: 140,000 tiket</p>
    <p>Total Nilai Penjualan: Rp 56,000,000,000 (asumsi rata-rata harga tiket Rp 400,000)</p>
    <p>Persentase Tiket Terjual: 100% (kapasitas penuh)</p>
    <p>Tingkat Penjualan: Sangat Tinggi (ludes dalam waktu singkat)</p>
</div>
<br>
<hr class="border-t border-black mb-6" />
<div class="text-sm">
    <p class="font-bold mb-1">Penjualan</p>
    <p>VIP: 15,000 tiket (Rp 9,000,000,000)</p>
    <p>Regular: 85,000 tiket (Rp 34,000,000,000)</p>
    <p>Standing: 40,000 tiket (Rp 13,000,000,000)</p>
    <p>Tingkat Penjualan: Sangat Tinggi (ludes dalam waktu singkat)</p>
    <p>Online: 90,000 tiket (Rp 36,000,000,000)</p>
    <p>Outlet: 50,000 tiket (Rp 20,000,000,000)</p>
    <p>Presale: 40,000 tiket (Rp 16,000,000,000)</p>
    <p>General Sale: 100,000 tiket (Rp 40,000,000,000)</p>
</div>
<br>
<hr class="border-t border-black mb-6" />
<div class="text-sm">
    <p class="font-bold mb-1">Analisis Tambahan</p>
    <p>-Grafik penjualan menunjukkan lonjakan signifikan saat presale.</p>
    <p>-Wilayah penjualan terbanyak: Jakarta, Surabaya, Bandung.</p>
    <p>-Jenis tiket terlaris: Regular</p>
    <p>-Catatan: Ada promosi early bird di presale dan kerjasama dengan e-commerce besar.</p>
    <p>-Penjualan tiket konser BLACKPINK sangat sukses, memenuhi kapasitas dengan cepat.</p>
    <p>-Rekomendasi: Perlu tingkatkan kapasitas venue dan integrasi penjualan online yang lebih baik.</p>
</div>
<br>

   </section>
  </main>
 </body>
</html>
