@extends('admin.layout')
@section('title', 'Add Menu Item')
@section('breadcrumb', 'Menu Items › Add')

@section('content')
<div class="page-head">
    <div>
        <h1>Add Menu Item</h1>
        <div class="subtitle">Create a new dish or beverage</div>
    </div>
    <a href="{{ route('admin.menu-items.index') }}" class="action-btn btn-primary">← Back</a>
</div>

<div style="max-width:800px">
<form action="{{ route('admin.menu-items.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header"><h3>Item Details</h3></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Name *</label>
                <input type="text" name="name" class="form-input" required value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-input" rows="3" style="resize:vertical">{{ old('description') }}</textarea>
            </div>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <select name="category_id" class="form-select" required style="width:100%">
                        <option value="">Select category</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id?'selected':'' }}>{{ $cat->icon }} {{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Price (USD) *</label>
                    <input type="number" name="price" class="form-input" step="0.01" min="0" required value="{{ old('price') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-input" accept="image/*" style="padding:0.4rem">
            </div>
            <div style="display:flex;gap:2rem;flex-wrap:wrap;margin-top:0.5rem">
                @foreach(['available'=>'Available','featured'=>'Featured','vegetarian'=>'Vegetarian','vegan'=>'Vegan','gluten_free'=>'Gluten Free'] as $field => $label)
                <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;font-size:0.82rem">
                    <input type="checkbox" name="{{ $field }}" value="1" {{ old($field)?'checked':($field==='available'?'checked':'') }}>
                    {{ $label }}
                </label>
                @endforeach
            </div>
        </div>
    </div>
    <button type="submit" class="action-btn btn-gold" style="padding:0.75rem 2rem">Create Item</button>
</form>
</div>
@endsection