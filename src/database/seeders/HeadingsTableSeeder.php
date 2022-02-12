<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeadingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('headings')->insert([
            ['name' => 'школа і світ'],
            ['name' => 'мить слави'],
            ['name' => 'шкільні дива'],
            ['name' => 'а чому би і ні...'],
            ['name' => 'у тренді'],
        ]);
    }
}
