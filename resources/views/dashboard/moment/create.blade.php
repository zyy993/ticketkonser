<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Moment</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6fc;
      padding: 32px;
      max-width: 560px;
      margin: auto;
      color: #1e293b;
    }

    h1 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #0B1A8C;
      margin-bottom: 24px;
    }

    .form-wrapper {
      background: white;
      padding: 32px;
      border-radius: 20px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.05);
    }

    label {
      display: block;
      margin-top: 18px;
      font-weight: 600;
      color: #0B1A8C;
      font-size: 0.95rem;
    }

    input[type="file"] {
      width: 100%;
      margin-top: 8px;
      padding: 10px;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      background-color: #fff;
      transition: 0.2s;
    }

    input[type="file"]:focus {
      border-color: #4F8EF7;
      box-shadow: 0 0 0 2px rgba(79, 142, 247, 0.3);
      outline: none;
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

    ul {
      padding-left: 20px;
      margin-bottom: 16px;
    }

    ul li {
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
  </style>
</head>
<body>
  <div class="form-wrapper">
    <h1>Upload Moment</h1>

    @if ($errors->any())
      <ul>
        @foreach ($errors->all() as $error)
          <li class="error">⚠ {{ $error }}</li>
        @endforeach
      </ul>
    @endif

    <form action="{{ route('moment.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <label for="image">Moment Image:</label>
      <input type="file" name="image" id="image" accept="image/*" required>

      <button type="submit">Upload</button>
    </form>

    <a href="{{ route('dashboard.index') }}">← Back to Dashboard</a>
  </div>
</body>
</html>
