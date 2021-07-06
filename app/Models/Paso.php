<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paso extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id_paso';

    public function receta(){
        return $this->belongsTo('App\Models\Receta', 'receta_id', 'id_receta');
    }
}
