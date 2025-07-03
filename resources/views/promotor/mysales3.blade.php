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
  </style>
 </head>
 <body class="bg-white text-black">
   <!-- Navbar -->
    <nav class="bg-[#00108b] flex items-center justify-between px-6 py-3">
        <div class="flex items-center space-x-2 min-w-[840px]">
            <img alt="TixMeUp logo with hand gesture icon in white on blue background" class="w-8 h-8" height="32"
                src="{{ asset('img/logo.png') }}" width="32" />
            <span class="text-white font-semibold text-lg select-none">TixMeUp</span>
        </div>
        <div class="hidden sm:flex flex-1 max-w-[480px] mx-6 mr-10"> <!-- Increased right margin here -->
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
                        <span class="font-semibold text-white text-lg">USERNAME</span>
                        <br>
                        <span class="text-white text-sm">user@example.com</span>
                    </div>
                    <button id="closeSidebar" class="text-white text-2xl focus:outline-none ml-auto">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <ul class="p-4 space-y-4 text-white ml-4">
                    <li><a href="#" class="hover:underline">My Sales</a></li>
                    <li><a href="#" class="hover:underline">My Event archive</a></li>
                    <li><a href="#" class="hover:underline">Recap of user transactions</a></li>
                    <li><a href="#" class="hover:underline">Reviews &amp; Ratings</a></li>
                    <li><a href="#" class="hover:underline">FAQ</a></li>
                    <li><a href="#" class="hover:underline">Notification</a></li>
                    <li>
                        <div class="flex items-center">
                            <button id="toggleAdminPromotor" class="ml-2 text-white focus:outline-none"></button>
                        </div>
                    </li>
                    <li><a href="#" id="logoutButton" class="hover:underline">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
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
  <main class="max-w-4xl mx-auto p-4 space-y-8">
<!-- Card for Jumlah Penonton -->
<section class="rounded-lg p-6 ">
    <div class="relative">
        <h2 class="chart-title absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-full mb-2">
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
                <!-- Background box for Y-axis labels and bars with border -->
                <rect fill="#f9fafb" x="100" y="10" width="600" height="310" rx="5" stroke="#ccc" stroke-width="1" />

                <!-- Horizontal grid lines -->
                <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="320" y2="320" />
                <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="280" y2="280" />
                <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="240" y2="240" />
                <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="200" y2="200" />
                <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="160" y2="160" />
                <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="120" y2="120" />
                <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="80" y2="80" />
                <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="40" y2="40" />

                <!-- Y axis labels -->
                <text class="chart-text axis-label" dominant-baseline="middle" text-anchor="end" x="70" y="320">0</text>
                <text class="chart-text axis-label" dominant-baseline="middle" text-anchor="end" x="70" y="280">20,000</text>
                <text class="chart-text axis-label" dominant-baseline="middle" text-anchor="end" x="70" y="240">40,000</text>
                <text class="chart-text axis-label" dominant-baseline="middle" text-anchor="end" x="70" y="200">60,000</text>
                <text class="chart-text axis-label" dominant-baseline="middle" text-anchor="end" x="70" y="160">80,000</text>
                <text class="chart-text axis-label" dominant-baseline="middle" text-anchor="end" x="70" y="120">100,000</text>
                <text class="chart-text axis-label" dominant-baseline="middle" text-anchor="end" x="70" y="80">120,000</text>
                <text class="chart-text axis-label" dominant-baseline="middle" text-anchor="end" x="70" y="40">140,000</text>

                <!-- Y axis label vertical -->
                <text class="chart-text" dominant-baseline="middle" text-anchor="middle" transform="rotate(-90 15 130)" x="15" y="130" font-weight="bold ">Jumlah Penonton</text>

                <!-- Bars and labels with equal spacing -->
                <!-- BLACKPINK -->
                <rect fill="#ff69b4" height="280" width="50" x="110" y="40" />
                <text class="bar-value" x="135" y="35" font-weight="normal">140,000</text>
                <text class="bar-label" x="135" y="340" font-weight="normal">BLACKPINK</text>
                <!-- EXO-SC -->
                <rect fill="#2563eb" height="30" width="50" x="190" y="290" />
                <text class="bar-value" x="215" y="285" font-weight="normal">15,000</text>
                <text class="bar-label" x="215" y="340" font-weight="normal">EXO-SC</text>
                <!-- IU -->
                <rect fill="#7c3aed" height="24" width="50" x="270" y="296" />
                <text class="bar-value" x="295" y="292" font-weight="normal">12,000</text>
                <text class="bar-label" x="295" y="340" font-weight="normal">IU</text>
                <!-- Ariana Grande -->
                <rect fill="#f97316" height="18" width="50" x="350" y="302" />
                <text class="bar-value" x="375" y="298" font-weight="normal">9,000</text>
                <text class="bar-label" x="375" y="340" font-weight="normal">Ariana Grande</text>
                <!-- G-Dragon -->
                <rect fill="#22c55e" height="33" width="50" x="430" y="287" />
                <text class="bar-value" x="455" y="283" font-weight="normal">16,500</text>
                <text class="bar-label" x="455" y="340" font-weight="normal">G-Dragon</text>
                <!-- SEVENTEEN -->
                <rect fill="#facc15" height="100" width="50" x="510" y="220" />
                <text class="bar-value" x="535" y="215" font-weight="normal">50,000</text>
                <text class="bar-label" x="535" y="340" font-weight="normal">SEVENTEEN</text>
            </svg>
            <!-- X-axis label inside the card -->
            <text class="chart-title axis-label text-center block mt-2" dominant-baseline="middle" x="350" y="0">
                Event Konser
            </text>
    </div>
