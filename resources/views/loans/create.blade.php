<x-app-layout>
    <x-slot name="header">New Loan</x-slot>

    <div style="max-width:760px;">
        <div class="card">
            <div class="card-header">
                <span class="card-title">Loan Details</span>
                <a href="{{ route('loans.index') }}" class="btn btn-ghost btn-sm">← Back</a>
            </div>
            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-error">
                        <ul style="list-style:none; margin:0; padding:0;">
                            @foreach($errors->all() as $error)<li>✕ {{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('loans.store') }}">
                    @csrf

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                        <div class="form-group" style="grid-column:span 2;">
                            <label class="form-label">Member</label>
                            <select name="member_id" class="form-input form-select">
                                <option value="">-- Select Member --</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                        {{ $member->first_name }} {{ $member->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Loan Date</label>
                            <input type="date" name="loan_date" value="{{ old('loan_date', today()->format('Y-m-d')) }}" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Due Date</label>
                            <input type="date" name="due_date" value="{{ old('due_date') }}" class="form-input">
                        </div>
                    </div>

                    <!-- Books -->
                    <div class="form-group">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                            <label class="form-label" style="margin:0;">Books</label>
                            <button type="button" onclick="addBookRow()" class="btn btn-ghost btn-sm">+ Add Book</button>
                        </div>

                        <div id="book-rows" style="display:flex; flex-direction:column; gap:8px;">
                            <div class="book-row" style="display:flex; gap:8px; align-items:center;">
                                <select name="books[0][book_id]" class="form-input form-select" style="flex:1;">
                                    <option value="">-- Select Book --</option>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }} (Available: {{ $book->quantity }})</option>
                                    @endforeach
                                </select>
                                <input type="number" name="books[0][quantity]" value="1" min="1" class="form-input" style="width:90px;" placeholder="Qty">
                                <button type="button" onclick="removeBookRow(this)" class="btn btn-danger btn-sm">✕</button>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex; gap:8px; margin-top:8px;">
                        <button type="submit" class="btn btn-primary">Create Loan</button>
                        <a href="{{ route('loans.index') }}" class="btn btn-ghost">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let rowIndex = 1;
        const booksJson = @json($books);

        function addBookRow() {
            const container = document.getElementById('book-rows');
            const div = document.createElement('div');
            div.className = 'book-row';
            div.style = 'display:flex; gap:8px; align-items:center;';

            let options = '<option value="">-- Select Book --</option>';
            booksJson.forEach(book => {
                options += `<option value="${book.id}">${book.title} (Available: ${book.quantity})</option>`;
            });

            div.innerHTML = `
                <select name="books[${rowIndex}][book_id]" class="form-input form-select" style="flex:1;">${options}</select>
                <input type="number" name="books[${rowIndex}][quantity]" value="1" min="1" class="form-input" style="width:90px;" placeholder="Qty">
                <button type="button" onclick="removeBookRow(this)" class="btn btn-danger btn-sm">✕</button>
            `;
            container.appendChild(div);
            rowIndex++;
        }

        function removeBookRow(btn) {
            const rows = document.querySelectorAll('.book-row');
            if (rows.length > 1) btn.closest('.book-row').remove();
        }
    </script>
</x-app-layout>