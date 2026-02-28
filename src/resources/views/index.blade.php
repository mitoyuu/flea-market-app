<!-- 商品一覧画面 -->
@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="tab-area">

    {{-- おすすめタブ --}}
    <a href="{{ url('/') }}"
        class="tab {{ $tab === 'recommend' ? 'active' : '' }}">
        おすすめ
    </a>

    {{-- マイリストタブ --}}
    <a href="{{ url('/?tab=mylist') }}"
        class="tab {{ $tab === 'mylist' ? 'active' : '' }}">
        マイリスト
    </a>

</div>
<div class="items">
    @foreach ($items as $item)
    <div class="item">
        <a href="{{ route('item.show', $item->id) }}">
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
        </a>
        <p>{{ $item->name }}</p>
    </div>
    @endforeach
</div>

@endsection