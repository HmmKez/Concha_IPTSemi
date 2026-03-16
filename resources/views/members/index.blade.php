<x-app-layout>
    <x-slot name="header">Members</x-slot>

    @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">✕ {{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <span class="card-title">All Members</span>
            <a href="{{ route('members.create') }}" class="btn btn-primary btn-sm">+ Add Member</a>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Membership End</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                    <tr>
                        <td style="color:#94a3b8;">{{ $loop->iteration }}</td>
                        <td style="font-weight:600; color:#1e293b;">{{ $member->first_name }} {{ $member->last_name }}</td>
                        <td style="color:#64748b;">{{ $member->email }}</td>
                        <td>{{ $member->phone ?? '—' }}</td>
                        <td>
                            @php $expired = \Carbon\Carbon::parse($member->membership_end)->isPast(); @endphp
                            <span class="badge {{ $expired ? 'badge-overdue' : 'badge-active' }}">
                                {{ \Carbon\Carbon::parse($member->membership_end)->format('M d, Y') }}
                            </span>
                        </td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <a href="{{ route('members.show', $member) }}" class="btn btn-ghost btn-sm">View</a>
                                <a href="{{ route('members.edit', $member) }}" class="btn btn-ghost btn-sm">Edit</a>
                                <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Delete this member?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center; color:#94a3b8; padding:40px;">No members found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:16px 24px; border-top:1px solid #f1f5f9;">{{ $members->links() }}</div>
    </div>
</x-app-layout>