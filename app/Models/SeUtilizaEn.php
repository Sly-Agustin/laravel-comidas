<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeUtilizaEn extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id_utilizaen';

    public function receta(){
        return $this->belongsTo('App\Models\Receta', 'receta_id', 'id_receta');
    }
    public function ingrediente(){
        return $this->belongsTo('App\Models\Ingrediente', 'ingrediente_id', 'id_ingrediente');
    }
}
