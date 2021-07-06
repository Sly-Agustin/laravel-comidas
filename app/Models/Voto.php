<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id_voto';

    public function user(){
        return $this->belongsTo('App\Models\User', 'usuario_id');
    }
    public function receta(){
        return $this->belongsTo('App\Models\Receta', 'receta_id', 'id_receta');
    }
}
