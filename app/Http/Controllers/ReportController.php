<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReportController extends Controller
{
    private function makePdf(string $html): Dompdf
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf;
    }

    public function loansReport(Request $request)
    {
        $query = Loan::with('member', 'loanItems.book');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('loan_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('loan_date', '<=', $request->date_to);
        }

        $loans = $query->latest()->get();

        $stats = [
            'total'    => $loans->count(),
            'active'   => $loans->where('status', 'active')->count(),
            'overdue'  => $loans->where('status', 'overdue')->count(),
            'returned' => $loans->where('status', 'returned')->count(),
        ];

        $html = view('reports.loans', compact('loans', 'stats', 'request'))->render();
        $dompdf = $this->makePdf($html);

        return response($dompdf->output(), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="loans-report-' . now()->format('Y-m-d') . '.pdf"',
        ]);
    }

    public function booksReport()
    {
        $books = Book::with('category')->orderBy('title')->get();

        $stats = [
            'total'     => $books->count(),
            'in_stock'  => $books->where('quantity', '>', 0)->count(),
            'out_stock' => $books->where('quantity', 0)->count(),
            'low_stock' => $books->where('quantity', '<=', 5)->where('quantity', '>', 0)->count(),
        ];

        $html = view('reports.books', compact('books', 'stats'))->render();
        $dompdf = $this->makePdf($html);

        return response($dompdf->output(), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="books-report-' . now()->format('Y-m-d') . '.pdf"',
        ]);
    }
}