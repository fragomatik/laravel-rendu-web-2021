<?php

use Illuminate\Database\Seeder;

class CommentariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Commentary::class, 90)->create();
    }
}
