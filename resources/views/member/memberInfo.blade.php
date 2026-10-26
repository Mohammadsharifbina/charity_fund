@extends("layout.master")
@section("content")

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Information</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
    :root {
        --primary: #3B1E54;
        --primary-light: #eee7f5;
        --bg: #f5f3f8;
        --text: #292333;
        --muted: #777184;
        --border: #e8e3ee;
        --green: #16845b;
        --red: #d74747;
    }



    a {
        text-decoration: none;
        color: inherit;
    }

    .container {
        width: min(1200px, 94%);
        /* margin: 30px auto; */
    }



    .topbar h1 {
        color: var(--primary);
        font-size: 25px;

    }

    .subtitle {
        color: var(--muted);
        font-size: 14px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--primary);
        color: white;
        padding: 11px 16px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .btn:hover {
        opacity: .9;
    }

    .profile {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 25px;
        background: white;
        border: 1px solid var(--border);
        border-radius: 15px;
        margin-bottom: 22px;
    }

    .avatar1 {
        width: 100px;
        height: 100px;
        flex-shrink: 0;
        border-radius: 50%;
        background: var(--primary-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        font-weight: bold;
        overflow: hidden;
    }

    .avatar1 img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-info {
        flex: 1;
        min-width: 0;
    }

    .profile-info h2 {
        font-size: 23px;
        margin-bottom: 8px;
        overflow-wrap: anywhere;
    }

    .profile-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px 20px;
        color: var(--muted);
        font-size: 14px;
        margin-top: 10px;
    }

    .status {
        display: inline-block;
        padding: 6px 12px;
        background: #e1f7eb;
        color: var(--green);
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    .section-title {
        font-size: 19px;
        margin: 25px 0 15px;
        color: var(--primary);
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border: 1px solid var(--border);
        border-radius: 12px;
        min-width: 0;
    }

    .stat-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--muted);
        font-size: 13px;
        margin-bottom: 17px;
    }

    .stat-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 10px;
        font-size: 16px;
    }

    .stat-card h3 {
        font-size: 23px;
        overflow-wrap: anywhere;
        margin-bottom: 7px;
    }

    .stat-card p {
        color: var(--muted);
        font-size: 12px;
    }

    .green {
        color: var(--green);
    }

    .red {
        color: var(--red);
    }

    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 25px;
    }

    .panel {
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 22px;
        min-width: 0;
    }

    .panel h3 {
        color: var(--primary);
        margin-bottom: 20px;
        font-size: 17px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 13px 0;
        border-bottom: 1px solid var(--border);
        font-size: 14px;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-row span:first-child {
        color: var(--muted);
    }

    .info-row strong {
        text-align: right;
        overflow-wrap: anywhere;
    }

    .table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        white-space: nowrap;
    }

    th,
    td {
        padding: 14px 12px;
        text-align: left;
        border-bottom: 1px solid var(--border);
        font-size: 13px;
    }

    th {
        background: #faf8fc;
        color: var(--muted);
        font-weight: 600;
    }

    .badge {
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
    }

    .badge-deposit {
        background: #e1f7eb;
        color: var(--green);
    }

    .badge-withdraw {
        background: #ffe9e9;
        color: var(--red);
    }

    .empty {
        text-align: center;
        padding: 25px;
        color: var(--muted);
    }

    .actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 22px;
    }

    .btn-outline {
        background: white;
        color: var(--primary);
        border: 1px solid var(--primary);
    }

    @media (max-width: 900px) {
        .stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 520px) {
        .container {
            width: 94%;
            margin: 18px auto;
        }

        .topbar h1 {
            font-size: 21px;
        }

        .profile {
            padding: 17px;
            align-items: flex-start;
            flex-direction: column;
        }

        .avatar1 {
            width: 78px;
            height: 78px;
            font-size: 29px;
        }

        .profile-info h2 {
            font-size: 20px;
        }

        .stats {
            gap: 10px;
        }

        .stat-card {
            padding: 14px;
        }

        .stat-card h3 {
            font-size: 19px;
        }

        .stat-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .panel {
            padding: 15px;
        }

        .actions .btn {
            flex: 1;
        }
    }

    @media print {
        body {
            background: white;
        }

        .actions,
        .topbar .btn {
            display: none;
        }

        .container {
            width: 100%;
            margin: 0;
        }
    }
    </style>
</head>

<body>

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
                    {{ $user->lastname }}
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
                        <i class="fa-solid fa-envelope"></i>
                        {{ $user->email ?? 'Not provided' }}
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
                    {{ number_format($balance ?? 0, 2) }}
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
                    {{ number_format($totalDeposits ?? 0, 2) }}
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
                    {{ number_format($monthlyPaid ?? 0, 2) }}
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
                    <strong>{{ $user->lastname }}</strong>
                </div>

                <div class="info-row">
                    <span>Phone</span>
                    <strong>{{ $user->phone ?? '—' }}</strong>
                </div>

                <div class="info-row">
                    <span>Email</span>
                    <strong>{{ $user->email ?? '—' }}</strong>
                </div>

                <div class="info-row">
                    <span>Address</span>
                    <strong>{{ $user->address ?? '—' }}</strong>
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
                        {{ number_format($monthlyPaid ?? 0, 2) }} AFN
                    </strong>
                </div>

                <div class="info-row">
                    <span>Remaining This Month</span>
                    <strong class="red">
                        {{ number_format($monthlyRemaining ?? max(0, ($monthlyRequired ?? 300) - ($monthlyPaid ?? 0)), 2) }}
                        AFN
                    </strong>
                </div>

                <div class="info-row">
                    <span>Account Status</span>
                    <strong>{{ ucfirst($user->status ?? 'Active') }}</strong>
                </div>

                <div class="info-row">
                    <span>Account Balance</span>
                    <strong>{{ number_format($balance ?? 0, 2) }} AFN</strong>
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