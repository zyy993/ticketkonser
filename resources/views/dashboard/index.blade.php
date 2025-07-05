<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard - All Sections</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 24px;
            background-color: #f4f6f9;
            color: #1f2937;
        }

        .back-wrapper {
            margin-bottom: 30px;
        }

        .back-button {
            display: inline-block;
            background: linear-gradient(to right, #0B1460, #4F8EF7);
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 9999px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }

        .back-button:hover {
            background: linear-gradient(to right, #09124d, #3a75dd);
        }

        .topbar {
            margin-bottom: 16px;
        }

        .topbar a {
            font-weight: 600;
            font-size: 0.95rem;
            color: #0B1460;
            background-color: #e8f0fe;
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }

        .topbar a:hover {
            background-color: #d0e3fd;
        }

        .success {
            background-color: #dcfce7;
            border: 1px solid #22c55e;
            color: #166534;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 500;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 40px 0 20px;
            border-left: 4px solid #0B1460;
            padding-left: 10px;
            color: #1e293b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 40px;
        }

        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #0B1460;
            color: white;
            font-size: 0.85rem;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        img {
            width: 80px;
            height: 45px;
            object-fit: cover;
            border-radius: 6px;
        }

        .delete {
            background-color: #dc2626;
            color: white;
            padding: 6px 12px;
            font-size: 0.8rem;
            font-weight: 500;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .delete:hover {
            background-color: #b91c1c;
        }

        .moments-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 40px;
        }

        .moment-card {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            padding: 12px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            text-align: center;
            width: 160px;
        }

        .moment-card img {
            width: 100%;
            height: 90px;
            border-radius: 8px;
            object-fit: cover;
            margin-bottom: 8px;
        }

        #deleteModal {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.4);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal-box {
            background: white;
            width: 90%;
            max-width: 400px;
            padding: 24px;
            border-radius: 12px;
            border-top: 5px solid #1d4ed8;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        .modal-box h2 {
            font-size: 1.2rem;
            font-weight: bold;
            color: #1d4ed8;
            margin-bottom: 10px;
        }

        .modal-box p {
            font-size: 0.95rem;
            color: #4b5563;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 20px;
        }

        .btn {
            padding: 8px 16px;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-cancel {
            background-color: #f3f4f6;
            color: #374151;
        }

        .btn-cancel:hover {
            background-color: #e5e7eb;
        }

        .btn-delete {
            background-color: #dc2626;
            color: white;
        }

        .btn-delete:hover {
            background-color: #b91c1c;
        }
    </style>
</head>
<body>
    <div class="back-wrapper">
        <a href="{{ route('dashboard.promotor') }}" class="back-button"><- Kembali ke Dashboard Promotor</a>
    </div>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <h1>Dashboard - Manage Events</h1>
    @include('dashboard._table', [ 'title' => 'Event', 'data' => $events, 'createRoute' => route('dashboard.create'), 'editRoute' => 'dashboard.edit', 'deleteRoute' => 'dashboard.destroy' ])

    <h1>Dashboard - Manage Horizon</h1>
    @include('dashboard._table', [ 'title' => 'Horizon', 'data' => $horizons, 'createRoute' => route('horizon.create'), 'editRoute' => 'horizon.edit', 'deleteRoute' => 'horizon.destroy' ])

    <h1>Dashboard - Manage Moment</h1>
    <div class="topbar">
        <a href="{{ route('moment.create') }}">+ Add New Moment</a>
    </div>

    <div class="moments-container">
        @forelse ($moments as $moment)
            <div class="moment-card">
                @if($moment->image_path)
                    <img src="{{ asset('storage/' . $moment->image_path) }}" alt="Moment">
                    <form action="{{ route('moment.destroy', $moment->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete">Delete</button>
                    </form>
                @else
                    <p>No Image</p>
                @endif
            </div>
        @empty
            <p>No moments found.</p>
        @endforelse
    </div>

    <div id="deleteModal">
        <div class="modal-box animate-fade-in">
            <h2>Konfirmasi Penghapusan</h2>
            <p>Apakah Anda yakin ingin menghapus data ini?</p>
            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeDeleteModal()">Batal</button>
                <button type="button" class="btn btn-delete" onclick="submitDeleteForm()">Hapus</button>
            </div>
        </div>
    </div>

    <script>
        let targetDeleteForm = null;

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('form.delete-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    targetDeleteForm = this;
                    document.getElementById('deleteModal').style.display = 'flex';
                });
            });
        });

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
            targetDeleteForm = null;
        }

        function submitDeleteForm() {
            if (targetDeleteForm) {
                targetDeleteForm.submit();
            }
        }
    </script>
</body>
</html>
