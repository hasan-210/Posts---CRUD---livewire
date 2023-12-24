<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'BackeEnd'
        ]);

        Category::create([
            'name' => 'FrontEnd'
        ]);

        Category::create([
            'name' => 'FullStack'
        ]);
    }
}
