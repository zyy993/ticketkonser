<div class="topbar">
    <a href="{{ $createRoute }}">+ Add New {{ $title }}</a>
</div>

<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Penyanyi</th>
            <th>Date & Time</th>
            <th>Location</th>
            <th style="width:150px;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
            <tr>
                <td>
                    @if($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}">
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->penyanyi ?? '-' }}</td>
                <td>{{ $item->date ? \Carbon\Carbon::parse($item->date)->format('Y-m-d H:i') : '-' }}</td>
                <td>{{ $item->location ?? '-' }}</td>
                <td>
                    <a href="{{ route($editRoute, $item->id) }}">Edit</a>
                    <form action="{{ route($deleteRoute, $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure to delete this {{ $title }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No {{ $title }} data found.</td></tr>
        @endforelse
    </tbody>
</table>
