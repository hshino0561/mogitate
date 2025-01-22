@extends('layouts.app')
@section('title', '商品登録')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/03_products_reg.css') }}" />
@endsection

@section('content')
    <main class="container">
        <h2 class="form-title">商品登録</h2>
        <form class="product-form" action="/products/register" method="post" enctype="multipart/form-data">
            @csrf
            
            <!-- 商品名 -->
            <div class="form-group">
                <label for="product-name">商品名 <span class="required-label">必須</span></label>
                <input type="text" id="product-name" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <div class="error-message">
                        <p>{{ $errors->first('name') }}</p>
                    </div>
                @endif
            </div>

            <!-- 値段 -->
            <div class="form-group">
                <label for="price">値段 <span class="required-label">必須</span></label>
                <input type="number" id="price" name="price" placeholder="値段を入力" value="{{ old('price') }}">
                @if ($errors->has('price'))
                    <div class="error-message">
                        <p>{{ $errors->first('price') }}</p>
                    </div>
                @endif
            </div>

            <!-- 商品画像 -->
            <div class="form-group">
                <label for="product-image">商品画像 <span class="required-label">必須</span></label>
                    <img id="image-preview" src="#" alt="画像プレビュー" class="image-preview" style="display: none;">
                <div class="file-upload-wrapper">
                    <label for="file-upload" class="file-label">ファイルを選択</label>
                    <input type="file" id="file-upload" name="image" style="display: none;" onchange="updateImageDisplay()">
                    <p id="file-name" class="file-name">{{ old('image_name', $product->image ?? '') }}</p>
                    <input type="hidden" id="hidden-image-name" name="image_name" value="{{ old('image_name', $product->image ?? '') }}">
                </div>
                @if ($errors->has('image'))
                    <div class="error-message">
                        <p>{{ $errors->first('image') }}</p>
                    </div>
                @endif
                @if ($errors->has('reg_image'))
                    <div class="error-message">
                        <p>{{ $errors->first('reg_image') }}</p>
                    </div>
                @endif
            </div>

            <!-- 季節 -->
            <div class="form-group">
                <label>季節 <span class="required-label">必須</span><span class="info-label red-text">複数選択可</span></label>
                <div class="season-options">
                    <label class="custom-checkbox">
                        <input type="checkbox" name="season[]" value="1" {{ in_array(1, old('season', [])) ? 'checked' : '' }}>
                        <span class="checkmark"></span> 春
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" name="season[]" value="2" {{ in_array(1, old('season', [])) ? 'checked' : '' }}>
                        <span class="checkmark"></span> 夏
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" name="season[]" value="3" {{ in_array(1, old('season', [])) ? 'checked' : '' }}>
                        <span class="checkmark"></span> 秋
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" name="season[]" value="4" {{ in_array(1, old('season', [])) ? 'checked' : '' }}>
                        <span class="checkmark"></span> 冬
                    </label>
                </div>
                @if ($errors->has('season'))
                    <div class="error-message">
                        <p>{{ $errors->first('season') }}</p>
                    </div>
                @endif
            </div>

            <!-- 商品説明 -->
            <div class="form-group">
                <label for="description">商品説明 <span class="required-label">必須</span></label>
                <textarea id="description" name="description" rows="6" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            </div>
            @if ($errors->has('description'))
                <div class="error-message">
                    <p>{{ $errors->first('description') }}</p>
                </div>
            @endif

            <!-- ボタン -->
            <div class="form-buttons">
                <button type="button" class="btn cancel-btn" onclick="window.location.href='/products';">戻る</button>
                <button type="submit" class="btn submit-btn">登録</button>
            </div>
        </form>
    </main>
@endsection

@section('scripts')
    <script>
        function updateImageDisplay() {
            const input = document.getElementById('file-upload');
            const fileNameElement = document.getElementById('file-name');
            const imagePreviewElement = document.getElementById('image-preview');
            const file = input.files[0];
            fileNameElement.textContent = file ? file.name : '';

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreviewElement.src = e.target.result;
                    imagePreviewElement.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                imagePreviewElement.style.display = 'none';
            }
        }
    </script>
@endsection
