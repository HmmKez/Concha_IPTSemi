<x-app-layout>
    <x-slot name="header">Books</x-slot>

    @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">✕ {{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <span class="card-title">All Books</span>
            <div style="display:flex; gap:8px;">
                <a href="{{ route('reports.books') }}" class="btn btn-ghost btn-sm">⬇ PDF Report</a>
                <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm">+ Add Book</a>
            </div>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td style="color:#94a3b8;">{{ $loop->iteration }}</td>
                        <td style="font-weight:600; color:#1e293b;">{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td style="font-family:monospace; font-size:12px;">{{ $book->isbn }}</td>
                        <td><span class="badge badge-info">{{ $book->category->name }}</span></td>
                        <td>
                            <span class="badge {{ $book->quantity === 0 ? 'badge-overdue' : ($book->quantity <= 5 ? 'badge-warning' : 'badge-active') }}">
                                {{ $book->quantity }}
                            </span>
                        </td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-ghost btn-sm">Edit</a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Delete this book?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center; color:#94a3b8; padding:40px;">No books found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:16px 24px; border-top:1px solid #f1f5f9;">{{ $books->links() }}</div>
    </div>
</x-app-layout>