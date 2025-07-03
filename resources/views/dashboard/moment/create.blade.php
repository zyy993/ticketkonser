<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Moment</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 4px; }
        button { margin-top: 20px; background-color: #4a6b8a; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #3a5570; }
        .error { color: red; font-size: 0.9rem; }
    </style>
</head>
<body>
    <h1>Upload Moment</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('moment.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="image">Moment Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>

    <p><a href="{{ route('dashboard.index') }}">← Back to Dashboard</a></p>
</body>
</html>
