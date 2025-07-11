
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <style>
   body {
      font-family: 'Montserrat', sans-serif;
    }
  </style>
 </head>
<body class="flex flex-col min-h-screen bg-white text-gray-800 font-inter">
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
<main class="max-w-7xl mx-auto p-4 sm:p-6 md:p-10 overflow-x-hidden">
   <div class="flex flex-col lg:flex-row gap-6">
    <!-- Left side with image only -->
    <section class="flex-[1.8] rounded-xl overflow-hidden border border-gray-200 shadow-sm">
     <img src="{{ asset('img/deadline.jpg') }}"
     class="w-full object-cover aspect-[16/9]"
     alt="Gambar" />
    </section>

    <!-- Right side with event details -->
    <section class="flex-4 bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
      <h1 class="font-bold text-lg leading-tight mb-10 underline">
        BLACKPINK | DEADLINE
      </h1>
      <div class="space-y-5 text-gray-700 text-sm">
        <div class="font-bold flex items-center space-x-3">
          <i class="far fa-calendar-alt text-gray-400 w-5"></i>
          <span class="text-lg">November 11, 2025</span>
        </div>
        <div class="font-bold flex items-center space-x-3">
          <i class="fas fa-map-marker-alt text-gray-400 w-5"></i>
          <span class="text-lg">Gelora Bung Karno Stadium,
                   Jakarta</span>
        </div>
        <div class="font-bold flex items-center space-x-3">
          <i class="far fa-clock text-gray-400 w-5"></i>
          <span class="text-lg">Gates open at 5:00 PM | Show starts at 7:00 PM</span>
        </div>
        <hr class="my-9 border-t-2 border-gray-300" />
       <div class="mt-14 flex items-center space-x-4">
     <img height="90" src="{{ asset('img/ime id.png') }}" width="90"/>

        <div class="text-xl text-gray-500 mt-1">
          Diselenggarakan oleh
          <br />
          <span class="font-bold text-gray-700">iMe ID</span>
        </div>
       </div>
      </div>
    </section>
   </div>
<!-- SEAT PLAN & KATEGORI TIKET -->
<form class="flex flex-col w-full px-6 mt-12 gap-6 max-w-6xl mx-auto">

   <label class="block text-xl font-bold relative top-8 mb-4">
  Seat Plan dan Kategori Tiket
</label>
  <div class="flex flex-row gap-12">
    <!-- SEAT PLAN -->
    <div class="w-full flex flex-col gap-6">
  <img src="{{ asset('img/stage.png') }}" alt="Seat Plan" class="w-[700px] h-[450px] object-contain" />
