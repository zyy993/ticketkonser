<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   TixMeUp Review &amp; Rating
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   /* Custom star color for rating */
    .star-yellow {
      color: #fbbf24;
    }
  </style>
 </head>
 <body class="bg-white font-sans text-gray-900">
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
  <main class="max-w-5xl mx-auto p-4 sm:p-6 md:p-8">
 <!-- Review & Rating Header -->
<!-- resources/views/user/review1.blade.php -->

<h3 class="text-2xl font-bold text-gray-900 text-center">Review & Rating</h3>


<section class="w-full max-w-5xl mx-auto mt-10 ">

    <div class="border border-gray-300 rounded-md flex flex-col md:flex-row md:space-x-6 p-4 mb-8" style="min-height: 120px">
        <!-- Review count -->
        <!-- Review count -->
<div class="flex-1 border-r border-gray-300 pr-6 mb-4 md:mb-0">
    <p class="font-semibold text-sm mb-1 select-none">Review count</p>
    <p class="font-extrabold text-3xl leading-none select-text">{{ number_format($totalReviews) }}</p>
    <p class="text-xs text-gray-500 mt-1 select-none">
        Total review from {{ number_format($totalReviews) }} people up to {{ now()->format('jS \o\f F Y') }}
    </p>
</div>

<!-- Average rating -->
<div class="flex-1 border-r border-gray-300 pr-6 mb-4 md:mb-0">
    <p class="font-semibold text-sm mb-1 select-none">Average rating</p>
    <div class="flex items-center space-x-2">
        <p class="font-extrabold text-3xl leading-none select-text">
            {{ number_format($averageRating, 1, ',', '.') }}
        </p>
        <div class="flex space-x-0.5">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= floor($averageRating))
                    <i class="fas fa-star star-yellow"></i>
                @elseif ($i - $averageRating < 1)
                    <i class="fas fa-star-half-alt star-yellow"></i>
                @else
                    <i class="far fa-star star-yellow"></i>
                @endif
            @endfor
        </div>
    </div>
    <p class="text-xs text-gray-500 mt-1 select-none">
        Based on {{ number_format($totalReviews) }} reviews
    </p>
</div>

        <!-- Rating distribution -->
        <div class="flex-1">
            <div class="flex items-center space-x-2 text-xs text-gray-600 mb-1 select-none">
                <span class="w-10 flex items-center justify-end space-x-1 text-right"><i class="fas fa-star star-yellow text-[10px]"></i><span>5</span></span>
                <div class="h-3 rounded-full bg-purple-600" style="width: 58%"></div>
                <span class="w-12 text-right">58,0%</span>
            </div>
            <div class="flex items-center space-x-2 text-xs text-gray-600 mb-1 select-none">
                <span class="w-10 flex items-center justify-end space-x-1 text-right"><i class="fas fa-star star-yellow text-[10px]"></i><span>4</span></span>
                <div class="h-3 rounded-full bg-purple-400" style="width: 31.7%"></div>
                <span class="w-12 text-right">31,7%</span>
            </div>
            <div class="flex items-center space-x-2 text-xs text-gray-600 mb-1 select-none">
                <span class="w-10 flex items-center justify-end space-x-1 text-right"><i class="fas fa-star star-yellow text-[10px]"></i><span>3</span></span>
                <div class="h-3 rounded-full bg-purple-300" style="width: 10.3%"></div>
                <span class="w-12 text-right">10,3%</span>
            </div>
            <div class="flex items-center space-x-2 text-xs text-gray-600 mb-1 select-none">
                <span class="w-10 flex items-center justify-end space-x-1 text-right"><i class="fas fa-star star-yellow text-[10px]"></i><span>2</span></span>
                <div class="h-3 rounded-full bg-purple-200" style="width: 1.3%"></div>
                <span class="w-12 text-right">1,3%</span>
            </div>
            <div class="flex items-center space-x-2 text-xs text-gray-600 select-none">
                <span class="w-10 flex items-center justify-end space-x-1 text-right"><i class="fas fa-star star-yellow text-[10px]"></i><span>1</span></span>
                <div class="h-3 rounded-full bg-purple-100" style="width: 0.1%"></div>
                <span class="w-12 text-right">0,1%</span>
            </div>
        </div>
    </div>

     <h3 class="text-2xl font-bold text-gray-900 text-center ">Give your review</h3>
    <section class="rounded-lg p-6 shadow-sm w-full max-w-3xl">


        <!-- Star Rating -->
        <form action="{{ route('reviews.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="flex justify-start mb-6 space-x-2 text-yellow-400 text-3xl cursor-pointer select-none" id="star-container">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="far fa-star" data-value="{{ $i }}"></i>
                @endfor
            </div>

            <input type="hidden" name="rating" id="rating" value="0">

            <!-- Review Form -->
            <div class="bg-white p-4 border border-gray-200 rounded-lg">
                <!-- Judul Ulasan -->
                <div class="mb-4 flex items-start">
                    <div class="w-32 flex justify-between font-semibold">
                        <span>Review title</span><span>:</span>
                    </div>
                    <input type="text" name="title" class="flex-1 border-none rounded mt-0 p-2 text-sm bg-transparent focus:outline-none" placeholder="Tuliskan judul untuk ulasanmu!" required />
                </div>

                <!-- Isi Ulasan -->
                <div class="mb-6 flex items-start">
                    <div class="w-32 flex justify-between font-semibold">
                        <span>Review</span><span>:</span>
                    </div>
                    <input type="text" name="body" class="flex-1 border-none rounded p-2 text-sm bg-transparent focus:outline-none" placeholder="Tuliskan ulasanmu" required />
                </div>
            </div>

            <!-- Tombol Kirim -->
            <div class="flex justify-end mt-6">
                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700" type="submit">Send</button>
            </div>
        </form>
    </section>
