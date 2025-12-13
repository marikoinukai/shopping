<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Shop;

class ShopController extends Controller
{
      public function index()
    {
      $shops = Shop::with('product')->get();
      $categories = Category::all();
      $products = Product::all();
      return view('shop', compact('categories','products'));
    }
}
