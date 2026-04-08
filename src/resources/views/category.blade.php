@extends('layouts.app')

@section('title', 'カテゴリ一覧')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')

{{-- メッセージ --}}
<div class="message">
    <div class="message__inner">

        @if(session('message'))
        <p class="message__text message__text--success">
            {{ session('message') }}
        </p>
        @endif

        @error('name')
        <p class="message__text message__text--danger">
            {{ $message }}
        </p>
        @enderror

    </div>
</div>

<div class="category">

    {{-- 作成 --}}
    <form class="category-form" action="/categories" method="post">
        @csrf
        <input class="category-form__input" type="text" name="name" value="{{ old('name') }}" placeholder="カテゴリを入力">
        <button class="category-form__button">作成</button>
    </form>

    {{-- 一覧 --}}
    <div class="category-list">
        <h2 class="category-list__title">Category</h2>

        @foreach($categories as $category)
        <div class="category-list__item">
            <form action="/categories/update" method="post">
                @csrf
                @method('PATCH')

                <input type="text" name="name" value="{{ $category->name }}">
                <input type="hidden" name="id" value="{{ $category->id }}">

                <button class="category-list__button category-list__button--update">更新</button>
            </form>

            <form action="/categories/delete" method="post">
                @csrf
                @method('DELETE')

                <input type="hidden" name="id" value="{{ $category->id }}">
                <button class="category-list__button category-list__button--delete">削除</button>
            </form>

        </div>
        @endforeach
    </div>

</div>


@endsection