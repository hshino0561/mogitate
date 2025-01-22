<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // これを追加
use App\Models\Product;
use App\Models\Season;
use App\Http\Controllers\ProductController;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
      // productsテーブルから全データを取得
      // $products = Product::all();
      $products = Product::query();

          /* ページネーション */
          $products = $products->Paginate(6);

          // ビューにデータを渡す
          return view('01_index', compact('products'));
    }

    public function search(Request $request)
    {
      /* キーワードから検索処理 */
      $search_key = $request->input('name');

      // モデルクエリビルダーを初期化
      $products = Product::query();

      //$keyword　が空ではない場合、検索処理を実行します
      if (!empty($search_key)) {
          $products->where(function($query) use ($search_key) {
              $query->where('name', 'LIKE', "%{$search_key}%");
          });
      }

      /* ページネーション */
      $products = $products->Paginate(6);

      // ビューにデータを渡す
      return view('01_index', compact('products'));
   }

    public function detail_show($id)
    {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all(); // product_season テーブルからすべてのシーズンを取得

        return view('02_products_detail', compact('product', 'seasons'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        // バリデーション後のデータを使用
        $validatedData = $request->validated();

        // フォームデータの更新
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        // 画像のアップロードと保存(変更用)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $request->input('new_image'); // 隠しフィールドからファイル名を取得
            $filePath = $file->storeAS('public/img', $fileName);
            $product->image = $fileName;
        }

        // 季節の更新
        $product->seasons()->sync($request->input('season', []));

        // データベースに保存
        $product->save();

        return redirect()->route('products.index')->with('success', '商品が更新されました');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // 画像を削除する場合
        if ($product->image) {
            Storage::delete('public/images/' . $product->image);
        }

        // 商品を削除
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品が削除されました');
    }

    public function reg_show()
    {
      // ビューにデータを渡す
          return view('03_products_reg');
    }

    public function store(ProductRequest $request)
    {
        // バリデーション後のデータを使用
        $validatedData = $request->validated();

        // 新しい商品を作成
        $product = new Product;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        // 画像のアップロードと保存
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName(); // 元のファイル名を取得
            $extension = $file->getClientOriginalExtension(); // ファイルの拡張子を取得
            $timestmp = date('Ymd_His'); // 年月日_時分秒 の形式でタイムスタンプを取得
            $fileName = pathinfo($originalName, PATHINFO_FILENAME) . '_' . $timestmp . '.' . $extension;
            $filePath = $file->storeAs('public/img', $fileName);
            $product->image = basename($filePath);
        } else {
            // 画像がアップロードされていない場合、.pngを設定
            $product->image = '.png';
        }

        // データベースに保存
        $product->save();

        // 季節情報の事後紐づけ(同期)
        $seasons = $request->input('season');
        $product->seasons()->sync($seasons);
        
        return redirect()->route('products.index')->with('success', '商品が登録されました');
    }    
}
