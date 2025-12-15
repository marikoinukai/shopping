<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>A-Shop</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/shop.css') }}" />
   <!-- <link rel="stylesheet" href="{{ asset('css/index.css') }}"> -->
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <a class="header__logo" href="/shop">A-Shop購入サイト</a>
        <nav>
         <ul class="header-nav">
           <li class="header-nav__item">
            <a class="header-nav__link" href="/">管理</a>
           </li>
         </ul>
        </nav>
      </div>  
    </div>
  </header>

  <main>
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
        <h2>購入商品</h2>
      </div>
      <form class="create-form" action="/shop" method="post">
        @csrf
        <div class="create-form__item">
          <label for="product_name" class="create-form__label">商品</label>
          <select class="create-form__item-input" name="product_id">
            <option value="">商品を選択してください</option>
            @foreach ($products as $product)
            <option value="{{ $product['id'] }}">
              {{ $product['product_name'] }} ({{ number_format($product['price']) }}円)
            </option>
            @endforeach
          </select>
          <label for="quantity" class="create-form__label">数量</label>
          <input 
            class="create-form__item-input2" 
            type="number" 
            name="quantity"
            value="{{ old('quantity') }}"
            placeholder="例: 3">
        </div>
        <div class="create-form__button">
          <button class="create-form__button-submit" type="submit">
            カートに入れる
          </button>
        </div>
      </form>
      <div class="section__title">
        <h2>カートの商品</h2>
      </div>
      <div class="product-table">
        <table class="product-table__inner">
          <tr class="product-table__row">
            <th class="product-table__header">
              <span class="product-table__header-span2">商品</span>
              <span class="product-table__header-span5">価格(円)</span> 
              <span class="product-table__header-span5">数量</span> 
              <span class="product-table__header-span4">合計(円)</span> 
            </th>
          </tr>
          @foreach ($shops as $shop)
          <tr class="product-table__row">
            <td class="product-table__item">
              <form class="update-form" action="/shop" method="POST">
                @method('PATCH')
                @csrf
                  <div class="update-form__item">
                    <input 
                      class="update-form__item-input" 
                      type="text" 
                      name="product_name" 
                      value="{{ $shop['product']['product_name'] }}"
                    />
                    <input type="hidden" name="id" value="{{ $product['id'] }}"/>
                  </div>
                  <div class="update-form__item">
                    <input 
                      class="update-form__item-input2" 
                      type="number" 
                      name="price" 
                      value="{{ $shop['product']['price'] }}"
                    />
                  </div>
                  <div class="update-form__item">
                    <input 
                      class="update-form__item-input2" 
                      type="number" 
                      name="quantity" 
                      value="{{ $shop['quantity']}}"
                    />
                  </div>
                  <div class="update-form__item">
                    <input 
                      class="update-form__item-input2" 
                      type="number" 
                      name="quantity" 
                      value="{{ $shop['subtotal']}}"
                    />
                  </div>
              </form>
            </td>
            <td class="product-table__item">
              <form class="delete-form" action="/shop/delete" method="POST">
                @method('DELETE')
                @csrf
                  <div class="delete-form__button">
                    <input type="hidden" name="id" value="{{$shop['id'] }}">
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
  </main>
</body>

</html>