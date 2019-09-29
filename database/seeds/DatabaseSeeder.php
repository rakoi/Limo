<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        factory(App\User::class,50)->create();
        factory(App\Post::class,50)->create();
        factory(App\Series::class,50)->create();
        factory(App\Watchlist::class,50)->create();
        
    }
}
