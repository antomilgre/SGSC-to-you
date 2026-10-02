<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title'   => 'History',
                'slug'    => 'history',
                'content' => 'History of St. George Sports Club.',
            ],
            [
                'title'   => 'Mission',
                'slug'    => 'mission',
                'content' => 'Our mission is to develop sports culture.',
            ],
            [
                'title'   => 'Vision',
                'slug'    => 'vision',
                'content' => 'Our vision is to inspire young athletes.',
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
