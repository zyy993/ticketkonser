<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

    body {
      font-family: 'Inter', sans-serif;
    }

    /* Scrollbar Customization */
    ::-webkit-scrollbar {
      width: 8px;
    }
    ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 10px;
    }
  </style>
</head>
<body class="bg-gray-100 tracking-normal">

  <!-- Layout Wrapper -->
  <div class="flex flex-col md:flex-row min-h-screen">

    <!-- Sidebar -->
    <div class="w-full md:w-64 bg-white shadow-lg h-auto md:h-screen fixed md:relative z-10">
      <div class="p-6 text-xl font-bold text-indigo-700 flex items-center space-x-2 border-b border-gray-200">
        <div class="w-10 h-10 rounded-full border-2 border-indigo-700 flex items-center justify-center bg-white">
          <img src="{{ asset('img/logo2.png') }}" alt="TixMeUp Logo" class="w-6 h-6">
        </div>
        <span>TixMeUp</span>
      </div>
      <nav class="mt-6 space-y-2 px-4">
        <a href="#" class="flex items-center py-2 px-4 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 rounded-lg transition">
          <span>Dashboard</span>
        </a>
        <a href="{{ route('dashboard.index') }}" class="flex items-center py-2 px-4 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 rounded-lg transition">
          <span>Events</span>
        </a>
        <a href="/mysales" class="flex items-center py-2 px-4 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 rounded-lg transition">
          <span>Tickets</span>
        </a>
        <a href="{{ route('home.tampil') }}" class="flex items-center py-2 px-4 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 rounded-lg transition">
          <span>Preview</span>
        </a>
        <a href="#" id="logoutButton" class="flex items-center py-2 px-4 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 rounded-lg transition">
             <span>Logout</span>
        </a>
      </nav>
    </div>

     <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>
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

    const logoutButton = document.getElementById('logoutButton');
    const logoutForm = document.getElementById('logoutForm');
    const logoutConfirmation = document.getElementById('logoutConfirmation');
    const yesButton = document.querySelector('#logoutConfirmation button.bg-blue-500'); // tombol YES
    const noButton = document.querySelector('#logoutConfirmation button.bg-gray-400'); // tombol NO

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
</script>


    <!-- Main Content -->
    <div class="flex-1 ml-0 md:ml-64 p-6 bg-gray-100">

      <!-- Header -->
      <div class="mb-6 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white p-6 rounded-xl shadow-md">
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <p class="text-indigo-100 mt-1">Selamat Datang di Dashboard</p>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition">
          <p class="text-gray-500">Total Events</p>
          <h2 class="text-3xl font-semibold text-indigo-600">{{ $totalEvents }}</h2>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition">
          <p class="text-gray-500">Tickets Sold</p>
          <h2 class="text-3xl font-semibold text-indigo-600">{{ $ticketsSold }}</h2>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition">
          <p class="text-gray-500">Revenue</p>
         <h2 class="text-3xl font-semibold text-green-600">
  Rp {{ number_format($totalRevenue, 0, ',', '.') }}
</h2>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition">
          <p class="text-gray-500">Users</p>
          <h2 class="text-3xl font-semibold text-blue-600">{{ $totalUsers }}</h2>
        </div>
      </div>

      <!-- Latest Orders Table -->
      <div class="mt-10 bg-white rounded-xl shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold text-gray-800">Latest Orders</h2>
          <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
            View All
          </button>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-gray-50 border-b text-sm text-gray-600">
                <th class="py-2 px-4">User</th>
                <th class="py-2 px-4">Event</th>
                <th class="py-2 px-4">Ticket</th>
                <th class="py-2 px-4">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($latestOrders as $order)
              <tr class="border-b hover:bg-gray-50 text-sm">
                <td class="py-2 px-4">{{ $order->user->name ?? 'Guest' }}</td>
                <td class="py-2 px-4">{{ $order->ticket->event->name ?? '-' }}</td>
                <td class="py-2 px-4">{{ $order->ticket->zone ?? 'General' }}</td>
                <td class="py-2 px-4">
                  <span class="font-semibold
                    {{ $order->status === 'paid' ? 'text-green-600' :
                       ($order->status === 'pending' ? 'text-yellow-500' : 'text-red-500') }}">
                    {{ ucfirst($order->status) ?? 'Unknown' }}
                  </span>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center text-gray-400 py-4">No orders found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
