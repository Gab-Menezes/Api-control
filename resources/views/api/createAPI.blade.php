@extends('layout')

@section('header')
    New API
@endsection

@section('content')
@include('error', ['errors' => $errors])
@include('formAPI', ['action' => $action, 'apiName' => $name, 'api' => $api, 'option' => $option])
@endsection
