<header class="topbar">
    <button class="toggle-btn" id="toggle" aria-label="Toggle sidebar">
        <i class="fa-solid fa-bars"></i>
    </button>
    <h1 id="page-title">@yield('title', 'My Store')</h1>

    <div class="profile" id="profile">
        <button class="profile-btn" id="profile-btn" aria-expanded="false">
            <span class="avatar"><i class="fa-solid fa-user"></i></span>
            <span class="profile-text">
                <span class="profile-name">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</span>
                <span class="profile-role">{{ auth()->user()->role->name }}</span>
            </span>
            <span class="profile-chev">
                <i class="fa-solid fa-angle-down"></i>
            </span>
        </button>
        <div class="pf-menu" id="profile-menu" role="menu" hidden>
            <div class="pf-head">
                <strong>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</strong>
                <span>{{ auth()->user()->email }}</span>
            </div>
            <a href="#profile" class="pf-item" role="menuitem">
                <i class="fa-solid fa-user"></i>
                My Profile
            </a>
            <hr>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="pf-item danger" role="menuitem">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Signout
                </button>
            </form>
        </div>
    </div>
</header>
