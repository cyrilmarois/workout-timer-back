<?php

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        foreach($values as $value) {
            $now = now()->toDateTimeLocalString();
            $data[] = [
                'slug' => $value,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }
        Type::insert($data);
    }
}
