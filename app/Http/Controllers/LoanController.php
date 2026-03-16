<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Jobs\SendLoanConfirmationEmail;

class LoanController extends Controller
{
    public function index()
    {
        // Auto-mark overdue loans
        Loan::where('status', 'active')
            ->where('due_date', '<', today())
            ->update(['status' => 'overdue']);

        $loans = Loan::with('member', 'loanItems.book')->latest()->paginate(10);
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::where('membership_end', '>=', today())->get();
        $books = Book::where('quantity', '>', 0)->get();
        return view('loans.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'loan_date' => 'required|date',
            'due_date'  => 'required|date|after:loan_date',
            'books'     => 'required|array|min:1',
            'books.*.book_id'  => 'required|exists:books,id',
            'books.*.quantity' => 'required|integer|min:1',
        ]);

        // Check stock availability
        foreach ($request->books as $item) {
            $book = Book::findOrFail($item['book_id']);
            if ($book->quantity < $item['quantity']) {
                return back()->withErrors([
                    'books' => "Not enough stock for book: {$book->title}. Available: {$book->quantity}"
                ])->withInput();
            }
        }

        // Create the loan
        $loan = Loan::create([
            'member_id' => $request->member_id,
            'loan_date' => $request->loan_date,
            'due_date'  => $request->due_date,
            'status'    => 'active',
        ]);

        foreach ($request->books as $item) {
            $loan->loanItems()->create([
                'book_id'  => $item['book_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        SendLoanConfirmationEmail::dispatch($loan);
        
        return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
    }

    public function show(Loan $loan)
    {
        $loan->load('member', 'loanItems.book');
        return view('loans.show', compact('loan'));
    }

    public function return(Loan $loan)
    {
        if ($loan->status === 'returned') {
            return redirect()->route('loans.index')->with('error', 'Loan has already been returned.');
        }

        // Restore book stock
        $loan->loanItems()->each(fn($item) => $item->delete());

        $loan->update([
            'status'        => 'returned',
            'returned_date' => today(),
        ]);

        return redirect()->route('loans.index')->with('success', 'Loan marked as returned.');
    }

    public function destroy(Loan $loan)
    {
        if ($loan->status !== 'returned') {
            return redirect()->route('loans.index')->with('error', 'Only returned loans can be deleted.');
        }

        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully.');
    }
}