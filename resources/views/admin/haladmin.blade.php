<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   TixMeUp
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
           input, select {
            min-width: 100px;
        }
   body {
      font-family: 'Montserrat', sans-serif;
    }
  </style>
 </head>
<body class="bg-gray-50 font-sans">

    <!-- Navbar -->
    <nav class="bg-[#00108b] flex items-center justify-between px-6 py-3">
        <div class="flex items-center space-x-2 min-w-[840px]">
            <img alt="TixMeUp logo with hand gesture icon in white on blue background" class="w-8 h-8" height="32"
                src="{{ asset('img/logo.png') }}" width="32" />
            <span class="text-white font-semibold text-lg select-none">TixMeUp</span>
        </div>
        <div class="hidden sm:flex flex-1 max-w-[480px] mx-6 mr-10"> <!-- Increased right margin here -->
            <div class="relative w-full">
                <input
                    class="w-full rounded-full bg-[#00108b] placeholder-white text-white pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-white"
                    placeholder="Search by artist or event" type="text" />
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-white text-sm"></i>
            </div>
        </div>
        <div class="flex items-center space-x-3 min-w-[180px] justify-end">
            <button class="text-white text-xl sm:hidden">
                <i class="fas fa-bars"></i>
            </button>
            <button id="sidebarToggle" class="text-white text-xl hidden sm:block focus:outline-none">
                <i class="fas fa-chevron-down"></i>
            </button>
            <!-- Sidebar -->
            <div id="sidebar"
                class="fixed bg-[#00108b] top-0 right-0 h-full w-64 shadow-lg z-50 transform translate-x-full transition-transform duration-300">
                <div class="flex items-center justify-start px-4 py-3 border-b">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                        class="bi bi-person-circle text-white" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                     <div class="ml-4">
    <span class="font-semibold text-white text-lg">{{ Auth::user()->name }}</span>
    <br>
    <span class="text-white text-sm">{{ Auth::user()->email }}</span>
</div>
                    <button id="closeSidebar" class="text-white text-2xl focus:outline-none ml-auto">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <ul class="p-4 space-y-4 text-white ml-4">

                    <li><a href="{{ route('home.tampil') }}" class="hover:underline">Home</a></li>
                    <li><a href="{{ route('user.shoppingbasket') }}" class="hover:underline">Shopping Basket</a></li>
                    <li><a href="{{ route('riwayat.index') }}" class="hover:underline">Transaction History</a></li>

                    <li><a href="{{ route('user.review1') }}" class="hover:underline">Reviews &amp; Ratings</a></li>
                    <li><a href="{{ route('user.faq1') }}" class="hover:underline">FAQ</a></li>
                    <li>
                        <div class="flex items-center">

                            <button id="toggleAdminPromotor" class="ml-2 text-white focus:outline-none">
                            </button>
                        </div>

                    </li>
                   @auth
  <li>
    <a href="#" id="logoutButton" class="hover:underline">Logout</a>
    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </li>
@endauth

                </ul>
            </div>
        </div>

    </nav>
    <script>
  document.getElementById('logoutButton').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('logoutForm').submit();
  });
