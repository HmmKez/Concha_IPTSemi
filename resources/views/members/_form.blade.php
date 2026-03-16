@if($errors->any())
    <div class="alert alert-error">
        <ul style="list-style:none; margin:0; padding:0;">
            @foreach($errors->all() as $error)<li>✕ {{ $error }}</li>@endforeach
        </ul>
    </div>
@endif

<div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
    <div class="form-group">
        <label class="form-label">First Name</label>
        <input type="text" name="first_name" value="{{ old('first_name', $member->first_name ?? '') }}" class="form-input">
    </div>
    <div class="form-group">
        <label class="form-label">Last Name</label>
        <input type="text" name="last_name" value="{{ old('last_name', $member->last_name ?? '') }}" class="form-input">
    </div>
    <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email', $member->email ?? '') }}" class="form-input">
    </div>
    <div class="form-group">
        <label class="form-label">Phone <span style="color:#94a3b8; font-weight:400;">(optional)</span></label>
        <input type="text" name="phone" value="{{ old('phone', $member->phone ?? '') }}" class="form-input">
    </div>
    <div class="form-group" style="grid-column:span 2;">
        <label class="form-label">Address <span style="color:#94a3b8; font-weight:400;">(optional)</span></label>
        <textarea name="address" class="form-input form-textarea">{{ old('address', $member->address ?? '') }}</textarea>
    </div>
    <div class="form-group">
        <label class="form-label">Membership Start</label>
        <input type="date" name="membership_start" value="{{ old('membership_start', isset($member) ? \Carbon\Carbon::parse($member->membership_start)->format('Y-m-d') : '') }}" class="form-input">
    </div>
    <div class="form-group">
        <label class="form-label">Membership End</label>
        <input type="date" name="membership_end" value="{{ old('membership_end', isset($member) ? \Carbon\Carbon::parse($member->membership_end)->format('Y-m-d') : '') }}" class="form-input">
    </div>
</div>