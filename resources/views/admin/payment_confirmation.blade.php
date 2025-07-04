

<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   TixMeUp Notification
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Inter', sans-serif;
      .active {
    background-color: #B7C3D1; /* Change to your desired blue color */
    color: black; /* Change text color if needed */
}

    }
  </style>
 </head>
 <body class="bg-white">
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
                     <li><a href="{{ route('admin.payment.confirmation') }}" class="hover:underline">Payment Confirmation</a></li>
                    <li><a href="{{ route('riwayat.index') }}" class="hover:underline">Recap Of User Transaction</a></li>

                    <li><a href="{{ route('user.review1') }}" class="hover:underline">Review & Ratings</a></li>

                    <li><a href="{{ route('admin.livechat') }}" class="hover:underline">Live Chat</a></li>
                   <li><a href="{{ route('faq.manage') }}" class="hover:underline">FAQ</a></li>
                    <li>

                    </li>
                    <li><a href="#" id="logoutButton" class="hover:underline">Logout</a></li>
                </ul>
                        <div class="flex items-center">

                            <button id="toggleAdminPromotor" class="ml-2 text-white focus:outline-none">
                            </button>
                        </div>
                    </li>
                   @auth
@endauth

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
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebarToggle');
        const close = document.getElementById('closeSidebar');
        const logoutButton = document.getElementById('logoutButton');
        const logoutConfirmation = document.getElementById('logoutConfirmation');
        const logoutForm = document.getElementById('logoutForm');
        const yesButton = logoutConfirmation?.querySelector('.bg-blue-500');
        const noButton = logoutConfirmation?.querySelector('.bg-gray-400');

        // Sidebar toggle
        if (toggle && sidebar) {
            toggle.addEventListener('click', () => {
                sidebar.classList.remove('translate-x-full');
            });
        }

        if (close && sidebar) {
            close.addEventListener('click', () => {
                sidebar.classList.add('translate-x-full');
            });
        }

        // Show logout confirmation popup
        if (logoutButton && logoutConfirmation) {
            logoutButton.addEventListener('click', function (e) {
                e.preventDefault();
                logoutConfirmation.classList.remove('hidden');
            });
        }

        // YES = Submit logout form
        if (yesButton && logoutForm) {
            yesButton.addEventListener('click', function () {
                logoutForm.submit();
            });
        }

        // NO = Close popup
        if (noButton && logoutConfirmation) {
            noButton.addEventListener('click', function () {
                logoutConfirmation.classList.add('hidden');
            });
        }

        // Close sidebar if click outside
        document.addEventListener('click', function (e) {
            if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                sidebar.classList.add('translate-x-full');
            }
        });

        // Optional toggle admin/promotor (jika ada)
        const toggleAdminPromotor = document.getElementById('toggleAdminPromotor');
        const adminPromotorList = document.getElementById('adminPromotorList');
        if (toggleAdminPromotor && adminPromotorList) {
            toggleAdminPromotor.addEventListener('click', function () {
                adminPromotorList.classList.toggle('hidden');
            });
        }
    });
</script>

    </nav>

<section class="max-w-6xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Payment Confirmation</h2>

    @foreach ($orders as $order)
    <div class="border border-gray-300 rounded-lg p-4 mb-4 bg-white shadow-sm">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="font-semibold text-lg text-gray-800">{{ $order->ticket->event->name ?? 'Unknown Event' }}</h3>
                <p class="text-sm text-gray-600">User ID: {{ $order->user_id }}</p>
                <p class="text-sm text-gray-600">Total Harga: Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600">Status:
                    <span class="font-semibold {{ $order->status === 'accepted' ? 'text-green-600' : ($order->status === 'rejected' ? 'text-red-600' : 'text-yellow-600') }}">
                        {{ ucfirst($order->status ?? 'pending') }}
                    </span>
                </p>
            </div>

            @if ($order->status === null || $order->status === 'pending')
            <div class="flex gap-2">
                <form action="{{ route('admin.payment.accept', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Accept</button>
                </form>
                <form action="{{ route('admin.payment.reject', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Reject</button>
                </form>
            </div>
            @endif
        </div>
    </div>
    @endforeach
</section>

!-- Footer -->
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
