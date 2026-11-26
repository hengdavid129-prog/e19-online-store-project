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
    @yield('style')
</head>

<body>
    <div class="app">
        @include('layouts.admin.sidebar')

        {{-- Dark overlay behind the drawer on mobile --}}
        <div class="backdrop" id="backdrop"></div>

        <main class="content">
            @include('layouts.admin.topbar')

            <div class="page container-fluid">
                @yield('content')
            </div>
            
        </main>
    </div>

    @stack('script')
    @yield('script')
</body>

</html>
