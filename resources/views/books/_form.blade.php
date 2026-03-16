@if($errors->any())
    <div class="alert alert-error">
        <ul style="list-style:none; margin:0; padding:0;">
            @foreach($errors->all() as $error)<li>✕ {{ $error }}</li>@endforeach
        </ul>
    </div>
@endif

<div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
    <div class="form-group">
        <label class="form-label">Title</label>
        <input type="text" name="title" value="{{ old('title', $book->title ?? '') }}" class="form-input">
    </div>
    <div class="form-group">
        <label class="form-label">Author</label>
        <input type="text" name="author" value="{{ old('author', $book->author ?? '') }}" class="form-input">
    </div>
    <div class="form-group">
        <label class="form-label">ISBN</label>
        <input type="text" name="isbn" value="{{ old('isbn', $book->isbn ?? '') }}" class="form-input">
    </div>
    <div class="form-group">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-input form-select">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label class="form-label">Quantity</label>
        <input type="number" name="quantity" value="{{ old('quantity', $book->quantity ?? 0) }}" min="0" class="form-input">
    </div>
    <div class="form-group" style="grid-column:span 2;">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-input form-textarea" maxlength="1000">{{ old('description', $book->description ?? '') }}</textarea>
    </div>
</div>