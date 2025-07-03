<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Shopping basket
  </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   /* Custom font weight for bold text */
   .font-extrabold {
     font-weight: 800;
   }
   .font-semibold-custom {
     font-weight: 600;
   }
   .font-semibold-custom-strong {
     font-weight: 700;
   }
   /* Uniform date font size */
   .date-text {
     font-size: 0.75rem; /* 12px */
     line-height: 1rem; /* 16px */
   }
  </style>
 </head>
 <body class="bg-white font-sans">
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
  <div class="max-w-5xl mx-auto p-4">
  <h1 class="font-extrabold text-lg sm:text-xl md:text-2xl text-center mb-6">
    Shopping basket
</h1>
   <!-- Payment in progress -->

<section class="mb-8 relative">
  <h2 class="font-bold text-lg mb-2">Payment in progress</h2>

  @forelse ($orders as $order)
  <div class="relative flex flex-col sm:flex-row bg-blue-50 border border-blue-200 rounded-md p-3 sm:p-4 mb-4">
    <div class="absolute top-3 right-3 text-gray-500 select-none font-semibold-custom-strong date-text">
      {{ \Carbon\Carbon::parse($order->created_at)->format('Y.m.d') }}

      <span class="text-xs font-bold {{ $order->status === 'accepted' ? 'text-green-600' : ($order->status === 'rejected' ? 'text-red-600' : 'text-yellow-600') }}">
  {{ ucfirst($order->status) }}
</span>
    </div>

    <div class="flex-shrink-0 mb-3 sm:mb-0 sm:mr-4">
      <img
        alt="{{ $order->ticket->event->name ?? 'Event' }}"
        class="rounded"
        height="90"
        width="120"
        src="{{ $order->ticket->event->image_path ? asset('storage/' . $order->ticket->event->image_path) : 'https://via.placeholder.com/120x90.png?text=No+Image' }}"
      />
    </div>

    <div class="flex-1 flex flex-col justify-between">
      <div>
        <h3 class="font-extrabold text-sm sm:text-base leading-tight max-w-[60%]">
          {{ $order->ticket->event->name ?? 'Event Name' }}
        </h3>

        <table class="w-[400px] max-w-full text-xs text-gray-600 mt-1 table-fixed border-collapse">
          <tbody>
            <tr class="border-b border-gray-300">
              <td class="w-1/3 py-0.5 font-semibold-custom">List Price</td>
              <td class="w-2/3 text-right py-0.5 font-semibold-custom">
                Rp{{ number_format($order->harga_tiket, 0, ',', '.') }}
              </td>
            </tr>
            <tr class="border-b border-gray-300">
              <td class="py-0.5 font-semibold-custom">Tax (15%)</td>
              <td class="text-right py-0.5 font-semibold-custom">
                Rp{{ number_format($order->harga_tiket * 0.15, 0, ',', '.') }}
              </td>
            </tr>
            <tr class="border-b border-gray-300">
              <td class="py-0.5 font-semibold-custom">Total</td>
              <td class="text-right py-0.5 font-semibold-custom">
                Rp{{ number_format($order->total_harga + ($order->harga_tiket * 0.15), 0, ',', '.') }}
              </td>
            </tr>
          </tbody>
        </table>

        <p class="text-[9px] font-semibold-custom mt-1">
          Payment Code : <span class="font-normal">{{ str_pad($order->id, 11, '0', STR_PAD_LEFT) }}</span>
        </p>
        <p class="text-[9px] text-blue-600 mt-0.5 font-semibold-custom">
          *Berakhir pada {{ \Carbon\Carbon::parse($order->created_at)->addDays(3)->translatedFormat('d F Y') }}
        </p>
      </div>

      <div class="flex flex-col items-end mt-2 space-y-1">
  @if ($order->status === 'accepted')
    <a href="{{ route('ticket.download', ['order_id' => $order->id]) }}">
      <button class="bg-green-600 hover:bg-green-700 text-white text-xs px-4 py-1 rounded font-semibold">
        🎟 Download Ticket
      </button>
    </a>
  @elseif ($order->status === 'rejected')
    <p class="text-[9px] italic text-red-500 font-semibold-custom">
      Your order has been rejected.
    </p>
  @else
    <p class="text-[9px] italic text-gray-600 font-semibold-custom">
      Please make the payment before 59.00
    </p>
  @endif
