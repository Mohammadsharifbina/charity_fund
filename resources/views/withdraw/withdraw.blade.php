@extends('layout.master')

@section('content')

<button class="btn" onclick="history.back()"> back</button>
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
            @foreach ($withdraws as $payment)

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
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </a>
                </td>

                <td>
                    <form action="/withdraw/{{ $payment->id }}" method="POST" class="delete-form">

                        @csrf
                        @method('delete')

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



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
.delete-confirm-popup {
    border-radius: 20px !important;
    padding: 25px 20px 18px !important;
    font-family: Arial, sans-serif;
    direction: rtl;
}

.delete-confirm-title {
    font-size: 23px !important;
    font-weight: 700 !important;
    color: #172033 !important;
    margin-top: 12px !important;
}

.delete-confirm-text {
    font-size: 16px !important;
    line-height: 1.8 !important;
    color: #778197 !important;
}

.delete-confirm-btn {
    border-radius: 12px !important;
    padding: 15px 22px !important;
    font-size: 15px !important;
    font-weight: bold !important;
    box-shadow: none !important;
}

.delete-cancel-btn {
    background: #e5e7eb !important;
    color: #374151 !important;
}

.delete-confirm-btn-red {
    background: #e52525 !important;
    color: white !important;
}

.delete-confirm-btn-red:hover {
    background: #c91d1d !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {

    document.querySelectorAll('.delete-form').forEach(function(form) {

        form.addEventListener('submit', function(event) {
            if (form.dataset.confirmed === 'true') {
                return;
            }

            event.preventDefault();

            Swal.fire({
                title: 'ایا ډاډه یې؟',
                text: 'ایا غواړې دا ریکارډ حذف کړې؟ دا عمل بېرته نه شي راګرځېدای!',
                icon: 'warning',

                iconColor: '#ff2424',
                background: '#ffffff',
                width: 420,
                padding: '25px 20px',

                showCancelButton: true,
                reverseButtons: false,
                focusCancel: true,

                confirmButtonText: 'هو، حذف یې کړه',
                cancelButtonText: 'نه، لغوه کړه',

                buttonsStyling: false,
                customClass: {
                    popup: 'delete-confirm-popup',
                    title: 'delete-confirm-title',
                    htmlContainer: 'delete-confirm-text',
                    confirmButton: 'delete-confirm-btn delete-confirm-btn-red',
                    cancelButton: 'delete-confirm-btn delete-cancel-btn',
                    actions: 'delete-confirm-actions'
                },

                showClass: {
                    popup: 'swal2-show'
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    form.dataset.confirmed = 'true';
                    form.requestSubmit();
                }
            });
        });

    });

});
</script>

@endsection