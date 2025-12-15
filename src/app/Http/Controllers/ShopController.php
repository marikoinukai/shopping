<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Shop;
use App\Http\Requests\ShopRequest;

class ShopController extends Controller
{
      public function index()
    {
      $shops = Shop::with('product')->get();
      $categories = Category::all();
      $products = Product::all();

      return view('shop', compact('shops','categories','products'));
    }

    public function store(ShopRequest $request)
    {
        // 1. バリデーション済みの product_id と quantity を取得
        $validated = $request->validated();
        
        // 2. 商品価格を取得
        // \App\Models\Product は、ファイルの冒頭で use App\Models\Product; していれば Product::find() でOKです
        $product = Product::find($validated['product_id']);
        $price = $product ? $product->price : 0;
        
        // 3. 合計金額 (subtotal) をサーバー側で計算
        $subtotal = $price * $validated['quantity'];
        
        // 4. データベースに保存するデータを作成
        $data = [
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'subtotal' => $subtotal, // ★★★ 必ず計算結果を含める ★★★
        ];
        
        // 5. データベースに保存
        Shop::create($data);
        
        // 6. リダイレクト
        return redirect('/shop')->with('message', '商品をカートに入れました');
    }

    public function destroy(Request $request)
    {
      Shop::find($request->id)->delete();
      return redirect('/shop')->with('message', 'カートから商品を削除しました');
    } 
}