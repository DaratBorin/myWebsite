@extends('admin.layout')
@section('title', 'Menu Items')
@section('breadcrumb', 'Menu Items')

@section('content')
<div class="page-head">
    <div>
        <h1>Menu Items</h1>
        <div class="subtitle">{{ $items->total() }} total items</div>
    </div>
    <a href="{{ route('admin.menu-items.create') }}" class="action-btn btn-gold">+ Add Item</a>
</div>

<div class="card">
    <div style="overflow-x:auto">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:0.75rem">
                        @if($item->image)
                        <img src="{{ Storage::url($item->image) }}" style="width:45px;height:45px;object-fit:cover;border-radius:2px">
                        @else
                        <div style="width:45px;height:45px;background:#F8F4ED;display:flex;align-items:center;justify-content:center;font-size:1.2rem;border-radius:2px">🍽️</div>
                        @endif
                        <div>
                            <div style="font-weight:500">{{ $item->name }}</div>
                            @if($item->description)
                            <div style="font-size:0.72rem;color:#8A7D6B">{{ Str::limit($item->description, 50) }}</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td>{{ $item->category->name ?? '—' }}</td>
                <td style="color:#C9A84C;font-weight:500">{{ $item->formatted_price }}</td>
                <td>
                    @if($item->available)
                    <span class="badge badge-confirmed">Available</span>
                    @else
                    <span class="badge badge-cancelled">Unavailable</span>
                    @endif
                </td>
                <td>
                    @if($item->featured)
                    <span class="badge badge-paid">⭐ Featured</span>
                    @else
                    <span style="color:#8A7D6B;font-size:0.78rem">—</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex;gap:0.5rem">
                        <a href="{{ route('admin.menu-items.edit', $item) }}" class="action-btn btn-primary">Edit</a>
                        <form action="{{ route('admin.menu-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this item?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;padding:3rem;color:#8A7D6B">No menu items yet</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
<div style="margin-top:1.5rem">{{ $items->links() }}</div>
@endsection