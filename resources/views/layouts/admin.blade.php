<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
        integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>

<body>
    <div class="app">
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
                <a href="#dashboard" class="nav-item active" title="Dashboard">
                    <i class="fa-solid fa-gauge"></i>
                    <span class="label">Dashboard</span>
                </a>
                <a href="#category" class="nav-item" title="Category">
                    <i class="fa-solid fa-layer-group"></i>
                    <span class="label">Category</span>
                </a>
                <a href="#product" class="nav-item" title="Product">
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

        {{-- Dark overlay behind the drawer on mobile --}}
        <div class="backdrop" id="backdrop"></div>

        <main class="content">
            <header class="topbar">
                <button class="toggle-btn" id="toggle" aria-label="Toggle sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h1 id="page-title">Dashboard</h1>

                <div class="profile" id="profile">
                    <button class="profile-btn" id="profile-btn" aria-expanded="false">
                        <span class="avatar"><i class="fa-solid fa-user"></i></span>
                        <span class="profile-text">
                            <span class="profile-name">{{ auth()->user()->name }}</span>
                            <span class="profile-role">{{ auth()->user()->role->name }}</span>
                        </span>
                        <span class="profile-chev">
                            <i class="fa-solid fa-angle-down"></i>
                        </span>
                    </button>
                    <div class="pf-menu" id="profile-menu" role="menu" hidden>
                        <div class="pf-head">
                            <strong>{{ auth()->user()->name }}</strong>
                            <span>{{ auth()->user()->email }}</span>
                        </div>
                        <a href="#profile" class="pf-item" role="menuitem">
                            <i class="fa-solid fa-user"></i>
                            My Profile
                        </a>
                        <hr>
                        <form method="POST" action="{{ route('logout') }}">
                            <button type="submit" class="pf-item danger" role="menuitem">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                Signout
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            <div class="page container-fluid">

            </div>
        </main>
    </div>

    <script>
        
    </script>
</body>

</html>
