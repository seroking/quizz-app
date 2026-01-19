<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    public function run(): void
    {
        Topic::truncate();

        Topic::create([
            'name' => 'Drawing Fundamentals',
            'description' => 'Basics of drawing and visual fundamentals',
        ]);
    }
}
