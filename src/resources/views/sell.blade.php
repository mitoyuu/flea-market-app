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
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">商品画像</span>
                <div class="form__image">
                    <div class="form__image-preview">
                        <!-- <img src="{{ asset(auth()->user()->img) }}" alt="商品画像"> -->
                    </div>
                    <label class="form__image-select">
                        画像を選択する
                        <input type="file" name="img">
                    </label>
                    <div class="form__error">
                        @error('img')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">商品の詳細</span>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">カテゴリー</span>
                    @foreach($categories as $category)
                    <label>
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}">
                        {{ $category->content }}
                    </label>
                    @endforeach
                </div>
                <div class="form__error">
                    @error('category_ids')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">商品の状態</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--select">
                            <select name="status_id">
                                <option value="">選択してください</option>
                                @foreach($statuses as $status)
                                <option value="{{ $status->id }}">
                                    {{ $status->content }}
                                </option>
                                @endforeach
                            </select>
                            <div class="form__error">
                                @error('status_id')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">商品名と説明</span>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">商品名</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="name" value="{{ old('name') }}" />
                        </div>
                        <div class="form__error">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">ブランド名</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="brand" value="{{ old('brand') }}" />
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">商品の説明</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="description" value="{{ old('description') }}" />
                        </div>
                        <div class="form__error">
                            @error('description')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">販売価格</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="price" value="{{ old('price') }}" />
                    </div>
                    <div class="form__error">
                        @error('price')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">出品する</button>
            </div>
    </form>
</div>
@endsection