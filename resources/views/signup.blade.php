<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>TixMeUp Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet"
  />
  <link href="https://fonts.googleapis.com/css2?family=Inter&amp;display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-[#0B1A8C] flex flex-col min-h-screen">
  <!-- Navbar -->
  <nav class="bg-[#0B1A8C] flex items-center px-4 py-3 border-b border-[#0B1A8C]">
    <img
      alt="TixMeUp logo hand sign in white on blue background"
      class="w-8 h-8 mr-2"
      height="32"
      src="{{ asset('img/logo.png') }}"
      width="32"
    />
    <span class="text-white font-extrabold text-lg select-none">TixMeUp</span>
  </nav>

  <!-- Main content with background image from Laravel asset -->
  <main class="flex-grow flex flex-col items-center justify-center px-4 py-10 relative">
  <img
    alt="Background image showing glowing headphones and globe digital background with greenish particles on black"
    class="absolute inset-0 w-full h-full object-cover -z-10"
    src="{{ asset('img/bgsignup.jpg') }}"
  />

  <form
    action="{{ route('register.with.otp') }}"
    method="POST"
    aria-label="Sign Up Form"
    class="relative w-full max-w-md flex flex-col items-center space-y-3 px-6 py-8 bg-transparent"
  >
    @csrf

    <h2 class="text-white font-bold text-xl mb-4 select-none z-10">Sign Up</h2>

    {{-- Name --}}
    <input
      class="w-full rounded-lg bg-[#E5E7EB] bg-opacity-80 placeholder-gray-400 text-gray-700 py-2 px-4 text-sm focus:outline-none z-10"
      placeholder="Name"
      type="text"
      name="name"
      required
    />

    {{-- Email --}}
    <input
      class="w-full rounded-lg bg-[#E5E7EB] bg-opacity-80 placeholder-gray-400 text-gray-700 py-2 px-4 text-sm focus:outline-none z-10"
      placeholder="Email"
      type="email"
      name="email"
      required
    />

    {{-- No HP --}}
    <input
      class="w-full rounded-lg bg-[#E5E7EB] bg-opacity-80 placeholder-gray-400 text-gray-700 py-2 px-4 text-sm focus:outline-none z-10"
      placeholder="No HP"
      type="text"
      name="no_hp"
      required
    />

    {{-- Password --}}
    <input
      class="w-full rounded-lg bg-[#E5E7EB] bg-opacity-80 placeholder-gray-400 text-gray-700 py-2 px-4 text-sm focus:outline-none z-10"
      placeholder="Password"
      type="password"
      name="password"
      required
    />

    <button
      class="w-full rounded-md bg-[#4F6D8C] text-white font-semibold py-2 text-sm hover:bg-[#3e5670] transition-colors z-10"
      type="submit"
    >
      Sign Up
    </button>
  </form>
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
