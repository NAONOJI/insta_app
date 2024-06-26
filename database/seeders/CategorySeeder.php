<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; //represents the categories table

class CategorySeeder extends Seeder
{
    private $category;

    public function __construct(Category $category){
        $this->category = $category;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $categories = [
            [
                'name' => 'Poets',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'App',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Applicants',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Friends',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]
        ];

        $this->category->insert($categories);
    }
}
