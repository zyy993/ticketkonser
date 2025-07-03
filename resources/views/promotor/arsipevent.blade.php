<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Ticket Archive - TixMeUp
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Inter', sans-serif;
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
  <main class="max-w-3xl mx-auto px-4 sm:px-6 md:px-0 py-8">
   <h1 class="text-center font-bold text-xl sm:text-2xl mb-6 select-none">
    Ticket Archive
   </h1>
   <!-- Ticket 1 -->
   <section class="flex flex-col border border-gray-300 rounded-xl p-4 mb-6">
    <div class="flex items-center mb-3">
     <img alt="BLACKPINK BORN PINK album cover with black background and pink text" class="w-20 h-20 rounded-md flex-shrink-0" height="80" src="https://storage.googleapis.com/a1aa/image/cfcce71b-659a-451f-aab7-aa91e8a6b023.jpg" width="80"/>
     <div class="ml-4 flex-1">
      <h2 class="font-semibold text-sm sm:text-base leading-tight mb-0.5 select-text">
       BLACKPINK WORLD TOUR | BORNPINK
      </h2>
      <p class="text-xs sm:text-sm text-gray-600 select-text">
       11 Maret 2022 · GBK Jakarta
      </p>
     </div>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between text-xs sm:text-sm text-gray-700">
     <div class="flex flex-col">
      <p class="mb-1 select-text">
       Total Tiket Terjual : 131.000
      </p>
      <span class="inline-block bg-pink-200 text-pink-700 text-xs rounded-full px-3 py-1 select-text w-max">
       Sukses (98% tiket terjual)
      </span>
     </div>
     <div class="flex flex-col items-start sm:items-end mt-3 sm:mt-0">
      <p class="mb-2 select-text">
       Pendapatan : Rp 150M
      </p>
      <button class="bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-md px-5 py-2 select-none">
       Lihat Detail
      </button>
     </div>
    </div>
   </section>
   <!-- Ticket 2 -->
   <section class="flex flex-col border border-gray-300 rounded-xl p-4 mb-6">
    <div class="flex items-center mb-3">
     <img alt="EXO SC Back To Back album cover with two men in blue background" class="w-20 h-20 rounded-md flex-shrink-0" height="80" src="https://storage.googleapis.com/a1aa/image/fbf55454-ae63-401b-d15e-77d7ceafec64.jpg" width="80"/>
     <div class="ml-4 flex-1">
      <h2 class="font-semibold text-sm sm:text-base leading-tight mb-0.5 select-text">
       EXO SC | BACK TO BACK
      </h2>
      <p class="text-xs sm:text-sm text-gray-600 select-text">
       04 Februari 2023 · Ancol Beach City International Stadium, Jakarta
      </p>
     </div>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between text-xs sm:text-sm text-gray-700">
     <div class="flex flex-col">
      <p class="mb-1 select-text">
       Total Tiket Terjual : 15.000
      </p>
      <span class="inline-block bg-pink-200 text-pink-700 text-xs rounded-full px-3 py-1 select-text w-max">
       Sukses (87% tiket terjual)
      </span>
     </div>
     <div class="flex flex-col items-start sm:items-end mt-3 sm:mt-0">
      <p class="mb-2 select-text">
       Pendapatan : Rp 6M
      </p>
      <button class="bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-md px-5 py-2 select-none">
       Lihat Detail
      </button>
     </div>
    </div>
   </section>
   <!-- Ticket 3 -->
   <section class="flex flex-col border border-gray-300 rounded-xl p-4 mb-6">
    <div class="flex items-center mb-3">
     <img alt="IU H.E.R Tour album cover with close up of eye makeup in pink tones" class="w-20 h-20 rounded-md flex-shrink-0" height="80" src="https://storage.googleapis.com/a1aa/image/ed6d5b62-1cc6-42ae-f512-b4fb21a53c9a.jpg" width="80"/>
     <div class="ml-4 flex-1">
      <h2 class="font-semibold text-sm sm:text-base leading-tight mb-0.5 select-text">
       IU WORLD TOUR | H.E.R TOUR
      </h2>
      <p class="text-xs sm:text-sm text-gray-600 select-text">
       27-28 April 2024 · Indonesia Convention Exhibition BSD City, Jakarta
      </p>
     </div>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between text-xs sm:text-sm text-gray-700">
     <div class="flex flex-col">
      <p class="mb-1 select-text">
       Total Tiket Terjual : 12.000
      </p>
      <span class="inline-block bg-pink-200 text-pink-700 text-xs rounded-full px-3 py-1 select-text w-max">
       Sukses (80% tiket terjual)
      </span>
     </div>
     <div class="flex flex-col items-start sm:items-end mt-3 sm:mt-0">
      <p class="mb-2 select-text">
       Pendapatan : Rp 4,5M
      </p>
      <button class="bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-md px-5 py-2 select-none">
       Lihat Detail
      </button>
     </div>
    </div>
   </section>
   <!-- Ticket 4 -->
   <section class="flex flex-col border border-gray-300 rounded-xl p-4 mb-6">
    <div class="flex items-center mb-3">
     <img alt="Ariana Grande Honeymoon Tour album cover with black and white photo of Ariana Grande" class="w-20 h-20 rounded-md flex-shrink-0" height="80" src="https://storage.googleapis.com/a1aa/image/6697efc6-7efd-40fb-f456-9db6265c1d10.jpg" width="80"/>
     <div class="ml-4 flex-1">
      <h2 class="font-semibold text-sm sm:text-base leading-tight mb-0.5 select-text">
       ARIANA GRANDE | HONEYMOON TOUR
      </h2>
      <p class="text-xs sm:text-sm text-gray-600 select-text">
       26 Agustus 2015 di JIExpo Kemayoran
      </p>
     </div>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between text-xs sm:text-sm text-gray-700">
     <div class="flex flex-col">
      <p class="mb-1 select-text">
       Total Tiket Terjual : 9.000
      </p>
      <span class="inline-block bg-pink-200 text-pink-700 text-xs rounded-full px-3 py-1 select-text w-max">
       Sukses (85% tiket terjual)
      </span>
     </div>
     <div class="flex flex-col items-start sm:items-end mt-3 sm:mt-0">
      <p class="mb-2 select-text">
       Pendapatan : Rp 2,7M
      </p>
      <button class="bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-md px-5 py-2 select-none">
       Lihat Detail
      </button>
     </div>
    </div>
   </section>
   <!-- Ticket 5 -->
   <section class="flex flex-col border border-gray-300 rounded-xl p-4 mb-6">
    <div class="flex items-center mb-3">
     <img alt="G-Dragon Ubermensch Tour album cover with black and white photo of G-Dragon" class="w-20 h-20 rounded-md flex-shrink-0" height="80" src="https://storage.googleapis.com/a1aa/image/05fd6ba8-d196-40c7-7090-156f1d101f1d.jpg" width="80"/>
     <div class="ml-4 flex-1">
      <h2 class="font-semibold text-sm sm:text-base leading-tight mb-0.5 select-text">
       G-DRAGON - UBERMENSCH TOUR
      </h2>
      <p class="text-xs sm:text-sm text-gray-600 select-text">
       26 Juli 2025 · Indonesia Arena, Jakarta
      </p>
     </div>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between text-xs sm:text-sm text-gray-700">
     <div class="flex flex-col">
      <p class="mb-1 select-text">
       Total Tiket Terjual : 16.500
      </p>
      <span class="inline-block bg-pink-200 text-pink-700 text-xs rounded-full px-3 py-1 select-text w-max">
       Sukses (98% tiket terjual)
      </span>
     </div>
     <div class="flex flex-col items-start sm:items-end mt-3 sm:mt-0">
      <p class="mb-2 select-text">
       Pendapatan : Rp 4,2M
      </p>
      <button class="bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-md px-5 py-2 select-none">
       Lihat Detail
      </button>
     </div>
    </div>
   </section>
   <!-- Ticket 6 -->
   <section class="flex flex-col border border-gray-300 rounded-xl p-4 mb-6">
    <div class="flex items-center mb-3">
     <img alt="Seventeen Right Here Tour album cover with brown and gold stage photo" class="w-20 h-20 rounded-md flex-shrink-0" height="80" src="https://storage.googleapis.com/a1aa/image/0acf886c-a985-4f37-846f-b65fe5816674.jpg" width="80"/>
     <div class="ml-4 flex-1">
      <h2 class="font-semibold text-sm sm:text-base leading-tight mb-0.5 select-text">
       SEVENTEEN WORLD TOUR | RIGHT HERE
      </h2>
      <p class="text-xs sm:text-sm text-gray-600 select-text">
       8-9 Februari 2025 · Jakarta International Stadium (JIS), Jakarta
      </p>
     </div>
    </div>
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between text-xs sm:text-sm text-gray-700">
     <div class="flex flex-col">
      <p class="mb-1 select-text">
       Total Tiket Terjual : 50.000
      </p>
      <span class="inline-block bg-pink-200 text-pink-700 text-xs rounded-full px-3 py-1 select-text w-max">
       Sukses (95% tiket terjual)
      </span>
     </div>
     <div class="flex flex-col items-start sm:items-end mt-3 sm:mt-0">
      <p class="mb-2 select-text">
       Pendapatan : Rp 7,5M
      </p>
      <button class="bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-md px-5 py-2 select-none">
       Lihat Detail
      </button>
     </div>
    </div>
   </section>
  </main>
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
 </body>
</html>
