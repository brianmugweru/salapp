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
        $normal = factory(App\User::class,50)->create(['role'=>'normal']);

        $salon = factory(App\User::class,6)->create()->each(function($u){
            $u->salon()->save(factory(App\Salon::class)->make());
        });

    }
}
