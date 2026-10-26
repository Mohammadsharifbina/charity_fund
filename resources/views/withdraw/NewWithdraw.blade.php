@extends("layout.master")

@section("content")

<main class="container">

    <header class="header">
        <h1>Add New Withdrawal</h1>
        <p>Complete the form below to register a new withdrawal.</p>
    </header>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="form-card">

        <form action="/withdraw" method="POST">
            @csrf

            <div class="form-grid">

                {{-- Member ID --}}
                <div class="form-group">
                    <label for="member_id">
                        Member <span class="required">*</span>
                    </label>

                    <select name="member_id" id="member_id" class="@error('member_id') is-invalid @enderror" required>



                        <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>


                    </select>

                    @error('member_id')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Amount --}}
                <div class="form-group">
                    <label for="amount">
                        Amount (AFN) <span class="required">*</span>
                    </label>

                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}"
                        placeholder="Enter amount" min="1" step="0.01" class="@error('amount') is-invalid @enderror"
                        required>

                    @error('amount')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Due Date --}}
                <div class="form-group full-width">
                    <label for="due_date">
                        Due Date <span class="required">*</span>
                    </label>

                    <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"
                        min="{{ date('Y-m-d') }}" class="@error('due_date') is-invalid @enderror" required>

                    @error('due_date')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="form-actions">

                <button type="submit" class="submit-btn">
                    Save Withdrawal
                </button>

                <button type="reset" class="reset-btn" onclick="window.location.reload()">
                    Cancel
                </button>

            </div>

        </form>

    </div>

</main>

@endsection