@extends("layout.master")
@section("content")
<div class="page active" id="dashboard">
    <div class="page-head">
        <div>
            <h1>Welcome back, Mohammad 👋</h1>
            <p>Here’s what is happening with your account today.</p>
        </div><button class="btn" onclick="toast('Report generated successfully')">＋ Download
            Report</button>
    </div>
    <div class="stats">
        <div class="card stat">
            <div>
                <p>Total Orders</p>
                <h3>48</h3><small>↑ 12% this month</small>
            </div>
            <div class="stat-icon">🛍</div>
        </div>
        <div class="card stat">
            <div>
                <p>Total Spent</p>
                <h3>$4,280</h3><small>↑ 8.4% this month</small>
            </div>
            <div class="stat-icon">💳</div>
        </div>
        <div class="card stat">
            <div>
                <p>Pending Orders</p>
                <h3>4</h3><small style="color:var(--warning)">Needs attention</small>
            </div>
            <div class="stat-icon">⏳</div>
        </div>
        <div class="card stat">
            <div>
                <p>Reward Points</p>
                <h3>2,840</h3><small>+240 this month</small>
            </div>
            <div class="stat-icon">★</div>
        </div>
    </div>
    <div class="grid">
        <div class="card">
            <div class="card-head">
                <h2>Spending Overview</h2><select style="border:1px solid var(--border);padding:5px;border-radius:6px">
                    <option>Last 6 months</option>
                    <option>This year</option>
                </select>
            </div>
            <div class="chart">
                <div class="bar-wrap">
                    <div class="bar" style="height:45%"></div>
                    <div class="bar alt" style="height:60%"></div><span class="bar-label">Apr</span>
                </div>
                <div class="bar-wrap">
                    <div class="bar" style="height:62%"></div>
                    <div class="bar alt" style="height:52%"></div><span class="bar-label">May</span>
                </div>
                <div class="bar-wrap">
                    <div class="bar" style="height:55%"></div>
                    <div class="bar alt" style="height:72%"></div><span class="bar-label">Jun</span>
                </div>
                <div class="bar-wrap">
                    <div class="bar" style="height:76%"></div>
                    <div class="bar alt" style="height:65%"></div><span class="bar-label">Jul</span>
                </div>
                <div class="bar-wrap">
                    <div class="bar" style="height:68%"></div>
                    <div class="bar alt" style="height:80%"></div><span class="bar-label">Aug</span>
                </div>
                <div class="bar-wrap">
                    <div class="bar" style="height:88%"></div>
                    <div class="bar alt" style="height:70%"></div><span class="bar-label">Sep</span>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-head">
                <h2>Recent Activity</h2><a href="#" onclick="showPage('orders');return false">View all</a>
            </div>
            <div class="activity">
                <div class="activity-item">
                    <div class="circle">✓</div>
                    <div>Order <b>#ORD-1048</b> delivered<small>Today, 10:32 AM</small></div>
                </div>
                <div class="activity-item">
                    <div class="circle">💳</div>
                    <div>Payment received for <b>$240</b><small>Yesterday, 3:20 PM</small></div>
                </div>
                <div class="activity-item">
                    <div class="circle">📦</div>
                    <div>Order <b>#ORD-1047</b> shipped<small>Sep 7, 2026</small></div>
                </div>
                <div class="activity-item">
                    <div class="circle">🎫</div>
                    <div>Support ticket updated<small>Sep 6, 2026</small></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card table-card">
        <div class="card-head">
            <h2>Recent Orders</h2><a href="#" onclick="showPage('orders');return false">View all orders
                →</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="recentRows"></tbody>
            </table>
        </div>
    </div>
</div>
@endsection