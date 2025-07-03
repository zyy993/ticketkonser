<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>TixMeUp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
  <style>

    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-white">
  <!-- Navbar -->
  @include('layout.navbar') <!-- Menyertakan navbar yang terpisah -->

  <!-- Konten Halaman -->
  @yield('content')

  <!-- Footer -->
   @include('layout.footer')
</body>
</html>
