<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{

    protected $table = 'docente';

    protected $fillable = [
        'cod_persona',
        'activo'
    ];

    protected $attributes = array(
       'deleted' => 0,
    );

    // Un Docente pertence a un persona
    public function persona()
    {
      return $this->belongsTo('App\Persona', 'cod_persona');
    }

}