</div>

    </div>
  </div>
  @empty
    <p class="text-sm text-gray-500">You have no pending orders.</p>
  @endforelse
</section>


    <div class="relative flex flex-col sm:flex-row bg-blue-50 border border-blue-200 rounded-md p-3 sm:p-4 mb-4 max-w-full">
     <div class="absolute top-3 right-3 flex flex-col items-end space-y-1 select-none z-20">

      <span class="text-[9px] bg-green-500 text-white rounded px-2 py-[2px] font-semibold">
       Active
      </span>
     </div>
     <div class="flex-shrink-0 mb-3 sm:mb-0 sm:mr-4 z-20">
      <img alt="BLACKPINK black and white portrait with sunglasses" class="rounded" height="90" src="https://storage.googleapis.com/a1aa/image/3138d905-a62b-4463-378c-49f49e6f57d8.jpg" width="120"/>
     </div>
     <div class="flex-1 flex flex-col justify-between z-20">
      <h3 class="font-extrabold text-sm sm:text-base leading-tight max-w-[60%]">
       BLACKPINK | DEADLINE
      </h3>
      <table class="w-[400px] max-w-full text-xs text-gray-600 mt-1 table-fixed border-collapse">
       <tbody>
        <tr class="border-b border-gray-300">
         <td class="w-1/3 py-0.5 font-semibold-custom">
          List Price
         </td>
         <td class="w-2/3 text-right py-0.5 font-semibold-custom">
          4,410,250
         </td>
        </tr>
        <tr class="border-b border-gray-300">
         <td class="py-0.5 font-semibold-custom">
          List Tax
         </td>
         <td class="text-right py-0.5 font-semibold-custom">
          661.537
         </td>
        </tr>
        <tr class="border-b border-gray-300">
         <td class="py-0.5 font-semibold-custom">
          Complete
         </td>
         <td class="text-right py-0.5 font-semibold-custom">
          5.071.787
         </td>
        </tr>
       </tbody>
      </table>
      <p class="text-[9px] font-semibold-custom mt-1">
       Payment Code :
       <span class="font-normal">
        11087589086
       </span>
      </p>
      <p class="text-[9px] text-blue-600 mt-0.5 font-semibold-custom">
       *Berakhir pada 27 Mei 2025
      </p>
      <div class="flex justify-end mt-1">
       <a class="text-blue-600 font-semibold-custom hover:underline text-[9px]" href="#">
        Click here to view your e-ticket
       </a>
      </div>
     </div>
    </div>
    <div class="relative flex flex-col sm:flex-row bg-blue-50 border border-blue-200 rounded-md p-3 sm:p-4 max-w-full mb-4">
     <div class="absolute top-3 right-3 flex flex-col items-end space-y-1 select-none z-20">
      <span class="text-gray-700 font-semibold-custom date-text">
       2025.04.07
      </span>
      <span class="text-[9px] bg-green-500 text-white rounded px-2 py-[2px] font-semibold">
       Active
      </span>
     </div>
     <div class="flex-shrink-0 mb-3 sm:mb-0 sm:mr-4 z-20">
      <img alt="Prambanan temple sunset landscape" class="rounded" height="90" src="https://storage.googleapis.com/a1aa/image/8c646c59-1c8a-4f7f-6e5e-33f47691c72d.jpg" width="120"/>
     </div>
     <div class="flex-1 flex flex-col justify-between z-20">
      <h3 class="font-extrabold text-sm sm:text-base leading-tight max-w-[60%]">
       PRAMBANAN JAZZ 2025
      </h3>
      <table class="w-[400px] max-w-full text-xs text-gray-600 mt-1 table-fixed border-collapse">
       <tbody>
        <tr class="border-b border-gray-300">
         <td class="w-1/3 py-0.5 font-semibold-custom">
          List Price
         </td>
         <td class="w-2/3 text-right py-0.5 font-semibold-custom">
          402,000
         </td>
        </tr>
        <tr class="border-b border-gray-300">
         <td class="py-0.5 font-semibold-custom">
          List Tax
         </td>
         <td class="text-right py-0.5 font-semibold-custom">
          60,300
         </td>
        </tr>
        <tr class="border-b border-gray-300">
         <td class="py-0.5 font-semibold-custom">
          Complete
         </td>
         <td class="text-right py-0.5 font-semibold-custom">
          462.300
         </td>
        </tr>
       </tbody>
      </table>
      <p class="text-[9px] font-semibold-custom mt-1">
       Payment Code :
       <span class="font-normal">
        33448796532
       </span>
      </p>
      <p class="text-[9px] text-blue-600 mt-0.5 font-semibold-custom">
       *Berakhir pada 27 Mei 2025
      </p>
      <div class="flex justify-end mt-1">
       <a class="text-blue-600 font-semibold-custom hover:underline text-[9px]" href="#">
        Click here to view your e-ticket
       </a>
      </div>
     </div>
    </div>
   </section>
   <!-- Expired ticket -->
   <section>
    <h2 class="font-bold text-lg mb-2">
    Expired ticket
