<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>TixMeUp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Pacifico&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
    }
    .font-pacifico {
      font-family: 'Pacifico', cursive;
    }
  </style>
</head>
<body class="bg-white text-gray-900">
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
                        <span class="font-semibold text-white text-lg">USERNAME</span>
                        <br>
                        <span class="text-white text-sm">user@example.com</span>
                    </div>
                    <button id="closeSidebar" class="text-white text-2xl focus:outline-none ml-auto">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <ul class="p-4 space-y-4 text-white ml-4">
                    <li><a href="#" class="hover:underline">My Tickets</a></li>
                    <li><a href="#" class="hover:underline">Shopping Basket</a></li>
                    <li><a href="#" class="hover:underline">Transaction History</a></li>
                    <li><a href="#" class="hover:underline">Reviews &amp; Ratings</a></li>
                    <li><a href="#" class="hover:underline">FAQ</a></li>
                    <li>
                        <div class="flex items-center">
                            <a href="#" class="hover:underline">Started as an</a>
                            <button id="toggleAdminPromotor" class="ml-2 text-white focus:outline-none">
                                <i class="fas fa-chevron-down"></i> <!-- Downward arrow icon -->
                            </button>
                        </div>
                        <ul id="adminPromotorList" class="ml-4 mt-1 space-y-2 hidden"> <!-- Initially hidden -->
                            <li><a href="#" class="hover:underline text-xs">Admin</a></li>
                            <li><a href="#" class="hover:underline text-xs">Promotor</a></li>
                        </ul>
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
<!-- Carousel -->
  <div class="relative border-b border-[#00108b]">
    <img alt="Black and white photo of four women posing with red BLACKPINK text overlay" class="w-full object-cover max-h-[250px]" height="250" src="{{ asset('img/Blackpink.png') }}" width="1200"/>
    <button aria-label="Previous slide" class="absolute top-1/2 left-2 -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-80 rounded-full p-2 text-2xl text-[#00108b]">
      <i class="fas fa-chevron-left"></i>
    </button>
    <button aria-label="Next slide" class="absolute top-1/2 right-2 -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-80 rounded-full p-2 text-2xl text-[#00108b]">
      <i class="fas fa-chevron-right"></i>
    </button>
  </div>

  <!-- Event Filter Buttons -->
  <section class="max-w-7xl mx-auto mt-6 px-4 flex space-x-4">
    <button id="allEventsBtn" class="border border-gray-900 rounded-full px-4 py-1.5 text-sm font-semibold text-gray-900 hover:bg-gray-100" type="button">
      All events
    </button>
    <button id="myEventsBtn" class="border border-gray-900 rounded-full px-4 py-1.5 text-sm font-semibold text-gray-900 hover:bg-gray-100" type="button">
      My Events
    </button>
  </section>

  <!-- Event Cards Grid -->
  <section id="eventsGrid" class="max-w-7xl mx-auto mt-6 px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Event cards will be injected here via JavaScript -->
  </section>

<!-- Add Event Button -->
<section class="max-w-7xl mx-auto mt-6 mb-16 px-4 flex justify-end">
  <button class="border border-gray-900 rounded-full px-6 py-1.5 text-sm font-semibold italic text-gray-900 hover:bg-gray-100" type="button">
    add events ...
  </button>
</section>

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


  <!-- JavaScript Logic -->
 <script>
  const eventsGrid = document.getElementById('eventsGrid');
  const allEventsBtn = document.getElementById('allEventsBtn');
  const myEventsBtn = document.getElementById('myEventsBtn');

  const createCard = (title, time, location, image) => `
    <article class="border border-gray-300 rounded-lg overflow-hidden shadow-sm flex flex-col">
      <img src="${image}" alt="${title}" class="w-full h-40 object-cover" />
      <div class="p-3 flex flex-col flex-grow">
        <h3 class="text-xs font-bold uppercase text-center mb-2">${title}</h3>
        <div class="flex justify-between items-center text-xs text-gray-500 mb-1 px-1">
          <div>
            <div class="flex items-center space-x-1"><i class="far fa-clock"></i><span>${time}</span></div>
            <div class="flex items-center space-x-1"><i class="fas fa-map-marker-alt"></i><span>${location}</span></div>
          </div>
          <button class="bg-blue-700 text-white text-xs px-3 py-1 rounded hover:bg-blue-800" type="button">More Info</button>
        </div>
      </div>
    </article>
  `;

  const allEvents = [
    createCard('BLACKPINK | DEADLINE', '25.11.10 06.00 PM', 'Jakarta', 'https://storage.googleapis.com/a1aa/image/ac1fd20d-4a46-499f-bb31-cf37f1131787.jpg'),
    createCard('Prambanan JAZZ 2025', '17.08.25 07.00 PM', 'Yogyakarta', 'https://storage.googleapis.com/a1aa/image/1db0d2c4-ba79-4a70-47a2-660bee7349f0.jpg'),
    createCard('NCT DREAM TOUR', '10.02.25 08.00 PM', 'Seoul', 'https://storage.googleapis.com/a1aa/image/dbe0f70d-8fea-4653-7209-09ffe57570e2.jpg'),
    createCard('KOMIKCON FEST 2025', '05.09.25 01.00 PM', 'Bandung', 'https://via.placeholder.com/400x200?text=Komikcon'),
    createCard('DWP FESTIVAL', '31.12.25 10.00 PM', 'Jakarta', 'https://via.placeholder.com/400x200?text=DWP'),
    createCard('JogjaROCKarta', '20.11.25 07.00 PM', 'Yogyakarta', 'https://via.placeholder.com/400x200?text=JogjaRock')
  ];

  const myEvents = [
    createCard('BLACKPINK | DEADLINE', '25.11.10 06.00 PM', 'Jakarta', 'https://storage.googleapis.com/a1aa/image/ac1fd20d-4a46-499f-bb31-cf37f1131787.jpg'),
    createCard('Prambanan JAZZ 2025', '17.08.25 07.00 PM', 'Yogyakarta', 'https://storage.googleapis.com/a1aa/image/1db0d2c4-ba79-4a70-47a2-660bee7349f0.jpg')
  ];

  function renderEvents(events) {
    eventsGrid.innerHTML = events.join('');
  }

  allEventsBtn.addEventListener('click', () => renderEvents(allEvents));
  myEventsBtn.addEventListener('click', () => renderEvents(myEvents));

  // Ensure all events are displayed when the page loads
  document.addEventListener('DOMContentLoaded', () => {
    renderEvents(allEvents); // Default load all events
  });
</script>
</body>
</html>
