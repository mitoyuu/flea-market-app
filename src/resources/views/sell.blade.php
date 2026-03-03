<!-- 商品出品画面 -->
@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')

<div class="item-sell__content">
    <div class="item-sell__heading">
        <h2>商品の出品</h2>
    </div>

    <form class="form" action="/sell" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品画像 -->
        <div class="form__group">
            <span class="form__label--item">商品画像</span>

            <div class="form__image">
                <div class="form__image-preview"></div>

                <label class="form__image-select">
                    画像を選択する
                    <input type="file" name="img">
                </label>
            </div>

            <div class="form__error">
                @error('img') {{ $message }} @enderror
            </div>
        </div>

        <!-- 商品の詳細 -->
        <div class="form__group">
            <span class="form__label--item section-title">商品の詳細</span>
        </div>

        <!-- カテゴリー -->
        <div class="form__group">
            <span class="form__label--item">カテゴリー</span>

            <div class="category-list">
                @foreach($categories as $category)
                <label class="category-item">
                    <input type="checkbox" name="category_ids[]" value="{{ $category->id }}">
                    <span>{{ $category->content }}</span>
                </label>
                @endforeach
            </div>

            <div class="form__error">
                @error('category_ids') {{ $message }} @enderror
            </div>
        </div>

        <!-- 商品の状態 -->
        <div class="form__group">
            <span class="form__label--item">商品の状態</span>

            <select name="status_id">
                <option value="">選択してください</option>
                @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->content }}</option>
                @endforeach
            </select>

            <div class="form__error">
                @error('status_id') {{ $message }} @enderror
            </div>
        </div>

        <!-- 商品名と説明 -->
        <div class="form__group">
            <span class="form__label--item section-title">商品名と説明</span>
        </div>

        <!-- 商品名 -->
        <div class="form__group">
            <span class="form__label--item">商品名</span>
            <input type="text" name="name" value="{{ old('name') }}">
            <div class="form__error">
                @error('name') {{ $message }} @enderror
            </div>
        </div>

        <!-- ブランド名 -->
        <div class="form__group">
            <span class="form__label--item">ブランド名</span>
            <input type="text" name="brand" value="{{ old('brand') }}">
        </div>

        <!-- 商品説明 -->
        <div class="form__group">
            <span class="form__label--item">商品の説明</span>
            <textarea name="description">{{ old('description') }}</textarea>
            <div class="form__error">
                @error('description') {{ $message }} @enderror
            </div>
        </div>

        <!-- 販売価格 -->
        <div class="form__group">
            <span class="form__label--item">販売価格</span>
            <input type="text" name="price" value="{{ old('price') }}">
            <div class="form__error">
                @error('price') {{ $message }} @enderror
            </div>
        </div>

        <!-- 出品ボタン -->
        <div class="form__button">
            <button class="form__button-submit" type="submit">出品する</button>
        </div>

    </form>
</div>
@endsection