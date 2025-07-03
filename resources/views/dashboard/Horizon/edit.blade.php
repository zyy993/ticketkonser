<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Horizon Event</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; margin-top: 4px; }
        button { margin-top: 20px; background-color: #4a6b8a; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #3a5570; }
        .error { color: red; font-size: 0.9rem; }
        img { width: 150px; height: auto; margin-top: 10px; border-radius: 8px; }
        a { text-decoration: none; color: #4a6b8a; }
    </style>
</head>
<body>
    <h1>Edit Horizon Event</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('horizon.update', $horizon) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="image">Image (optional):</label>
        <input type="file" name="image" id="image" accept="image/*" />
        @if($horizon->image_path)
            <img src="{{ asset('storage/' . $horizon->image_path) }}" alt="{{ $horizon->name }}" />
        @endif

        <label for="name">Event Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $horizon->name) }}" required />

        <label for="penyanyi">Penyanyi:</label>
        <input type="text" name="penyanyi" id="penyanyi" value="{{ old('penyanyi', $horizon->penyanyi) }}" required />

        <label for="date">Tanggal & Waktu Acara:</label>
        <input type="datetime-local" name="date" id="date" value="{{ old('date', \Carbon\Carbon::parse($horizon->date)->format('Y-m-d\TH:i')) }}" required />

        <label for="gates_open">Gates Open (optional):</label>
        <input type="datetime-local" name="gates_open" id="gates_open" value="{{ old('gates_open', optional($horizon->gates_open)->format('Y-m-d\TH:i')) }}" />

        <label for="show_starts">Show Starts (optional):</label>
        <input type="datetime-local" name="show_starts" id="show_starts" value="{{ old('show_starts', optional($horizon->show_starts)->format('Y-m-d\TH:i')) }}" />

        <label for="expired_at">Expired At (optional):</label>
        <input type="datetime-local" name="expired_at" id="expired_at" value="{{ old('expired_at', optional($horizon->expired_at)->format('Y-m-d\TH:i')) }}" />

        <label for="location">Location:</label>
        <input type="text" name="location" id="location" value="{{ old('location', $horizon->location) }}" required />

        <label for="price">Harga Tiket:</label>
        <input type="number" name="price" id="price" value="{{ old('price', $horizon->price) }}" step="0.01" min="0" required />

        <label for="deskripsi">Deskripsi (optional):</label>
        <textarea name="deskripsi" id="deskripsi" rows="4">{{ old('deskripsi', $horizon->deskripsi) }}</textarea>

        <button type="submit">Update</button>
    </form>

    <p><a href="{{ route('dashboard.index') }}">Back to Dashboard</a></p>
</body>
</html>