</script>

            <!--popup-->
            <div id="logoutConfirmation" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" style="z-index: 100;">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <h2 class="text-2xl font-bold mb-4">Are you sure you want to exit?</h2>
                    <div class="flex justify-center space-x-4">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">YES</button>
                        <button class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">NO</button>
                    </div>
                </div>
            </div>
            </div>
    <script>
        // JavaScript to toggle the visibility of Admin and Promotor options
        document.getElementById('toggleAdminPromotor').addEventListener('click', function() {
            const adminPromotorList = document.getElementById('adminPromotorList');
            adminPromotorList.classList.toggle('hidden'); // Toggle the 'hidden' class
        });

        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            const close = document.getElementById('closeSidebar');
            const logoutButton = document.getElementById('logoutButton');
            const logoutConfirmation = document.getElementById('logoutConfirmation');
            const yesButton = logoutConfirmation.querySelector('.bg-blue-500');
            const noButton = logoutConfirmation.querySelector('.bg-gray-400');

            toggle.addEventListener('click', () => {
                sidebar.classList.remove('translate-x-full');
            });

            close.addEventListener('click', () => {
                sidebar.classList.add('translate-x-full');
            });

            // Show logout confirmation popup
            logoutButton.addEventListener('click', (e) => {
                e.preventDefault(); // Prevent default action
                logoutConfirmation.classList.remove('hidden'); // Show popup
            });

            // Handle YES button click
            yesButton.addEventListener('click', () => {
                // Implement logout logic here
                // For example, redirect to logout URL
                window.location.href = '/logout'; // Change this to your logout URL
            });

            // Handle NO button click
            noButton.addEventListener('click', () => {
                logoutConfirmation.classList.add('hidden'); // Hide popup
            });

            // Optional: close sidebar when clicking outside
            document.addEventListener('click', function(e) {
                if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                    sidebar.classList.add('translate-x-full');
                }
            });
        });
    </script>
    </nav>
  <!-- Carousel -->
  <div class="relative border-b border-[#00108b]">
    <img alt="Black and white photo of four women posing with red BLACKPINK text overlay" class="w-full object-cover max-h-[250px]" height="250" src="{{ asset('img/Blackpink.png') }}" width="1200"/>
    <button aria-label="Previous slide" class="absolute top-1/2 left-2 -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-80 rounded-full p-2 text-2xl text-[#00108b]">
      <i class="fas fa-chevron-left"></i>
    </button>
    <button aria-label="Next slide" class="absolute top-1/2 right-2 -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-80 rounded-full p-2 text-2xl text-[#00108b]">
      <i class="fas fa-chevron-right"></i>
    </button>
  </div>

  <!-- Stats -->
<section class="max-w-6xl mx-auto mt-8 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
  <!-- Konser Aktif -->
  <div class="bg-white shadow-md rounded-xl py-6">
    <p class="text-base font-bold text-black tracking-widest uppercase">Konser Aktif</p>
    <h2 class="text-3xl font-bold text-black mt-2">{{ $jumlahKonserAktif }}</h2>
    <p class="mt-2 text-gray-500">Jumlah konser yang masih dijual tiketnya</p>
  </div>

  <!-- Tiket Terjual -->
  <div class="bg-white shadow-md rounded-xl py-6">
    <p class="text-base font-bold text-black tracking-widest uppercase">Tiket Terjual</p>
    <h2 class="text-3xl font-bold text-black mt-2">{{ number_format($tiketTerjual) }}</h2>
    <p class="mt-2 text-gray-500">Jumlah tiket terjual dari konser aktif</p>
  </div>

  <!-- Total Pendapatan -->
  <div class="bg-white shadow-md rounded-xl py-6">
    <p class="text-base font-bold text-black tracking-widest uppercase">Total Pendapatan</p>
    <h2 class="text-3xl font-bold text-black mt-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
    <p class="mt-2 text-gray-500">Total pemasukan dari tiket konser aktif</p>
  </div>
</section>



<section class="max-w-6xl mx-auto mt-12 bg-white ">


<!-- Grafik Penjualan Tiket per Hari -->
<!-- Grafik Penjualan Tiket per Hari -->
<section class="w-full mt-12 bg-white rounded-lg shadow-md">
  <!-- Header -->
  <div class="flex items-center bg-gray-200 px-6 py-3 rounded-t-lg relative">
    <div class="w-4 h-4 bg-gray-200 absolute -left-2 top-1/2 -translate-y-1/2 rotate-45"></div>
    <h2 class="text-lg font-bold text-black">Grafik Penjualan Tiket per Hari</h2>
  </div>

  <!-- Chart -->
  <div class="px-4 py-6 ml-24">
    <svg viewBox="0 0 1350 500" width="100%" height="500" class="block w-full">
      <!-- Axis box -->
      <rect x="80" y="40" width="1080" height="350" fill="#ffffff" stroke="#000" stroke-width="1" />

      <!-- Horizontal grid lines -->
      <g stroke="#ccc" stroke-width="1">
        @for ($y = 390; $y >= 40; $y -= 50)
          <line x1="80" x2="1160" y1="{{ $y }}" y2="{{ $y }}" />
        @endfor
      </g>

      <!-- Y-axis labels -->
      <g fill="black" font-size="16" text-anchor="end">
        @php $label = 0; @endphp
        @for ($y = 390; $y >= 40; $y -= 50)
          <text x="70" y="{{ $y }}" dy="4">{{ $label }}</text>
          @php $label += 50; @endphp
        @endfor
      </g>

      <!-- Y-axis title -->
      <text transform="rotate(-90)" x="-220" y="20" text-anchor="middle" font-size="18" font-weight="bold">
        Tiket Terjual
      </text>

      <!-- X-axis labels -->
      <g fill="black" font-size="14" text-anchor="middle">
        @foreach ($dataPoints as $point)
          <text x="{{ $point['x'] }}" y="435">{{ $point['tanggal'] }}</text>
        @endforeach
      </g>

      <!-- X-axis title -->
      <text x="650" y="470" text-anchor="middle" font-size="18" font-weight="bold">Tanggal</text>

      <!-- Data Line -->
      <polyline
        fill="none"
        stroke="blue"
        stroke-width="2"
        points="{{ implode(' ', collect($dataPoints)->map(fn($p) => "{$p['x']},{$p['y']}")->toArray()) }}"
      />

      <!-- Data points -->
      <g fill="blue">
        @foreach ($dataPoints as $point)
          <circle cx="{{ $point['x'] }}" cy="{{ $point['y'] }}" r="4">
            <title>{{ $point['tanggal'] }}: {{ $point['total'] }} tiket</title>
          </circle>
        @endforeach
      </g>
    </svg>
  </div>
