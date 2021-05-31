<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingrediente;

class IngredienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingrediente::Truncate();

        # Especias
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='sal';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='pimienta';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='pimienta negra';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='pimienta verde';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='pimienta blanca';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='pimienta rosa';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='pimenton';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='oregano';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='azucar';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='comino';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='azucar impalpable';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='sal del Himalaya';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='aji molido';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='curry';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='jengibre';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='ajo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='curcuma';
        $ingrediente->save();

        # Verduras y frutas
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='zapallo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='papa';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='batata';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='zanahoria';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='cebolla';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='cebolla morada';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='cebolla de verdeo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='morron colorado';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='morron amarillo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='morron verde';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='apio';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='puerro';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='aji vinagre';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='aji picante';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='lechuga';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='tomate';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='tomate redondo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='tomate perita';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='lechuga mantecosa';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='repollo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='manzana';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='manzana roja';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='manzana verde';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='naranja';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='limon';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='banana';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='platano';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='pomelo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='frutilla';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='cereza';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='kiwi';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='pepino';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='sandia';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='choclo';
        $ingrediente->save();

        # Carne de pollo
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='pollo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='pechuga de pollo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='pata de pollo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='ala de pollo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='rancho de pollo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='huesos de pollo';
        $ingrediente->save();

        # Carne de cerdo
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='bondiola de cerdo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='chuleta de cerdo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='panceta';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='panceta ahumada';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='panceta salada';
        $ingrediente->save();

        # Carne de vaca
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='osobuco';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='paleta de vaca';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='bife angosto';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='bife ancho';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='aguja';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='ojo de bife';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='asado de vaca';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='vacio';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='bola de lomo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='nalga de vaca';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='cuadril';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='falda';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='carne de vaca';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='matambre de vaca';
        $ingrediente->save();


        # Embutidos, fiambres y productos de origen animal
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='salchicha';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='chorizo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='salchicha parrillera';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='longaniza';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='fiambrin';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='queso';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='jamon cocido';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='jamon crudo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='queso cheddar';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='queso parmesano';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='queso reggianito';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='queso gouda';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='leche';
        $ingrediente->save();

        # Aceites
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='aceite de oliva';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='aceite neutro';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='aceite de girasol';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='aceite de coco';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='aceite de soja';
        $ingrediente->save();

        # Legumbres
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='poroto';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='lenteja';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='garbanzo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='mani';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='nuez';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='arveja';
        $ingrediente->save();

        # Alcohol
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='vino blanco';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='vino tinto';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='cerveza';
        $ingrediente->save();

        # Harinas
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='harina';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='harina de trigo';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='harina de maiz';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='maicena';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='polenta';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='harina 0000';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='harina 000';
        $ingrediente->save();

        # Fideos y arroces
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='arroz';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='fideos';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='fideos soperos';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='fideos de arroz';
        $ingrediente->save();
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='arroz yamani';
        $ingrediente->save();

        # Sin categoria
        $ingrediente = new Ingrediente;
        $ingrediente->nombre='leche de coco';
        $ingrediente->save();
    }
}
