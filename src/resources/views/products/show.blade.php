@extends('layouts.app')

@section('title','商品詳細')

@section('content')
  <h1>商品詳細</h1>

  @if($product->image)
    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width:480px;border-radius:8px;">
  @endif

  <div style="border:1px solid #eee;border-radius:8px;padding:12px;margin-top:12px;">
    <p><strong>商品名：</strong>{{ $product->name }}</p>
    <p><strong>値段：</strong>¥{{ number_format($product->price) }}</p>
    @if($product->seasons?->count())
      <p><strong>季節：</strong>{{ $product->seasons->pluck('name')->join('・') }}</p>
    @endif
    <p><strong>商品説明：</strong><br>{{ $product->description }}</p>
  </div>

  <div style="margin-top:12px;display:flex;gap:8px;flex-wrap:wrap;">
    <a href="{{ route('products.index') }}">戻る</a>
    <a href="{{ route('products.edit', ['product' => $product->id]) }}">変更</a>

    <form action="{{ route('products.destroy', ['product' => $product->id]) }}"
          method="POST" onsubmit="return confirm('削除しますか？')" style="display:inline;">
      @csrf @method('DELETE')
      <button type="submit">削除</button>
    </form>
  </div>
@endsection
