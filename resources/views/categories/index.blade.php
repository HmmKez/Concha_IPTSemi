<x-app-layout>
    <x-slot name="header">Categories</x-slot>

    @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">✕ {{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <span class="card-title">All Categories</span>
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">+ Add Category</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Books</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td style="color:#94a3b8;">{{ $loop->iteration }}</td>
                        <td style="font-weight:600; color:#1e293b;">{{ $category->name }}</td>
                        <td style="color:#64748b; max-width:280px;">{{ Str::limit($category->description, 60) ?? '—' }}</td>
                        <td><span class="badge badge-info">{{ $category->books_count }} books</span></td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <a href="{{ route('categories.show', $category) }}" class="btn btn-ghost btn-sm">View</a>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-ghost btn-sm">Edit</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center; color:#94a3b8; padding:40px;">No categories found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:16px 24px; border-top:1px solid #f1f5f9;">{{ $categories->links() }}</div>
    </div>
</x-app-layout>