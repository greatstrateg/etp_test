@extends('layouts.app')

@section('head_title', 'Админ панель')
@section('header_title', 'Админ панель')
@section('body_title', 'Список товаров')
@section('header_button')
    <a class="btn btn-danger btn-sm" href="{{ route('authLogout') }}">Выход</a>
@endsection
@section('body_content')
    @if(count($goods))
        <table class="table_good p-1">
        <thead>
        <tr>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Страховка</th>
        </tr>
        </thead>
        <tbody>
        @foreach($goods as $good)
            <tr>
            <td>{{ $good->name }}</td>
            <td>{{ $good->quality }}</td>
            <td>{{ $good->guarant }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    @else
        <h4>Такого документа не существует</h4>
    @endif
    <div class="p-1"><a class="btn btn-primary" onclick="window.history.go(-1); return false;">Назад</a></div>
@endsection
