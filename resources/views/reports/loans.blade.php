<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Loans Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; padding: 30px; }
        h1 { font-size: 20px; font-weight: bold; margin-bottom: 4px; }
        .subtitle { color: #666; font-size: 11px; margin-bottom: 20px; }
        .stats { display: flex; gap: 12px; margin-bottom: 24px; }
        .stat-box { flex: 1; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px; text-align: center; }
        .stat-box .number { font-size: 22px; font-weight: bold; }
        .stat-box .label { font-size: 10px; color: #666; margin-top: 2px; }
        .active { color: #16a34a; }
        .overdue { color: #dc2626; }
        .returned { color: #6b7280; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        thead { background-color: #f1f5f9; }
        th { padding: 8px 10px; text-align: left; font-size: 10px; text-transform: uppercase; color: #555; border-bottom: 2px solid #e2e8f0; }
        td { padding: 8px 10px; border-bottom: 1px solid #e2e8f0; font-size: 11px; vertical-align: top; }
        tr:last-child td { border-bottom: none; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 10px; font-weight: bold; }
        .badge-active { background: #dcfce7; color: #16a34a; }
        .badge-overdue { background: #fee2e2; color: #dc2626; }
        .badge-returned { background: #f1f5f9; color: #6b7280; }
        .footer { margin-top: 24px; text-align: right; font-size: 10px; color: #999; }
    </style>
</head>
<body>

    <h1>Loans Report</h1>
    <div class="subtitle">Generated on {{ now()->format('F d, Y \a\t h:i A') }}</div>

    <div class="stats">
        <div class="stat-box">
            <div class="number">{{ $stats['total'] }}</div>
            <div class="label">Total Loans</div>
        </div>
        <div class="stat-box">
            <div class="number active">{{ $stats['active'] }}</div>
            <div class="label">Active</div>
        </div>
        <div class="stat-box">
            <div class="number overdue">{{ $stats['overdue'] }}</div>
            <div class="label">Overdue</div>
        </div>
        <div class="stat-box">
            <div class="number returned">{{ $stats['returned'] }}</div>
            <div class="label">Returned</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Member</th>
                <th>Books</th>
                <th>Loan Date</th>
                <th>Due Date</th>
                <th>Returned Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $index => $loan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $loan->member->first_name }} {{ $loan->member->last_name }}</td>
                    <td>{{ $loan->loanItems->pluck('book.title')->join(', ') }}</td>
                    <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('M d, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}</td>
                    <td>{{ $loan->returned_date ? \Carbon\Carbon::parse($loan->returned_date)->format('M d, Y') : '—' }}</td>
                    <td>
                        <span class="badge badge-{{ $loan->status }}">{{ ucfirst($loan->status) }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:#999; padding: 20px;">No loans found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">{{ config('app.name') }} &mdash; Library Lending System</div>

</body>
</html>