</div>

    <!-- KATEGORI TIKET -->
    <section class="mt-6 space-y-4 max-w-full mx-auto lg:mx-0">
  <!-- Ticket item 1 -->
  <article
    class="border border-gray-300 rounded-xl flex overflow-hidden relative"
    style="width: 550px;"
  >
    <img
      alt="Taylor Swift wearing red outfit..."
      class="rounded-l-xl"
      src="{{ asset('img/deadline.jpg') }}"
      style="width: 100px; height: 100%; object-fit: cover;"
    />

    <div class="flex-1 p-2 flex flex-col justify-between">
      <div>
        <h2 class="font-semibold text-sm text-[#1A1A1A]">
          BLACKPINK | DEADLINE
        </h2>
        <ul class="text-xs text-[#4B4B4B] mt-1 space-y-1">
          <li class="flex items-center gap-1">
            <i class="fas fa-map-marker-alt text-[#4B4B4B] text-[10px]"></i>
            <span>Gelora Bung Karno Stadium, Jakarta</span>
          </li>
          <li class="flex items-center gap-1">
            <i class="fas fa-clock text-[#4B4B4B] text-[10px]"></i>
            <span>Gates open at 5:00 PM | Show starts at 7:00 PM</span>
          </li>
        </ul>
        <a
          class="text-xs text-[#1A2EBF] mt-1 inline-block hover:underline"
          href="#"
          >* Berakhir pada 27 Mei 2025</a
        >
      </div>
      <!-- Bagian bawah: jumlah tiket + tombol -->
      <div
        class="flex flex-col items-end gap-2"
        style="margin-top: 0px; justify-content: flex-start;"
      >
        <!-- Counter -->
        <div class="flex items-center gap-2">
          <button
            id="decrement"
            type="button"
            class="w-5 h-5 flex items-center justify-center border border-black rounded-full text-sm font-bold"
          >
            −
          </button>
          <span
            id="quantity"
            class="w-4 text-center text-sm font-semibold select-none"
            >1</span
          >
          <button
            id="increment"
            type="button"
            class="w-5 h-5 flex items-center justify-center border border-black rounded-full text-sm font-bold"
          >
            +
          </button>
        </div>
        <!-- Tombol Buy -->
        <button
          class="bg-[#1A2EBF] text-white text-xs font-semibold rounded px-3 py-1"
          type="button"
        >
          Buy Now
        </button>
      </div>
    </div>
    <div
      class="absolute top-0 right-0 bg-[#1A2EBF] text-white text-[10px] font-semibold px-2 py-0.5 rounded-bl-lg select-none"
    >
      VVIP
    </div>
  </article>

  <!-- Script untuk tombol -->
  <script>
    const quantityEl = document.getElementById("quantity");
    const quantityLabel = document.getElementById("quantityLabel");
    const decrementBtn = document.getElementById("decrement");
    const incrementBtn = document.getElementById("increment");

    let quantity = 1;

    decrementBtn.addEventListener("click", () => {
      if (quantity > 1) {
        quantity--;
        quantityEl.textContent = quantity;
        quantityLabel.textContent = quantity;
      }
    });

    incrementBtn.addEventListener("click", () => {
      quantity++;
      quantityEl.textContent = quantity;
      quantityLabel.textContent = quantity;
    });
  </script>
  <!-- Ticket item 2 -->
  <article
    class="border border-gray-300 rounded-xl flex overflow-hidden relative"
    style="width: 550px;"
  >
    <img
      alt="Taylor Swift ticket"
      class="rounded-l-xl"