</section>

<script>
    const stars = document.querySelectorAll('#star-container i');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = parseInt(star.getAttribute('data-value'));
            ratingInput.value = value;
            stars.forEach(s => {
                s.classList.remove('fas');
                s.classList.add('far');
            });
            for (let i = 0; i < value; i++) {
                stars[i].classList.remove('far');
                stars[i].classList.add('fas');
            }
        });
    });
</script>



<!-- Reviews List -->
<section class="space-y-6">

  <!-- Judul Section -->
  <h3 class="text-2xl font-bold text-gray-900 text-center">Reviews from other users</h3>
  <!-- Review 1 -->
  @foreach ($reviews as $review)
<article class="flex space-x-4 mb-6">
  <div class="flex-shrink-0 flex flex-col items-center leading-none select-none">
    {{-- Bintang Rating --}}
    <div class="text-yellow-400 text-lg">
      @for ($i = 1; $i <= 5; $i++)
        <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
      @endfor
    </div>

    {{-- Nama User --}}
    <span class="mt-1 text-xs font-semibold text-black select-text">
      {{ $review->user->name ?? 'Anonim' }}
    </span>

    {{-- Tanggal --}}
    <time class="text-xs text-gray-500 mt-0.5 select-none">
      {{ \Carbon\Carbon::parse($review->created_at)->translatedFormat('d F Y') }}
    </time>
  </div>

  <div class="flex-1">
    {{-- Judul Review --}}
    <p class="text-sm mt-1 text-gray-900 select-text font-semibold">
      {{ $review->title }}
    </p>

    {{-- Isi Review --}}
    <p class="text-xs text-gray-600 mt-1 select-text">
      {{ $review->body }}

    </p>

    {{-- Tombol Like & Dislike --}}
    <div class="flex space-x-4 mt-3">
      <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-up"></i>
        <span>{{ $review->likes }}</span>
      </button>
      <button class="flex items-center space-x-1 text-gray-700 border border-gray-300 rounded px-3 py-1 text-xs select-none" type="button">
        <i class="far fa-thumbs-down"></i>
        <span>{{ $review->dislikes }}</span>
      </button>
    </div>
  </div>
</article>
@endforeach
    <!-- Review 3 -->
   </section>
      <div class="flex justify-end mt-8">
    <button class="flex items-center space-x-2 text-xs text-gray-700 border border-gray-300 rounded px-4 py-2 select-none" type="button">
     <span>
      More complete
     </span>
     <i class="fas fa-chevron-right">
     </i>
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
