<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Models\Category;

class ProductController extends Controller
{
       public function index()
      {
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('index', compact('products', 'categories'));
      }

      public function store(ProductRequest $request)
      {
        $product = $request->only(['category_id', 'product_name']);
        Product::create($product);
        return redirect('/')->with('message', '商品を登録しました');
      }

      public function update(ProductRequest $request)
      {
        $product = $request->only(['product_name']);
        Product::find($request->id)->update($product);
        return redirect('/')->with('message', '商品を修正しました');
      }

      public function destroy(Request $request)
      {
        Product::find($request->id)->delete();
        return redirect('/')->with('message', 'Productを削除しました');
      }

      public function search(Request $request)
      {
        $products = Product::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
        $categories = Category::all();

        return view('index', compact('products', 'categories'));
      }
}
