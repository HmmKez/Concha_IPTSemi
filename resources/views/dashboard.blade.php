<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <!-- Stat Cards -->
    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:16px; margin-bottom:28px;">
        <div class="stat-card indigo">
            <div class="stat-icon" style="background:#eef2ff;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#6366f1"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div class="stat-number">{{ $stats['total_books'] }}</div>
            <div class="stat-label">Total Books</div>
        </div>
        <div class="stat-card purple">
            <div class="stat-icon" style="background:#faf5ff;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#a855f7"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div class="stat-number">{{ $stats['total_members'] }}</div>
            <div class="stat-label">Total Members</div>
        </div>
        <div class="stat-card green">
            <div class="stat-icon" style="background:#f0fdf4;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#22c55e"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            </div>
            <div class="stat-number">{{ $stats['active_loans'] }}</div>
            <div class="stat-label">Active Loans</div>
        </div>
        <div class="stat-card red">
            <div class="stat-icon" style="background:#fef2f2;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="stat-number">{{ $stats['overdue_loans'] }}</div>
            <div class="stat-label">Overdue Loans</div>
        </div>
        <div class="stat-card slate">
            <div class="stat-icon" style="background:#f8fafc;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#64748b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="stat-number">{{ $stats['returned_loans'] }}</div>
            <div class="stat-label">Returned Loans</div>
        </div>
        <div class="stat-card amber">
            <div class="stat-icon" style="background:#fffbeb;">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#f59e0b"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div class="stat-number">{{ $stats['low_stock'] }}</div>
            <div class="stat-label">Low Stock Books</div>
        </div>
    </div>

    <!-- Recent Loans + Low Stock side by side -->
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">

        <div class="card">
            <div class="card-header">
                <span class="card-title">Recent Loans</span>
                <a href="{{ route('loans.index') }}" class="btn btn-ghost btn-sm">View All</a>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_loans as $loan)
                        <tr>
                            <td>
                                <div style="font-weight:600; color:#1e293b;">{{ $loan->member->first_name }} {{ $loan->member->last_name }}</div>
                                <div style="font-size:12px; color:#94a3b8;">{{ $loan->loanItems->pluck('book.title')->join(', ') }}</div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}</td>
                            <td><span class="badge badge-{{ $loan->status }}">{{ ucfirst($loan->status) }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="3" style="text-align:center; color:#94a3b8; padding:32px;">No loans yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card">
            <div class="card-header">
                <span class="card-title">Low Stock Books</span>
                <a href="{{ route('books.index') }}" class="btn btn-ghost btn-sm">View All</a>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($low_stock_books as $book)
                        <tr>
                            <td style="font-weight:600; color:#1e293b;">{{ $book->title }}</td>
                            <td><span class="badge badge-info">{{ $book->category->name }}</span></td>
                            <td>
                                <span class="badge {{ $book->quantity === 0 ? 'badge-overdue' : 'badge-warning' }}">
                                    {{ $book->quantity }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" style="text-align:center; color:#94a3b8; padding:32px;">All books are well stocked.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>