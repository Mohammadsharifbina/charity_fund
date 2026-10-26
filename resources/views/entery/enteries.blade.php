@extends('layout.master')

@section('content')

<button class="btn" onclick="window.location.href='{{ route('Entery.create') }}'">＋ New Payment</button>
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($enteries as $payment)

            @if (request('edit') == $payment->id)

            {{-- Edit the selected record in this table --}}
            <tr>
                <td>
                    <div class="avatar">
                        @if ($payment->member?->image &&
                        file_exists(public_path('students/' . $payment->member->image)))
                        <img src="{{ asset('students/' . $payment->member->image) }}"
                            alt="{{ $payment->member->name }}">
                        @else
                        <span>
                            {{ strtoupper(substr($payment->member->name ?? 'U', 0, 1)) }}
                        </span>
                        @endif
                    </div>
                </td>

                <td>{{ $payment->member->name ?? 'Unknown' }}</td>

                <td colspan="3">
                    <form action="/Entery/{{ $payment->id }}" method="POST" class="edit-form">
                        @csrf
                        @method('PUT')
                        <input type="text" value="{{ $payment->member_id }}" readonly name="member_id" hidden
                            style="max-width: 40px; height: 28px; padding: 2px 6px; font-size: 12px;">
                        <input type="number" name="amount" value="{{ old('amount', $payment->amount) }}" step="0.01"
                            min="0" required>

                        <button type="submit" class="save-btn">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Save
                        </button>

                        <a href="{{ url()->current() }}" class="cancel-btn">
                            <i class="fa-solid fa-xmark"></i>
                            Cancel
                        </a>
                    </form>
                </td>

                <td>
                    <i class="fa-solid fa-trash"></i>
                </td>
            </tr>

            @else

            {{-- Normal table row --}}
            <tr>
                <td>
                    <div class="avatar">
                        @if ($payment->member?->image &&
                        file_exists(public_path('students/' . $payment->member->image)))
                        <img src="{{ asset('students/' . $payment->member->image) }}"
                            alt="{{ $payment->member->name }}">
                        @else
                        <span>
                            {{ strtoupper(substr($payment->member->name ?? 'U', 0, 1)) }}
                        </span>
                        @endif
                    </div>
                </td>

                <td>{{ $payment->member->name ?? 'Unknown' }}</td>
                <td>{{ $payment->amount }}</td>

                <td>
                    {{ \Morilog\Jalali\Jalalian::fromDateTime($payment->created_at)->format('Y-m-d') }}
                </td>

                <td>
                    <a href="{{ url()->current() }}?edit={{ $payment->id }}">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                </td>

                <td>
                    <form action="/Entery/{{ $payment->id }}" method="POST"
                        onsubmit="return confirm('ایا ته ډاډه یې چې دا ریکارډ حذف کړې؟');">

                        @csrf
                        @method('get')

                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>

                </td>
            </tr>

            @endif

            @endforeach
        </tbody>
    </table>
</div>

<style>
.edit-form {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;
}

.edit-form input {
    width: 100px;
    max-width: 100%;
    padding: 6px 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 13px;
}

.save-btn,
.cancel-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 6px 9px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    font-size: 12px;
    cursor: pointer;
    white-space: nowrap;
}

.save-btn {
    background: #198754;
    color: white;
}

.cancel-btn {
    background: #6c757d;
    color: white;
}

.avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #3b1e54;
    color: white;
}

.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>

@endsection