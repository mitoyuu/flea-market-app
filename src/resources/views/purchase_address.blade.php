<!-- 送付先住所変更画面 -->
@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase_address.css') }}">
@endsection

@section('content')
<div class="-form__content">
    <div class="mypage-form__heading">
        <h2>住所の変更</h2>
    </div>
    <form method="POST" action="/purchase/address/{{ $item->id }}">
        @csrf
        <!-- ↓ 見えないように『今の商品はこれ！』と教えるために記述必須 ないと$request->item が null になる-->
        <input type="hidden" name="item" value="{{ $item->id }}">

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">郵便番号</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="post_code" value="{{ old('post_code', $user->post_code) }}">
                </div>
                <div class="form__error">
                    @error('post_code')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" value="{{ old('address', $user->address) }}">
                </div>
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" value="{{ old('building', $user->building) }}">
                </div>
                <div class="form__error">
                    @error('building')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
        <input type="hidden" name="item_id" value="{{ $item->id }}">
    </form>
</div>
@endsection