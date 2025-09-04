<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;

class ProductController extends Controller
{
    /**
     * 商品一覧（検索・並び替え対応）
     */
    public function index(Request $request)
    {
        $query = Product::with('seasons');

        // 商品名検索
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->input('q') . '%');
        }

        // 価格の並び替え
        $sort = $request->input('sort');
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');   // 低い順
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');  // 高い順
        } else {
            $query->orderBy('id', 'asc');      // デフォルト
        }

        $products = $query->paginate(6)->appends($request->query());

        return view('products.index', compact('products'));
    }

    /**
     * /products/search からのリクエストを index() に委譲
     */
    public function search(Request $request)
    {
        return $this->index($request);
    }

    /**
     * 商品詳細
     */
    public function show(Product $product)
    {
        $product->load('seasons');
        return view('products.show', compact('product'));
    }

    /**
     * 商品登録フォーム
     */
    public function create()
    {
        $seasonList = Season::orderBy('id')->pluck('name')->all();
        return view('products.create', compact('seasonList'));
    }

    /**
     * 商品登録
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'price'       => ['required','integer','between:0,10000'],
            'description' => ['required','string','max:120'],
            'image'       => ['required','string','max:255','regex:/\.(png|jpe?g)$/i'],
            'seasons'     => ['required','array','min:1'],
        ], [], [
            'name'        => '商品名',
            'price'       => '値段',
            'description' => '商品説明',
            'image'       => '商品画像',
            'seasons'     => '季節',
        ]);

        $product = Product::create([
            'name'        => $data['name'],
            'price'       => $data['price'],
            'image'       => $data['image'],
            'description' => $data['description'],
        ]);

        $seasonIds = Season::whereIn('name', $data['seasons'])->pluck('id')->all();
        $product->seasons()->sync($seasonIds);

        return redirect()->route('products.index');
    }

    /**
     * 商品編集フォーム
     */
    public function edit(Product $product)
    {
        $product->load('seasons');
        $seasonList = Season::orderBy('id')->pluck('name')->all();
        return view('products.edit', compact('product','seasonList'));
    }

    /**
     * 商品更新
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'price'       => ['required','integer','between:0,10000'],
            'description' => ['required','string','max:120'],
            'image'       => ['required','string','max:255','regex:/\.(png|jpe?g)$/i'],
            'seasons'     => ['required','array','min:1'],
        ], [], [
            'name'        => '商品名',
            'price'       => '値段',
            'description' => '商品説明',
            'image'       => '商品画像',
            'seasons'     => '季節',
        ]);

        $product->update([
            'name'        => $data['name'],
            'price'       => $data['price'],
            'image'       => $data['image'],
            'description' => $data['description'],
        ]);

        $seasonIds = Season::whereIn('name', $data['seasons'])->pluck('id')->all();
        $product->seasons()->sync($seasonIds);

        return redirect()->route('products.show', ['product' => $product->id]);
    }

    /**
     * 商品削除
     */
    public function destroy(Product $product)
    {
        $product->seasons()->detach();
        $product->delete();
        return redirect()->route('products.index');
    }
}