</section>


<!-- Grafik Pendapatan per Event (Berjalan) -->
<section class="w-full mt-12 bg-white rounded-lg shadow-md">
  <!-- Header -->
  <div class="flex items-center bg-gray-200 px-6 py-3 rounded-t-lg relative">
    <div class="w-4 h-4 bg-gray-200 absolute -left-2 top-1/2 -translate-y-1/2 rotate-45"></div>
    <h2 class="text-lg font-bold text-black">Grafik Pendapatan per Event (Dalam Proses)</h2>
  </div>
<!-- Chart -->
<div class="px-4 py-6">
  <svg
  aria-label="Grafik Penjualan Tiket per Hari"
  viewBox="0 0 1350 480"
  width="100%"
  height="480"
  class="block w-full"
>

    <!-- Judul di atas border box -->
    <text x="700" y="25" text-anchor="middle" font-size="20" font-weight="bold">
      Grafik Pendapatan per Konser (Berjalan)
    </text>
    <!-- Y-axis title (rotated) -->
    <text transform="rotate(-90)" x="-200" y="90" text-anchor="middle" font-size="18" font-weight="bold">
      Artis
    </text>

    <!-- Border box -->
    <rect x="200" y="40" width="1000" height="330" fill="#ffffff" stroke="#000" stroke-width="1" />

    <!-- Horizontal bars + labels -->
    <g font-size="16" fill="black" dominant-baseline="middle">
      <text x="190" y="100" text-anchor="end">NIKI</text>
      <rect x="200" y="80" width="950" height="36" fill="#3b82f6" />
      <text x="1160" y="100">Rp 960,000,000</text>

      <text x="190" y="160" text-anchor="end">J-Hope</text>
      <rect x="200" y="140" width="850" height="36" fill="#3b82f6" />
      <text x="1060" y="160">Rp 850,000,000</text>

      <text x="190" y="220" text-anchor="end">Day6</text>
      <rect x="200" y="200" width="750" height="36" fill="#3b82f6" />
      <text x="960" y="220">Rp 750,000,000</text>

      <text x="190" y="280" text-anchor="end">Olivia</text>
      <rect x="200" y="260" width="550" height="36" fill="#3b82f6" />
      <text x="760" y="280">Rp 500,000,000</text>

      <text x="190" y="340" text-anchor="end">Eaj Park</text>
      <rect x="200" y="320" width="450" height="36" fill="#3b82f6" />
      <text x="660" y="340">Rp 410,000,000</text>

    </g>

    <!-- X-axis guide lines -->
    <g stroke="#ccc" stroke-width="1">
      <line x1="200" x2="200" y1="40" y2="380" />
      <line x1="400" x2="400" y1="40" y2="380" />
      <line x1="600" x2="600" y1="40" y2="380" />
      <line x1="800" x2="800" y1="40" y2="380" />
      <line x1="1000" x2="1000" y1="40" y2="380" />
    </g>

    <!-- X-axis labels -->
    <g font-size="14" fill="black" text-anchor="middle">
      <text x="200" y="400">0,0</text>
      <text x="400" y="400">0.2</text>
      <text x="600" y="400">0,4</text>
      <text x="800" y="400">0,6</text>
      <text x="1000" y="400">0,8</text>
      <text x="1200" y="400">1,0</text>
    </g>

    <!-- X-axis title -->
    <text x="700" y="450" text-anchor="middle" font-size="18" font-weight="bold">Pendapatan (Rp)</text>
  </svg>
