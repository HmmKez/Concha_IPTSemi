<x-app-layout>
    <x-slot name="header">Add Category</x-slot>

    <div style="max-width:760px;">
        <div class="card">
            <div class="card-header">
                <span class="card-title">Category Details</span>
                <a href="{{ route('categories.index') }}" class="btn btn-ghost btn-sm">← Back</a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    @include('categories._form')
                    <div style="display:flex; gap:8px; margin-top:8px;">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-ghost">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>