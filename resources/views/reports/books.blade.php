<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Books Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; padding: 30px; }
        h1 { font-size: 20px; font-weight: bold; margin-bottom: 4px; }
        .subtitle { color: #666; font-size: 11px; margin-bottom: 20px; }
        .stats { display: flex; gap: 12px; margin-bottom: 24px; }
        .stat-box { flex: 1; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px; text-align: center; }
        .stat-box .number { font-size: 22px; font-weight: bold; color: #2563eb; }
        .stat-box .label { font-size: 10px; color: #666; margin-top: 2px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        thead { background-color: #f1f5f9; }
        th { padding: 8px 10px; text-align: left; font-size: 10px; text-transform: uppercase; color: #555; border-bottom: 2px solid #e2e8f0; }
        td { padding: 8px 10px; border-bottom: 1px solid #e2e8f0; font-size: 11px; }
        tr:last-child td { border-bottom: none; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 10px; font-weight: bold; }
        .badge-ok { background: #dcfce7; color: #16a34a; }
        .badge-low { background: #fef9c3; color: #ca8a04; }
        .badge-out { background: #fee2e2; color: #dc2626; }
        .footer { margin-top: 24px; text-align: right; font-size: 10px; color: #999; }
    </style>
</head>
<body>

    <h1>Books Report</h1>
    <div class="subtitle">Generated on {{ now()->format('F d, Y \a\t h:i A') }}</div>

    <div class="stats">
        <div class="stat-box">
            <div class="number">{{ $stats['total'] }}</div>
            <div class="label">Total Books</div>
        </div>
        <div class="stat-box">
            <div class="number" style="color:#16a34a">{{ $stats['in_stock'] }}</div>
            <div class="label">In Stock</div>
        </div>
        <div class="stat-box">
            <div class="number" style="color:#ca8a04">{{ $stats['low_stock'] }}</div>
            <div class="label">Low Stock</div>
        </div>
        <div class="stat-box">
            <div class="number" style="color:#dc2626">{{ $stats['out_stock'] }}</div>
            <div class="label">Out of Stock</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Stock Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $index => $book)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->category->name }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td>
                        @if($book->quantity === 0)
                            <span class="badge badge-out">Out of Stock</span>
                        @elseif($book->quantity <= 5)
                            <span class="badge badge-low">Low Stock</span>
                        @else
                            <span class="badge badge-ok">In Stock</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:#999; padding: 20px;">No books found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">{{ config('app.name') }} &mdash; Library Lending System</div>

</body>
</html>