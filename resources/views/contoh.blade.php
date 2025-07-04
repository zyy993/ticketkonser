<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>TixMeUp Seating</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .seat {
            cursor: pointer;
            transition: background-color 0.3s; /* Smooth transition for color change */
        }
        .selected {
            background-color: #4CAF50; /* Green */
        }
        .disabled {
            background-color: #ccc; /* Gray */
            cursor: not-allowed;
        }
        .button-disabled {
            opacity: 0.5; /* Reduced opacity for disabled state */
        }
    </style>
    <script>
        function selectSeat(seat) {
            // If the seat is already selected, do nothing
            if (seat.classList.contains('selected')) {
                return;
            }

            // Remove 'selected' class from all seats and reset their colors
            const selectedSeats = document.querySelectorAll('.selected');
            selectedSeats.forEach(s => {
                s.classList.remove('selected');
                s.style.backgroundColor = ''; // Reset color to original
                // Reset the corresponding opposite seat
                const oppositeSeat = document.querySelector(`.seat[data-seat-name="${s.getAttribute('data-seat-name')}"]:not([data-side="${s.getAttribute('data-side')}"])`);
                if (oppositeSeat) {
                    oppositeSeat.classList.remove('selected');
                    oppositeSeat.style.backgroundColor = ''; // Reset color
                }
            });

            // Add 'selected' class to the clicked seat
            seat.classList.add('selected');
            seat.style.backgroundColor = '#4CAF50'; // Change to green or any color you prefer

            // Check if the selected seat is in Zone A, B, or D and select the opposite
            const seatName = seat.getAttribute('data-seat-name');
            const side = seat.getAttribute('data-side');
            if (seatName === 'ZONE A' || seatName === 'ZONE B' || seatName === 'ZONE D') {
                const oppositeSide = side === 'left' ? 'right' : 'left';
                const oppositeSeat = document.querySelector(`.seat[data-seat-name="${seatName}"][data-side="${oppositeSide}"]`);
                if (oppositeSeat) {
                    oppositeSeat.classList.add('selected');
                    oppositeSeat.style.backgroundColor = '#4CAF50'; // Change to green or any color you prefer
                }
            }

            // Enable the Select Seat button
            const selectSeatButton = document.getElementById('selectSeatButton');
            selectSeatButton.classList.remove('disabled', 'button-disabled');
            selectSeatButton.disabled = false; // Enable button
            selectSeatButton.style.opacity = 1; // Set opacity to 100%
        }
        function selectSeat(seat) {
    // If the seat is already selected, do nothing
    if (seat.classList.contains('selected')) {
        return;
    }

    // Disable all other seats
    const allSeats = document.querySelectorAll('.seat');
    allSeats.forEach(s => {
        if (!s.classList.contains('selected')) {
            s.classList.add('disabled');
            s.style.backgroundColor = '#ccc'; // Set to gray
            s.style.cursor = 'not-allowed'; // Change cursor to not-allowed
            s.onclick = null; // Remove click event
        }
    });

    // Remove 'selected' class from all seats and reset their colors
    const selectedSeats = document.querySelectorAll('.selected');
    selectedSeats.forEach(s => {
        s.classList.remove('selected');
        s.style.backgroundColor = ''; // Reset color to original
        // Reset the corresponding opposite seat
        const oppositeSeat = document.querySelector(`.seat[data-seat-name="${s.getAttribute('data-seat-name')}"]:not([data-side="${s.getAttribute('data-side')}"])`);
        if (oppositeSeat) {
            oppositeSeat.classList.remove('selected');
            oppositeSeat.style.backgroundColor = ''; // Reset color
        }
    });

    // Add 'selected' class to the clicked seat
    seat.classList.add('selected');
    seat.style.backgroundColor = '#4CAF50'; // Change to green or any color you prefer

    // Check if the selected seat is in Zone A, B, or D and select the opposite
    const seatName = seat.getAttribute('data-seat-name');
    const side = seat.getAttribute('data-side');
    if (seatName === 'ZONE A' || seatName === 'ZONE B' || seatName === 'ZONE D') {
        const oppositeSide = side === 'left' ? 'right' : 'left';
        const oppositeSeat = document.querySelector(`.seat[data-seat-name="${seatName}"][data-side="${oppositeSide}"]`);
        if (oppositeSeat) {
            oppositeSeat.classList.add('selected');
            oppositeSeat.style.backgroundColor = '#4CAF50'; // Change to green or any color you prefer
        }
    }

    // Enable the Select Seat button
    const selectSeatButton = document.getElementById('selectSeatButton');
    selectSeatButton.classList.remove('disabled', 'button-disabled');
    selectSeatButton.disabled = false; // Enable button
    selectSeatButton.style.opacity = 1; // Set opacity to 100%
}


        function confirmSelection() {
            const selectedSeats = document.querySelectorAll('.selected');
            if (selectedSeats.length > 0) {
                const seatNames = Array.from(selectedSeats).map(seat => seat.getAttribute('data-seat-name')).join(', ');
                const confirmation = confirm(`You have selected ${seatNames}. Do you want to proceed?`);
                if (confirmation) {
                    alert('Seat confirmed!');
                } else {
                    // Deselect all selected seats and reset their colors
                    selectedSeats.forEach(seat => {
                        seat.classList.remove('selected'); // Deselect
                        seat.style.backgroundColor = ''; // Reset color
                    });
                    const selectSeatButton = document.getElementById('selectSeatButton');
                    selectSeatButton.classList.add('disabled', 'button-disabled');
                    selectSeatButton.disabled = true; // Disable button again
                    selectSeatButton.style.opacity = 0.5; // Set opacity to 50%
                }
            } else {
                alert('Please select a seat first.');
            }
        }
        function confirmSelection() {
    const selectedSeats = document.querySelectorAll('.selected');
    if (selectedSeats.length > 0) {
        const seatNames = Array.from(selectedSeats).map(seat => seat.getAttribute('data-seat-name')).join(', ');
        const confirmation = confirm(`You have selected ${seatNames}. Do you want to proceed?`);
        if (confirmation) {
            alert('Seat confirmed!');
        } else {
            // Deselect all selected seats and reset their colors
            selectedSeats.forEach(seat => {
                seat.classList.remove('selected'); // Deselect
                seat.style.backgroundColor = ''; // Reset color
            });

            // Re-enable all seats
            const allSeats = document.querySelectorAll('.seat');
            allSeats.forEach(s => {
                s.classList.remove('disabled');
                s.style.backgroundColor = ''; // Reset to original color
                s.style.cursor = 'pointer'; // Change cursor back to pointer
                s.onclick = function() { selectSeat(this); }; // Re-attach click event
            });

            // Disable the Select Seat button again
            const selectSeatButton = document.getElementById('selectSeatButton');
            selectSeatButton.classList.add('disabled', 'button-disabled');
            selectSeatButton.disabled = true; // Disable button again
            selectSeatButton.style.opacity = 0.5; // Set opacity to 50%
        }
    } else {
        alert('Please select a seat first.');
    }
}

    </script>
