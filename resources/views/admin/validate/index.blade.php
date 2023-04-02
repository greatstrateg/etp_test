@extends('layouts.app')

@section('head_title', 'Админ панель')
@section('header_title', 'Админ панель')
@section('body_title', 'Проверка подписи')
@section('header_button')
    <a class="btn btn-danger btn-sm" href="{{ route('authLogout') }}">Выход</a>
@endsection
@section('body_content')
    @if($data)
        <div>{{ $date->xml_string }}</div>
        <div>{{ $date->sign }}</div>
    @endif
@endsection
