@extends('layouts.app')
@section('title', '商品一覧')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/01_index.css') }}" />
@endsection

@section('content')
    <main class="container">
        <aside class="sidebar">
            <h2>商品一覧</h2>
            <div class="search-box">
                <form action="/products/search" method="get" class="search-form">
                  @csrf
                  <input type="text" name="name" placeholder="商品名で検索">
                    <button type="submit" class="search-button">検索</button>
                </form>
            </div>
            <div class="filter-box">
                <label for="price-sort">価格順で表示</label>
                <select id="price-sort">
                    <option value="">価格で並べ替え</option>
                </select>
            </div>
        </aside>

        <div class="content">
            <div class="product-header">
                <button type="button" class="add-product-btn" onclick="window.location.href='{{ route('products.register') }}';">+ 商品を追加</button>
            </div>

            <div class="product-grid">
                <!-- 商品カード -->
                @foreach ($products as $productId)
                    <div class="product-card">
                        <a href="/products/{{ $productId->id }}">
                            <img src="{{ asset('storage/img/' . $productId->image) }}" alt="{{ $productId->name }}">
                        </a>
                        <p class="product-name">{{ $productId->name }}</p>
                        <p class="product-price">&yen;{{ $productId->price }}</p>
                    </div>
                @endforeach
            </div>

            <div class="pagination">
                <nav aria-label="Page navigation">
                    {{ $products->links('vendor.pagination.custom') }}
                </nav>
            </div>
        </div>
@endsection

@section('scripts')
    <script>
        // 商品一覧ページ固有のスクリプト
        //console.log('商品一覧ページのスクリプトが読み込まれました');
    </script>
@endsection
