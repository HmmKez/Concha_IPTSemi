<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        // Auto-mark overdue loans
        Loan::where('status', 'active')
            ->where('due_date', '<', today())
            ->update(['status' => 'overdue']);

        $stats = [
            'total_books'    => Book::count(),
            'total_members'  => Member::count(),
            'active_loans'   => Loan::where('status', 'active')->count(),
            'overdue_loans'  => Loan::where('status', 'overdue')->count(),
            'returned_loans' => Loan::where('status', 'returned')->count(),
            'low_stock'      => Book::where('quantity', '<=', 5)->count(),
        ];

        $recent_loans = Loan::with('member', 'loanItems.book')
            ->latest()
            ->take(5)
            ->get();

        $low_stock_books = Book::with('category')
            ->where('quantity', '<=', 5)
            ->orderBy('quantity')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recent_loans', 'low_stock_books'));
    }
}