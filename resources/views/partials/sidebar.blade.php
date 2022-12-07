

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard.show')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.showApproval')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Approval</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{route('show.buyOut')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Buy-Out</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{route('show.payment')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Payment Check</span></a>
    </li>

</ul>
<!-- End of Sidebar -->
