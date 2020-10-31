<?php

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            'high',
            'low',
            'rest'
        ];
        $data = [];
        foreach ($values as $value) {
            $data[] = [
                'slug' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Type::insert($data);
    }
}
