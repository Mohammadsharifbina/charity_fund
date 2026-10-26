<!DOCTYPE html>
<html lang="en">

@include("layout.head")

<body>
    <div class="overlay" id="overlay"></div>

    @include("layout.aside")

    <main class="main">
        @include("layout.header")

        <section class="content">
            <!-- DASHBOARD -->
            @yield("content")

            <!-- ORDERS -->
        </section>
    </main>
    <div class="toast" id="toast"></div>
    <script>
    const orders = [
        ['#ORD-1048', 'Sep 9, 2026', 'Premium Laptop', '1', '$1,240', 'Delivered'],
        ['#ORD-1047', 'Sep 7, 2026', 'Wireless Headphones', '2', '$320', 'Shipped'],
        ['#ORD-1046', 'Sep 4, 2026', 'Office Chair', '1', '$450', 'Pending'],
        ['#ORD-1045', 'Aug 31, 2026', 'Mechanical Keyboard', '2', '$180', 'Delivered'],
        ['#ORD-1044', 'Aug 27, 2026', '27" Monitor', '1', '$390', 'Delivered'],
        ['#ORD-1043', 'Aug 22, 2026', 'USB-C Hub', '3', '$150', 'Cancelled'],
        ['#ORD-1042', 'Aug 19, 2026', 'Web Camera', '1', '$210', 'Delivered'],
        ['#ORD-1041', 'Aug 15, 2026', 'Desk Lamp', '2', '$90', 'Pending']
    ];

    function status(s) {
        let c = s.toLowerCase();
        return `<span class="badge ${c}">${s}</span>`
    }

    function render() {
        document.getElementById('recentRows').innerHTML = orders.slice(0, 5).map(o =>
            `<tr><td><b>${o[0]}</b></td><td>${o[1]}</td><td>${o[2]}</td><td>${o[4]}</td><td>${status(o[5])}</td></tr>`
        ).join('');
        document.getElementById('orderRows').innerHTML = orders.map(o =>
            `<tr><td><b>${o[0]}</b></td><td>${o[1]}</td><td>${o[2]}</td><td>${o[3]}</td><td>${o[4]}</td><td>${status(o[5])}</td><td><button onclick="toast('Viewing ${o[0]}')" style="color:var(--primary);background:none">View</button></td></tr>`
        ).join('');
        const inv = orders.slice(0, 6).map((o, i) =>
            `<tr><td><b>#INV-${20260+i}</b></td><td>${o[1]}</td><td>${o[0]}</td><td>${o[4]}</td><td>${status(i===2?'Pending':'Paid')}</td><td><button onclick="toast('Invoice downloaded')" style="color:var(--primary);background:none">Download</button></td></tr>`
        ).join('');
        document.getElementById('invoiceRows').innerHTML = inv;
    }

    document.querySelectorAll('.nav a[data-page]').forEach(a => a.addEventListener('click', e => {
        e.preventDefault();
        showPage(a.dataset.page)
    }));
    document.getElementById('orderFilter').addEventListener('input', e => {
        const q = e.target.value.toLowerCase();
        document.querySelectorAll('#orderRows tr').forEach(r => r.style.display = r.innerText.toLowerCase()
            .includes(q) ? '' : 'none');
    });
    document.getElementById('globalSearch').addEventListener('input', e => {
        const q = e.target.value.toLowerCase();
        if (q) {
            showPage('orders');
            document.getElementById('orderFilter').value = q;
            document.getElementById('orderFilter').dispatchEvent(new Event('input'))
        }
    });

    function toast(msg) {
        const t = document.getElementById('toast');
        t.textContent = msg;
        t.classList.add('show');
        clearTimeout(window.tt);
        window.tt = setTimeout(() => t.classList.remove('show'), 2200)
    }

    function saveProfile() {
        toast('Profile changes saved successfully')
    }

    function closeMenu() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('overlay').classList.remove('show')
    }
    document.getElementById('menu').onclick = () => {
        document.getElementById('sidebar').classList.add('open');
        document.getElementById('overlay').classList.add('show')
    }
    document.getElementById('overlay').onclick = closeMenu;
    document.getElementById('logout').onclick = e => {
        e.preventDefault();
        toast('Logout clicked — connect this to your backend')
    }
    render();
    </script>
</body>

</html>