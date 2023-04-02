@extends('layouts.app')

@section('head_title', 'Админ панель')
@section('header_title', 'Админ панель')
@section('body_title', 'Проверка подписи')
@section('header_button')
    <a class="btn btn-danger btn-sm" href="{{ route('authLogout') }}">Выход</a>
@endsection
@section('body_content')
    @if($data)
        <div class="form-group mt-2">
            <label class="ms-1">XML файл:</label>
            <textarea class="form-control mt-2" rows="5">{{ $data->xml_string }}</textarea>
        </div>
        <div class="form-group mt-2">
            <label class="ms-1">Подпись:</label>
            <textarea class="form-control  mt-2" rows="5">{{ $data->signature }}</textarea>
        </div>
    @endif
@endsection
