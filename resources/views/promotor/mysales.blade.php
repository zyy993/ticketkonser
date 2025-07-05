<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>TixMeUp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Back Button -->
<a href="{{ route('dashboard.promotor') }}"
   class="fixed top-4 left-4 bg-[#4a6b8a] text-white px-4 py-2 rounded-md font-semibold shadow hover:bg-[#3b566e]">
  ← Kembali
</a>


  <main class="max-w-6xl mx-auto p-6 space-y-10">

    <!-- Grafik Jumlah Penonton -->
    <section class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-center text-lg font-bold text-black mb-4">

        Jumlah Penonton Konser di Indonesia per Event
      </h2>
      <div class="overflow-x-auto">
        <svg aria-label="Bar chart showing concert attendance" class="mx-auto" height="350" viewBox="0 0 700 350" width="100%" style="max-width: 700px">
          <rect fill="#f9fafb" x="100" y="10" width="600" height="310" rx="5" stroke="#ccc" stroke-width="1" />
          <g stroke="#ccc" stroke-width="1">
            @for ($i = 40; $i <= 320; $i += 40)
              <line x1="100" x2="650" y1="{{ $i }}" y2="{{ $i }}" />
            @endfor
          </g>
          <g font-size="10" fill="#000" text-anchor="end">
  @foreach ([0,20000,40000,60000,80000,100000,120000,140000] as $i => $label)
    @php
      $step = 280 / 7; // 280 adalah tinggi grafik (dari 320 ke 40), 7 adalah jumlah interval antar label
      $y = 320 - ($i * $step);
    @endphp
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
            <rect fill="{{ $colors[$index % count($colors)] }}" height="{{ $height }}" width="50" x="{{ $x }}" y="{{ $y }}" />
            <text font-size="10" x="{{ $x + 25 }}" y="{{ $y - 5 }}" text-anchor="middle" class="fill-black font-semibold">
              {{ number_format($item->total, 0, ',', '.') }}
            </text>
            <text font-size="10" x="{{ $x + 25 }}" y="340" text-anchor="middle" class="fill-gray-800">
              {{ \Illuminate\Support\Str::limit($item->event_name, 10, '..') }}
            </text>
          @endforeach
        </svg>
        <p class="text-center mt-2 font-semibold text-gray-700">Event Konser</p>
      </div>
    </section>

    <!-- Filter Button -->
    <section class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-center text-lg font-bold text-black mb-4">Laporan Penjualan Tiket</h2>
      <div class="flex flex-wrap justify-center gap-3 mb-4">
        @foreach(array_keys($weeklySales) as $eventName)
          <button onclick="showChart('{{ Str::slug($eventName) }}')" class="bg-pink-500 hover:bg-pink-600 text-white font-semibold px-4 py-2 rounded-md shadow">
            {{ $eventName }}
          </button>
        @endforeach
      </div>

      @foreach($weeklySales as $event => $sales)
        <section id="chart-{{ Str::slug($event) }}" class="chart-section hidden">
          <h3 class="text-center font-bold text-sm text-black mb-2">
            Penjualan Tiket per Minggu - {{ $event }}
          </h3>
          @php
            $max = collect($sales)->max('jumlah');
            $scale = $max > 0 ? 200 / $max : 0;
            $points = []; $xBase = 140; $xStep = 140;
          @endphp
          <svg class="block mx-auto mb-6" height="260" viewBox="0 0 700 260" width="100%" style="max-width: 700px">
            <rect fill="#f9fafb" x="100" y="10" width="600" height="210" rx="5" stroke="#ccc" stroke-width="1" />
            @for ($i = 0; $i <= 5; $i++)
              @php $y = 220 - ($i * 40); @endphp
              <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="{{ $y }}" y2="{{ $y }}" />
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
            <polyline fill="none" stroke="#ff69b4" stroke-width="2" points="{{ implode(' ', $points) }}" />
            @foreach($points as $point)
              @php [$cx, $cy] = explode(',', $point); @endphp
              <circle cx="{{ $cx }}" cy="{{ $cy }}" fill="#ff69b4" r="4" />
            @endforeach
          </svg>
        </section>
      @endforeach
    </section>

    <!-- Statistik Ringkasan -->
    <section class="grid md:grid-cols-2 gap-6 text-sm text-gray-800">
      <div class="bg-white rounded-lg shadow-md p-5 border">
        <h3 class="font-bold mb-2 text-[#1d4ed8]">Ticket</h3>
        <p>Total Tiket Terjual: 140.000 tiket</p>
        <p>Total Penjualan: Rp 56.000.000.000</p>
        <p>Persentase Terjual: 100%</p>
        <p>Tingkat Penjualan: Sangat Tinggi</p>
      </div>

      <div class="bg-white rounded-lg shadow-md p-5 border">
        <h3 class="font-bold mb-2 text-[#1d4ed8]">Penjualan</h3>
        <p>VIP: 15.000 tiket (Rp 9M)</p>
        <p>Regular: 85.000 tiket (Rp 34M)</p>
        <p>Standing: 40.000 tiket (Rp 13M)</p>
        <p>Online: 90.000 tiket (Rp 36M)</p>
        <p>Outlet: 50.000 tiket (Rp 20M)</p>
        <p>Presale: 40.000 tiket (Rp 16M)</p>
        <p>General: 100.000 tiket (Rp 40M)</p>
      </div>

      <div class="md:col-span-2 bg-white rounded-lg shadow-md p-5 border">
        <h3 class="font-bold mb-2 text-[#1d4ed8]">Analisis Tambahan</h3>
        <ul class="list-disc ml-5 space-y-1">
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
