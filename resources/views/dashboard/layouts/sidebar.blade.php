<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Master</div>
                <a class="nav-link {{ Request::is('dashboard*') ? 'active' : null }}" href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link {{ Request::is('product*') ? 'active' : null }}" href="/product">
                    <div class="sb-nav-link-icon"><i class="fas fa-dove"></i></div>
                    Product
                </a>
                <a class="nav-link {{ Request::is('stock*') ? 'active' : null }}" href="/stock">
                    <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                    Stock
                </a>
                <div class="sb-sidenav-menu-heading">Transaction</div>
                <a class="nav-link {{ Request::is('barangmasuk*') ? 'active' : null }}" href="/barangmasuk">
                    <div class="sb-nav-link-icon"><i class="fas fa-warehouse"></i></div>
                    Barang Masuk
                </a>
                <a class="nav-link {{ Request::is('transaction*') ? 'active' : null }}" href="/transaction">
                    <div class="sb-nav-link-icon"><i class="fas fa-hand-holding-dollar"></i></div>
                    Penjualan
                </a>
                {{-- <a class="nav-link collapsed {{ Request::is('peminjaman*') ? 'active' : null }}" href="/peminjaman" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Transaksi
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('peminjaman*') | Request::is('pengembalian*') ? 'show' : null }}" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('peminjaman*') ? 'active' : null }}" href="/peminjaman">Peminjaman</a>
                        <a class="nav-link {{ Request::is('pengembalian*') ? 'active' : null }}" href="/pengembalian">Pengembalian</a>
                    </nav>
                </div> --}}

    </nav>
</div>
