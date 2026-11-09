@extends('layouts.guest')

@section('title', 'Create account')

@section('content')
    <h2 class="text-center">Create your account</h2>
    <p class="text-center">Free and takes less than a minute</p>

    <form action="{{ route('store-register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input 
                type="text" 
                class="form-control @error('name') is-invalid @enderror"
                name="name"
                value="{{ old('name') }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                value="{{ old('email') }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input 
                type="text" 
                class="form-control @error('phone') is-invalid @enderror"
                name="phone"
                value="{{ old('phone') }}">
            @error('phone')
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
            <button class="btn btn-primary w-100">Create account</button>
        </div>
    </form>
@endsection

@section('content-footer')
    <p class="text-center mt-2">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Sign in</a> </p>
@endsection