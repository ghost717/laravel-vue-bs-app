<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Item::create([
            'name' => 'Produkt 1',
            'amount' => 4
        ]);
        App\Item::create([
            'name' => 'Produkt 2',
            'amount' => 12
        ]);
        App\Item::create([
            'name' => 'Produkt 3',
            'amount' => 0
        ]);
        App\Item::create([
            'name' => 'Produkt 4',
            'amount' => 6
        ]);
        App\Item::create([
            'name' => 'Produkt 5',
            'amount' => 2
        ]);
    }
}
