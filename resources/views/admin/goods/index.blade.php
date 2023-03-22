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
        <div class="grid_sum p-1">
            <div>Сумма гарантий: </div>
            <div><span>{{ $sum }}</span> ₽</div>
        </div>
        <div class="grid_sum p-1">
            <div>Страховой взнос 0.8%: </div>
            <div><span>{{ $pay }}</span> ₽</div>
        </div>
    @else
        <h4>Такого документа не существует</h4>
    @endif
    <div class="p-1"><a class="btn btn-primary" onclick="window.history.go(-1); return false;">Назад</a></div>
    <div></div>
@endsection
