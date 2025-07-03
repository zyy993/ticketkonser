<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Moment</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 4px; }
        button { margin-top: 20px; background-color: #4a6b8a; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #3a5570; }
        img { margin-top: 15px; width: 200px; border-radius: 6px; }
        .error { color: red; font-size: 0.9rem; }
        a { display: inline-block; margin-top: 20px; text-decoration: none; color: #4a6b8a; }
    </style>
</head>
<body>
    <h1>Edit Moment</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('moment.update', $moment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="image">Replace Image:</label>
        <input type="file" name="image" id="image" accept="image/*">

        @if($moment->image_path)
            <p>Current Image:</p>
            <img src="{{ asset('storage/' . $moment->image_path) }}" alt="Moment Image">
        @endif

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('dashboard.index') }}">← Back to Dashboard</a>
</body>
</html>
