<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id_receta';

    public function user(){
        return $this->belongsTo('App\Models\User', 'usuario_id');
    }
    public function comida(){
        return $this->belongsTo('App\Models\Comida', 'comida_id', 'id_comida');
    }
}
