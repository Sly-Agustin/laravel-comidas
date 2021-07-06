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
        $comida->nombre='pollo al curry';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='pollo al champiñon';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='pollo a la parrilla';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='pollo al vino';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='osobuco al vino';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='fideos con tuco';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='pasta primavera';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='papas bravas';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='papas con cheddar';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='hamburguesa';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='bife de chorizo con verduras salteadas';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='sopa';
        $comida->isVisible=true;
        $comida->save();
        $comida = new Comida;
        $comida->nombre='arroz con pollo';
        $comida->isVisible=true;
        $comida->save();
    }
}
