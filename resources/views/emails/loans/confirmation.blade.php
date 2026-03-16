@component('mail::message')
# Loan Confirmation

Dear {{ $loan->member->first_name }} {{ $loan->member->last_name }},

Your loan has been successfully recorded. Here are your loan details:

@component('mail::panel')
**Loan Date:** {{ \Carbon\Carbon::parse($loan->loan_date)->format('M d, Y') }}
**Due Date:** {{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}
**Status:** {{ ucfirst($loan->status) }}
@endcomponent

**Borrowed Books:**

@component('mail::table')
| Title | Author | Quantity |
|:------|:-------|:--------:|
@foreach($loan->loanItems as $item)
| {{ $item->book->title }} | {{ $item->book->author }} | {{ $item->quantity }} |
@endforeach
@endcomponent

Please return the books on or before the due date to avoid being marked overdue.

Thanks,
{{ config('app.name') }}
@endcomponent