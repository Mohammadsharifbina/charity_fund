@extends("layout.master")
@section("content")

<button class="btn" onclick="history.back()">Back</button>

<table class="table table-bordered table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Last name</th>
            <th>Amount</th>
            <th>Success</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($members as $member)
        @php
        $entry = $monthlyEntries->get($member->id);
        @endphp

        <tr>
            {{-- Member Image --}}
            <td>
                @if ($member->image)
                <img src="{{ asset('students/' . $member->image) }}" alt="{{ $member->name }}" width="45" height="45"
                    class="rounded-circle" style="object-fit: cover;">
                @else
                <div class="rounded-circle bg-secondary text-white
                        d-flex align-items-center justify-content-center" style="width:45px; height:45px;">
                    {{ strtoupper(substr($member->name, 0, 1)) }}
                </div>
                @endif
            </td>

            {{-- Name --}}
            <td>{{ $member->name }}</td>

            {{-- Last Name --}}
            <td>{{ $member->last_name }}</td>

            {{-- Amount Form --}}
            <td>
                <form action="/Entery" method="POST" class="d-flex gap-2">
                    @csrf

                    <input type="hidden" name="member_id" value="{{ $member->id }}">

                    <input type="number" name="amount" class="form-control form-control-sm"
                        style="max-width:100px; height:28px;" placeholder="Amount" min="1" step="0.01"
                        value="{{ $entry?->amount ?? '' }}" {{ $entry ? 'readonly' : '' }} required>

                    @if (!$entry)
                    <button type="submit" class="btn-save">
                        Save
                    </button>
                    @else
                    <span class="text-muted small align-self-center">
                        Saved
                    </span>
                    @endif
                </form>
            </td>

            {{-- Success Message --}}
            <td>
                @if ($entry)
                <span class="text-success fw-bold">
                    ✓ Success!
                </span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection