<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Create Event</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      padding: 32px;
      max-width: 760px;
      margin: auto;
      background-color: #f4f6fc;
      color: #1e293b;
    }

    h1 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #0B1A8C;
      margin-bottom: 24px;
    }

    label {
      display: block;
      margin-top: 18px;
      font-weight: 600;
      color: #0B1A8C;
      font-size: 0.95rem;
    }

    input,
    textarea {
      width: 100%;
      padding: 10px 14px;
      margin-top: 6px;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      font-size: 0.95rem;
      transition: 0.2s;
      background: #fff;
    }

    input:focus,
    textarea:focus {
      outline: none;
      border-color: #4F8EF7;
      box-shadow: 0 0 0 2px rgba(79, 142, 247, 0.3);
    }

    button {
      margin-top: 28px;
      background: linear-gradient(to right, #0B1A8C, #4F8EF7);
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 9999px;
      font-weight: 600;
      font-size: 0.95rem;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: linear-gradient(to right, #092279, #3a75dd);
    }

    .error {
      color: #dc2626;
      font-size: 0.875rem;
      margin-top: 4px;
    }

    a {
      display: inline-block;
      margin-top: 24px;
      color: #4F8EF7;
      text-decoration: none;
      font-weight: 600;
    }

    a:hover {
      text-decoration: underline;
    }

    ul {
      padding-left: 20px;
      margin-bottom: 16px;
    }

    ul li {
      margin-top: 4px;
    }

    .form-wrapper {
      background: white;
      padding: 32px;
      border-radius: 20px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.05);
    }
  </style>
</head>
<body>
  <div class="form-wrapper">
    <h1>Create New Event</h1>

    @if ($errors->any())
      <div>
        <ul>
          @foreach ($errors->all() as $error)
            <li class="error">⚠ {{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <label for="image">Image (optional):</label>
      <input type="file" name="image" id="image" accept="image/*" />

      <label for="name">Event Name:</label>
      <input type="text" name="name" id="name" value="{{ old('name') }}" required />

      <label for="penyanyi">Penyanyi:</label>
      <input type="text" name="penyanyi" id="penyanyi" value="{{ old('penyanyi') }}" required />

      <label for="date">Tanggal & Waktu Acara:</label>
      <input type="datetime-local" name="date" id="date" value="{{ old('date') }}" required />

      <label for="gates_open">Gates Open (optional):</label>
      <input type="datetime-local" name="gates_open" id="gates_open" value="{{ old('gates_open') }}" />

      <label for="show_starts">Show Starts (optional):</label>
      <input type="datetime-local" name="show_starts" id="show_starts" value="{{ old('show_starts') }}" />

      <label for="expired_at">Expired At (optional):</label>
      <input type="datetime-local" name="expired_at" id="expired_at" value="{{ old('expired_at') }}" />

      <label for="location">Location:</label>
      <input type="text" name="location" id="location" value="{{ old('location') }}" required />

      <label for="price">Harga Tiket:</label>
      <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" required />

      <label for="deskripsi">Deskripsi (optional):</label>
      <textarea name="deskripsi" id="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>

      <button type="submit">Save</button>
    </form>

    <a href="{{ route('dashboard.index') }}">← Back to Dashboard</a>
  </div>
</body>
</html>
