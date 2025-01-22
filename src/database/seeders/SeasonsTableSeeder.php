<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Carbonクラスをインポート

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // 外部キー制約を無効化
        //DB::table('seasons')->truncate(); // カテゴリーテーブルをトランケート
        //DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // 外部キー制約を再有効化

        $currentTimestamp = Carbon::now();

        $param = [
          'name' => '春',
          'created_at' => $currentTimestamp,
          'updated_at' => $currentTimestamp,
        ];
        DB::table('seasons')->insert($param);

        $param = [
          'name' => '夏',
          'created_at' => $currentTimestamp,
          'updated_at' => $currentTimestamp,
        ];
        DB::table('seasons')->insert($param);

        $param = [
          'name' => '秋',
          'created_at' => $currentTimestamp,
          'updated_at' => $currentTimestamp,
        ];
        DB::table('seasons')->insert($param);

        $param = [
          'name' => '冬',
          'created_at' => $currentTimestamp,
          'updated_at' => $currentTimestamp,
        ];
        DB::table('seasons')->insert($param);
    }
}
