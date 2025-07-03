<!-- resources/views/dashboard/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Event</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 700px; margin: auto; background-color: #f8f9fa; }
        label { display: block; margin-top: 10px; font-weight: bold; color: #333; }
        input, textarea { width: 100%; padding: 8px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px; }
        button {
            margin-top: 20px;
            background-color: #4a6b8a;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover { background-color: #3a5570; }
        .error { color: red; font-size: 0.9rem; }
        a { text-decoration: none; color: #4a6b8a; }
        img.preview { margin-top: 8px; max-height: 100px; border: 1px solid #ccc; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Edit Event</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="image">Image (optional):</label>
        <input type="file" name="image" id="image" accept="image/*" />
        @if ($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="preview">
        @endif

        <label for="name">Event Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $event->name) }}" required />

        <label for="penyanyi">Penyanyi:</label>
        <input type="text" name="penyanyi" id="penyanyi" value="{{ old('penyanyi', $event->penyanyi) }}" required />

        <label for="date">Tanggal & Waktu Acara:</label>
        <input type="datetime-local" name="date" id="date" value="{{ old('date', \Carbon\Carbon::parse($event->date)->format('Y-m-d\TH:i')) }}" required />

        <label for="gates_open">Gates Open (optional):</label>
        <input type="datetime-local" name="gates_open" id="gates_open" value="{{ old('gates_open', $event->gates_open ? \Carbon\Carbon::parse($event->gates_open)->format('Y-m-d\TH:i') : '') }}" />

        <label for="show_starts">Show Starts (optional):</label>
        <input type="datetime-local" name="show_starts" id="show_starts" value="{{ old('show_starts', $event->show_starts ? \Carbon\Carbon::parse($event->show_starts)->format('Y-m-d\TH:i') : '') }}" />

        <label for="expired_at">Expired At (optional):</label>
        <input type="datetime-local" name="expired_at" id="expired_at" value="{{ old('expired_at', $event->expired_at ? \Carbon\Carbon::parse($event->expired_at)->format('Y-m-d\TH:i') : '') }}" />

        <label for="location">Location:</label>
        <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}" required />

        <label for="price">Harga Tiket:</label>
        <input type="number" name="price" id="price" value="{{ old('price', $event->price) }}" step="0.01" min="0" required />

        <label for="deskripsi">Deskripsi (optional):</label>
        <textarea name="deskripsi" id="deskripsi" rows="4">{{ old('deskripsi', $event->deskripsi) }}</textarea>

        <button type="submit">Update</button>
    </form>

    <p><a href="{{ route('dashboard.index') }}">← Back to Dashboard</a></p>
</body>
</html>
