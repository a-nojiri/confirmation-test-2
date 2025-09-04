@extends('layouts.app')

@section('title','商品一覧')

@section('content')
  <h1>商品一覧</h1>

{{-- 商品名で検索 --}}
<form method="GET" action="{{ route('products.index') }}" style="margin-bottom:8px;">
  <input type="text" name="q" value="{{ request('q') }}" placeholder="商品名を検索">
  <input type="hidden" name="sort" value="{{ request('sort') }}">
  <button type="submit">検索</button>
</form>

{{-- 価格順で表示（高い順 / 低い順） --}}
<form method="GET" action="{{ route('products.index') }}" style="margin-bottom:16px;">
  @if(request('q'))
    <input type="hidden" name="q" value="{{ request('q') }}">
  @endif
  <label>価格順で表示</label>
  <select name="sort">
    <option value="">選択しない</option>
    <option value="price_desc" {{ request('sort')==='price_desc' ? 'selected' : '' }}>高い順に表示</option>
    <option value="price_asc"  {{ request('sort')==='price_asc'  ? 'selected' : '' }}>低い順に表示</option>
  </select>
  <button type="submit">並び替え</button>
</form>


  <p style="text-align:right;margin-bottom:8px;">
    <a href="{{ route('products.create') }}">＋ 商品を追加</a>
  </p>

  @if($products->count())
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;">
      @foreach($products as $p)
        <a href="{{ route('products.show', ['product' => $p->id]) }}"
           style="text-decoration:none;color:inherit;border:1px solid #eee;border-radius:8px;padding:10px;display:block;">
          @if($p->image)
            <img src="{{ asset($p->image) }}" alt="{{ $p->name }}" style="width:100%;height:auto;border-radius:6px;">
          @endif
          <div style="margin-top:6px;font-weight:600">{{ $p->name }}</div>
          <div>¥{{ number_format($p->price) }}</div>
        </a>
      @endforeach
    </div>

    <div style="margin-top:12px;">
      {{ $products->appends(request()->query())->links() }}
    </div>
  @else
    <p>商品がありません。</p>
  @endif
@endsection
