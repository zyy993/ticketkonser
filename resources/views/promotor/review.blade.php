<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   TixMeUp Review &amp; Rating
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   /* Custom star color for rating */
    .star-yellow {
      color: #fbbf24;
    }
  </style>
 </head>
 <body class="bg-white font-sans text-gray-900">
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
  <main class="max-w-5xl mx-auto p-4 sm:p-6 md:p-8">
   <!-- Review & Rating Header -->
   <section>
    <h2 class="font-semibold text-base mb-4 select-none">
     Review &amp; Rating
    </h2>
    <div class="border border-gray-300 rounded-md flex flex-col md:flex-row md:space-x-6 p-4 mb-8" style="min-height: 120px">
     <!-- Review count -->
     <div class="flex-1 border-r border-gray-300 pr-6 mb-4 md:mb-0">
      <p class="font-semibold text-sm mb-1 select-none">
       Review count
      </p>
      <p class="font-extrabold text-3xl leading-none select-text">
       9.926
      </p>
      <p class="text-xs text-gray-500 mt-1 select-none">
       Total review from 9.926 people from this 9th of 2nd of year
      </p>
     </div>
     <!-- Average rating -->
     <div class="flex-1 border-r border-gray-300 pr-6 mb-4 md:mb-0">
      <p class="font-semibold text-sm mb-1 select-none">
       Average rating
      </p>
      <div class="flex items-center space-x-2">
       <p class="font-extrabold text-3xl leading-none select-text">
        4,4
       </p>
       <div class="flex space-x-0.5">
        <i class="fas fa-star star-yellow">
        </i>
        <i class="fas fa-star star-yellow">
        </i>
        <i class="fas fa-star star-yellow">
        </i>
        <i class="fas fa-star star-yellow">
        </i>
        <i class="fas fa-star-half-alt star-yellow">
        </i>
       </div>
      </div>
      <p class="text-xs text-gray-500 mt-1 select-none">
       Based on 9.926 reviews
      </p>
     </div>
     <!-- Rating distribution -->
     <div class="flex-1">
      <div class="flex items-center space-x-2 text-xs text-gray-600 mb-1 select-none">
       <span class="w-10 flex items-center justify-end space-x-1 text-right">
        <i class="fas fa-star star-yellow text-[10px]"></i>
        <span>5</span>
       </span>
       <div class="h-3 rounded-full bg-purple-600" style="width: 58%">
       </div>
       <span class="w-12 text-right">
        58,0%
       </span>
      </div>
      <div class="flex items-center space-x-2 text-xs text-gray-600 mb-1 select-none">
       <span class="w-10 flex items-center justify-end space-x-1 text-right">
        <i class="fas fa-star star-yellow text-[10px]"></i>
        <span>4</span>
       </span>
       <div class="h-3 rounded-full bg-purple-400" style="width: 31.7%">
       </div>
       <span class="w-12 text-right">
        31,7%
       </span>
      </div>
      <div class="flex items-center space-x-2 text-xs text-gray-600 mb-1 select-none">
       <span class="w-10 flex items-center justify-end space-x-1 text-right">
        <i class="fas fa-star star-yellow text-[10px]"></i>
        <span>3</span>
       </span>
       <div class="h-3 rounded-full bg-purple-300" style="width: 10.3%">
       </div>
       <span class="w-12 text-right">
        10,3%
       </span>
      </div>
      <div class="flex items-center space-x-2 text-xs text-gray-600 mb-1 select-none">
       <span class="w-10 flex items-center justify-end space-x-1 text-right">
        <i class="fas fa-star star-yellow text-[10px]"></i>
        <span>2</span>
       </span>
       <div class="h-3 rounded-full bg-purple-200" style="width: 1.3%">
       </div>
       <span class="w-12 text-right">
        1,3%
       </span>
      </div>
      <div class="flex items-center space-x-2 text-xs text-gray-600 select-none">
       <span class="w-10 flex items-center justify-end space-x-1 text-right">
        <i class="fas fa-star star-yellow text-[10px]"></i>
        <span>1</span>
       </span>
       <div class="h-3 rounded-full bg-purple-100" style="width: 0.1%">
       </div>
       <span class="w-12 text-right">
        0,1%
       </span>
      </div>
     </div>
    </div>
   </section>
   <!-- Reviews list -->
   <section class="space-y-6">
    <!-- Review 1 -->
    <article class="flex space-x-4">
     <div class="flex-shrink-0 flex flex-col items-center leading-none select-none">
      <div class="text-yellow-400 text-lg">
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
      </div>
      <span class="mt-1 text-xs font-semibold text-black select-text">
       AurelKim
      </span>
      <time class="text-xs text-gray-500 mt-0.5 select-none">
       13 Maret 2023
      </time>
     </div>
     <div class="flex-1">
      <p class="text-sm mt-1 text-gray-900 select-text font-semibold">
       Konser Impian Seumur Hidup
      </p>
      <p class="text-xs text-gray-600 mt-1 select-text">
       Ini pertama kalinya aku nonton JKT48 langsung dan aku sangat puas karena
            aku lihat JKT48nya sangat energik. Aku juga suka lagu-lagunya. Terima kasih
            sudah membuat konser ini.
      </p>
      <div class="flex space-x-4 mt-3">
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-up">
        </i>
        <span>
         1
        </span>
       </button>
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-down">
        </i>
        <span>
         0
        </span>
       </button>
      </div>
     </div>
    </article>
    <!-- Review 2 -->
    <article class="flex space-x-4">
     <div class="flex-shrink-0 flex flex-col items-center leading-none select-none">
      <div class="text-yellow-400 text-lg">
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="far fa-star text-gray-300">
       </i>
      </div>
      <span class="mt-1 text-xs font-semibold text-black select-text">
       blinkzone88
      </span>
      <time class="text-xs text-gray-500 mt-0.5 select-none">
       13 Maret 2023
      </time>
     </div>
     <div class="flex-1">
      <p class="text-sm mt-1 text-gray-900 select-text font-semibold">
       Seru tapi ada kendala teknis
      </p>
      <p class="text-xs text-gray-600 mt-1 select-text">
       Overall sangat seru dan seru banget tapi agak kurang pas. Ada kendala teknis
            yang bikin agak terganggu sedikit. Selain itu, sistem masuknya juga kurang
            lancar, tapi yang penting tiketnya dan acara oke dan seru deh. Totalnya
            puas banget dan bakal nonton lagi kalau ada acara JKT48 lagi. Sukses terus
            buat acara TixMeUp.
      </p>
      <div class="flex space-x-4 mt-3">
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-up">
        </i>
        <span>
         0
        </span>
       </button>
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-down">
        </i>
        <span>
         1
        </span>
       </button>
      </div>
     </div>
    </article>
    <!-- Review 3 -->
    <article class="flex space-x-4">
     <div class="flex-shrink-0 flex flex-col items-center leading-none select-none">
      <div class="text-yellow-400 text-lg">
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="far fa-star text-gray-300">
       </i>
       <i class="far fa-star text-gray-300">
       </i>
      </div>
      <span class="mt-1 text-xs font-semibold text-black select-text">
       jisoostan_21
      </span>
      <time class="text-xs text-gray-500 mt-0.5 select-none">
       5 Maret 2023
      </time>
     </div>
     <div class="flex-1">
      <p class="text-sm mt-1 text-gray-900 select-text font-semibold">
       Crowd Management Harus Dievaluasi
      </p>
      <p class="text-xs text-gray-600 mt-1 select-text">
       Aku agak kesal karena acara pembukaan agak terlambat dan susah ke lokasi.
            Tapi yang paling aku sesalkan adalah crowd management. Antrian masuk
            berantakan dan agak kurang terkoordinasi. Aku berharap panitia bisa lebih
            disiplin dan tertib supaya acara bisa lebih lancar. Semoga ke depannya
            lebih baik lagi.
      </p>
      <div class="flex space-x-4 mt-3">
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-up">
        </i>
        <span>
         0
        </span>
       </button>
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-down">
        </i>
        <span>
         0
        </span>
       </button>
      </div>
     </div>
    </article>
    <!-- Review 4 -->
    <article class="flex space-x-4">
     <div class="flex-shrink-0 flex flex-col items-center leading-none select-none">
      <div class="text-yellow-400 text-lg">
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
      </div>
      <span class="mt-1 text-xs font-semibold text-black select-text">
       hanablink
      </span>
      <time class="text-xs text-gray-500 mt-0.5 select-none">
       12 Maret 2023
      </time>
     </div>
     <div class="flex-1">
      <p class="text-sm mt-1 text-gray-900 select-text font-semibold">
       Worth Every Second!
      </p>
      <p class="text-xs text-gray-600 mt-1 select-text">
       Konsernya sangat seru banget dan banyak lagu yang dinyanyikan. Aku sangat
            puas dengan acara ini. Meskipun agak sedikit ada gangguan saat masuk tapi
            overall sangat happy. Aku suka banget konser ini dan pengen nonton lagi
            terus - terussaya pasti nonton lagi kalau ada konser JKT48 lagi. Terima
            kasih TixMeUp, pokoknya sukses terus yaa &lt;3
      </p>
      <div class="flex space-x-4 mt-3">
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-up">
        </i>
        <span>
         1
        </span>
       </button>
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-down">
        </i>
        <span>
         0
        </span>
       </button>
      </div>
     </div>
    </article>
    <!-- Review 5 -->
    <article class="flex space-x-4">
     <div class="flex-shrink-0 flex flex-col items-center leading-none select-none">
      <div class="text-yellow-400 text-lg">
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
      </div>
      <span class="mt-1 text-xs font-semibold text-black select-text">
       bp4ever
      </span>
      <time class="text-xs text-gray-500 mt-0.5 select-none">
       15 Maret 2023
      </time>
     </div>
     <div class="flex-1">
      <p class="text-sm mt-1 text-gray-900 select-text font-semibold">
       BLACKPINK Slay All Night
      </p>
      <p class="text-xs text-gray-600 mt-1 select-text">
       Aku suka banget dengan acara BLACKPINK yang keren banget konsepnya dan
            penampilannya luar biasa. Aku juga suka lagu-lagunya yang enak didengar.
            Aku berharap acara seperti ini bisa terus ada dan makin keren lagi. Terima
            kasih TixMeUp atas pengalaman yang luar biasa ini.
      </p>
      <div class="flex space-x-4 mt-3">
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-up">
        </i>
        <span>
         1
        </span>
       </button>
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-down">
        </i>
        <span>
         0
        </span>
       </button>
      </div>
     </div>
    </article>
    <!-- Review 6 -->
    <article class="flex space-x-4">
     <div class="flex-shrink-0 flex flex-col items-center leading-none select-none">
      <div class="text-yellow-400 text-lg">
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
      </div>
      <span class="mt-1 text-xs font-semibold text-black select-text">
       ryuzakura
      </span>
      <time class="text-xs text-gray-500 mt-0.5 select-none">
       17 Maret 2023
      </time>
     </div>
     <div class="flex-1">
      <p class="text-sm mt-1 text-gray-900 select-text font-semibold">
       Magical Night with BLACKPINK
      </p>
      <p class="text-xs text-gray-600 mt-1 select-text">
       Dua kata buat acara ini: magical night! Aku terpesona pada tata cahaya dan
            desain panggungnya. Semua anggota tampil dengan sangat memukau dan lagu-lagu
            mereka sangat enak didengar. Aku sangat ingin datang lagi ke acara seperti
            ini. Terima kasih TixMeUp sudah membuat malamku sangat spesial.
      </p>
      <div class="flex space-x-4 mt-3">
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-up">
        </i>
        <span>
         1
        </span>
       </button>
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-down">
        </i>
        <span>
         0
        </span>
       </button>
      </div>
     </div>
    </article>
    <!-- Review 7 -->
    <article class="flex space-x-4">
     <div class="flex-shrink-0 flex flex-col items-center leading-none select-none">
      <div class="text-yellow-400 text-lg">
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
       <i class="fas fa-star">
       </i>
      </div>
      <span class="mt-1 text-xs font-semibold text-black select-text">
       icha_luvrosé
      </span>
      <time class="text-xs text-gray-500 mt-0.5 select-none">
       18 Maret 2023
      </time>
     </div>
     <div class="flex-1">
      <p class="text-sm mt-1 text-gray-900 select-text font-semibold">
       Sempurna Tapi Masih Bisa Lebih Baik
      </p>
      <p class="text-xs text-gray-600 mt-1 select-text">
       Aku sangat bangga menjadi bagian dari BLACKPINK. Lagu-lagu mereka penuh
            energi dan penampilan mereka sangat luar biasa. Namun, pengalaman masuk
            ke venue agak kurang nyaman. Aku berharap panitia bisa memperbaiki hal ini
            supaya pengalaman menonton bisa lebih baik lagi. Tapi secara keseluruhan,
            aku sangat puas dan akan terus support mereka! Wajib nonton lagi!
      </p>
      <div class="flex space-x-4 mt-3">
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-up">
        </i>
        <span>
         1
        </span>
       </button>
       <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-down">
        </i>
        <span>
         0
        </span>
       </button>
      </div>
     </div>
    </article>
   </section>
   <!-- More complete button -->
   <div class="flex justify-end mt-8">
    <button class="flex items-center space-x-2 text-xs text-black border border-black rounded px-4 py-2 select-none" type="button">
     <span>
      More complete
     </span>
     <i class="fas fa-chevron-right">
     </i>
    </button>
   </div>
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
