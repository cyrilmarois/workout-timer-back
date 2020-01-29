<?php

use App\Models\Sound;
use Illuminate\Database\Seeder;

class SoundTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $path = public_path('storage');
        $files = array_values(array_diff(scandir($path),[
            '.', '..', '.DS_Store', '.gitignore'
        ]));
        foreach($files as $i => $file) {
            $now = now()->toDateTimeLocalString();
            if (is_readable($path.DIRECTORY_SEPARATOR.$file)) {
                $index = $i+1;
                $data[] = [
                    'name' => 'sound '.$index,
                    'filename' => $file,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }
        }

        Sound::insert($data);
    }
}
