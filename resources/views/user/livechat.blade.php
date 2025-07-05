<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   TixMeUp Chat
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
 <body class="flex flex-col bg-white min-h-screen flex flex-col">
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
<!-- Chat content -->
<main class="w-full h-screen flex flex-col p-6 bg-gradient-to-br from-[#e0f2fe] to-white font-sans">
    <!-- Judul -->
    <h2 class="text-2xl font-extrabold text-center text-[#0B1A8C] mb-6 tracking-wide">💬 Chat dengan Admin</h2>

    <!-- Chat Box -->
    <div id="chatBox" class="flex-1 overflow-y-auto bg-white p-5 rounded-3xl shadow-xl border border-blue-200 space-y-3 mb-5 scroll-smooth transition-all duration-300">
        <!-- Chat messages will appear here -->
    </div>

    <!-- Input -->
    <form id="chatForm" class="mt-auto">
        @csrf
        <div class="flex items-center gap-3">
            <input type="text" name="message" id="messageInput"
                   class="flex-1 border border-gray-300 rounded-full px-5 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                   placeholder="Tulis pesan kamu di sini..." required>
            <button class="bg-gradient-to-r from-[#0B1A8C] to-[#4F8EF7] text-white px-6 py-2 rounded-full text-sm shadow-md hover:shadow-lg hover:from-[#092279] hover:to-[#3a75dd] transition-all duration-300">Kirim</button>
        </div>
    </form>
</main>

<!-- Script -->
<script>
    function fetchChats() {
        fetch('/get-chats')
            .then(res => res.json())
            .then(data => {
                const box = document.getElementById('chatBox');
                box.innerHTML = '';

                data.forEach(chat => {
                    const align = chat.role === 'admin' ? 'justify-start' : 'justify-end';
                    const bg = chat.role === 'admin'
                        ? 'bg-[#0B1A8C] text-white'
                        : 'bg-[#DCF2FF] text-gray-900';
                    const avatar = chat.role === 'admin' ? '🤖' : '🧑';

                    box.innerHTML += `
                        <div class="flex ${align} animate-fade-in">
                            <div class="flex items-end gap-2 max-w-[75%]">
                                ${chat.role !== 'admin' ? `<div class="text-xl">${avatar}</div>` : ''}
                                <div class="${bg} px-5 py-2 rounded-2xl shadow-md text-sm font-medium tracking-wide">${chat.message}</div>
                                ${chat.role === 'admin' ? `<div class="text-xl">${avatar}</div>` : ''}
                            </div>
                        </div>
                    `;
                });

                box.scrollTop = box.scrollHeight;
            });
    }

    document.getElementById('chatForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const message = document.getElementById('messageInput').value;

        fetch('/send-chat', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('[name=_token]').value,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ message })
        }).then(() => {
            document.getElementById('messageInput').value = '';
            fetchChats();
        });
    });

    setInterval(fetchChats, 3000);
    fetchChats();
</script>

<!-- Animasi Fade In -->
<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>

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