src="{{ asset('img/deadline.jpg') }}"
      style="width: 100px; height: 100%; object-fit: cover;"
    />
    <div class="flex-1 p-3 flex flex-col justify-between">
      <div>
        <h2 class="font-semibold text-sm text-[#1A1A1A]">
          BLACKPINK | DEADLINE
        </h2>
        <ul class="text-xs text-[#4B4B4B] mt-1 space-y-1">
          <li class="flex items-center gap-1">
            <i class="fas fa-map-marker-alt text-[#4B4B4B] text-[10px]"></i>
            <span>Gelora Bung Karno Stadium, Jakarta</span>
          </li>
          <li class="flex items-center gap-1">
            <i class="fas fa-clock text-[#4B4B4B] text-[10px]"></i>
            <span>Gates open at 5:00 PM | Show starts at 7:00 PM</span>
          </li>
        </ul>
        <a
          class="text-xs text-[#1A2EBF] mt-1 inline-block hover:underline"
          href="#"
          >* Berakhir pada 27 Mei 2025</a
        >
      </div>
      <div
        class="flex flex-col items-end gap-2"
        style="margin-top: 0px; justify-content: flex-start;"
      >
        <div class="flex items-center gap-2">
          <button
            type="button"
            class="w-5 h-5 flex items-center justify-center border border-black rounded-full text-sm font-bold decrement"
          >
            −
          </button>
          <span class="quantity w-4 text-center text-sm font-semibold select-none"
            >1</span
          >
          <button
            type="button"
            class="w-5 h-5 flex items-center justify-center border border-black rounded-full text-sm font-bold increment"
          >
            +
          </button>
        </div>
        <button
          class="bg-[#1A2EBF] text-white text-xs font-semibold rounded px-3 py-1"
          type="button"
        >
          Buy Now
        </button>
      </div>
    </div>
    <div
      class="absolute top-0 right-0 bg-[#1A2EBF] text-white text-[10px] font-semibold px-2 py-0.5 rounded-bl-lg select-none"
    >
      ZONE B
    </div>

    <script>
      (() => {
        const article = document.currentScript.parentElement;
        const incrementBtn = article.querySelector(".increment");
        const decrementBtn = article.querySelector(".decrement");
        const quantitySpan = article.querySelector(".quantity");

        incrementBtn.addEventListener("click", () => {
          let currentQty = parseInt(quantitySpan.textContent);
          quantitySpan.textContent = currentQty + 1;
        });

        decrementBtn.addEventListener("click", () => {
          let currentQty = parseInt(quantitySpan.textContent);
          if (currentQty > 1) {
            quantitySpan.textContent = currentQty - 1;
          }
        });
      })();
    </script>
  </article>
  <!-- Ticket item 3 -->
  <article
    class="border border-gray-300 rounded-xl flex overflow-hidden relative"
    style="width: 550px;"
  >
    <img
      alt="Taylor Swift ticket 3"
      class="rounded-l-xl"
      src="{{ asset('img/deadline.jpg') }}"
      style="width: 100px; height: 100%; object-fit: cover;"
    />
    <div class="flex-1 p-3 flex flex-col justify-between">
      <div>
        <h2 class="font-semibold text-sm text-[#1A1A1A]">
          BLACKPINK | DEADLINE
        </h2>
        <ul class="text-xs text-[#4B4B4B] mt-1 space-y-1">
          <li class="flex items-center gap-1">
            <i class="fas fa-map-marker-alt text-[#4B4B4B] text-[10px]"></i>
            <span>Gelora Bung Karno Stadium, Jakarta</span>
          </li>
          <li class="flex items-center gap-1">
            <i class="fas fa-clock text-[#4B4B4B] text-[10px]"></i>
            <span>Gates open at 5:00 PM | Show starts at 7:00 PM</span>
          </li>
        </ul>
        <a
          class="text-xs text-[#1A2EBF] mt-1 inline-block hover:underline"
          href="#"
          >* Berakhir pada 27 Mei 2025</a
        >
      </div>
      <div
        class="flex flex-col items-end gap-2"
        style="margin-top: 0px; justify-content: flex-start;"
      >
        <div class="flex items-center gap-2">
          <button
            type="button"
            class="w-5 h-5 flex items-center justify-center border border-black rounded-full text-sm font-bold decrement"
          >
            −
          </button>
          <span class="quantity w-4 text-center text-sm font-semibold select-none"
            >1</span
          >
          <button
            type="button"
            class="w-5 h-5 flex items-center justify-center border border-black rounded-full text-sm font-bold increment"
          >
            +
          </button>
        </div>
        <button
          class="bg-[#1A2EBF] text-white text-xs font-semibold rounded px-3 py-1"
          type="button"
        >
          Buy Now
        </button>
      </div>
    </div>
    <div
      class="absolute top-0 right-0 bg-[#1A2EBF] text-white text-[10px] font-semibold px-2 py-0.5 rounded-bl-lg select-none"
    >
      ZONE D
    </div>

    <script>
      (() => {
        const article = document.currentScript.parentElement;
        const incrementBtn = article.querySelector(".increment");
        const decrementBtn = article.querySelector(".decrement");
        const quantitySpan = article.querySelector(".quantity");

        incrementBtn.addEventListener("click", () => {
          let currentQty = parseInt(quantitySpan.textContent);
          quantitySpan.textContent = currentQty + 1;
        });

        decrementBtn.addEventListener("click", () => {
          let currentQty = parseInt(quantitySpan.textContent);
          if (currentQty > 1) {
            quantitySpan.textContent = currentQty - 1;
          }
        });
      })();
    </script>
  </article>
</section>
  </div>
</form>
</form>
<div class="w-full max-w-6xl mx-auto">
  <label for="event-description" class="block text-xl font-extrabold text-gray-800 pl-4 relative top-2">
    Masukkan Deskripsi Event!
  </label>
</div>