</div>
</section>

<!-- Grafik Pendapatan per Event (Selesai) -->
<section class="w-full mt-12 bg-white rounded-lg shadow-md">
  <!-- Header -->
  <div class="flex items-center bg-gray-200 px-6 py-3 rounded-t-lg relative">
    <div class="w-4 h-4 bg-gray-200 absolute -left-2 top-1/2 -translate-y-1/2 rotate-45"></div>
    <h2 class="text-lg font-bold text-black">Grafik Pendapatan per Event (Selesai)</h2>
  </div>

<!-- Chart -->
<div class="px-4 py-6">
  <svg
    aria-label="Grafik Penjualan Tiket per Hari"
    viewBox="0 0 1350 900"
    width="100%"
    height="900"
    class="block w-full"
  >
    <!-- Judul di atas border box -->
    <text x="700" y="25" text-anchor="middle" font-size="20" font-weight="bold">
      Grafik Pendapatan per Konser (Sudah Terlaksana)
    </text>
    <!-- Y-axis title (rotated) -->
    <text transform="rotate(-90)" x="-300" y="90" text-anchor="middle" font-size="18" font-weight="bold">
      Artis
    </text>

    <!-- Border box -->
    <rect x="200" y="40" width="1000" height="600" fill="#ffffff" stroke="#000" stroke-width="1" />

    <!-- Horizontal bars + labels -->
    <g font-size="16" fill="black" dominant-baseline="middle">
      <text x="190" y="100" text-anchor="end">NIKI</text>
      <rect x="200" y="80" width="950" height="36" fill="#3b82f6" />
      <text x="1160" y="100">Rp 960,000,000</text>

      <text x="190" y="160" text-anchor="end">J-Hope</text>
      <rect x="200" y="140" width="850" height="36" fill="#3b82f6" />
      <text x="1060" y="160">Rp 850,000,000</text>

      <text x="190" y="220" text-anchor="end">Day6</text>
      <rect x="200" y="200" width="750" height="36" fill="#3b82f6" />
      <text x="960" y="220">Rp 750,000,000</text>

      <text x="190" y="280" text-anchor="end">Olivia</text>
      <rect x="200" y="260" width="550" height="36" fill="#3b82f6" />
      <text x="760" y="280">Rp 500,000,000</text>

      <text x="190" y="340" text-anchor="end">Eaj Park</text>
      <rect x="200" y="320" width="450" height="36" fill="#3b82f6" />
      <text x="660" y="340">Rp 410,000,000</text>

      <text x="190" y="400" text-anchor="end">Hindia</text>
      <rect x="200" y="380" width="300" height="36" fill="#3b82f6" />
      <text x="510" y="400">Rp 380,000,000</text>

      <text x="190" y="460" text-anchor="end">Bernadya</text>
      <rect x="200" y="440" width="250" height="36" fill="#3b82f6" />
      <text x="460" y="460">Rp 320,000,000</text>

      <text x="190" y="520" text-anchor="end">NDX</text>
      <rect x="200" y="500" width="220" height="36" fill="#3b82f6" />
      <text x="430" y="520">Rp 290,000,000</text>

      <text x="190" y="580" text-anchor="end">Lomba Sihir</text>
      <rect x="200" y="560" width="200" height="36" fill="#3b82f6" />
      <text x="410" y="580">Rp 270,000,000</text>

    </g>

    <!-- X-axis guide lines -->
    <g stroke="#ccc" stroke-width="1">
      <line x1="200" x2="200" y1="40" y2="650" />
      <line x1="400" x2="400" y1="40" y2="650" />
      <line x1="600" x2="600" y1="40" y2="650" />
      <line x1="800" x2="800" y1="40" y2="650" />
      <line x1="1000" x2="1000" y1="40" y2="650" />
    </g>

    <!-- X-axis labels -->
    <g font-size="14" fill="black" text-anchor="middle">
      <text x="200" y="680">0,0</text>
      <text x="400" y="680">0.2</text>
      <text x="600" y="680">0,4</text>
      <text x="800" y="680">0,6</text>
      <text x="1000" y="680">0,8</text>
      <text x="1200" y="680">1,0</text>
    </g>

    <!-- X-axis title -->
    <text x="700" y="750" text-anchor="middle" font-size="18" font-weight="bold">Pendapatan (Rp)</text>
  </svg>
