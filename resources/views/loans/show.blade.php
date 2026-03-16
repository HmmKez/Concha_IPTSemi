<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Loan Details</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium mb-4">Loan Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                <div><span class="font-medium">Member:</span> {{ $loan->member->first_name }} {{ $loan->member->last_name }}</div>
                <div><span class="font-medium">Status:</span>
                    <span class="px-2 py-1 rounded text-xs font-medium
                        {{ $loan->status === 'active' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $loan->status === 'returned' ? 'bg-gray-100 text-gray-700' : '' }}
                        {{ $loan->status === 'overdue' ? 'bg-red-100 text-red-700' : '' }}">
                        {{ ucfirst($loan->status) }}
                    </span>
                </div>
                <div><span class="font-medium">Loan Date:</span> {{ \Carbon\Carbon::parse($loan->loan_date)->format('M d, Y') }}</div>
                <div><span class="font-medium">Due Date:</span> {{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}</div>
                @if($loan->returned_date)
                    <div><span class="font-medium">Returned Date:</span> {{ \Carbon\Carbon::parse($loan->returned_date)->format('M d, Y') }}</div>
                @endif
            </div>

            @if($loan->status !== 'returned')
                <div class="mt-4">
                    <form action="{{ route('loans.return', $loan) }}" method="POST" class="inline" onsubmit="return confirm('Mark this loan as returned?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mark as Returned</button>
                    </form>
                </div>
            @endif
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-medium">Borrowed Books</h3>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($loan->loanItems as $item)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->book->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $item->book->author }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('loans.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Back to Loans</a>
        </div>

    </div>
</x-app-layout>