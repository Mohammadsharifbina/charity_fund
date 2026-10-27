@extends("layout.master")
@section("content")


<div class="container" id="printArea">

    {{-- Page heading --}}
    <div class="topbar">
        <div>
            <h1>User Account Details</h1>
            <p class="subtitle">View personal information and financial history.</p>
        </div>

        <a href="{{ url('/dashboard') }}" class="btn">
            <i class="fa-solid fa-arrow-left"></i>
            Dashboard
        </a>
    </div>

    {{-- User profile --}}
    <div class="profile">

        <div class="avatar1">
            @if (!empty($user->image))
            <img src="{{ asset('students/' . $user->image) }}" alt="{{ $user->name }}"
                onerror="this.style.display='none'; this.parentElement.textContent='{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}';">
            @else
            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
            @endif
        </div>

        <div class="profile-info">
            <h2>
                {{ $user->name }}
                {{ $user->last_name }}
            </h2>

            <span class="status">
                {{ ucfirst($user->status ?? 'Active') }}
            </span>


            <div class="profile-meta">
                <span>
                    <i class="fa-solid fa-id-card"></i>
                    ID: {{ $user->id }}
                </span>

                <span>
                    <i class="fa-solid fa-phone"></i>
                    {{ $user->phone ?? 'Not provided' }}
                </span>


                <span>
                    <a href="/withdraw/{{ $user->id }}">send Mony</a>
                </span>
            </div>
        </div>
    </div>

    {{-- Financial summary --}}
    <h2 class="section-title">Financial Summary</h2>

    <div class="stats">

        <div class="stat-card">
            <div class="stat-heading">
                <div class="stat-icon">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                Current Balance
            </div>

            <h3>
                {{ number_format($totalAmount ?? 0, 2) }}
                <small>AFN</small>
            </h3>

            <p>Available account balance</p>
        </div>

        <div class="stat-card">
            <div class="stat-heading">
                <div class="stat-icon">
                    <i class="fa-solid fa-circle-arrow-down"></i>
                </div>
                Total Deposited
            </div>

            <h3 class="green">
                {{ number_format($Deposit ?? 0, 2) }}
                <small>AFN</small>
            </h3>

            <p>Total money contributed</p>
        </div>

        <div class="stat-card">
            <div class="stat-heading">
                <div class="stat-icon">
                    <i class="fa-solid fa-circle-arrow-up"></i>
                </div>
                Total Withdrawn
            </div>

            <h3 class="red">
                {{ number_format($totalWithdrawals ?? 0, 2) }}
                <small>AFN</small>
            </h3>

            <p>ټولې اخیستل شوې پیسې</p>
        </div>

        <div class="stat-card">
            <div class="stat-heading">
                <div class="stat-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                This Month
            </div>

            <h3>
                {{ number_format($thisMonth ?? 0, 2) }}
                <small>AFN</small>
            </h3>

            <p>Contribution paid this month</p>
        </div>

    </div>

    {{-- User details and monthly information --}}
    <div class="content-grid">

        <div class="panel">
            <h3>
                <i class="fa-solid fa-user"></i>
                Personal Information
            </h3>

            <div class="info-row">
                <span>First Name</span>
                <strong>{{ $user->name }}</strong>
            </div>

            <div class="info-row">
                <span>Last Name</span>
                <strong>{{ $user->last_name }}</strong>
            </div>

            <div class="info-row">
                <span>Phone</span>
                <strong>{{ $user->phone ?? '—' }}</strong>
            </div>




            <div class="info-row">
                <span>Member Since</span>
                <strong>
                    {{ $user->created_at?->format('d M Y') ?? '—' }}
                </strong>
            </div>

        </div>

        <div class="panel">
            <h3>
                <i class="fa-solid fa-calendar-days"></i>
                Monthly Contribution
            </h3>

            <div class="info-row">
                <span>Required Monthly Amount</span>
                <strong>{{ number_format($monthlyRequired ?? 300, 2) }} AFN</strong>
            </div>

            <div class="info-row">
                <span>Paid This Month</span>
                <strong class="green">
                    {{ number_format($thisMonth ?? 0, 2) }} AFN
                </strong>
            </div>



            <div class="info-row">
                <span>Account Status</span>
                <strong>{{ ucfirst($user->status ?? 'Active') }}</strong>
            </div>


        </div>

    </div>

    {{-- Transaction history --}}
    <div class="panel" style="margin-top: 25px;">
        <h3>
            <i class="fa-solid fa-clock-rotate-left"></i>
            Recent Transactions
        </h3>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Transaction Type</th>
                        <th>Amount (AFN)</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($transactions ?? [] as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>

                        <td>
                            @if ($transaction->type === 'deposit')
                            <span class="badge badge-deposit">
                                Deposit
                            </span>
                            @else
                            <span class="badge badge-withdraw">
                                Withdrawal
                            </span>
                            @endif
                        </td>

                        <td>
                            {{ number_format($transaction->amount, 2) }}
                        </td>

                        <td>
                            {{ $transaction->description ?? '—' }}
                        </td>

                        <td>
                            {{ $transaction->created_at?->format('d M Y') ?? '—' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty">
                            No transactions found for this user.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Actions --}}
    <div class="actions">
        <button type="button" class="btn" onclick="window.print()">
            <i class="fa-solid fa-print"></i>
            Print Account
        </button>

        <a onclick="history.back()" class="btn btn-outline">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Dashboard
        </a>
    </div>

</div>

</body>

</html>

@endsection