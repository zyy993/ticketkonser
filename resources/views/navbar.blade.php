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
                    <li><a href="#" class="hover:underline">My Tickets</a></li>
                    <li><a href="#" class="hover:underline">Shopping Basket</a></li>
                    <li><a href="#" class="hover:underline">Transaction History</a></li>
                    <li><a href="#" class="hover:underline">Reviews &amp; Ratings</a></li>
                    <li><a href="#" class="hover:underline">FAQ</a></li>
                    <li>
                        <div class="flex items-center">
                            <button id="toggleAdminPromotor" class="ml-2 text-white focus:outline-none">
                            </button>
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
