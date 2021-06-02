<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comida;

class ComidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comida::Truncate();

        $comida = new Comida;
        $comida->nombre='Pollo al curry';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='Pollo al champiñon';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='Pollo a la parrilla';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='Pollo al vino';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='Osobuco al vino';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='Fideos con tuco';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='Pasta primavera';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='Papas bravas';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='Papas con cheddar';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='Hamburguesa';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='Bife de chorizo con verduras salteadas';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='Sopa';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='Arroz con pollo';
        $comida->isVisible=true;
        $comida->save();
    }
}
