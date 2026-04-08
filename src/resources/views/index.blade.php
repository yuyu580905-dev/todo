@extends('layouts.app')

@section('title', 'Todo一覧')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
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

        @error('content')
        <p class="message__text message__text--danger">
            {{ $message }}
        </p>
        @enderror

    </div>
</div>

<div class="todo">

    {{-- 新規作成 --}}
    <div class="todo__section">
        <h2 class="todo__title">新規作成</h2>

        <form class="todo-form" action="/todos" method="post">
            @csrf
            <input class="todo-form__input" type="text" name="content" value="{{ old('content') }}" placeholder="Todoを入力">
            <select class="todo-form__select" name="category_id">
                <option value="">カテゴリ選択</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button class="todo-form__button todo-form__button--create">作成</button>
        </form>
    </div>

    {{-- 検索 --}}
    <div class="todo__section">
        <h2 class="todo__title">Todo検索</h2>

        <form class="todo-form" action="/todos/search" method="get">
            @csrf
            <input class="todo-form__input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="Todoを入力">
            <select class="todo-form__select" name="category_id">
                <option value="">カテゴリ選択</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button class="todo-form__button">検索</button>
        </form>
    </div>

    {{-- 一覧 --}}
    <div class="todo-list">
        <div class="todo-list__header">
            <span>Todo</span>
            <span>カテゴリ</span>
        </div>

        @foreach($todos as $todo)
        <div class="todo-list__item">
            <form action="/todos/{{ $todo->id }}" method="post">
                @csrf
                @method('PATCH')

                <input type="text" name="content" value="{{ $todo->content }}">

                <select name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $todo->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>

                <button class="todo-list__button todo-list__button--update">更新</button>
            </form>

            <form action="/todos/{{ $todo->id }}" method="post">
                @csrf
                @method('DELETE')

                <button class="todo-list__button todo-list__button--delete">
                    削除
                </button>
            </form>

        </div>
        @endforeach

    </div>
</div>

@endsection