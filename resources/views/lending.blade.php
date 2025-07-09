<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   TixMeUp
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Montserrat', sans-serif;
    }
    html {
    scroll-behavior: smooth;
  }
  </style>
 </head>
 <body class="bg-white text-gray-900 scroll-smooth">
<!-- Navbar -->
<nav class="bg-[#00108b] flex items-center justify-between px-6 py-2 h-[57px]">
    <div class="flex items-center space-x-2 min-w-[840px]">
        <img alt="TixMeUp logo with hand gesture icon in white on blue background" class="w-8 h-8" src="{{ asset('img/logo.png') }}" />

        <span class="text-white font-semibold text-lg select-none">TixMeUpccccc</span>
    </div>
           <!-- FORM -->
        <form class="relative flex items-center max-w-[400px] w-full">
            <input
            type="text"
            name="q"
            placeholder="Search by artist"
            class="w-full h-8 rounded-full bg-[#00108b] placeholder-white text-white pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-white relative top-[7px]"
            />
            <i class="fas fa-search absolute left-3 top-[70%] -translate-y-1/2 text-white text-sm"></i>
        </form>
        @if(session('not_found'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                {{ session('not_found') }}
            </div>
        @endif
    <div class="flex items-center space-x-3 min-w-[180px] justify-end">
        <!-- Sign In & Sign Up Buttons -->
        <a href="/signin"
   class="text-white border border-white px-4 py-1.5 rounded-full text-xs hover:bg-white hover:text-[#00108b] transition duration-200 ease-in-out">
   Sign In
</a>

        <a href="/signup"
        class="text-white border border-white px-4 py-1.5 rounded-full text-xs hover:bg-white hover:text-[#00108b] transition duration-200 ease-in-out">
        Sign Up
        </a>
</nav>
  <!-- Carousel -->
 <div
  x-data="{
    images: [
      '{{ asset('img/Blackpink.png') }}',
      '{{ asset('img/oppah.jpg') }}',
      '{{ asset('img/jini2.jpg') }}',
      '{{ asset('img/lissa.png') }}'
    ],
    activeIndex: 0,
    next() { this.activeIndex = (this.activeIndex + 1) % this.images.length },
    prev() { this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length },
    autoplay() {
      setInterval(() => { this.next() }, 3000);
    }
  }"
  x-init="autoplay()"
  class="relative border-b border-[#00108b] h-[250px] overflow-hidden"
>
  <!-- Image Slides -->
  <template x-for="(image, index) in images" :key="index">
    <img
      x-show="activeIndex === index"
      x-transition
      x-cloak
      :src="image"
      class="absolute inset-0 w-full h-[250px] object-cover"
    />
  </template>

  <!-- Previous Button -->
  <button
    @click="prev"
    aria-label="Previous slide"
    class="absolute top-1/2 left-2 -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-80 rounded-full p-2 text-2xl text-[#00108b]"
  >
    <i class="fas fa-chevron-left"></i>
  </button>

  <!-- Next Button -->
  <button
    @click="next"
    aria-label="Next slide"
    class="absolute top-1/2 right-2 -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-80 rounded-full p-2 text-2xl text-[#00108b]"
  >
    <i class="fas fa-chevron-right"></i>
  </button>
</div>


<!-- Filter Buttons -->
<div class="flex space-x-4 px-6 py-4">
  <a href="#this-month">
    <button class="border border-[#00108b] rounded-full px-6 py-3 text-lg font-bold text-[#00108b] hover:bg-[#00108b] hover:text-white transition">
      This Month
    </button>
  </a>
  <a href="#upcoming">
    <button class="border border-[#00108b] rounded-full px-6 py-3 text-lg font-bold text-[#00108b] hover:bg-[#00108b] hover:text-white transition">
      Upcoming
    </button>
  </a>
  <a href="#moments">
    <button class="border border-[#00108b] rounded-full px-6 py-3 text-lg font-bold text-[#00108b] hover:bg-[#00108b] hover:text-white transition">
      Moment's
    </button>
  </a>
</div>

  <main class="px-6 pb-8 max-w-[1200px] mx-auto">
    <!-- THIS MONTH's SPOTLIGHT -->
    <section class="mb-8" id="this-month">


      <h2 class="text-3xl font-bold mb-4 select-none">THIS MONTH’s SPOTLIGHT</h2>
      <div class="flex items-center space-x-4 overflow-x-auto scrollbar-hide">

@foreach ($contents as $content)
    <div class="min-w-[370px] bg-white border border-gray-200 rounded-lg shadow-sm flex-shrink-">
        @if($content->image_path)
            <img src="{{ asset('storage/' . $content->image_path) }}" alt="{{ $content->name }}" class="rounded-t-lg object-cover w-full h-[140px]" />
        @else
            <img src="https://placehold.co/280x140?text=No+Image" alt="No Image" />
        @endif
        <div class="p-3">
            <p class="text-xs font-semibold mb-1 select-none">{{ $content->name }}</p>
            <div class="flex items-center text-xs text-gray-500 space-x-1 mb-2 select-none">
                <i class="fas fa-calendar-alt"></i>
                <span>{{ \Carbon\Carbon::parse($content->date)->format('H.i') }}</span>
                <i class="fas fa-map-marker-alt ml-3"></i>
                <span>{{ $content->location }}</span>
            </div>

  <button class="bg-[#4a6b8a] text-white text-xs rounded px-3 py-1 hover:bg-[#3a5570] transition">More info</button>


        </div>
    </div>
@endforeach
        <!-- Card 1 -->
          </div>
        </div>
      </div>
    </section>
    <!-- ON THE HORIZON -->
 <section class="mb-8" id="upcoming">

  <h2 class="text-3xl font-bold mb-4 select-none">ON THE HORIZON !!!</h2>
  <div class="flex items-center space-x-4 overflow-x-auto scrollbar-hide">
    {{-- Debug --}}


   @forelse ($horizons as $horizon)
  <div class="min-w-[370px] bg-white border border-gray-200 rounded-lg shadow-sm flex-shrink-0">
    <img
      alt="{{ $horizon->title }}"
      class="rounded-t-lg object-cover w-full h-[140px]"
      height="140"
      width="280"
      src="{{ asset('storage/' . $horizon->image_path) }}"
    />
    <div class="p-3">
      <p class="text-xs font-semibold mb-1 select-none">{{ $horizon->title }}</p>
      <div class="flex items-center text-xs text-gray-500 space-x-1 mb-2 select-none">
        <i class="fas fa-calendar-alt"></i>
        <span>{{ $horizon->jam }}</span>
        <i class="fas fa-map-marker-alt ml-3"></i>
        <span>{{ $horizon->lokasi }}</span>
      </div>

        <button class="bg-[#4a6b8a] text-white text-xs rounded px-3 py-1 hover:bg-[#3a5570] transition" type="button">
  More Info
</button>


    </div>
  </div>
@empty
  <p class="text-sm text-gray-600">Tidak ada data horizon untuk saat ini.</p>
@endforelse
  </div>
</section>

  </main>
  <!-- Moments We Loved -->
 <section class="bg-[#0B1A8C] mt-12 py-8" id="moments">
   <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-10">
      <h2 class="text-white font-semibold text-lg sm:text-xl mb-6 select-none">
         Moments We Loved
      </h2>
      <div class="grid grid-cols-3 gap-4">
         @forelse ($moments as $moment)
            <img
               alt="Moment"
               class="rounded-lg object-cover w-full h-[130px]"
               height="200"
               width="300"
               src="{{ asset('storage/' . $moment->image_path) }}"
            />
         @empty
            <p class="text-white col-span-3 text-center">Belum ada moment yang tersedia.</p>
         @endforelse
      </div>
   </div>
   <!-- Live Chat Bubble (Link to Live Chat Page) -->

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
