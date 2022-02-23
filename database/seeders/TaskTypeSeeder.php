<?php

namespace Database\Seeders;

use App\Models\TaskType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaskType::create([
            'name' => 'Kaynak'
        ]);

        TaskType::create([
            'name' => 'Boya'
        ]);

        TaskType::create([
            'name' => 'Montaj'
        ]);
    }
}
