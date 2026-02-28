<!-- プロフィール画面 -->
@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="form__content">
    <div class="form__group">
        <div class="form__image">
            <div class="form__image-preview">
                <img src="{{ asset(auth()->user()->img) }}" alt="ユーザーアイコン">
            </div>
            <div class="form__heading">
                <h1>{{ $user->name }}</h1>
            </div>
            <div class="form__button">
                <a href="/mypage/profile" class="form__button-submit">プロフィールを編集</a>
            </div>
        </div>
    </div>
    <div class="tab-area">

        {{-- 出品した商品 --}}
        <a href="{{ url('/mypage?page=sell') }}"
            class="tab {{ $page === 'sell' ? 'active' : '' }}">
            出品した商品
        </a>

        {{-- 購入した商品 --}}
        <a href="{{ url('/mypage?page=buy') }}"
            class="tab {{ $page === 'buy' ? 'active' : '' }}">
            購入した商品
        </a>

    </div>
    <div class="items">
        @foreach ($items as $item)
        <div class="item">
            <a href="{{ route('item.show', $item->id) }}">
                @if(Str::startsWith($item->img, 'items/'))
                <!-- 自分で出品した画像（storage保存） -->
                <img src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->name }}" width="350">
                @else
                <!-- シーダーで登録した画像用 -->
                <img src="{{ asset($item->img) }}" alt="{{ $item->name }}" width="350">
                @endif
            </a>
            <p>{{ $item->name }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection