@if($errors->any())
    <div class="alert alert-error">
        <ul style="list-style:none; margin:0; padding:0;">
            @foreach($errors->all() as $error)<li>✕ {{ $error }}</li>@endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" class="form-input">
</div>
<div class="form-group">
    <label class="form-label">Description <span style="color:#94a3b8; font-weight:400;">(optional)</span></label>
    <textarea name="description" class="form-input form-textarea" maxlength="1000">{{ old('description', $category->description ?? '') }}</textarea>
</div>