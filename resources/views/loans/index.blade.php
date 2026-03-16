<x-app-layout>
    <x-slot name="header">Loans</x-slot>

    @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">✕ {{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <span class="card-title">All Loans</span>
            <div style="display:flex; gap:8px;">
                <a href="{{ route('reports.loans') }}" class="btn btn-ghost btn-sm">⬇ PDF Report</a>
                <a href="{{ route('loans.create') }}" class="btn btn-primary btn-sm">+ New Loan</a>
            </div>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Member</th>
                    <th>Books</th>
                    <th>Loan Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td style="color:#94a3b8;">{{ $loop->iteration }}</td>
                        <td style="font-weight:600; color:#1e293b;">{{ $loan->member->first_name }} {{ $loan->member->last_name }}</td>
                        <td style="color:#64748b; font-size:12px;">{{ Str::limit($loan->loanItems->pluck('book.title')->join(', '), 50) }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('M d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}</td>
                        <td><span class="badge badge-{{ $loan->status }}">{{ ucfirst($loan->status) }}</span></td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <a href="{{ route('loans.show', $loan) }}" class="btn btn-ghost btn-sm">View</a>
                                @if($loan->status !== 'returned')
                                    <form action="{{ route('loans.return', $loan) }}" method="POST" onsubmit="return confirm('Mark as returned?')">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-primary btn-sm">Return</button>
                                    </form>
                                @endif
                                @if($loan->status === 'returned')
                                    <form action="{{ route('loans.destroy', $loan) }}" method="POST" onsubmit="return confirm('Delete this loan?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center; color:#94a3b8; padding:40px;">No loans found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:16px 24px; border-top:1px solid #f1f5f9;">{{ $loans->links() }}</div>
    </div>
</x-app-layout>