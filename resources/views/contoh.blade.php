<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>TixMeUp - Upload Poster & Seat Plan</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-white text-gray-800 font-inter">


  <header class="flex items-center justify-between h-16 bg-blue-800 text-white sticky top-0 z-50 px-6">
    <div class="flex items-center gap-4">
      <span class="flex items-center gap-2 text-2xl font-bold">
        <span class="material-icons text-3xl">theater_comedy</span>
        TixMeUp
      </span>
    </div>
    <div class="relative flex-1 max-w-md mx-6">
      <input type="search" aria-label="Search" placeholder="Search by artist or event" class="w-full h-9 rounded-full pl-4 pr-10 border-none outline-none" />
      <span class="material-icons absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-600 pointer-events-none">search</span>
    </div>
    <button class="flex items-center justify-center w-10 h-10 rounded-md bg-transparent text-white" aria-label="Filter options">
      <span class="material-icons">filter_list</span>
    </button>
  </header>


  <main class="flex-1 max-w-6xl mx-auto my-8 px-6 grid grid-cols-2 gap-12">
    <section class="w-full aspect-w-16 aspect-h-9 rounded-lg bg-gray-300 overflow-hidden shadow-md">
      <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ad78aa4c-b0b7-4924-925d-eaf4b3d9e852.png" alt="Poster preview" class="w-full h-full object-cover rounded-lg" />
    </section>

    <section class="flex flex-col">
      <h2 class="text-lg font-semibold mb-4">Masukkan Poster untuk ditampilkan pada event anda!!</h2>
      <div class="flex items-center gap-3 mb-5">
        <input type="file" id="posterUpload" class="border border-gray-400 rounded-lg p-2 cursor-pointer text-sm" />
      </div>
      <div class="flex gap-4 mb-8">
        <button class="flex-1 py-2 font-semibold text-white bg-blue-600 rounded-full hover:bg-blue-700">Confirm</button>
        <button class="flex-1 py-2 font-semibold text-white bg-gray-600 rounded-full hover:bg-gray-700">Cancelled</button>
      </div>
      <div class="bg-gray-100 rounded-lg border border-gray-300 p-4 flex flex-col gap-4">
        <div class="flex items-center gap-3">
          <label for="eventDate" class="material-icons text-gray-500">event</label>
          <input type="date" id="eventDate" name="eventDate" class="flex-1 border-none rounded-lg p-2" />
        </div>
        <div class="flex items-center gap-3">
          <label for="eventVenue" class="material-icons text-gray-500">location_on</label>
          <input type="text" id="eventVenue" name="eventVenue" placeholder="Masukkan Venue event" class="flex-1 border-none rounded-lg p-2" />
        </div>
        <div class="flex items-center gap-3">
          <label for="eventTime" class="material-icons text-gray-500">access_time</label>
          <input type="time" id="eventTime" name="eventTime" class="flex-1 border-none rounded-lg p-2" />
        </div>
      </div>
    </section>
  </main>


  <form class="flex flex-col max-w-3xl mx-auto mt-16">
    <div class="flex flex-col gap-6">
      <label for="seat-plan" class="block text-sm font-semibold mb-2">Masukkan Seat Plan dan Kategori Tiket anda!</label>
      <button type="button" class="flex-1 border border-gray-400 rounded-lg bg-white aspect-w-4 aspect-h-3 flex items-center justify-center cursor-pointer">
        <span class="material-icons text-6xl text-gray-600">add</span>
      </button>
    </div>

    <div class="flex flex-col gap-3 mt-6">
      <input type="text" class="bg-gray-200 border-none rounded-lg p-3 text-gray-600 italic font-semibold" placeholder="Masukkan kategori Seat Plan dan tiket" />
      <input type="text" class="bg-gray-200 border-none rounded-lg p-3 text-gray-600 italic font-semibold" placeholder="Masukkan kategori Seat Plan dan tiket" />
      <input type="text" class="bg-gray-200 border-none rounded-lg p-3 text-gray-600 italic font-semibold" placeholder="Masukkan kategori Seat Plan dan tiket" />
      <input type="text" class="bg-gray-200 border-none rounded-lg p-3 text-gray-600 italic font-semibold" placeholder="Masukkan kategori Seat Plan dan tiket" />
      <button type="button" class="flex items-center bg-gray-200 rounded-lg p-3 text-gray-600 font-semibold gap-2">
        <span class="material-icons">add</span> Tambah kategori
      </button>
    </div>
  </form>


  <label for="event-description" class="block text-sm font-semibold mt-8 mb-2">Masukkan Deskripsi Event!</label>
  <textarea id="event-description" class="w-full max-w-3xl min-h-[140px] border border-gray-400 rounded-lg p-4 resize-y" aria-label="Masukkan Deskripsi Event"></textarea>


  <div class="max-w-3xl mx-auto text-right mt-6">
    <button type="submit" class="bg-blue-600 text-white font-semibold py-3 px-8 rounded-full hover:bg-blue-700">Confirm</button>
  </div>

</body>
</html>
