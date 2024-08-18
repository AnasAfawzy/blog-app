<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatgorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catgories = ['Food', 'Travel', 'Financial', 'Fashion'];
        foreach ($catgories as $catgory) {
            Category::create([
                'name' => $catgory
            ]);
        }
    }
}
