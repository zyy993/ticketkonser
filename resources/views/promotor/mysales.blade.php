<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>TixMeUp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <style>
    .back-button {
      display: inline-block;
      background: linear-gradient(to right, #0B1460, #4F8EF7);
      color: #ffffff;
      padding: 10px 20px;
      border-radius: 9999px;
      font-size: 0.9rem;
      font-weight: 600;
      text-decoration: none;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      transition: background 0.3s ease, transform 0.2s ease;
    }
    .back-button:hover {
      background: linear-gradient(to right, #09124d, #3a75dd);
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-100 via-blue-50 to-white text-gray-800 min-h-screen font-sans">

  <!-- Tombol Kembali -->
  <a href="{{ route('dashboard.promotor') }}" class="fixed top-4 left-4 z-50 back-button">
    <- Kembali ke Dashboard Promotor
  </a>

  <main class="pt-24 max-w-6xl mx-auto px-4 sm:px-6 py-14 space-y-10">

    <!-- Grafik Jumlah Penonton -->
    <section class="bg-white p-8 rounded-2xl shadow-lg border">
      <h2 class="text-center text-2xl font-bold text-gray-900 mb-6">📊 Jumlah Penonton Konser di Indonesia per Event</h2>
      <div class="overflow-x-auto">
        <svg class="mx-auto" height="350" viewBox="0 0 700 350" width="100%" style="max-width: 700px">
          <rect fill="#f9fafb" x="100" y="10" width="600" height="310" rx="10" stroke="#ccc" stroke-width="1" />
          <g stroke="#e5e7eb" stroke-width="1">
            @for ($i = 40; $i <= 320; $i += 40)
              <line x1="100" x2="650" y1="{{ $i }}" y2="{{ $i }}" />
            @endfor
          </g>
          <g font-size="11" fill="#000" text-anchor="end">
            @foreach ([0,20000,40000,60000,80000,100000,120000,140000] as $i => $label)
              @php $step = 280 / 7; $y = 320 - ($i * $step); @endphp
              <text x="90" y="{{ $y + 4 }}">{{ number_format($label) }}</text>
            @endforeach
          </g>
          <text transform="rotate(-90)" x="-180" y="20" text-anchor="middle" font-weight="bold" font-size="12">Jumlah Penonton</text>
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
            <rect fill="{{ $colors[$index % count($colors)] }}" height="{{ $height }}" width="50" rx="6" x="{{ $x }}" y="{{ $y }}" />
            <text font-size="10" x="{{ $x + 25 }}" y="{{ $y - 5 }}" text-anchor="middle" class="fill-black font-semibold">
              {{ number_format($item->total, 0, ',', '.') }}
            </text>
            <text font-size="10" x="{{ $x + 25 }}" y="340" text-anchor="middle" class="fill-gray-800">
              {{ \Illuminate\Support\Str::limit($item->event_name, 10, '..') }}
            </text>
          @endforeach
        </svg>
        <p class="text-center mt-4 font-medium text-gray-600">Event Konser</p>
      </div>
    </section>

    <!-- Filter Event -->
    <section class="bg-white p-8 rounded-2xl shadow-lg border">
      <h2 class="text-center text-2xl font-bold text-gray-900 mb-6">📈 Laporan Penjualan Tiket</h2>
      <div class="flex flex-wrap justify-center gap-4 mb-6">
        @foreach(array_keys($weeklySales) as $eventName)
          <button onclick="showChart('{{ Str::slug($eventName) }}')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-full shadow-md transition">
            {{ $eventName }}
          </button>
        @endforeach
      </div>

      @foreach($weeklySales as $event => $sales)
        <section id="chart-{{ Str::slug($event) }}" class="chart-section hidden">
          <h3 class="text-center font-bold text-base text-gray-700 mb-2">
            Penjualan Tiket per Minggu - {{ $event }}
          </h3>
          @php
            $max = collect($sales)->max('jumlah');
            $scale = $max > 0 ? 200 / $max : 0;
            $points = []; $xBase = 140; $xStep = 140;
          @endphp
          <svg class="block mx-auto mb-6" height="260" viewBox="0 0 700 260" width="100%" style="max-width: 700px">
            <rect fill="#f9fafb" x="100" y="10" width="600" height="210" rx="10" stroke="#ccc" stroke-width="1" />
            @for ($i = 0; $i <= 5; $i++)
              @php $y = 220 - ($i * 40); @endphp
              <line stroke="#e5e7eb" stroke-width="1" x1="100" x2="650" y1="{{ $y }}" y2="{{ $y }}" />
              <text font-size="10" fill="#000" text-anchor="end" x="90" y="{{ $y }}">
                {{ number_format($i * ($max / 5)) }}
              </text>
            @endfor
            <text transform="rotate(-90)" x="-130" y="20" text-anchor="middle" font-size="12" class="fill-black font-bold">
              Jumlah Tiket Terjual
            </text>
            @foreach($sales as $i => $week)
              @php
                $x = $xBase + $xStep * $i;
                $y = 220 - ($week['jumlah'] * $scale);
                $points[] = "$x,$y";
              @endphp
              <text font-size="10" fill="#000" text-anchor="middle" x="{{ $x }}" y="240">{{ $week['label'] }}</text>
            @endforeach
            <polyline fill="none" stroke="#2563eb" stroke-width="2" points="{{ implode(' ', $points) }}" />
            @foreach($points as $point)
              @php [$cx, $cy] = explode(',', $point); @endphp
              <circle cx="{{ $cx }}" cy="{{ $cy }}" fill="#2563eb" r="4" />
            @endforeach
          </svg>
        </section>
      @endforeach
    </section>

    <!-- Statistik Ringkasan -->
    <section class="grid md:grid-cols-2 gap-6 text-sm text-gray-800">
      <div class="bg-white rounded-2xl shadow-md p-6 border">
        <h3 class="font-bold mb-2 text-blue-700 text-lg">🎟️ Ticket</h3>
        <ul class="space-y-1">
          <li>Total Tiket Terjual: <strong>140.000 tiket</strong></li>
          <li>Total Penjualan: <strong>Rp 56.000.000.000</strong></li>
          <li>Persentase Terjual: <strong>100%</strong></li>
          <li>Tingkat Penjualan: <strong>Sangat Tinggi</strong></li>
        </ul>
      </div>

      <div class="bg-white rounded-2xl shadow-md p-6 border">
        <h3 class="font-bold mb-2 text-blue-700 text-lg">💰 Penjualan</h3>
        <ul class="space-y-1">
          <li>VIP: 15.000 tiket (Rp 9M)</li>
          <li>Regular: 85.000 tiket (Rp 34M)</li>
          <li>Standing: 40.000 tiket (Rp 13M)</li>
          <li>Online: 90.000 tiket (Rp 36M)</li>
          <li>Outlet: 50.000 tiket (Rp 20M)</li>
          <li>Presale: 40.000 tiket (Rp 16M)</li>
          <li>General: 100.000 tiket (Rp 40M)</li>
        </ul>
      </div>

      <div class="md:col-span-2 bg-white rounded-2xl shadow-md p-6 border">
        <h3 class="font-bold mb-2 text-blue-700 text-lg">📌 Analisis Tambahan</h3>
        <ul class="list-disc ml-6 space-y-1 text-sm">
          <li>Lonjakan presale sangat signifikan</li>
          <li>Wilayah terbanyak: Jakarta, Surabaya, Bandung</li>
          <li>Tiket terlaris: Regular</li>
          <li>Strategi promosi: Early bird + e-commerce besar</li>
          <li>Rekomendasi: Tambah kapasitas venue, tingkatkan penjualan online</li>
        </ul>
      </div>
    </section>

  </main>

  <script>
    function showChart(id) {
      document.querySelectorAll('.chart-section').forEach(el => el.classList.add('hidden'));
      const target = document.getElementById('chart-' + id);
      if (target) target.classList.remove('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
      const firstChart = document.querySelector('.chart-section');
      if (firstChart) firstChart.classList.remove('hidden');
    });
  </script>
</body>
</html>
