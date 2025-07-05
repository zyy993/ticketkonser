<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   TixMeUp FAQ
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
 <body class="bg-white text-black ">
<!-- Navbar -->
<nav class="bg-[#00108b] flex items-center justify-between px-6 py-3">
    <div class="flex items-center space-x-2 min-w-[840px]">
        <img alt="TixMeUp logo with hand gesture icon in white on blue background" class="w-8 h-8" src="{{ asset('img/logo.png') }}" />
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
        <div id="sidebar" class="fixed bg-[#00108b] top-0 right-0 h-full w-64 shadow-lg z-50 transform translate-x-full transition-transform duration-300">
            <div class="flex items-center justify-start px-4 py-3 border-b">
                 <a href="{{ route('user.editprofile') }}">
               <img
  src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('img/kosong.png') }}"
  alt="User avatar"
  class="w-10 h-10 rounded-full object-cover bg-white"
/>
                </a>
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
                    <li><a href="{{ route('riwayat.indext') }}" class="hover:underline">Transaction History</a></li>

                    <li><a href="{{ route('user.review1') }}" class="hover:underline">Reviews &amp; Ratings</a></li>
                    <li><a href="{{ route('user.faq1') }}" class="hover:underline">FAQ</a></li>
                    <li>
                    </li>
                    <li><a href="#" id="logoutButton" class="hover:underline">Logout</a></li>
                    <div class="flex items-center">
                        <button id="toggleAdminPromotor" class="ml-2 text-white focus:outline-none">
                            <!-- Optional Admin/Promotor Toggle -->
                        </button>
                    </div>
                </li>
            </ul>
        </div>

    </div>
    <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>

</nav>

<!-- Popup for Logout Confirmation -->
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
    document.getElementById('logoutForm').submit();
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
  <!-- Main content -->
<main class="max-w-4xl mx-auto px-4 sm:px-6 md:px-10 py-6  flex-grow">
    <h1 class="text-xl font-bold mb-6">Frequently Asked Questions</h1>

    <section id="faq-section" class="space-y-6">
        @foreach ($faqs as $index => $faq)
        <article class="border-b border-black pb-4">
           @php $faqId = 'faq-' . $index; @endphp

<div class="flex justify-between items-center cursor-pointer" onclick="toggleFaq('{{ $faqId }}')">
    <h2 class="font-semibold text-base leading-tight max-w-[90%]">{{ $faq->judul }}</h2>
    <span id="icon-{{ $faqId }}" class="text-gray-600 text-sm transition-all">▼</span>
</div>
<div id="content-{{ $faqId }}" class="hidden mt-2 text-sm">
    <p class="mb-1 leading-snug text-gray-800">{{ $faq->deskripsi }}</p>
    <p class="italic text-xs text-gray-700">{{ $faq->deskripsi_en }}</p>
</div>
        </article>
        @endforeach
    </section>
</main>
 </body>

<script>
    function toggleFaq(faqId) {
        const content = document.getElementById('content-' + faqId);
        const icon = document.getElementById('icon-' + faqId);

        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.textContent = '▲';
        } else {
            content.classList.add('hidden');
            icon.textContent = '▼';
        }
    }
</script>

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
