<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $member->first_name }} {{ $member->last_name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium mb-4">Member Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                <div><span class="font-medium">Email:</span> {{ $member->email }}</div>
                <div><span class="font-medium">Phone:</span> {{ $member->phone ?? '—' }}</div>
                <div><span class="font-medium">Address:</span> {{ $member->address ?? '—' }}</div>
                <div><span class="font-medium">Membership Start:</span> {{ \Carbon\Carbon::parse($member->membership_start)->format('M d, Y') }}</div>
                <div><span class="font-medium">Membership End:</span> {{ \Carbon\Carbon::parse($member->membership_end)->format('M d, Y') }}</div>
            </div>
            <div class="mt-4">
                <a href="{{ route('members.edit', $member) }}" class="text-blue-600 hover:underline">Edit Member</a>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-medium">Loan History</h3>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Loan Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Books</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($loans as $loan)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($loan->loan_date)->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 py-1 rounded text-xs font-medium
                                    {{ $loan->status === 'active' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $loan->status === 'returned' ? 'bg-gray-100 text-gray-700' : '' }}
                                    {{ $loan->status === 'overdue' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $loan->loanItems->pluck('book.title')->join(', ') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-400">No loan history found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4">{{ $loans->links() }}</div>
        </div>

    </div>
</x-app-layout>