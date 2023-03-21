@extends('layouts.app')

@section('head_title', 'Гарантийные обязательства на доставку грузов')
@section('header_title', 'Гарантийные обязательства на доставку грузов')
@section('body_title', 'Перечень товаров')
@section('header_button')
    @auth
        <a class="btn btn-primary btn-sm" href="{{ route('admin_panel') }}">Вход</a>
    @endauth
    @guest
        <auth-vue></auth-vue>
    @endguest
@endsection
@section('body_content')
    <list-goods-vue v-bind:arr_goods="arr_goods"></list-goods-vue>
    <sum-goods-vue v-bind:arr_goods="arr_goods"></sum-goods-vue>
    <xml-goods-vue v-bind:arr_goods="arr_goods"></xml-goods-vue>
@endsection

