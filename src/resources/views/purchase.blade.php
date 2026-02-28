<!-- 商品購入画面 -->
@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')

<div class="purchase-container">
    <form action="{{ route('purchase.store', $item->id) }}" method="POST">
        @csrf

        <div class="purchase-flex">

            <!-- 左側 -->
            <div class="purchase-left">
                <div class="image-wrapper">
                    @if(Str::startsWith($item->img, 'items/'))
                    <!-- 自分で出品した画像（storage保存） -->
                    <img src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->name }}" width="350">
                    @else
                    <!-- シーダーで登録した画像用 -->
                    <img src="{{ asset($item->img) }}" alt="{{ $item->name }}" width="350">
                    @endif
                </div>

                <div class="item__detail">
                    <h1>{{ $item->name }}</h1>
                    <p>¥{{ number_format($item->price) }}(税込)</p>

                    <!-- 支払い方法 -->
                    <div class="form__group">
                        <div class="form__group-title">
                            <span class="form__label--item">支払い方法</span>
                        </div>
                        <div class="form__group-content">
                            <div class="form__input--select">
                                <select name="payment_method_id">
                                    <option value="">選択してください</option>
                                    @foreach($payment_methods as $payment_method)
                                    <option value="{{ $payment_method->id }}"
                                        {{ old('payment_method_id') == $payment_method->id ? 'selected' : '' }}>
                                        {{ $payment_method->content }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="form__error">
                                    @error('payment_method_id')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <!-- 配送先 -->
                            <div class="form__group">
                                <div class="form__group-title">
                                    <span class="form__label--item">配送先</span>
                                </div>
                                <div class="form__button">
                                    <a href="/purchase/address/{{ $item->id }}" class="form__button-submit">変更する</a>
                                </div>
                                <div class="form__group-content">
                                    <div class="form__input--text">
                                        <p>〒 {{ $user->post_code }}</p>
                                        <p>{{ $user->address }}{{ $user->building }}
                                        </p>
                                        <input type="hidden" name="address" value="{{ $user->address }}">
                                        <div class="form__error">
                                            @error('address')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 右側（小計） -->
                    <div class="purchase-right">
                        <div class="summary-box">
                            <div class="summary-row">
                                <span>商品代金</span>
                                <span>¥{{ number_format($item->price) }}</span>
                            </div>

                            <hr>

                            <div class="summary-row">
                                <span>支払い方法</span>
                                <span>{{ $payment_method->content }}</span>
                            </div>
                            <!-- <button type="submit" class="purchase-button">
                        購入する
                    </button> -->
                            <div class="form__button">
                                <button class="form__button-submit" type="submit">
                                    購入する
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
    </form>
</div>

@endsection