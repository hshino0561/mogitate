<!-- <?php print_r($errors) ?> -->
@extends('layouts.app')
@section('title', '商品編集')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/02_products_detail.css') }}" />
@endsection

@section('content')
    <main class="container">
        <nav class="breadcrumb">
            <a href="/products">商品一覧</a> &gt; {{ $product->name }}
        </nav>

        <form class="product-form" action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <section class="product-edit">
                <div class="product-image">
                    <img id="product-img" src="{{ asset('storage/img/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="file-upload-wrapper">
                        <label for="file-upload" class="file-label">ファイルを選択</label>
                        <input type="file" id="file-upload" name="image" style="display: none;" onchange="updateImageDisplay()">
                        <p id="file-name" class="file-name">{{ $product->image }}</p>
                        <input type="hidden" id="new-image" name="new_image" value="{{ $product->image }}">
                    </div>
                    @if ($errors->has('image'))
                        <div class="error-message">
                            <p>{{ $errors->first('image') }}</p>
                        </div>
                    @endif
                    @if ($errors->has('new_image'))
                        <div class="error-message">
                            <p>{{ $errors->first('new_image') }}</p>
                        </div>
                    @endif
                </div>

                <div class="product-details">
                    <div class="form-group">
                        <label for="product-name">商品名</label>
                        <input type="text" id="product-name" name="name" value="{{ $product->name }}" placeholder="商品名を入力">
                        @if ($errors->has('name'))
                            <div class="error-message">
                                <p>{{ $errors->first('name') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="price">値段</label>
                        <input type="number" id="price" name="price" value="{{ $product->price }}" placeholder="値段を入力">
                        @if ($errors->has('price'))
                            <div class="error-message">
                                <p>{{ $errors->first('price') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>季節</label>
                        <div class="season-options">
                            @foreach ($seasons as $season)
                                <label class="custom-checkbox">
                                    <input type="checkbox" name="season[]" value="{{ $season->id }}" {{ in_array($season->id, $product->seasons->pluck('id')->toArray()) ? 'checked' : '' }}>
                                    <span class="checkmark"></span> {{ $season->name }}
                                </label>
                            @endforeach
                        </div>
                        @if ($errors->has('season'))
                            <div class="error-message">
                                <p>{{ $errors->first('season') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <div class="form-group">
                <label for="description">商品説明</label>
                <textarea id="description" name="description" rows="4" placeholder="商品の説明を入力">{{ $product->description }}</textarea>
            </div>
            @if ($errors->has('description'))
                <div class="error-message">
                    <p>{{ $errors->first('description') }}</p>
                </div>
            @endif

            <div class="form-buttons">
                <button type="button" class="btn cancel-btn" onclick="window.location.href='/products';">戻る</button>
                <button type="submit" class="btn save-btn">変更を保存</button>
        </form>

        <!-- 削除用のフォームを追加 -->
        <form id="delete-form" action="/products/{{ $product->id }}/delete" method="post">
            @csrf
            @method('delete')

                <div class="btn trash-btn" role="button" tabindex="0">
                    <img src="{{ asset('storage/img/Trash.png') }}" alt="Delete Icon" class="delete-icon">
                </div>
            </div>
        </form>
    </main>
@endsection

@section('scripts')
    <script>
        function updateImageDisplay() {
            const fileInput = document.getElementById('file-upload');
            const fileNameDisplay = document.getElementById('file-name');
            const imageDisplay = document.getElementById('product-img');
            const newImageInput = document.getElementById('new-image');  // 隠しフィールドを取得
            const file = fileInput.files[0];

            if (file) {
                fileNameDisplay.textContent = file.name;
                const reader = new FileReader();

                reader.onload = function(e) {
                    imageDisplay.src = e.target.result;
                }

                reader.onerror = function() {
                    console.error('File could not be read! Error code: ' + reader.error.code);
                    alert('エラーが発生しました。ファイルを読み込めませんでした。'); // エラーメッセージを表示
                    imageDisplay.src = ''; // エラー時に画像をクリア
                }

                reader.readAsDataURL(file);

                // 隠しフィールドに新しいファイル名を設定
                newImageInput.value = file.name;
            }
        }

        function submitDeleteForm(event) {
            event.preventDefault();
            if (confirm('本当に削除しますか？')) {
                document.getElementById('delete-form').submit();
            }
        }

        document.querySelector('.trash-btn').addEventListener('click', submitDeleteForm);
    </script>
@endsection
