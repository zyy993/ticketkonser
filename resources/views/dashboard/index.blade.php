<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard - All Sections</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 24px;
            background-color: #f9fafb;
            color: #333;
        }

        .back-button {
            position: fixed;
            top: 24px;
            left: 24px;
            background-color: #4a6b8a;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .back-button:hover {
            background-color: #3a5570;
        }

        .topbar {
            margin-bottom: 16px;
        }

        .topbar a {
            font-weight: bold;
            font-size: 1rem;
            color: #2563eb;
            text-decoration: none;
            background-color: #e0ecff;
            padding: 8px 14px;
            border-radius: 6px;
        }

        .topbar a:hover {
            background-color: #c7dcff;
        }

        .success {
            background-color: #dcfce7;
            border: 1px solid #22c55e;
            color: #166534;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-weight: 500;
        }

        h1 {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 60px 0 20px;
            border-left: 4px solid #4a6b8a;
            padding-left: 10px;
            color: #1f2937;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 40px;
        }

        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #4a6b8a;
            color: white;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: #f3f4f6;
        }

        img {
            width: 80px;
            height: 45px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .delete {
            background-color: #dc2626;
            color: white;
            padding: 6px 12px;
            font-size: 0.8rem;
            font-weight: 500;
            border: none;
            border-radius: 5px;
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
            padding: 14px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
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

        /* Modal */
        .hidden {
            display: none !important;
        }

        @keyframes fade-in {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
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

        #deleteModal .modal-box {
            background: white;
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

    <!-- Modal -->
    <div id="deleteModal">
        <div class="modal-box animate-fade-in">
            <h2>Konfirmasi Penghapusan</h2>
            <p>Apakah Anda yakin ingin menghapus data ini?</p>
            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeDeleteModal()">Batal</button>
                <button type="button" class="btn btn-delete" onclick="submitDeleteForm()">
                    <i class="fas fa-trash-alt"></i> Hapus
                </button>
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