</section>
 <hr class="border-t border-black mb-4" />

   <!-- Card for Analisis -->
   <section class="border border-black rounded-lg p-6 shadow-sm">
    <h3 class="font-bold text-sm mb-2 text-center" style="color:#f97316;">
    Penjualan Tiket per Minggu - ARIANA GRANDE
    </h3>
    <svg
     aria-label="Line chart showing ticket sales per week for exo"
     class="block mx-auto mb-6"
     height="260"
     role="img"
     viewBox="0 0 700 260"
     width="100%"
     style="max-width: 700px"
    >
    <!-- Background box for Y-axis labels and bars with border -->
                <rect fill="#f9fafb" x="100" y="10" width="600" height="210" rx="5" stroke="#ccc" stroke-width="1" />
     <!-- Horizontal grid lines -->
     <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="220" y2="220" />
     <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="180" y2="180" />
     <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="140" y2="140" />
     <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="100" y2="100" />
     <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="60" y2="60" />
     <line stroke="#ccc" stroke-width="1" x1="100" x2="650" y1="20" y2="20" />
     <!-- Y axis labels -->
     <text
      class="chart-text axis-label"
      dominant-baseline="middle"
      text-anchor="end"
      x="70"
      y="220"
     >
      0
     </text>
     <text
      class="chart-text axis-label"
      dominant-baseline="middle"
      text-anchor="end"
      x="70"
      y="180"
     >
      1000
     </text>
     <text
      class="chart-text axis-label"
      dominant-baseline="middle"
      text-anchor="end"
      x="70"
      y="140"
     >
      2000
     </text>
     <text
      class="chart-text axis-label"
      dominant-baseline="middle"
      text-anchor="end"
      x="70"
      y="100"
     >
      3000
     </text>
     <text
      class="chart-text axis-label"
      dominant-baseline="middle"
      text-anchor="end"
      x="70"
      y="60"
     >
      4000
     </text>
     <text
      class="chart-text axis-label"
      dominant-baseline="middle"
      text-anchor="end"
      x="70"
      y="20"
     >
      5000
     </text>
     <!-- Y axis label vertical -->
     <text class="chart-text" dominant-baseline="middle" font-weight="600" text-anchor="middle" transform="rotate(-90 15 130)" x="15" y="130">
      Jumlah Tiket Terjual
     </text>
     <!-- X axis labels with equal spacing -->
     <text
      class="chart-text axis-label"
      dominant-baseline="middle"
      text-anchor="middle"
      x="140"
      y="240"
     >
      Minggu 1
     </text>
     <text
      class="chart-text axis-label"
      dominant-baseline="middle"
      text-anchor="middle"
      x="280"
      y="240"
     >
      Minggu 2
     </text>
     <text
      class="chart-text axis-label"
      dominant-baseline="middle"
      text-anchor="middle"
      x="420"
      y="240"
     >
      Minggu 3
     </text>
     <text
      class="chart-text axis-label"
      dominant-baseline="middle"
      text-anchor="middle"
      x="560"
      y="240"
     >
      Minggu 4
     </text>
     <!-- Line with updated points for values 50000, 40000, 30000, 20000 -->
            <polyline
            fill="none"
            points="140,120 280,140 420,140 560,120"
            stroke="#f97316"
            stroke-width="2"
        />
        <!-- Points -->
        <circle cx="140" cy="120" fill="#f97316" r="4" />
        <circle cx="280" cy="140" fill="#f97316" r="4" />
        <circle cx="420" cy="140" fill="#f97316" r="4" />
        <circle cx="560" cy="120" fill="#f97316" r="4" />
    </svg>
    <!-- X-axis label inside the card -->
            <text class="chart-title axis-label text-center block mt-2" dominant-baseline="middle" x="350" y="0">
                Minggu
            </text>
   <hr class="border-t border-black mb-6" />
   <br>
<div class="text-sm">
    <p class="font-bold mb-1">Ticket</p>
    <p>Total Tiket Terjual: 9,000 tiket</p>
    <p>Total Nilai Penjualan: Rp 4,050,000,000 (rata-rata harga tiket Rp 450,000)</p>
    <p>Persentase Tiket Terjual: 85%</p>
    <p>Tingkat Penjualan: Baik</p>
</div>
<br>
<hr class="border-t border-black mb-6" />
<div class="text-sm">
    <p class="font-bold mb-1">Penjualan</p>
    <p>VIP: 1,500 tiket (Rp 900,000,000)</p>
    <p>Regular: 5,000 tiket (Rp 1,875,000,000)</p>
    <p>Standing: 2,500 tiket (Rp 1,275,000,000)</p>
    <br>
    <p>Online: 4,000 tiket (Rp 1,800,000,000)</p>
    <p>Outlet: 5,000 tiket (Rp 2,250,000,000)</p>
    <br>
    <p>Presale: 2,000 tiket (Rp 900,000,000)</p>
    <p>General Sale: 7,000 tiket (Rp 3,150,000,000)</p>
</div>
<br>
<hr class="border-t border-black mb-6" />
<div class="text-sm">
    <p class="font-bold mb-1">Analisis Tambahan</p>
    <p>-Penjualan outlet lebih tinggi dibanding online.</p>
    <p>-Wilayah terbanyak: Jakarta, Bali.</p>
    <p>-Jenis tiket terlaris: Regular.</p>
    <p>-Catatan: Kendala server pada masa presale.</p>
    <p>-Penjualan tiket Ariana Grande cukup sukses.</p>
    <p>-Rekomendasi: Upgrade infrastruktur server dan tingkatkan promosi online.</p>
</div>
<br>

   </section>
  </main>
 </body>
</html>
