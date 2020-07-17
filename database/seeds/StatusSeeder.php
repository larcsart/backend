<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'description' => 'Orçamento'
        ]);

        DB::table('status')->insert([
            'description' => 'Pedido'
        ]);
    }
}
