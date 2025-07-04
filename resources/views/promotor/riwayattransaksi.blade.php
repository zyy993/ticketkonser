<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   TixMeUp - Riwayat Transaksi Promotor/Admin
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Inter', sans-serif;
    }
  </style>
 </head>
 <body class="bg-white min-h-screen">
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
  <main class="px-4 sm:px-10 py-8">
   <div class="max-w-5xl mx-auto bg-white rounded-2xl border border-gray-200 shadow-md p-4 sm:p-8">
    <div class="overflow-x-auto rounded-2xl">
     <table class="w-full border-collapse rounded-2xl text-sm text-gray-700">
      <thead>
       <tr class="bg-gray-100 rounded-t-2xl">
        <th class="text-left font-semibold py-3 px-3 rounded-tl-2xl w-10">
         No
        </th>
        <th class="text-left font-semibold py-3 px-3 min-w-[110px]">
         Username
        </th>
        <th class="text-left font-semibold py-3 px-3 min-w-[130px]">
         Email
        </th>
        <th class="text-left font-semibold py-3 px-3 min-w-[110px]">
         Tgl. pem
        </th>
        <th class="text-left font-semibold py-3 px-3 min-w-[110px]">
         Jenis tiket
        </th>
        <th class="text-left font-semibold py-3 px-3 min-w-[70px]">
         Jumlah
        </th>
        <th class="text-left font-semibold py-3 px-3 min-w-[110px]">
         Total
        </th>
        <th class="text-left font-semibold py-3 px-3 rounded-tr-2xl min-w-[90px]">
         Status
        </th>
       </tr>
      </thead>
      <tbody>
       <tr class="border-t border-gray-200">
        <td class="py-3 px-3 font-semibold">
         1
        </td>
        <td class="py-3 px-3">
         Zera Aulia
        </td>
        <td class="py-3 px-3">
         zeraaulia
        </td>
        <td class="py-3 px-3">
         2023-06-01
        </td>
        <td class="py-3 px-3">
         VVIP
        </td>
        <td class="py-3 px-3">
         2
        </td>
        <td class="py-3 px-3">
         Rp5.000.000
        </td>
        <td class="py-3 px-3">
         <span class="inline-block bg-[#a6f4a6] text-[#0f7a0f] text-xs font-semibold px-3 py-1 rounded-md select-none">
          Success
         </span>
        </td>
       </tr>
       <tr class="border-t border-gray-200">
        <td class="py-3 px-3 font-semibold">
         2
        </td>
        <td class="py-3 px-3">
         Damar Putra
        </td>
        <td class="py-3 px-3">
         damarp
        </td>
        <td class="py-3 px-3">
         2023-06-01
        </td>
        <td class="py-3 px-3">
         Zone A
        </td>
        <td class="py-3 px-3">
         1
        </td>
        <td class="py-3 px-3">
         Rp2.000.000
        </td>
        <td class="py-3 px-3">
         <span class="inline-block bg-[#4a6edb] text-white text-xs font-semibold px-3 py-1 rounded-md select-none">
          In Process
         </span>
        </td>
       </tr>
       <tr class="border-t border-gray-200">
        <td class="py-3 px-3 font-semibold">
         3
        </td>
        <td class="py-3 px-3">
         Vina Lestari
        </td>
        <td class="py-3 px-3">
         vina_l
        </td>
        <td class="py-3 px-3">
         2023-06-02
        </td>
        <td class="py-3 px-3">
         Zone D
        </td>
        <td class="py-3 px-3">
         3
        </td>
        <td class="py-3 px-3">
         Rp3.000.000
        </td>
        <td class="py-3 px-3">
         <span class="inline-block bg-[#4a6edb] text-white text-xs font-semibold px-3 py-1 rounded-md select-none">
          In Process
         </span>
        </td>
       </tr>
       <tr class="border-t border-gray-200">
        <td class="py-3 px-3 font-semibold">
         4
        </td>
        <td class="py-3 px-3">
         Arsen Maul
        </td>
        <td class="py-3 px-3">
         arsenmln
        </td>
        <td class="py-3 px-3">
         2023-06-03
        </td>
        <td class="py-3 px-3">
         Zone A
        </td>
        <td class="py-3 px-3">
         2
        </td>
        <td class="py-3 px-3">
         Rp4.000.000
        </td>
        <td class="py-3 px-3">
         <span class="inline-block bg-[#4a6edb] text-white text-xs font-semibold px-3 py-1 rounded-md select-none">
          In Process
         </span>
        </td>
       </tr>
       <tr class="border-t border-gray-200">
        <td class="py-3 px-3 font-semibold">
         5
        </td>
        <td class="py-3 px-3">
         Dina Ayu
        </td>
        <td class="py-3 px-3">
         dinad
        </td>
        <td class="py-3 px-3">
         2023-06-03
        </td>
        <td class="py-3 px-3">
         Zone D
        </td>
        <td class="py-3 px-3">
         1
        </td>
        <td class="py-3 px-3">
         Rp1.000.000
        </td>
        <td class="py-3 px-3">
         <span class="inline-block bg-[#4a6edb] text-white text-xs font-semibold px-3 py-1 rounded-md select-none">
          In Process
         </span>
        </td>
       </tr>
       <tr class="border-t border-gray-200">
        <td class="py-3 px-3 font-semibold">
         6
        </td>
        <td class="py-3 px-3">
         Aji Nugroho
        </td>
        <td class="py-3 px-3">
         ajinugroho
        </td>
        <td class="py-3 px-3">
         2023-06-02
        </td>
        <td class="py-3 px-3">
         VVIP
        </td>
        <td class="py-3 px-3">
         1
        </td>
        <td class="py-3 px-3">
         Rp2.500.000
        </td>
        <td class="py-3 px-3">
         <span class="inline-block bg-[#fca5a5] text-[#7f1d1d] text-xs font-semibold px-3 py-1 rounded-md select-none">
          canceled
         </span>
        </td>
       </tr>
      </tbody>
     </table>
    </div>
    <div class="flex justify-end mt-6">
     <button class="bg-[#4a6edb] text-white text-sm font-semibold px-6 py-2 rounded-full hover:bg-[#3b57b0] transition-colors">
      Show in File
     </button>
    </div>
   </div>
    </body>
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

</html>
