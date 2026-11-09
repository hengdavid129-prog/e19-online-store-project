<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Online Store')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="d-flex justify-content-center align-items-center gap-2 pt-3 pb-3">
        <span class="fs-1"><i class="fa-solid fa-store"></i></span>
        <h1>My Store</h1>
    </header>
    <main>
        <div class="d-flex justify-content-center align-items-center">
            <div class="w-25 p-4 rounded-2" style="background-color: #d8d7d7">
                @yield('content')
            </div>
        </div>
        @yield('content-footer')
    </main>

    <script>
        const passwordToggle = document.getElementById('toggle-password');
        passwordToggle.addEventListener('click', function (e) {
            passwordInput = document.getElementById('password');
            if (passwordInput.type == 'password') {
                passwordToggle.innerHTML = '<i class="fa-regular fa-eye"></i>';
                passwordInput.type = 'text';
            } else {
                passwordToggle.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
                passwordInput.type = 'password';
            }
        });
    </script>
</body>
</html>