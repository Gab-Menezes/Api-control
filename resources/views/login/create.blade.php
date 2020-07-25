@extends('layout')

@section('header')
    Create Account
@endsection

@section('content')
<form method="post">
    @csrf
    <div class="form-group">
        <label for="name" style="color: #CCCCCC">Name</label>
        <input type="text" name="name" id="name" required class="form-control">
    </div>

    <div class="form-group">
        <label for="email" style="color: #CCCCCC">Email</label>
        <input type="email" name="email" id="email" required class="form-control">
    </div>

    <div class="form-group">
        <label for="password" style="color: #CCCCCC">Password</label>
        <input type="password" name="password" id="password" required min="1" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary mt-3">
        Create
    </button>
</form>
@endsection
