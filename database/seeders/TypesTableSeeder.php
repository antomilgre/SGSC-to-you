<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            ['name' => 'social'],
            ['name' => 'trust'],
            ['name' => 'sport'],
            ['name' => 'activity'],
        ]);
    }
}
