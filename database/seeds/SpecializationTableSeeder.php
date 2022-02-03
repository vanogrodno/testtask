<?php

use Illuminate\Database\Seeder;

class SpecializationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->insert([
            'title' => 'Первая специализация',
        ]);
        DB::table('specializations')->insert([
            'title' => 'Вторая специализация',
        ]);
    }
}
