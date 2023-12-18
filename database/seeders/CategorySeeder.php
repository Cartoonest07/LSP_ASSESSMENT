<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Bass',
            'Electric Bass',
            'Bass Effect',
            'Guitar',
            'Electric Guitar',
            'Guitar Effect',
            'Drumset',
            'Electric Drum',
            'Piano',
            'Electric Keyboard',
            'Recorder',
            'Sound System',
            'Microphone',
            'Ear Monitor',
        ];

        foreach ($categories as $category) {
            DB::table('category')->insert([
                'name' => $category,
            ]);
        }
    }
}
