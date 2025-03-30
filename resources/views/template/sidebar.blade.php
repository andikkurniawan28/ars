<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-gamepad"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ARS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('dashboard-aktif')">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>
                {{ str_replace('_', ' ', ucwords('dashboard')) }}
            </span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @yield('master-aktif')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#master"
            aria-expanded="true" aria-controls="master">
            <i class="fas fa-fw fa-database"></i>
            <span>
                {{ str_replace('_', ' ', ucwords('master')) }}
            </span>
        </a>
        <div id="master" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('cabang.index') }}">{{ str_replace('_', ' ', ucwords('cabang')) }}</a>
                <a class="collapse-item" href="{{ route('peran.index') }}">{{ str_replace('_', ' ', ucwords('peran')) }}</a>
                <a class="collapse-item" href="{{ route('user.index') }}">{{ str_replace('_', ' ', ucwords('user')) }}</a>
                <a class="collapse-item" href="{{ route('supplier.index') }}">{{ str_replace('_', ' ', ucwords('supplier')) }}</a>
                <a class="collapse-item" href="{{ route('pelanggan.index') }}">{{ str_replace('_', ' ', ucwords('pelanggan')) }}</a>
                <a class="collapse-item" href="{{ route('jenis_konsol.index') }}">{{ str_replace('_', ' ', ucwords('jenis_konsol')) }}</a>
                <a class="collapse-item" href="{{ route('firmware.index') }}">{{ str_replace('_', ' ', ucwords('firmware')) }}</a>
                <a class="collapse-item" href="{{ route('konsol.index') }}">{{ str_replace('_', ' ', ucwords('konsol')) }}</a>
                <a class="collapse-item" href="{{ route('meja.index') }}">{{ str_replace('_', ' ', ucwords('meja')) }}</a>
                <a class="collapse-item" href="{{ route('akun.index') }}">{{ str_replace('_', ' ', ucwords('akun')) }}</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @yield('transaksi-aktif')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi"
            aria-expanded="true" aria-controls="transaksi">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>{{ str_replace('_', ' ', ucwords('transaksi')) }}</span>
        </a>
        <div id="transaksi" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">{{ str_replace('_', ' ', ucwords('pembelian_konsumsi')) }}</a>
                <a class="collapse-item" href="">{{ str_replace('_', ' ', ucwords('penjualan_konsumsi')) }}</a>
                <a class="collapse-item" href="">{{ str_replace('_', ' ', ucwords('penjualan_rental')) }}</a>
                <a class="collapse-item" href="">{{ str_replace('_', ' ', ucwords('jurnal_umum')) }}</a>
                <a class="collapse-item" href="">{{ str_replace('_', ' ', ucwords('log_aktivitas')) }}</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @yield('laporan-aktif')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan"
            aria-expanded="true" aria-controls="laporan">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>{{ str_replace('_', ' ', ucwords('laporan')) }}</span>
        </a>
        <div id="laporan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">{{ str_replace('_', ' ', ucwords('buku_besar')) }}</a>
                <a class="collapse-item" href="">{{ str_replace('_', ' ', ucwords('arus_kas')) }}</a>
                <a class="collapse-item" href="">{{ str_replace('_', ' ', ucwords('laba_rugi')) }}</a>
                <a class="collapse-item" href="">{{ str_replace('_', ' ', ucwords('neraca')) }}</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
