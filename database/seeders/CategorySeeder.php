<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = fake()->date('Y-m-d h:m:s');
        $data = [
            'Technology category',
            'Sports category',
            'Fashion category',
        ];
        foreach ($data as $item) {
            Category::create([
                'name' => $item,
                'slug' => Str::slug($item),
                'status' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ]);
        }
    }
}
