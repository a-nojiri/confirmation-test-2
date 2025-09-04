@extends('layouts.app')

@section('title','商品変更')

@section('content')
  <h1>商品変更</h1>

  @if ($errors->any())
    <div style="border:1px solid #f99;background:#fff6f6;padding:8px;border-radius:6px;margin-bottom:12px;">
      <ul style="margin:0;padding-left:18px;">
        @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  @php
    $seasonList = isset($seasonList) && count($seasonList) ? $seasonList : ['春','夏','秋','冬'];
    $checked = old('seasons', $product->seasons?->pluck('name')->all() ?? []);
  @endphp

  @if($product->image)
    <div style="margin-bottom:12px;">
      <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width:360px;border-radius:8px;">
    </div>
  @endif

  <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
    @csrf @method('PUT')

    <div style="margin:10px 0;">
      <label>商品名</label><br>
      <input type="text" name="name" value="{{ old('name', $product->name) }}" style="width:100%;">
    </div>

    <div style="margin:10px 0;">
      <label>値段</label><br>
      <input type="number" name="price" value="{{ old('price', $product->price) }}" style="width:100%;">
    </div>

    <div style="margin:10px 0;">
      <span>季節</span><br>
      @foreach($seasonList as $s)
        <label style="margin-right:12px;">
          <input type="radio" name="seasons[]" value="{{ $s }}" {{ in_array($s, $checked) ? 'checked' : '' }}>
          {{ $s }}
        </label>
      @endforeach
    </div>

    <div style="margin:10px 0;">
      <label>商品説明</label><br>
      <textarea name="description" rows="5" style="width:100%;">{{ old('description', $product->description) }}</textarea>
    </div>

    <div style="margin:10px 0;">
      <label>商品画像</label><br>
      <input type="text" name="image" value="{{ old('image', $product->image) }}" style="width:100%;">
    </div>

    <div style="margin-top:12px;display:flex;gap:8px;flex-wrap:wrap;">
      <a href="{{ route('products.show', ['product' => $product->id]) }}">戻る</a>
      <button type="submit">変更を保存</button>
    </div>
  </form>

  <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST"
        onsubmit="return confirm('削除しますか？')" style="margin-top:12px;">
    @csrf @method('DELETE')
    <button type="submit">削除</button>
  </form>
@endsection
