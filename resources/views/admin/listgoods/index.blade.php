@extends('layouts.app')

@section('head_title', 'Админ панель')
@section('header_title', 'Админ панель')
@section('body_title', 'Список документов')
@section('header_button')
    <a class="btn btn-danger btn-sm" href="{{ route('authLogout') }}">Выход</a>
@endsection
@section('body_content')
    @if($list)
        <table class="table_good p-1">
        <thead>
        <tr>
            <th>ID листа</th>
            <th>Дата отправки</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $el)
            <tr>
            <td>{{ $el->id }}</td>
            <td>{{ $el->created_at }}</td>
            <td><a class="btn btn-info btn-sm text-white" href="{{ route('good_card', $el->id) }}">Смотреть товары</a></td>
            </tr>
        @endforeach
        </tbody>
        </table>
        <div class="p-1">
            {{ $links->links() }}
        </div>
    @endif
@endsection
