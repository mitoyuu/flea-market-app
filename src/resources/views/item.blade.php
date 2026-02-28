<!-- 商品詳細画面 -->
@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')

<div class="items">
    <div class="item__img">
        <div class="image-wrapper">
            @if(Str::startsWith($item->img, 'items/'))
            <!-- 自分で出品した画像（storage保存） -->
            <img src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->name }}" width="350">
            @else
            <!-- シーダーで登録した画像用 -->
            <img src="{{ asset($item->img) }}" alt="{{ $item->name }}" width="350">
            @endif

            @if ($item->buyer_id)
            <div class="sold-label">Sold</div>
            @endif
        </div>
    </div>
    <div class="item__detail">
        <h1>{{ $item->name }}</h1>
        <p>{{ $item->brand }}</p>
        <p>¥{{ number_format($item->price) }}(税込)</p>
        @if($item->isFavoritedBy(auth()->user()))
        <!-- この商品は、今ログインしてる人に「いいね♡」されてる？ -->
        <!-- {{-- すでにいいねしている → 削除 --}} -->
        <form method="POST" action="{{ route('favorite.destroy', $item) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="favorite-btn"> <img src="{{ asset('img/ハートロゴ_ピンク.png') }}" alt="いいね">
            </button>
        </form>
        @else
        <!-- {{-- まだいいねしていない → 保存 --}} -->
        <form method="POST" action="{{ route('favorite.store', $item) }}">
            @csrf
            <button type="submit" class="favorite-btn"> <img src="{{ asset('img/ハートロゴ_デフォルト.png') }}" alt="いいね">
            </button>
        </form>
        @endif
        <!-- いいね数 -->
        <p>{{ $item->favorites_count }}</p>
        <img src="{{ asset('img/ふきだしロゴ.png') }}" alt="コメント">
        <!-- コメント数 -->
        <p>{{ $item->comments_count }}</p>
        </form>

        <div class="form__button">
            <a href="/purchase/{{ $item->id }}" class="form__button-submit">購入手続きへ</a>
        </div>
        <h2>商品説明</h2>
        <p>{{ $item->description }}</p>
        <h2>商品の情報</h2>
        <p>
            カテゴリー
            @foreach ($item->categories as $category)
            <span>{{ $category->content }}</span>
            @endforeach
        </p>
        <p>商品の状態 {{ $item->status->content }} </p>
    </div>
    <form class="form" action="{{ route('comments.store', $item->id) }}" method="POST">
        @csrf
        <p>コメント ( {{ $item->comments_count }} )</p>

        @foreach($item->comments as $comment)
        <img src="{{ asset($comment->user->img) }}" alt="ユーザーアイコン">
        <p>{{ $comment->user->name }}</p>
        <p>{{ $comment->content }}</p>
        @endforeach
        <div class="form__group">
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <textarea name="content"></textarea>
                    <div class="form__error">
                        @error('content')
                        {{ $message }}
                        @enderror
                    </div>
                    <button class="form__button" type="submit">コメントを送信する</button>
                </div>
            </div>
        </div>
    </form>
    @endsection