<!-- Wrapper  -->
<div class="w-full px-2 py-10">
  <!-- Konten tab  -->
  <div id="content-deskripsi" class="w-full max-w-6xl border border-gray-300 rounded-lg p-6 shadow-sm text-gray-900">
    <h2 class="font-extrabold text-base mb-4 underline ">
      BLACKPINK | DEADLINE - Live in Jakarta
    </h2>

    <p class="mb-4 font-bold text-justify">
      Bersiaplah untuk malam penuh energi dan kemegahan bersama BLACKPINK dalam tur dunia paling ditunggu tahun ini – [The World Tour: Deadline] akhirnya hadir di Jakarta!
    </p>

    <p class="mb-4 text-justify">
      Setelah sukses mengguncang berbagai negara dengan penampilan memukau, BLACKPINK siap menghadirkan pertunjukan luar biasa yang akan membakar semangat para BLINK di tanah air. Konser ini bukan hanya tentang musik—ini adalah perayaan cinta, kekuatan, dan gaya khas BLACKPINK yang telah merebut hati jutaan penggemar di seluruh dunia.
      Jennie, Jisoo, Lisa, dan Rosé akan membawamu menjelajahi era kejayaan mereka, dari debut yang mendobrak dunia K-pop hingga lagu-lagu terbaru yang mendominasi chart global. Rasakan langsung dentuman beat dari DDU-DU DDU-DU, gemerlap Kill This Love, getaran emosional dari Stay, hingga kekuatan panggung luar biasa dari Pink Venom dan Shut Down.
    </p>

    <p class="mb-4 text-justify">
      Dibalut tata panggung spektakuler, efek visual futuristik, koreografi memikat, dan suasana yang membakar semangat, konser ini bukan hanya pertunjukan musik—ini adalah pengalaman global yang tak terlupakan bersama jutaan BLINK di seluruh dunia.
      Kenakan outfit BLACKPINK-mu yang paling ikonik, bawa lightstick kesayangan, dan bersiaplah menyatu dalam gelombang cinta dan energi luar biasa dari para member!
      Tandai kalendermu, karena Jakarta akan menjadi bagian dari sejarah tur dunia BLACKPINK – dan kamu adalah saksi hidupnya.
    </p>

    <h3 class="font-semibold text-base mt-8 mb-3">Syarat dan Ketentuan :</h3>

    <p class="mb-3">1. Tiket hanya tersedia melalui platform penjualan resmi yang telah ditentukan oleh promotor.</p>
    <p class="mb-3">2. Semua pembelian bersifat final. Tidak ada pengembalian dana (refund) atau penukaran tiket kecuali dalam kondisi konser dibatalkan oleh pihak penyelenggara.</p>
    <p class="mb-3">3. Harga tiket belum termasuk pajak dan biaya layanan.</p>
    <p class="mb-3">4. Tiket akan dikirim dalam format digital (e-ticket) melalui email atau aplikasi resmi.</p>
    <p class="mb-3">5. Penonton wajib menunjukkan e-ticket serta identitas resmi (KTP/Passport/SIM) yang sesuai dengan data pemesanan.</p>
    <p class="mb-3">6. Pintu masuk akan dibuka mulai pukul 16.00 WIB dan ditutup saat konser dimulai.</p>
    <p class="mb-3">7. Dilarang membawa senjata tajam, minuman keras, narkoba, kembang api, laser pointer, drone, dan benda berbahaya lainnya.</p>
    <p class="mb-3">8. Tidak diperbolehkan membawa makanan dan minuman dari luar ke dalam area konser.</p>
    <p class="mb-3">9. Dilarang melakukan tindakan yang mengganggu kenyamanan dan keamanan penonton lain.</p>
    <p class="mb-3">10. Penyelenggara berhak untuk mengubah jadwal, artis pendukung, atau susunan acara dengan pemberitahuan sebelumnya.</p>
  </div>
</div>

<div class="w-full max-w-6xl mx-auto mt-6 mb-12 flex justify-center">
  <button type="submit"
    class="w-full max-w-sm bg-[#5F7EA4] text-white font-semibold py-3 px-8 rounded-full hover:opacity-90">
    Return to the Home Page
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
