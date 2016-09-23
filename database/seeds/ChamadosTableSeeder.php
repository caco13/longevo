<?php

use Illuminate\Database\Seeder;

class ChamadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Chamado::class, 30)->create();
    }
}
