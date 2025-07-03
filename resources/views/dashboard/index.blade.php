<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard - All Sections</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9fafb;
            position: relative;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #4a6b8a;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .back-button:hover {
            background-color: #3a5570;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background: white;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #4a6b8a;
            color: white;
        }

        tr:nth-child(even) {
            background: #f3f4f6;
        }

        a {
            color: #4a6b8a;
            text-decoration: none;
            margin-right: 12px;
        }

        a:hover {
            text-decoration: underline;
        }

        .success {
            background: #daf5d8;
            border: 1px solid #34a853;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        button.delete {
            background-color: #dc2626;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button.delete:hover {
            background-color: #b91c1c;
        }

        img {
            width: 80px;
            height: 45px;
            object-fit: cover;
            border-radius: 4px;
        }

        .topbar {
            margin-bottom: 20px;
        }

        .topbar a {
            font-weight: bold;
            font-size: 1.1rem;
        }

        h1 {
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <a href="{{ route('dashboard.promotor') }}" class="back-button">← Kembali</a>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <h1>Dashboard - Manage Events</h1>
    @include('dashboard._table', [
        'title' => 'Event',
        'data' => $events,
        'createRoute' => route('dashboard.create'),
        'editRoute' => 'dashboard.edit',
        'deleteRoute' => 'dashboard.destroy'
    ])

    <h1>Dashboard - Manage Horizon</h1>
    @include('dashboard._table', [
        'title' => 'Horizon',
        'data' => $horizons,
        'createRoute' => route('horizon.create'),
        'editRoute' => 'horizon.edit',
        'deleteRoute' => 'horizon.destroy'
    ])

    <h1>Dashboard - Manage Moment</h1>
    <div class="topbar">
        <a href="{{ route('moment.create') }}">+ Add New Moment</a>
    </div>
    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        @forelse ($moments as $moment)
            <div style="text-align: center;">
                @if($moment->image_path)
                    <img src="{{ asset('storage/' . $moment->image_path) }}" width="150" style="border-radius: 6px;">
                    <form action="{{ route('moment.destroy', $moment->id) }}" method="POST" onsubmit="return confirm('Delete this moment?');" style="margin-top: 8px;">
                        @csrf
                        @method('DELETE')
                        <button class="delete">Delete</button>
                    </form>
                @else
                    <p>No Image</p>
                @endif
            </div>
        @empty
            <p>No moments found.</p>
        @endforelse
    </div>
</body>
</html>
