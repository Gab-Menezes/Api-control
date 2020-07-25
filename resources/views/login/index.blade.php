@extends('layout')

@section('header')
    Sign in
@endsection

@section('content')
    <form method="post">
        @csrf
        <div class="form-group">
            <label for="email" style="color: #CCCCCC">Email</label>
        <input type="email" name="email" id="email" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password" style="color: #CCCCCC">Password</label>
            <input type="password" name="password" id="password" required min="1" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            Login
        </button>

        <a href="/CreateAcc" class="btn btn-secondary mt-3">
            Create new account
        </a>
    </form>
@endsection
