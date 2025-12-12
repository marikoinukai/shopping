<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>A-Shop</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/shop.css') }}" />
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <a class="header__logo" href="/">Shopping</a>
        <nav>
         <ul class="header-nav">
           <li class="header-nav__item">
            <a class="header-nav__link" href="/categories">カテゴリ一覧</a>
           </li>
         </ul>
        </nav>
      </div>  
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>

</html>


<!-- @extends('layouts.app') -->

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="product__alert">
  @if(session('message'))
  <div class="product__alert--success">
     {{ session('message') }}
  </div>
  @endif
   @if ($errors->any())
   <div class="product__alert--danger">
     <ul>
       @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
       @endforeach
       </ul>
     </div>
   @endif
</div>

<div class="product__content">
   <div class="section__title">
   <h2>商品登録</h2>
 </div>
  <form class="create-form" action="/products" method="post">
  @csrf
    <div class="create-form__item">
      <label for="product_name" class="create-form__label">商品</label>
      <input 
        class="create-form__item-input" 
        type="text" 
        name="product_name"
        value="{{ old('product_name') }}"
        placeholder="例: 牛乳">
    

      <label for="price" class="create-form__label">価格</label>
      <input 
        class="create-form__item-input2" 
        type="number" 
        name="price"
        value="{{ old('price') }}"
        placeholder="例: 350">
        
        <select class="create-form__item-select" name="category_id">
           <option value="">カテゴリ</option>
             @foreach ($categories as $category)
                 <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
             @endforeach
     </select>
    </div>
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">
        登録
      </button>
    </div>
  </form>
  <div class="section__title">
   <h2>商品検索</h2>
 </div>
 <form class="search-form" action="/products/search" method="get">
     @csrf
   <div class="search-form__item">
    <label for="product_name" class="create-form__label">商品</label>
     <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}"
     placeholder="例: 牛乳">
     <label for="price" class="create-form__label">価格</label>
     <input class="search-form__item-input2" type="number" name="price" value="{{ old('price') }}"
     placeholder="例: 350">
     <select class="search-form__item-select" name="category_id">
       <option value="">カテゴリ</option>
           @foreach ($categories as $category)
           <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
           @endforeach
     </select>
   </div>
   <div class="search-form__button">
     <button class="search-form__button-submit" type="submit">
      検索
    </button>
   </div>
 </form>
  <div class="product-table">
    <table class="product-table__inner">
      <tr class="product-table__row">
        <th class="product-table__header">
         <span class="product-table__header-span">商品</span>
         <span class="product-table__header-span2">価格(円)</span> 
         <span class="product-table__header-span3">カテゴリ</span> 
       </th>
      </tr>
      @foreach ($products as $product)
      <tr class="product-table__row">
        <td class="product-table__item">
          <form class="update-form" action="/products/update" method="POST">
              @method('PATCH')
              @csrf
            <div class="update-form__item">
                  <input 
                    class="update-form__item-input" 
                    type="text" 
                    name="product_name" 
                    value="{{ $product['product_name'] }}"
                  />
                 <input type="hidden" name="id" value="{{ $product['id'] }}"/>
            </div>
            <div class="update-form__item">
                  <input 
                    class="update-form__item-input2" 
                    type="number" 
                    name="price" 
                    value="{{ $product['price'] }}"
                  />
                 <!-- <input type="hidden" name="id" value="{{ $product['id'] }}"/> -->
            </div>
            <div class="update-form__item">
             <p class="update-form__itme-p">{{ $product['category']['name'] }}</p>
           </div>
            <div class="update-form__button">
              <button class="update-form__button-submit" type="submit">
                更新
              </button>
            </div>
          </form>
        </td>
        <td class="product-table__item">
          <form class="delete-form" action="/products/delete" method="POST">
              @method('DELETE')
              @csrf
            <div class="delete-form__button">
               <input type="hidden" name="id" value="{{ $product['id'] }}">
              <button class="delete-form__button-submit" type="submit">
                削除
              </button>
            </div>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
