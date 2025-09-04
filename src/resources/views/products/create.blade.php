@extends('layouts.app')

@section('title','商品登録')

@section('content')
  <h1>商品登録</h1>

  @if ($errors->any())
    <div style="border:1px solid #f99;background:#fff6f6;padding:8px;border-radius:6px;margin-bottom:12px;">
      <ul style="margin:0;padding-left:18px;">
        @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  @php
    // コントローラから $seasonList（['春','夏','秋','冬']）が来る想定。無い時の保険。
    $seasonList = isset($seasonList) && count($seasonList) ? $seasonList : ['春','夏','秋','冬'];
  @endphp

  <form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div style="margin:10px 0;">
      <label>商品名</label><br>
      <input type="text" name="name" value="{{ old('name') }}" style="width:100%;">
    </div>

    <div style="margin:10px 0;">
      <label>値段</label><br>
      <input type="number" name="price" value="{{ old('price') }}" style="width:100%;">
    </div>

    <div style="margin:10px 0;">
      <span>季節</span><br>
      @foreach($seasonList as $s)
        <label style="margin-right:12px;">
          <input type="radio" name="seasons[]" value="{{ $s }}" {{ in_array($s, old('seasons', [])) ? 'checked' : '' }}>
          {{ $s }}
        </label>
      @endforeach
    </div>

    <div style="margin:10px 0;">
      <label>商品説明</label><br>
      <textarea name="description" rows="5" style="width:100%;">{{ old('description') }}</textarea>
    </div>

    <div style="margin:10px 0;">
      <label>商品画像</label><br>
      {{-- 画像はパス保存（例：images/banana.png / storage/products/xxx.jpg） --}}
      <input type="text" name="image" value="{{ old('image') }}" placeholder="例）images/banana.png" style="width:100%;">
    </div>

    <div style="margin-top:12px;display:flex;gap:8px;">
      <a href="{{ route('products.index') }}">戻る</a>
      <button type="submit">登録</button>
    </div>
  </form>
@endsection
