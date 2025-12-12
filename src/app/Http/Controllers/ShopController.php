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
      $shops = Category::all();
      $shops = Product::all();
      return view('index', compact('shops', 'products'));
    }
}
