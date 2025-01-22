<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品編集</title>
    <link rel="stylesheet" href="{{ asset('css/00_sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/02_products_detail.css') }}" />
</head>
<body>
    <header class="header">
        <h1 class="logo">mogitate</h1>
    </header>

    <main class="container">
        <nav class="breadcrumb">
            <a href="/products">商品一覧</a> &gt; {{ $product->name }}
        </nav>

        <section class="product-edit">
            <form class="product-form" action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')  <!-- LaravelのPUTメソッドを使用 -->

                <div class="product-image">
                    <img id="product-img" src="{{ asset('storage/img/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="file-upload-wrapper">
                        <label for="file-upload" class="file-label">ファイルを選択</label>
                        <input type="file" id="file-upload" name="image" style="display: none;" onchange="updateImageDisplay()">
                        <p id="file-name" class="file-name">{{ $product->image }}</p>
                        <!-- 隠しフィールドを追加して、ファイル名を保持 -->
                        <input type="hidden" id="new-image" name="new_image" value="{{ $product->image }}">
                    </div>
                </div>

                <div class="product-details">
                    <div class="form-group">
                        <label for="product-name">商品名</label>
                        <input type="text" id="product-name" name="name" value="{{ $product->name }}">
                    </div>

                    <div class="form-group">
                        <label for="price">値段</label>
                        <input type="number" id="price" name="price" value="{{ $product->price }}">
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
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">商品説明</label>
                    <textarea id="description" name="description" rows="4">{{ $product->description }}</textarea>
                </div>

                <div class="form-buttons">
                    <button type="button" class="btn cancel-btn" onclick="window.location.href='/products';">戻る</button>
                    <button type="submit" class="btn save-btn">変更を保存</button>
                </div>
            </form>

            <!-- 削除用のフォームを追加 -->
            <form id="delete-form" action="{{ route('products.destroy', $product->id) }}" method="post" style="display: none;">
                @csrf
                @method('delete')

            <div class="btn trash-btn" role="button" tabindex="0" onclick="submitDeleteForm()">
                <img src="{{ asset('img/Trash.png') }}" alt="Delete Icon" class="delete-icon">
            </div>
            </form>
        </section>
    </main>

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

                reader.readAsDataURL(file);

                // 隠しフィールドに新しいファイル名を設定
                newImageInput.value = file.name;
            }
        }

        function submitDeleteForm() {
            event.preventDefault();
            if (confirm('本当に削除しますか？')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</body>
</html>