</div>
</section>
<section class="w-full mt-12 bg-white rounded-lg shadow-md">
<div class="mt-32"></div>
    </section>
</section>
</body>

<!-- Footer -->
  <footer class="bg-[#0B1A8C] text-white px-6 py-8 select-none">
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-8 text-xs leading-relaxed">
      <!-- Navigasi Cepat -->
      <div>
        <p class="font-bold mb-2">Navigasi Cepat</p>
        <ul class="space-y-1">
          <li>Beranda</li>
          <li>Jadwal Konser</li>
          <li>Syarat &amp; ketentuan</li>
          <li>My Tickets</li>
          <li>FAQ</li>
        </ul>
      </div>
      <!-- Alamat -->
      <div>
        <p class="font-bold mb-2">Alamat</p>
        <p>
          TixMeUp Indonesia<br />
          Gedung Kreativitas Nusantara Lt. 2,<br />
          Jl. Kaliurang KM 9,3 No. 27A<br />
          RT 003 / RW 002,<br />
          Kelurahan Caturtunggal, Depok,<br />
          Kabupaten Sleman, Daerah Istimewa<br />
          Yogyakarta 55281, Indonesia
        </p>
      </div>
      <!-- Pembayaran -->
      <div>
        <p class="font-bold mb-2">Pembayaran</p>
        <p>Menerima Pembayaran</p>
        <div class="mt-2 grid grid-cols-3 gap-2 max-w-xs">
          <img
            alt="BCA bank logo blue and white"
            class="object-contain"
            height="30"
            src="{{ asset('img/footerBCA.jpg') }}"
            width="80"
          />
          <img
            alt="BRI bank logo blue and white"
            class="object-contain"
            height="30"
            src="{{ asset('img/footerBRI.jpg') }}"
            width="80"
          />
          <img
            alt="Mandiri bank logo blue and yellow"
            class="object-contain"
            height="30"
            src="{{ asset('img/footerMANDIRI.jpg') }}"
            width="80"
          />
          <img
            alt="BSI bank logo green and white"
            class="object-contain"
            height="30"
            src="{{ asset('img/footerBSI.jpg') }}"
            width="80"
          />
          <img
            alt="Gopay logo red and white"
            class="object-contain"
            height="30"
            src="{{ asset('img/footerCIMB.jpg') }}"
            width="80"
          />
          <img
            alt="BNI bank logo orange and white"
            class="object-contain"
            height="30"
            src="{{ asset('img/footerBNI.jpg') }}"
            width="80"
          />
        </div>
      </div>
    </div>
    <hr class="border-gray-600 my-6" />
    <div
      class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between text-xs space-y-3 sm:space-y-0"
    >
      <div class="flex items-center space-x-2 font-extrabold text-white">
        <img
          alt="TixMeUp logo hand sign in white on blue background"
          class="w-6 h-6"
          height="24"
          src="{{ asset('img/logo.png') }}"
          width="24"
        />
        <span>TixMeUp</span>
      </div>
      <div class="flex space-x-4 text-white">
        <a aria-label="Facebook" class="hover:text-gray-300" href="#">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a aria-label="Twitter" class="hover:text-gray-300" href="#">
          <i class="fab fa-twitter"></i>
        </a>
        <a aria-label="Instagram" class="hover:text-gray-300" href="#">
          <i class="fab fa-instagram"></i>
        </a>
        <a aria-label="YouTube" class="hover:text-gray-300" href="#">
          <i class="fab fa-youtube"></i>
        </a>
      </div>
      <div class="text-gray-300 text-center sm:text-right">
        © 2025 TixMeUp. Semua hak dilindungi undang-undang.
      </div>
    </div>
  </footer>
</html>
