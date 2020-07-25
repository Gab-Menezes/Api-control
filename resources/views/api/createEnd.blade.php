@extends('layout')

@section('header')
    New End Point
@endsection

@section('content')
@include('error', ['errors' => $errors])
@include('formEnd', ['action' => $action, 'name' => $name, 'end' => $end])
@endsection
