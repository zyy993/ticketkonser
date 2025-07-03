<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   TixMeUp Email Verification
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Inter', sans-serif;
    }
  </style>
 </head>
 <body class="bg-[#02096e] text-white min-h-screen flex flex-col">
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
  <!-- Main content -->
  <main class="flex-grow flex flex-col items-center justify-center px-4 text-center relative" style="background-color: transparent;">
   <img alt="Digital globe with green glowing particles background" class="absolute inset-0 w-full h-full object-cover opacity-70 -z-10" height="400" src="{{ asset('img/bgsignup.jpg') }}" width="600"/>
   <h1 class="font-extrabold text-white text-xl sm:text-2xl md:text-3xl leading-tight max-w-md mx-auto">
    LET’S VERIFY YOUR EMAIL
   </h1>
   <p class="italic text-white text-xs sm:text-sm max-w-md mt-2 mx-auto px-2">
    We already send a code to your email, please check your inbox and insert the code in form below to verify our email
   </p>
   <form class="mt-6 max-w-md w-full px-4 sm:px-0">
    <div class="flex justify-center gap-4 mb-6">
     <input aria-label="Verification code digit 1" class="w-16 h-16 rounded-lg bg-white bg-opacity-80 text-black text-3xl font-semibold text-center focus:outline-none focus:ring-2 focus:ring-[#02096e]" inputmode="numeric" maxlength="1" pattern="[0-9]*" type="text"/>
     <input aria-label="Verification code digit 2" class="w-16 h-16 rounded-lg bg-white bg-opacity-80 text-black text-3xl font-semibold text-center focus:outline-none focus:ring-2 focus:ring-[#02096e]" inputmode="numeric" maxlength="1" pattern="[0-9]*" type="text"/>
     <input aria-label="Verification code digit 3" class="w-16 h-16 rounded-lg bg-white bg-opacity-80 text-black text-3xl font-semibold text-center focus:outline-none focus:ring-2 focus:ring-[#02096e]" inputmode="numeric" maxlength="1" pattern="[0-9]*" type="text"/>
     <input aria-label="Verification code digit 4" class="w-16 h-16 rounded-lg bg-white bg-opacity-80 text-black text-3xl font-semibold text-center focus:outline-none focus:ring-2 focus:ring-[#02096e]" inputmode="numeric" maxlength="1" pattern="[0-9]*" type="text"/>
    </div>
    <button class="w-full bg-[#607d9a] text-white font-semibold text-lg py-3 rounded-md hover:bg-[#506b85] transition-colors" type="submit">
     Verify
    </button>
   </form>
   <p class="italic text-white text-xs max-w-md mt-4 px-2">
    Don’t worry it’s only one time, once your email is verified you do not need to do this anymore
   </p>
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