</head>
<body class="bg-white">
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
    <main class="max-w-5xl mx-auto mt-8 px-6 mb-16">
        <!-- Card container with overlay background -->
        <div class="relative rounded-lg shadow-lg overflow-hidden">
            <!-- Overlay background -->
            <div class="absolute inset-0 bg-black bg-opacity-20 pointer-events-none rounded-lg"></div>
            <!-- Content inside card -->
            <div class="relative bg-white p-8 rounded-lg">
                <!-- Stage -->
                <div class="bg-black text-white font-bold text-center py-16 text-lg rounded-tl-md rounded-tr-md w-1/2 mx-auto mb-3" style="font-family: Arial, sans-serif;">
                    STAGE
                </div>
                <!-- Seating layout container -->
                <div class="flex justify-between gap-1.5">
                    <!-- Left zones -->
                    <div class="flex flex-col gap-1.5 w-1/3">
                        <div class="bg-[#a00052] text-white font-bold text-sm text-center py-12 rounded-md seat" data-seat-name="ZONE A" data-side="left" onclick="selectSeat(this)">
                            ZONE A
                        </div>
                        <div class="bg-[#d6006f] text-white font-bold text-sm text-center py-12 rounded-md seat" data-seat-name="ZONE B" data-side="left" onclick="selectSeat(this)">
                            ZONE B
                        </div>
                        <div class="bg-[#e9c0c9] text-white font-bold text-sm text-center py-12 rounded-bl-lg seat" data-seat-name="ZONE D" data-side="left" onclick="selectSeat(this)">
                            ZONE D
                        </div>
                    </div>
                    <!-- Center zones -->
                    <div class="flex flex-col w-3/5 gap-1.5">
                        <div class="bg-[#80003c] text-white font-bold text-sm text-center py-28 rounded-md seat" data-seat-name="VVIP" onclick="selectSeat(this)">
                            VVIP
                        </div>
                        <div class="bg-[#d67ca0] text-white font-bold text-sm text-center py-12 rounded-b-md seat" data-seat-name="ZONE C" onclick="selectSeat(this)">
                            ZONE C
                        </div>
                    </div>
                    <!-- Right zones -->
                    <div class="flex flex-col gap-1.5 w-1/3">
                        <div class="bg-[#a00052] text-white font-bold text-sm text-center py-12 rounded-md seat" data-seat-name="ZONE A" data-side="right" onclick="selectSeat(this)">
                            ZONE A
                        </div>
                        <div class="bg-[#d6006f] text-white font-bold text-sm text-center py-12 rounded-md seat" data-seat-name="ZONE B" data-side="right" onclick="selectSeat(this)">
                            ZONE B
                        </div>
                        <div class="bg-[#e9c0c9] text-white font-bold text-sm text-center py-12 rounded-br-lg seat" data-seat-name="ZONE D" data-side="right" onclick="selectSeat(this)">
                            ZONE D
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Select Seat Button -->
        <div class="mt-4 text-center">
            <button id="selectSeatButton" onclick="confirmSelection()" class="bg-blue-500 text-white py-2 px-4 rounded button-disabled" disabled>Select Seat</button>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-[#0B1A8C] text-white px-6 py-8 select-none">
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs leading-relaxed">
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
                    <img alt="BCA bank logo" class="object-contain" height="30" src="{{ asset('img/footerBCA.jpg') }}" width="80"/>
                    <img alt="BRI bank logo" class="object-contain" height="30" src="{{ asset('img/footerBRI.jpg') }}" width="80"/>
                    <img alt="Mandiri bank logo" class="object-contain" height="30" src="{{ asset('img/footerMANDIRI.jpg') }}" width="80"/>
                    <img alt="BSI bank logo" class="object-contain" height="30" src="{{ asset('img/footerBSI.jpg') }}" width="80"/>
                    <img alt="Gopay logo" class="object-contain" height="30" src="{{ asset('img/footerCIMB.jpg') }}" width="80"/>
                    <img alt="BNI bank logo" class="object-contain" height="30" src="{{ asset('img/footerBNI.jpg') }}" width="80"/>
                </div>
            </div>
        </div>
        <hr class="border-gray-600 my-6"/>
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between text-xs space-y-3 sm:space-y-0">
            <div class="flex items-center space-x-2 font-extrabold text-white">
                <img alt="TixMeUp logo" class="w-6 h-6" height="24" src="{{ asset('img/logo.png') }}" width="24"/>
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
