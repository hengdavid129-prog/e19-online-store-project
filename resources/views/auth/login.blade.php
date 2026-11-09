@extends('layouts.guest')

@section('content')
<h2 class="text-center">Welcome back</h2>
    <p class="text-center">Sign in to continue shopping</p>

    <form action="{{ route('store-login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                value="{{ old('email') }}"
                >
            @error('email')
                <span class="text-danger">{{ $message }}</span>   
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="d-flex align-items-center justify-content-center">
                <input
                    id="password"
                    type="password" 
                    class="form-control rounded-end-0 @error('password') is-invalid @enderror"
                    name="password">
                <button id="toggle-password" type="button" class="btn btn-light rounded-start-0"><i class="fa-solid fa-eye-slash"></i></button>
            </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>  
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary w-100">Sign in</button>
        </div>
        <hr>
        <div class="mb-3">
            <a href="{{ route('register') }}" class="btn bg-transparent border border-dark border-opacity-50 w-100">Create a new account</a>
        </div>
    </form>
@endsection