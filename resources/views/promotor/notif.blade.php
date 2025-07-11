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
<main class="max-w-4xl mx-auto px-4 sm:px-6 md:px-10 py-6 mb-32">
    <h1 class="text-center font-semibold text-black text-base mb-6 select-none"> Notification </h1>

    <!-- Tabs -->
<div class="flex space-x-3 mb-8 justify-center">
    <button id="showAll" class="border border-black text-black text-xs font-semibold rounded-full px-4 py-1.5 select-none" type="button"> Semua </button>
    <button id="showUnread" class="border border-black text-black text-xs font-semibold rounded-full px-4 py-1.5 select-none" type="button"> Belum Dibaca </button>
    <button id="showUnreplied" class="border border-black text-black text-xs font-semibold rounded-full px-4 py-1.5 select-none" type="button"> Belum Dibalas </button>
</div>

    <!-- Notification list -->
    <div id="notificationList">
        <!-- Semua Notifikasi -->
        <ul class="space-y-6" id="allNotifications">
            <!-- Item 1 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> anindya_melody_17 </p>
                        <p class="leading-tight select-text"> Kak, tiket Pink VIP itu termasuk hi-touch atau cuma dekat panggung aja? </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 02/06 </span>
                    <div class="bg-[#0B1E8A] text-white rounded-full w-6 h-6 flex items-center justify-center font-semibold"> 1 </div>
                </div>
            </li>
            <!-- Item 2 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> lisa_onrepeat_everyday </p>
                        <p class="leading-tight select-text"> Aku sudah beli tiket, tapi belum dapet e-ticket ke email. Mohon bantuannya ya 🙏 </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 02/06 </span>
                    <div class="bg-[#0B1E8A] text-white rounded-full w-6 h-6 flex items-center justify-center font-semibold"> 1 </div>
                </div>
            </li>
            <!-- Item 3 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> ot4_forever_blinkz </p>
                        <p class="leading-tight select-text"> Batas maksimal pembelian tiket dalam satu akun berapa ya? </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 02/06 </span>
                    <div class="bg-[#0B1E8A] text-white rounded-full w-6 h-6 flex items-center justify-center font-semibold"> 1 </div>
                </div>
            </li>
            <!-- Item 4 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> pinkvenom_tourindo.bl </p>
                        <p class="leading-tight select-text"> Kak mohon info, gate dibuka jam berapa dan apakah perlu cetak tiket fisik? </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 02/06 </span>
                    <div class="bg-[#0B1E8A] text-white rounded-full w-6 h-6 flex items-center justify-center font-semibold"> 1 </div>
                </div>
            </li>
            <!-- Item 5 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> bpconcert_familytrip </p>
                        <p class="leading-tight select-text"> Saya bawa anak usia 9 tahun, apakah perlu beli tiket sendiri atau ada kebijakan khusus anak? </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 02/06 </span>
                    <div class="bg-[#0B1E8A] text-white rounded-full w-6 h-6 flex items-center justify-center font-semibold"> 1 </div>
                </div>
            </li>
            <!-- Item 6 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> blackpink_fan_tired123 </p>
                        <p class="leading-tight select-text"> Kenapa sih selalu rebutan tiket kayak gini tiap konser BLACKPINK? 🤔 </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 01/06 </span>
                    <div class="w-6 h-6 flex items-center justify-center font-semibold"> </div>
                </div>
            </li>
            <!-- Item 7 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> bpblinksquad_jakarta </p>
                        <p class="leading-tight select-text"> Untuk konser BORN PINK, semua zona boleh membawa lightstick resmi BLACKPINK. Tidak ada pembagian zona khusus, tapi akan ada light sync di area tertentu. </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 01/06 </span>
                    <div class="w-6 h-6 flex items-center justify-center font-semibold"> </div>
                </div>
            </li>
            <!-- Item 8 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> bornpink_diary_bali </p>
                        <p class="leading-tight select-text"> Maaf, tidak diperbolehkan membawa kamera profesional atau mirrorless. Hanya ponsel yang diizinkan untuk dokumentasi pribadi. </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 01/06 </span>
                    <div class="w-6 h-6 flex items-center justify-center font-semibold"> </div>
                </div>
            </li>
            <!-- Item 9 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> roseanne_indonesia_luv </p>
                        <p class="leading-tight select-text"> Ya, kami bekerja sama dengan mitra transportasi untuk menyediakan shuttle dari stasiun utama ke venue. Info lengkap akan kami umumkan H-3 sebelum konser. </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 01/06 </span>
                    <div class="w-6 h-6 flex items-center justify-center font-semibold"> </div>
                </div>
            </li>
        </ul>

        <!-- Notifikasi Belum Dibaca -->
        <ul class="space-y-6 hidden" id="unreadNotifications">
            <!-- Item 1 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> anindya_melody_17 </p>
                        <p class="leading-tight select-text"> Kak, tiket Pink VIP itu termasuk hi-touch atau cuma dekat panggung aja? </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 02/06 </span>
                    <div class="bg-[#0B1E8A] text-white rounded-full w-6 h-6 flex items-center justify-center font-semibold"> 1 </div>
                </div>
            </li>
            <!-- Item 2 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> lisa_onrepeat_everyday </p>
                        <p class="leading-tight select-text"> Aku sudah beli tiket, tapi belum dapet e-ticket ke email. Mohon bantuannya ya 🙏 </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 02/06 </span>
                    <div class="bg-[#0B1E8A] text-white rounded-full w-6 h-6 flex items-center justify-center font-semibold"> 1 </div>
                </div>
            </li>
            <!-- Item 3 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> ot4_forever_blinkz </p>
                        <p class="leading-tight select-text"> Batas maksimal pembelian tiket dalam satu akun berapa ya? </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 02/06 </span>
                    <div class="bg-[#0B1E8A] text-white rounded-full w-6 h-6 flex items-center justify-center font-semibold"> 1 </div>
                </div>
            </li>
            <!-- Item 4 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> pinkvenom_tourindo.bl </p>
                        <p class="leading-tight select-text"> Kak mohon info, gate dibuka jam berapa dan apakah perlu cetak tiket fisik? </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 02/06 </span>
                    <div class="bg-[#0B1E8A] text-white rounded-full w-6 h-6 flex items-center justify-center font-semibold"> 1 </div>
                </div>
            </li>
            <!-- Item 5 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> bpconcert_familytrip </p>
                        <p class="leading-tight select-text"> Saya bawa anak usia 9 tahun, apakah perlu beli tiket sendiri atau ada kebijakan khusus anak? </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 02/06 </span>
                    <div class="bg-[#0B1E8A] text-white rounded-full w-6 h-6 flex items-center justify-center font-semibold"> 1 </div>
                </div>
            </li>
        </ul>

       <!-- Notifikasi Belum Dibalas -->
        <ul class="space-y-6 hidden" id="unrepliedNotifications">
            <!-- Item 1 -->
            <li class="flex justify-between items-start border-b border-black/10 pb-4">
                <div class="flex space-x-4 max-w-[calc(100%-72px)]">
                    <img alt="User  avatar" class="w-10 h-10 rounded-full flex-shrink-0" src="https://storage.googleapis.com/a1aa/image/f405a632-8d6f-4000-4dad-1f2d34fa498d.jpg" />
                    <div class="text-sm text-black">
                        <p class="font-semibold leading-tight select-text"> blackpink_fan_tired123 </p>
                        <p class="leading-tight select-text"> Kenapa sih selalu rebutan tiket kayak gini tiap konser BLACKPINK? 🤔 </p>
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-1 text-xs text-[#0B1E8A] select-none min-w-[48px]">
                    <span> 01/06 </span>
                </div>
            </li>
        </ul>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Automatically show "Semua" notifications and set the active button
        const showAllButton = document.getElementById('showAll');
        setActiveButton(showAllButton);
        document.getElementById('allNotifications').classList.remove('hidden');
        document.getElementById('unreadNotifications').classList.add('hidden');
        document.getElementById('unrepliedNotifications').classList.add('hidden');
    });

    document.getElementById('showAll').onclick = function() {
        setActiveButton(this);
        document.getElementById('allNotifications').classList.remove('hidden');
        document.getElementById('unreadNotifications').classList.add('hidden');
        document.getElementById('unrepliedNotifications').classList.add('hidden');
    };

    document.getElementById('showUnread').onclick = function() {
        setActiveButton(this);
        document.getElementById('allNotifications').classList.add('hidden');
        document.getElementById('unreadNotifications').classList.remove('hidden');
        document.getElementById('unrepliedNotifications').classList.add('hidden');
    };

    document.getElementById('showUnreplied').onclick = function() {
        setActiveButton(this);
        document.getElementById('allNotifications').classList.add('hidden');
        document.getElementById('unreadNotifications').classList.add('hidden');
        document.getElementById('unrepliedNotifications').classList.remove('hidden');
    };

    // Function to set the active button
    function setActiveButton(activeButton) {
        const buttons = document.querySelectorAll('.flex button');
        buttons.forEach(button => {
            button.classList.remove('active'); // Remove active class from all buttons
        });
        activeButton.classList.add('active'); // Add active class to the clicked button
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
 </body>
</html>