</h2>
    <div class="relative flex flex-col sm:flex-row bg-gray-700 bg-opacity-90 rounded-md p-3 sm:p-4 mb-4 max-w-full overflow-hidden">
     <div class="absolute inset-0 bg-black bg-opacity-50 rounded-md z-10"></div>
     <div class="absolute top-3 right-3 flex flex-col items-end space-y-1 select-none z-20">
      <span class="text-gray-300 bg-gray-800 rounded px-2 py-[2px] font-semibold date-text">
       2025.07.10
      </span>
      <span class="text-gray-300 bg-gray-800 rounded px-2 py-[2px] font-semibold text-[9px]">
       Expired
      </span>
     </div>
     <div class="flex-shrink-0 mb-3 sm:mb-0 sm:mr-4 opacity-80 z-20">
      <img alt="Taylor Swift The Eras Tour red gloves closeup" class="rounded" height="90" src="https://storage.googleapis.com/a1aa/image/eb287f8b-ff27-406b-88e2-6fc1882f8d14.jpg" width="120"/>
     </div>
     <div class="flex-1 flex flex-col justify-between text-gray-400 opacity-80 z-20">
      <h3 class="font-extrabold text-sm sm:text-base leading-tight max-w-[60%] mb-1">
       Taylor Swift | The Eras Tour
      </h3>
      <table class="w-[400px] max-w-full text-xs mt-1 table-fixed border-collapse">
       <tbody>
        <tr class="border-b border-gray-600">
         <td class="w-1/3 py-0.5 font-semibold-custom">
          List Price
         </td>
         <td class="w-2/3 text-right py-0.5 font-semibold-custom">
          4,375,000
         </td>
        </tr>
        <tr class="border-b border-gray-600">
         <td class="py-0.5 font-semibold-custom">
          List Tax
         </td>
         <td class="text-right py-0.5 font-semibold-custom">
          626,250
         </td>
        </tr>
        <tr class="border-b border-gray-600">
         <td class="py-0.5 font-semibold-custom">
          Complete
         </td>
         <td class="text-right py-0.5 font-semibold-custom">
          5.031.250
         </td>
        </tr>
       </tbody>
      </table>
      <p class="text-[9px] font-semibold-custom mt-1">
       Payment Code :
       <span class="font-normal">
        33448796532
       </span>
      </p>
      <p class="text-[9px] text-blue-600 mt-0.5 font-semibold-custom">
       *Berakhir pada 27 Mei 2025
      </p>
     </div>
    </div>
    <div class="relative flex flex-col sm:flex-row bg-gray-700 bg-opacity-90 rounded-md p-3 sm:p-4 mb-4 max-w-full overflow-hidden">
     <div class="absolute inset-0 bg-black bg-opacity-50 rounded-md z-10"></div>
     <div class="absolute top-3 right-3 flex flex-col items-end space-y-1 select-none z-20">
      <span class="text-gray-300 bg-gray-800 rounded px-2 py-[2px] font-semibold date-text">
       2025.07.10
      </span>
      <span class="text-gray-300 bg-gray-800 rounded px-2 py-[2px] font-semibold text-[9px]">
       Expired
      </span>
     </div>
     <div class="flex-shrink-0 mb-3 sm:mb-0 sm:mr-4 opacity-80 z-20">
      <img alt="Taylor Swift The Eras Tour red gloves closeup" class="rounded" height="90" src="https://storage.googleapis.com/a1aa/image/eb287f8b-ff27-406b-88e2-6fc1882f8d14.jpg" width="120"/>
     </div>
     <div class="flex-1 flex flex-col justify-between text-gray-400 opacity-80 z-20">
      <h3 class="font-extrabold text-sm sm:text-base leading-tight max-w-[60%] mb-1">
       Taylor Swift | The Eras Tour
      </h3>
      <table class="w-[400px] max-w-full text-xs mt-1 table-fixed border-collapse">
       <tbody>
        <tr class="border-b border-gray-600">
         <td class="w-1/3 py-0.5 font-semibold-custom">
          List Price
         </td>
         <td class="w-2/3 text-right py-0.5 font-semibold-custom">
          4,375,000
         </td>
        </tr>
        <tr class="border-b border-gray-600">
         <td class="py-0.5 font-semibold-custom">
          List Tax
         </td>
         <td class="text-right py-0.5 font-semibold-custom">
          626.250
         </td>
        </tr>
        <tr class="border-b border-gray-600">
         <td class="py-0.5 font-semibold-custom">
          Complete
         </td>
         <td class="text-right py-0.5 font-semibold-custom">
          5.031.250
         </td>
        </tr>
       </tbody>
      </table>
      <p class="text-[9px] font-semibold-custom mt-1">
       Payment Code :
       <span class="font-normal">
        33448796532
       </span>
      </p>
      <p class="text-[9px] text-blue-600 mt-0.5 font-semibold-custom">
       *Berakhir pada 27 Mei 2025
      </p>
     </div>
    </div>
    <div class="relative flex flex-col sm:flex-row bg-gray-700 bg-opacity-90 rounded-md p-3 sm:p-4 max-w-full overflow-hidden">
     <div class="absolute inset-0 bg-black bg-opacity-50 rounded-md z-10"></div>
     <div class="absolute top-3 right-3 flex flex-col items-end space-y-1 select-none z-20">
      <span class="text-gray-300 bg-gray-800 rounded px-2 py-[2px] font-semibold date-text">
       2025.07.10
      </span>
      <span class="text-gray-300 bg-gray-800 rounded px-2 py-[2px] font-semibold text-[9px]">
       Expired
      </span>
     </div>
     <div class="flex-shrink-0 mb-3 sm:mb-0 sm:mr-4 opacity-80 z-20">
      <img alt="Taylor Swift The Eras Tour red gloves closeup" class="rounded" height="90" src="https://storage.googleapis.com/a1aa/image/eb287f8b-ff27-406b-88e2-6fc1882f8d14.jpg" width="120"/>
     </div>
     <div class="flex-1 flex flex-col justify-between text-gray-400 opacity-80 z-20">
      <h3 class="font-extrabold text-sm sm:text-base leading-tight max-w-[60%] mb-1">
       Taylor Swift | The Eras Tour
      </h3>
      <table class="w-[400px] max-w-full text-xs mt-1 table-fixed border-collapse">
       <tbody>
        <tr class="border-b border-gray-600">
         <td class="w-1/3 py-0.5 font-semibold-custom">
          List Price
         </td>
         <td class="w-2/3 text-right py-0.5 font-semibold-custom">
          4,375,000
         </td>
        </tr>
        <tr class="border-b border-gray-600">
         <td class="py-0.5 font-semibold-custom">
          List Tax
         </td>
         <td class="text-right py-0.5 font-semibold-custom">
          626.250
         </td>
        </tr>
        <tr class="border-b border-gray-600">
         <td class="py-0.5 font-semibold-custom">
          Complete
         </td>
         <td class="text-right py-0.5 font-semibold-custom">
          5.031.250
         </td>
        </tr>
       </tbody>
      </table>
      <p class="text-[9px] font-semibold-custom mt-1">
       Payment Code :
       <span class="font-normal">
        33448796532
       </span>
      </p>
      <p class="text-[9px] text-blue-600 mt-0.5 font-semibold-custom">
       *Berakhir pada 27 Mei 2025
      </p>
     </div>
    </div>
   </section>
  </div>
 </body>
 <!-- Footer -->
  <footer class="bg-[#0B1A8C] text-white px-6 py-8 select-none mt-auto">
    <div
      class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-8 text-xs leading-relaxed"
    >
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
