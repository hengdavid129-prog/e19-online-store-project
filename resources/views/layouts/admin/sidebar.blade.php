<aside class="sidebar" id="sidebar">
    <div class="sb-header">
        <div class="logo"><i class="fa-solid fa-bag-shopping"></i></div>
        <div class="sb-brand">
            <span class="sb-title">My Store</span>
            <span class="sb-subtitle">Admin Panel</span>
        </div>
        <button class="icon-btn close-btn" id="close">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <nav class="sb-nav" aria-label="Admin">
        <a href="{{ route('admin.dashboard') }}"
            class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" title="Dashboard">
            <i class="fa-solid fa-gauge"></i>
            <span class="label">Dashboard</span>
        </a>
        <a href="{{ route('admin.category') }}"
            class="nav-item {{ request()->routeIs('admin.category') ? 'active' : '' }}" title="Category">
            <i class="fa-solid fa-layer-group"></i>
            <span class="label">Category</span>
        </a>
        <a href="{{ route('admin.product') }}"
            class="nav-item {{ request()->routeIs('admin.product') ? 'active' : '' }}" title="Product">
            <i class="fa-solid fa-box-open"></i>
            <span class="label">Product</span>
        </a>
    </nav>
    <div class="sb-footer">
        <a href="{{ route('welcome') }}" class="nav-item back-shop" title="Back to Shop">
            <span class="icon">
                <i class="fa-solid fa-bag-shopping"></i>
            </span>
            <span class="footer-text">
                <span class="footer-title">Back to Shop</span>
                <span class=" footer-subtitle">My store</span>
            </span>
        </a>
    </div>
</aside>
