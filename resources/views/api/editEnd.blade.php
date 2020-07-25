@extends('layout')

@section('header')
    Edit End Point - {{$name}}
@endsection

@section('content')
@include('error', ['errors' => $errors])
@include('formEnd', ['action' => $action, 'name' => $name, 'end' => $end])
@endsection
