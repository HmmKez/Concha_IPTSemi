<x-app-layout>
    <x-slot name="header">Edit Category</x-slot>

    <div style="max-width:760px;">
        <div class="card">
            <div class="card-header">
                <span class="card-title">Edit Category Details</span>
                <a href="{{ route('categories.index') }}" class="btn btn-ghost btn-sm">← Back</a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('categories.update', $category) }}">
                    @csrf
                    @method('PUT')
                    @include('categories._form')
                    <div style="display:flex; gap:8px; margin-top:8px;">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-ghost">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>