<!-- プロフィール設定画面 -->
@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage_profile.css') }}">
@endsection

@section('content')
<div class="-form__content">
    <div class="mypage-form__heading">
        <h2>プロフィール設定</h2>
    </div>
    <form method="POST" action="/mypage/profile" enctype="multipart/form-data">
        <!-- ⇧ enctype="multipart/form-data">を使うことにより画像も保存できる -->
        @csrf
        <div class="form__group">
            <div class="form__image">
                <div class="form__image-preview">
                    <img src="{{ asset(auth()->user()->img) }}" alt="ユーザーアイコン">
                </div>
                <label class="form__image-select">
                    画像を選択する
                    <input type="file" name="img">
                    <div class="form__error">
                        @error('img')
                        {{ $message }}
                        @enderror
                    </div>
                </label>
            </div>
            <div class="form__group-title">
                <span class="form__label--item">ユーザー名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" value="{{ old('name', $user->name) }}">
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
    </form>
</div>
@endsection